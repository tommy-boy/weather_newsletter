#!/usr/local/bin/php -q
<?
/* UNUSABLE until we enable multilanguage support in our php setup - eric.brown@pni.com
				define(LC_TIME,"LC_TIME");
				setlocale (LC_TIME,"Spanish");
*/

// Generate the include for the weather forecast table used on AZCentral  (including the Lavoz (spanish)  version ) 
// eric.brown@pni.com
include("/projects/weather/admin/includes/mysql_connect.inc");
include("/projects/weather/admin/includes/lib.inc");

function sync_file($from,$to)  {
  //echo "Transmitting $to<br>\n";
  
  if (!$ftp = ftp_connect("ftp1"))  return false;
  if (!ftp_login($ftp, "cronuser", "black1"))  return false;
  if (!ftp_put($ftp, $to, $from, FTP_ASCII))  return false;
  if (!ftp_quit($ftp))  return false;

  return true;
}

$Days = Array();
$Days[] = Array();

$Languages = Array();
$Languages[0] = Array();
$Languages[0]['Name'] = "English";
$Languages[0]['ImagePath'] = "/weather/images2/"; 
$Languages[0]['Header'] = "Metro Phoenix forecast";
$Languages[0]['Filename'] = "/www_live/azc/htdocs/weather/incs/ForecastTable.inc";
$Languages[0]['FilenameTemp'] = "/www_live/azc/htdocs/weather/incs/ForecastTable.inc.tmp";
$Languages[0]['Tablename'] = "narrative";
$Languages[0]['Template'] = "/data/projects/weather/bin/forecast_table.template";
$Languages[1] = Array();
$Languages[1]['Name'] = "Spanish";
$Languages[1]['ImagePath'] = "/lavoz/clima/images/"; 
$Languages[1]['Header'] = "Pronóstico del clima para el área metropolitana de Phoenix";
$Languages[1]['Filename'] = "/www_live/azc/htdocs/lavoz/clima/includes/ForecastTable.inc";
$Languages[1]['FilenameTemp'] = "/www_live/azc/htdocs/lavoz/clima/includes/ForecastTable.inc.tmp";
$Languages[1]['Tablename'] = "narrative_spanish";
$Languages[1]['Template'] = "/data/projects/weather/bin/forecast_table.template";

# Adding the 12 News current.
$Languages[2] = Array();
$Languages[2]['Name'] = "English";
$Languages[2]['ImagePath'] = "/weather/images2/"; 
$Languages[2]['Header'] = "Metro Phoenix forecast";
$Languages[2]['Filename'] = "/www_live/azc/htdocs/weather/incs/12_2day_current.inc";
$Languages[2]['FilenameTemp'] = "/www_live/azc/htdocs/weather/incs/12_2day_current.inc.tmp";
$Languages[2]['Tablename'] = "narrative";
$Languages[2]['Template'] = "/data/projects/weather/bin/12_2day_current.template";
# Adding the 12 news next day.
$Languages[3] = Array();
$Languages[3]['Name'] = "English";
$Languages[3]['ImagePath'] = "/weather/images2/"; 
$Languages[3]['Header'] = "Metro Phoenix forecast";
$Languages[3]['Filename'] = "/www_live/azc/htdocs/weather/incs/12_2day_next.inc";
$Languages[3]['FilenameTemp'] = "/www_live/azc/htdocs/weather/incs/12_2day_next.inc.tmp";
$Languages[3]['Tablename'] = "narrative";
$Languages[3]['Template'] = "/data/projects/weather/bin/12_2day_next.template";
$LanguageCount = count($Languages);

$Translate = Array();
$Translate['Mon'] = "Lun.";
$Translate['Tue'] = "Mar.";
$Translate['Wed'] = "Mi&eacute;r.";
$Translate['Thu'] = "Jue.";
$Translate['Fri'] = "Vie.";
$Translate['Sat'] = "S&aacute;b.";
$Translate['Sun'] = "Dom.";

for($i=0;$i<$LanguageCount;$i++){
  $tmpTemplate = join("",file($Languages[$i]['Template']));
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
	while($r = mysql_fetch_object($res)){
		$hi_to_replace = "REPLACE_DAY".$count."_HI";
		$lo_to_replace = "REPLACE_DAY".$count."_LO";
		$dayname_to_replace = "REPLACE_DAY".$count."_DAYNAME";
		$myImage_to_replace = "REPLACE_DAY".$count."_IMAGE";

	  $tmpTemplate = str_replace($hi_to_replace,$r->hi,$tmpTemplate);
	  $tmpTemplate = str_replace($lo_to_replace,$r->lo,$tmpTemplate);
	  $tmpTemplate = str_replace($myImage_to_replace,$Languages[$i]['ImagePath'].$r->condition,$tmpTemplate);
		
    if($Languages[$i]['Name'] == "Spanish") {
				$tmpTemplate= str_replace($dayname_to_replace,$Translate[date("D",strtotime($r->day_id))],$tmpTemplate);	
	  }	
    else {
	  	$tmpTemplate = str_replace($dayname_to_replace,date("D",strtotime($r->day_id)),$tmpTemplate);
    }
		$count++;
	}

	if($Languages[$i]["Name"] == "English")
		$tmpTemplate = str_replace("REPLACE_NARRATIVE",$narrative,$tmpTemplate);
	else
		$tmpTemplate = str_replace("REPLACE_NARRATIVE","<span class=\"sidebar\"><span class=\"story\"><b>Temperaturas actuales:</b></span><br><!--#include virtual=\"/incs/currtemps.inc\" -->",$tmpTemplate);
	$tmpTemplate = str_replace("REPLACE_HEADER", $Languages[$i]['Header'],$tmpTemplate);

	if($Languages[$i]["Name"] == "English")
		$tmpTemplate = str_replace("REPLACE_NARRATIVE",$narrative,$tmpTemplate);
	else
		$tmpTemplate = str_replace("REPLACE_NARRATIVE","<span class=\"sidebar\"><span class=\"story\"><b>Temperaturas actuales:</b></span><br><!--#include virtual=\"/incs/currtemps.inc\" -->",$tmpTemplate);
	$tmpTemplate = str_replace("REPLACE_HEADER", $Languages[$i]['Header'],$tmpTemplate);
  echo $tmpTemplate;
  echo "----------------------------------------------------------------------------\n";
	echo "Publishing ".$Languages[$i]['FilenameTemp'] . ".........\n";
  echo "----------------------------------------------------------------------------\n";
	$fp = fopen($Languages[$i]['FilenameTemp'],"w+");
	fputs($fp,$tmpTemplate);
  fclose($fp);
	sync_file($Languages[$i]['FilenameTemp'],$Languages[$i]['Filename']);
	unlink($Languages[$i]['FilenameTemp']);
}
?>
