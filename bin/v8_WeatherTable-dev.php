#!/usr/local/bin/php -q
<?
/* *** Updates the "6-Day" forecast details on the weather page *** */

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
$Languages[0]['FileName'] = "/apps/generated/weather/generated/v8_weatherforecast-dev.inc";
$Languages[0]['shortfile'] = "/apps/generated/weather/generated/v8_shortforecast-dev.inc";
$Languages[0]['FilenameTemp'] = "/apps/generated/weather/generated/v8_ForecastTable.inc.tmp";
$Languages[0]['Template'] = "/apps/projects/weather/bin/v8_mainforecast_table.template";
$LanguageCount = count($Languages);

for($i=0;$i<$LanguageCount;$i++){
  $tmpTemplate = join("",file($Languages[$i]['Template']));
  $story = file_get_contents("http://www.azcentral.com/story/weather/2015/01/16/arizona-weather-local-forecast/21859087.json");
  $json = json_decode($story, true);
  $narrative = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $json['article']['body'][2]['value']);
  // $narrative = "A quick-moving weather disturbance will bring clouds and slightly lower temperatures for Wednesday. We also have a slight chance for a stray shower or two, but chances for rain are best in northern Arizona. Behind this system, highs will briefly dip to the 60s Thursday and Friday before a very nice warm-up to the low 80s next week. ~James Quinones";
  $string = file_get_contents("http://www.azcentral.com/weather.json");
  $json_a = json_decode($string, true);
  $count = 0;
  foreach ($json_a['primary_modules'] as $key =>$result) {
      if (array_key_exists('weather_seven_day', $result)) {
          for($offset = 1; $offset <= 7; $offset++) {
              foreach($json_a['primary_modules'][$key]['weather_seven_day'] as $pos => $forecast) {
                  if ($pos === $offset) {
                      $hi_to_replace = "REPLACE_DAY".$count."_HI";
                      $lo_to_replace = "REPLACE_DAY".$count."_LO";
                      $dayname_to_replace = "REPLACE_DAY".$count."_DAYNAME";
                      $myImage_to_replace = "REPLACE_DAY".$count."_IMAGE";
                      $tmpTemplate = str_replace($hi_to_replace,$forecast['tempFHi'],$tmpTemplate);
                      $tmpTemplate = str_replace($lo_to_replace,$forecast['tempFLo'],$tmpTemplate);
                      $tmpImage = $forecast['dayTime']['weatherIcon'].'.png';
                      $tmpTemplate = str_replace($myImage_to_replace,$Languages[$i]['ImagePath'].$tmpImage,$tmpTemplate);
                      $tmpTemplate = str_replace($dayname_to_replace,date("D",strtotime($forecast['dayCode'])),$tmpTemplate);
                      $count++;
                  }
              }
          }
      }
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
  system("rsync -a {$Languages[0]['shortfile']} content:/web/generated/weather/generated/v8_shortforecast-dev.inc");
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
  $string = file_get_contents("http://www.azcentral.com/weather.json");
  $json_a = json_decode($string, true);
  $count = 0;
  foreach ($json_a['primary_modules'] as $key => $result) {
      if (array_key_exists('weather_seven_day', $result)) {
          for($offset = 1; $offset < 4; $offset++) {
              foreach($json_a['primary_modules'][$key]['weather_seven_day'] as $pos => $forecast) {
                  if ($pos === $offset) {
                      $hi_to_replace = "REPLACE_DAY".$count."_HI";
                      $lo_to_replace = "REPLACE_DAY".$count."_LO";
                      $dayname_to_replace = "REPLACE_DAY".$count."_DAYNAME";
                      $myImage_to_replace = "REPLACE_DAY".$count."_IMAGE";
                      $template = str_replace($hi_to_replace,$forecast['tempFHi'],$template);
                      $template = str_replace($lo_to_replace,$forecast['tempFLo'],$template);
                      $tmpImage = $forecast['dayTime']['weatherIcon'].'.png';
                      $template = str_replace($myImage_to_replace,"/weather/imgs/icons/$tmpImage",$template);
                      $template = str_replace($dayname_to_replace,date("D",strtotime($forecast['dayCode'])),$template);
                      $count++;
                  }
              }
          }
      }
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
