#!/usr/local/bin/php -q
<?
/* *** Updates the "6-Day" forecast details on the weather page *** */

include("/projects/weather/admin/includes/mysql_connect.inc");
if (!defined("DBCONNECTION"))  {
  exit; // used to write template version of file when no connection
}
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
$Languages[0]['ImagePath'] = "http://i.azcentral.com/weather/imgs/icons/"; 
$Languages[0]['Header'] = "Metro Phoenix forecast";
#$Languages[0]['FileName'] = "/apps/dev/www.azcentral.com/htdocs/generated/weatherpage_forecast.inc";
#$Languages[0]['FilenameTemp'] = "/apps/dev/www.azcentral.com/htdocs/generated/ForecastTable.inc.tmp";
$Languages[0]['FileName'] = "/apps/generated/weather/generated/weatherpage_forecast.inc";
$Languages[0]['FilenameTemp'] = "/apps/generated/weather/generated/ForecastTable.inc.tmp";
$Languages[0]['TableName'] = "narrative";
$Languages[0]['Template'] = "/apps/projects/weather/bin/redesign_mainforecast_table.template";
$LanguageCount = count($Languages);

for($i=0;$i<$LanguageCount;$i++){
  $tmpTemplate = join("",file($Languages[$i]['Template']));
	$sql = "SELECT narrative FROM ".$Languages[$i]['TableName']." WHERE id='1'";
	$res = mysql_query($sql);
	$r = mysql_fetch_object($res);
	print_r($r);
	echo mysql_error();
	$narrative = $r->narrative;
	unset($sql);
	unset($res);
	unset($r);
	$sql = "SELECT * FROM tool_forecast ORDER BY day_id LIMIT 1,6";
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
	  $tmpTemplate = str_replace($dayname_to_replace,date("D",strtotime($r->day_id)),$tmpTemplate);
	  $count++;
	}
	$tmpTemplate = str_replace("REPLACE_NARRATIVE",$narrative,$tmpTemplate);
	$tmpTemplate = str_replace("REPLACE_HEADER", $Languages[$i]['Header'],$tmpTemplate);
	#$tmpTemplate = str_replace("REPLACE_NARRATIVE",$narrative,$tmpTemplate);
	#$tmpTemplate = str_replace("REPLACE_HEADER", $Languages[$i]['Header'],$tmpTemplate);
  echo $tmpTemplate;
  echo "----------------------------------------------------------------------------\n";
	echo "Publishing ".$Languages[$i]['FilenameTemp'] . ".........\n";
  echo "----------------------------------------------------------------------------\n";
	$fp = fopen($Languages[$i]['FilenameTemp'],"w+");
	fputs($fp,$tmpTemplate);
  fclose($fp);
	sync_file($Languages[$i]['FilenameTemp'],$Languages[$i]['FileName']);
	unlink($Languages[$i]['FilenameTemp']);
}
?>
