#!/usr/local/bin/php -q
<?
/* *** Creates the Weather Newsletters *** */

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
$Languages[0]['ImagePath'] = "http://www.azcentral.com/weather/imgs/icons/"; 
$Languages[0]['FileName'] = "/apps/generated/weather/generated/newsletter_forecast.inc";
$Languages[0]['FilenameTemp'] = "/apps/generated/weather/generated/newsletterforecast.inc.tmp";
$Languages[0]['Template'] = "/data/projects/weather/bin/newsletter_forecast.template";
$LanguageCount = count($Languages);

for($i=0;$i<$LanguageCount;$i++){
  $tmpTemplate = join("",file($Languages[$i]['Template']));
	$sql = "SELECT narrative FROM narrative WHERE id='1'";
	$res = mysql_query($sql);
	$r = mysql_fetch_object($res);
	print_r($r);
	echo mysql_error();
	$narrative = $r->narrative;
	unset($sql);
	unset($res);
	unset($r);
	$sql = "SELECT * FROM tool_forecast ORDER BY day_id LIMIT 0,7";
	$res = mysql_query($sql);
	$count = 0;
	while($r = mysql_fetch_object($res)){
		$hi_to_replace = "REPLACE_DAY".$count."_HI";
		$lo_to_replace = "REPLACE_DAY".$count."_LO";
		$dayname_to_replace = "REPLACE_DAY".$count."_DAYNAME";
		$myImage_to_replace = "REPLACE_DAY".$count."_IMAGE";
		$tmpTemplate = str_replace($hi_to_replace,$r->hi,$tmpTemplate);
		$tmpTemplate = str_replace($lo_to_replace,$r->lo,$tmpTemplate);
		$tmpImage = substr_replace($r->condition,'.png',-4);
		$tmpTemplate = str_replace($myImage_to_replace,$Languages[$i]['ImagePath'].$tmpImage,$tmpTemplate);
		$tmpTemplate = str_replace($dayname_to_replace,date("D",strtotime($r->day_id)),$tmpTemplate);
		$count++;
	}
	$tmpTemplate = str_replace("REPLACE_NARRATIVE",$narrative,$tmpTemplate);
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
