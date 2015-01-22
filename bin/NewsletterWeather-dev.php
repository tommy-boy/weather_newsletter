#!/usr/local/bin/php -q
<?
/* *** Creates the Weather Newsletters *** */

include("/projects/weather/admin/includes/lib.inc");

function sync_file($from,$to)  {
  
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
    $story = file_get_contents("http://www.azcentral.com/story/weather/2015/01/16/arizona-weather-local-forecast/21859087.json"); //narrative json test
	$json = json_decode($story, true);
	$narrative = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $json['article']['body'][2]['value']);
	$string = file_get_contents("http://www.azcentral.com/weather.json");
	$json_a = json_decode($string, true);
	$count = 0;
	foreach ($json_a['primary_modules'] as $key => $result) {
    	if (array_key_exists('weather_seven_day', $result)) {
        	foreach($json_a['primary_modules'][$key]['weather_seven_day'] as $forecast) {
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
