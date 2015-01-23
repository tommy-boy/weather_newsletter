#!/usr/local/bin/php -q
<?
include("/projects/weather/admin/includes/mysql_connect.inc");
#include("mysql_connect.inc");
if (!defined("DBCONNECTION"))  {
  exit; // used to write template version of file when no connection
}
include("/projects/weather/admin/includes/lib.inc");

function sync_file($from,$to){
  if(!$ftp=ftp_connect("ftp1")) return false;
  if(!ftp_login($ftp,"cronuser","black1")) return false;
  if(!ftp_put($ftp,$to,$from, FTP_ASCII)) return false;
  if(!ftp_quit($ftp)) return false;
  return true;
}

$days=array();
$days[]=array();

$languages=array();
$languages[0]=array();
$languages[0]['Name']="English";
$languages[0]['ImagePath']="http://j.azcentral.com/imgs/";
$languages[0]['Header']="Metro Phoenix Forecast";
//$languages[0]['FileName']="/apps/dev/www.azcentral.com/htdocs/generated/homepage_weathertab.inc";
//$languages[0]['FileNameTemp']="/apps/dev/www.azcentral.com/htdocs/generated/HomepageWeatherTab.inc.tmp";
$languages[0]['FileName']="/apps/generated/weather/generated/homepage_weathertab.inc";
$languages[0]['FileNameTemp']="/apps/generated/weather/generated/HomepageWeatherTab.inc.tmp";
$languages[0]['TableName']="narrative";
$languages[0]['Template']="/projects/weather/bin/redesign_forecast_table.template";

$languagecount=count($languages);
for($i=0;$i<$languagecount;$i++){
  $tmpTemplate=join("",file($languages[$i]['Template']));
  $sql="SELECT narrative from ".$languages[$i]['TableName']." WHERE id='1'";
  $res=mysql_query($sql);
  $r=mysql_fetch_object($res);
  print_r($r);
  echo mysql_error();
  #$narrative=$r->narrative;
  unset($sql);
  unset($res);
  unset($r);
  $sql="SELECT * FROM tool_forecast ORDER BY day_id LIMIT 1,2";
  $res=mysql_query($sql);
  $count=0;
  $dayafter=date("l",mktime(0,0,0,date("m"),date("d")+2,date("Y")));
  #echo "dayafter: $dayafter";exit;
  while($r=mysql_fetch_object($res)){
    $dayofweek_to_replace="REPLACE_DAY".$count."_DAYOFWEEK";
    $alttext_to_replace="REPLACE_DAY".$count."_ALTTEXT";
    $hi_to_replace="REPLACE_DAY".$count."_HI";
    $lo_to_replace="REPLACE_DAY".$count."_LO";
    $dayname_to_replace="REPLACE_DAY".$count."_DAYNAME";
    $myImage_to_replace="REPLACE_DAY".$count."_IMAGE";
    $condition_to_replace="REPLACE_DAY".$count."_DESCRIPTION";

    if($count==0){
       $tmpTemplate=str_replace($dayofweek_to_replace,"Tomorrow",$tmpTemplate);
    } elseif ($count==1) {
       $tmpTemplate=str_replace($dayofweek_to_replace,$dayafter,$tmpTemplate);
    }
    $tmpTemplate=str_replace($alttext_to_replace,strtolower($r->text_condition),$tmpTemplate);
    $tmpTemplate=str_replace($hi_to_replace,$r->hi,$tmpTemplate);
    $tmpTemplate=str_replace($lo_to_replace,$r->lo,$tmpTemplate);
    $tmpTemplate=str_replace($myImage_to_replace,$languages[$i]['ImagePath'].$r->condition,$tmpTemplate);
    $tmpTemplate=str_replace($condition_to_replace,$r->text_condition,$tmpTemplate);
    
    $count++;
  }
  
  echo $tmpTemplate;
  echo "--------------------------------------------------------------------\n";
  echo "Publishing ".$languages[$i]['FileNameTemp']."-----------------\n";
  echo "--------------------------------------------------------------------\n";
  $fp=fopen($languages[$i]['FileNameTemp'],"w+");
  fputs($fp,$tmpTemplate);
  fclose($fp);
  sync_file($languages[$i]['FileNameTemp'],$languages[$i]['FileName']);
  unlink($languages[$i]['FileNameTemp']);
}

?>
