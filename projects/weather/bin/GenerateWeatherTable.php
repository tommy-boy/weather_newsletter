#!/usr/local/bin/php -q
<?
/* UNUSABLE until we enable multilanguage support in our php setup - eric.brown@pni.com
				define(LC_TIME,"LC_TIME");
				setlocale (LC_TIME,"Spanish");
*/

// Generate the include for the weather forecast table used on AZCentral  (including the Lavoz (spanish)  version ) 
// eric.brown@pni.com
include("/www/process/weather/weather_tool/includes/mysql_connect.inc");
include("/www/process/weather/weather_tool/includes/lib.inc");

function sync_file($from,$to)  {
  //echo "Transmitting $to<br>\n";
  
  if (!$ftp = ftp_connect("ftp1"))  return false;
  if (!ftp_login($ftp, "cronuser", "black1"))  return false;
  if (!ftp_put($ftp, $to, $from, FTP_ASCII))  return false;
  if (!ftp_quit($ftp))  return false;

  return true;
}

$Languages = Array();
$Languages[0] = Array();
$Languages[0]['Name'] = "English";
$Languages[0]['ImagePath'] = "/weather/images2/"; 
$Languages[0]['Header'] = "Metro Phoenix forecast";
$Languages[0]['Filename'] = "/www_live/azc/htdocs/weather/includes2/weatherdata.js";
$Languages[0]['FilenameTemp'] = "/www_live/azc/htdocs/weather/includes2/weatherdata.js.tmp";
$Languages[0]['Tablename'] = "narrative";
$Languages[1] = Array();
$Languages[1]['Name'] = "Spanish";
$Languages[1]['ImagePath'] = "/lavoz/clima/images/"; 
$Languages[1]['Header'] = "Pronóstico del clima para el área metropolitana de Phoenix";
$Languages[1]['Filename'] = "/www_live/azc/htdocs/lavoz/clima/includes/weatherdata.js";
$Languages[1]['FilenameTemp'] = "/www_live/azc/htdocs/lavoz/clima/includes/weatherdata.js.tmp";
$Languages[1]['Tablename'] = "narrative_spanish";

$LanguageCount = count($Languages);

$Translate = Array();
$Translate['Mon'] = "Lun";
$Translate['Tue'] = "Mar";
$Translate['Wed'] = "Mi&eacute;";
$Translate['Thu'] = "Jue";
$Translate['Fri'] = "Vie";
$Translate['Sat'] = "S&aacute;b";
$Translate['Sun'] = "Dom";

for($i=0;$i<$LanguageCount;$i++){
	$sql = "SELECT narrative from ".$Languages[$i]['Tablename']." WHERE id='1'";
	$res = mysql_query($sql);
	$r = mysql_fetch_object($res);
	echo mysql_error();
	$narrative = $r->narrative;
	unset($sql);
	unset($res);
	unset($r);
	$sql = "SELECT * from tool_forecast order by day_id LIMIT 7";
	$res = mysql_query($sql);
	$count = 0;
	$output = "Days = new Array();\n";
	while($r = mysql_fetch_object($res)){
		$output .= "Days[$count] = new Array();\n";
		$output .= "Days[$count][\"hi\"] = $r->hi;\n";
		$output .= "Days[$count][\"lo\"] = $r->lo;\n";
		$output .= "Days[$count][\"name\"] = '";
		if($Languages[$i]['Name'] == "Spanish")
			$output .= $Translate[date("D",strtotime($r->day_id))];	
		else
			$output .= date("D",strtotime($r->day_id));
		$output .= "';\n";
		$output .= "Days[$count][\"image\"] = '".$Languages[$i]['ImagePath'].$r->condition."';\n";
		$count++;
	}
	if($Languages[$i]["Name"] == "English")
		$output .= "var Narrative = '".str_replace("'","&sbquo;",$narrative)."';\n";
	$output .= "var Header = '".$Languages[$i]['Header']."';\n";
	$fp = fopen($Languages[$i]['FilenameTemp'],"w+");
	fputs($fp,$output);
	fclose($fp);
	sync_file($Languages[$i]['FilenameTemp'],$Languages[$i]['Filename']);
	unlink($Languages[$i]['FilenameTemp']);
	echo $output;
	mysql_data_seek($res,0);

}



?>