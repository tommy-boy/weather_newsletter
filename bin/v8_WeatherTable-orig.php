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
$Languages[0]['ImagePath'] = "/weather/imgs/icons/";
$Languages[0]['Header'] = "METRO PHOENIX FORECAST";
$Languages[0]['FileName'] = "/apps/generated/weather/generated/v8_weatherforecast.inc";
$Languages[0]['shortfile'] = "/apps/generated/weather/generated/v8_shortforecast.inc";
$Languages[0]['FilenameTemp'] = "/apps/generated/weather/generated/v8_ForecastTable.inc.tmp";
//$Languages[0]['TableName'] = "narrative";
$result = mysql_query('SELECT tool_forecast.condition AS ImageName FROM tool_forecast ORDER BY day_id DESC LIMIT 1');
$num_rows = mysql_num_rows($result);
if(!$num_rows==0){
    $row = mysql_fetch_assoc($result);
    #if($row['hi']==0 || $row['hi']=='' ||$row['lo']==0 || $row['lo']=='') {
    if($row['ImageName'] == '') {
        $Languages[0]['Template'] = "/apps/projects/weather/bin/v8_mainforecast_6table.template";
    } else {
        $Languages[0]['Template'] = "/apps/projects/weather/bin/v8_mainforecast_table.template";
    }
    mysql_free_result($result);
}
$LanguageCount = count($Languages);

for($i=0;$i<$LanguageCount;$i++){
  $tmpTemplate = join("",file($Languages[$i]['Template']));
  //$sql = "SELECT narrative FROM ".$Languages[$i]['TableName']." WHERE id='1'";
  $sql = "SELECT narrative FROM narrative WHERE id='1'";
  $res = mysql_query($sql);
  $r = mysql_fetch_object($res);
  print_r($r);
  echo mysql_error();
  $narrative = $r->narrative;
  unset($sql);
  unset($res);
  unset($r);
  $sql = "SELECT * FROM tool_forecast ORDER BY day_id LIMIT 1,7";
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
  $tmpTemplate = str_replace("REPLACE_HEADER", $Languages[$i]['Header'],$tmpTemplate);
  echo $tmpTemplate;
  echo "----------------------------------------------------------------------------\n";
  echo "Publishing ".$Languages[$i]['FilenameTemp'] . ".........\n";
  echo "----------------------------------------------------------------------------\n";
  $fp = fopen($Languages[$i]['FilenameTemp'],"w+");
  fputs($fp,$tmpTemplate);
  fclose($fp);
  $fp=fopen($Languages[$i]['shortfile'],"w");
  fputs($fp,"<p>".$narrative."</p>");
  fclose($fp);
  sync_file($Languages[$i]['FilenameTemp'],$Languages[$i]['FileName']);
  system("rsync -a {$Languages[0]['shortfile']} content:/web/generated/weather/generated/v8_shortforecast.inc");
  // more stuff
  $anchor=preg_replace("/.*~/",'',$narrative);
  $anchorimg=rtrim($anchor);
  $anchorimg=strtolower(str_replace(" ","-",$anchorimg));
  $headshotout="<img src=\"./assets/imgs/$anchorimg.jpg\" width=\"72\" height=\"72\" alt=\"$anchor\"><br/>\n$anchor\n";
  file_put_contents("/apps/generated/weather/generated/v8_headshot.inc",$headshotout);
  system('rsync -a /apps/generated/weather/generated/v8_headshot.inc content:/web/generated/weather/generated/v8_headshot.inc');
  unlink($Languages[$i]['FilenameTemp']);
} 
// now do something similar but different for the 12news 3day weather file
  $fname='/apps/projects/weather/bin/12newspreview.template';
  $finalfile='/apps/generated/weather/generated/12newspreview.inc';
  $template=file_get_contents($fname);
  $template = str_replace('REPLACE_CURRENTWEATHER',
    file_get_contents('/apps/generated/weather/generated/v8_weathertoday.inc'),$template);
  $sql = "SELECT * FROM tool_forecast ORDER BY day_id LIMIT 1,3";
  $res = mysql_query($sql);
  $count = 0;
  while($r = mysql_fetch_object($res)){
    $hi_to_replace = "REPLACE_DAY".$count."_HI";
    $lo_to_replace = "REPLACE_DAY".$count."_LO";
    $dayname_to_replace = "REPLACE_DAY".$count."_DAYNAME";
    $myImage_to_replace = "REPLACE_DAY".$count."_IMAGE";
    $template = str_replace($hi_to_replace,$r->hi,$template);
    $template = str_replace($lo_to_replace,$r->lo,$template);
    $tmpImage = substr_replace($r->condition,'.png',-4);
    $template = str_replace($myImage_to_replace, "/weather/imgs/icons/$tmpImage",$template);
    $template = str_replace($dayname_to_replace,date("D",strtotime($r->day_id)),$template);
    $count++;
  }
  echo $template;
  echo "----------------------------------------------------------------------------\n";
  echo "Publishing ".$fname.".........\n";
  echo "----------------------------------------------------------------------------\n";
  $fp = fopen($fname.".tmp","w+");
  fputs($fp,$template);
  fclose($fp);
  sync_file($fname.".tmp",$finalfile);
  unlink($fname.".tmp");
