#!/usr/local/bin/php -q
<?
/* *** Updates the "TODAY" details on the weather page *** */

include("/projects/weather/admin/includes/mysql_connect.inc");
include("/projects/weather/admin/includes/lib.inc");

function sync_file($from,$to)  {
  //echo "Transmitting $to<br>\n";

  #if (!$ftp = ftp_connect("ftp1"))  return false;
  #if (!ftp_login($ftp, "cronuser", "black1"))  return false;
  #if (!ftp_put($ftp, $to, $from, FTP_ASCII))  return false;
  #if (!ftp_quit($ftp))  return false;

  #return true;
}

$Days = Array();
$Days[] = Array();

$Languages = Array();
$Languages[0] = Array();
$Languages[0]['Name'] = "English";
$Languages[0]['ImagePath'] = "/weather/imgs/icons/";
//$Languages[0]['Header'] = "Metro Phoenix forecast";
$Languages[0]['FileName'] = "/apps/generated/weather/generated/v8_weathertoday.inc";
$Languages[0]['FilenameTemp'] = "/apps/generated/weather/generated/v8_ForecastToday.inc.tmp";
$Languages[0]['Template'] = "/apps/projects/weather/bin/v8_weathertoday.template";
$LanguageCount = count($Languages);

for($i=0;$i<$LanguageCount;$i++){
  $tmpTemplate = join("",file($Languages[$i]['Template']));
	$sql = "SELECT * FROM tool_forecast ORDER BY day_id LIMIT 0,1";
	$res = mysql_query($sql);
	$r = mysql_fetch_object($res);
	$hi_to_replace = "REPLACE_DAY_HI";
	$lo_to_replace = "REPLACE_DAY_LO";
	$temp_to_replace = "REPLACE_TEMPERATURE";
	$myImage_to_replace = "REPLACE_DAY_IMAGE";

	$tmpTemplate = str_replace($hi_to_replace,$r->hi,$tmpTemplate);
	$tmpTemplate = str_replace($lo_to_replace,$r->lo,$tmpTemplate);
	//Do this fix for png images
	$tmpImage=substr_replace($r->condition,'.png',-4);
	$tmpTemplate = str_replace($myImage_to_replace,$Languages[$i]['ImagePath'].$tmpImage,$tmpTemplate);
	//Do this to get the current temps that is used on homepage
	$curTemp=ltrim(strip_tags(file_get_contents("/apps/generated/generated/phxtemperature.txt")),'|');
	$tmpTemplate = str_replace($temp_to_replace,trim($curTemp),$tmpTemplate);
	echo $tmpTemplate;
  echo "----------------------------------------------------------------------------\n";
	echo "Publishing ".$Languages[$i]['FilenameTemp'] . ".........\n";
  echo "----------------------------------------------------------------------------\n";
  $filename=$Languages[$i]['FileName'];
  file_put_contents_if_diff($filename,$tmpTemplate);
  `/bin/nice -n19 /usr/bin/rsync -aq --bwlimit=1000 $filename content:$filename >/dev/null 2>&1`;
}
exit;

function file_put_contents_if_diff($filename,$contents) {
  if ( $contents !== @file_get_contents($filename) ) {
    $dirname = dirname($filename);
    if (!is_dir($dirname)) {
      if (!@mkdir($dirname,0775,true)) {
        print "cannot mkdir $dirname\n";
        return false;
      }
    }
    if (false!==@file_put_contents($filename,$contents)) {
      #log_for_sync($filename);
    } else {
      print "cannot write $filename\n";
    }
  }
}
?>
