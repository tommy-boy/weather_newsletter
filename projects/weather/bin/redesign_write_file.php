<?

###### AIR NOW - AIR QUALITY ######
@include("/apps/live_www/azc/htdocs/incs/airnowinfo.php");
###### END OF AIR NOW #######

###### START WRITING WEATHER DATAFILE ######
$dataFile = "<ADD_PHP\n";
$dataFile .= "//Weather Data for Phoenix (WeatherStation)\n\n";
$dataFile .= "\$weather['location'] = \"".$xml->location."\";\n";
$dataFile .= "\$weather['station_id'] = \"".$xml->station_id."\";\n";
$dataFile .= "\$weather['latitude'] = \"".$xml->latitude."\";\n";
$dataFile .= "\$weather['longitude'] = \"".$xml->longitude."\";\n";
$dataFile .= "\$weather['observation_time'] = \"".$xml->observation_time."\";\n";
$dataFile .= "\$weather['weather'] = \"".$xml->weather."\";\n";
$dataFile .= "\$weather['temp_f'] = \"".$row['Temp']."\";\n";
$dataFile .= "\$weather['temp_c'] = \"".$xml->temp_c."\";\n";
$dataFile .= "\$weather['relative_humidity'] = \"".$xml->relative_humidity."\";\n";
$dataFile .= "\$weather['wind_string'] = \"".$xml->wind_string."\";\n";
$dataFile .= "\$weather['wind_dir'] = \"".$row['Wind Dir']."\";\n";
$dataFile .= "\$weather['wind_degrees'] = \"".$xml->wind_degrees."\";\n";
#$dataFile .= "\$weather['wind_mph'] = \"".$row['Wind Spd']."\";\n";
$dataFile .= "\$weather['wind_mph'] = \"".$xml->wind_mph."\";\n";
$dataFile .= "\$weather['wind_gust_mph'] = \"".$row['Wind Gust']."\";\n";
$dataFile .= "\$weather['pressure_mb'] = \"".$xml->pressure_mb."\";\n";
#$dataFile .= "\$weather['pressure_in'] = \"".$row['Raw Barom']."\";\n";
$dataFile .= "\$weather['pressure_in'] = \"".$xml->pressure_in."\";\n";
#$dataFile .= "\$weather['dewpoint_f'] = \"".$row['Dew Point']."\";\n";
$dataFile .= "\$weather['dewpoint_f'] = \"".$xml->dewpoint_f."\";\n";
$dataFile .= "\$weather['dewpoint_c'] = \"".$xml->dewpoint_c."\";\n";
#$dataFile .= "\$weather['heat_index_f'] = \"".$row['Heat Index']."\";\n";
// they're no longer sending heat index info.  Eh?  Big complex formula....
$dataFile .= "\$weather['heat_index_f'] = \"".$xml->heat_index_f."\";\n";
$dataFile .= "\$weather['heat_index_c'] = \"".$xml->heat_index_c."\";\n";
$dataFile .= "\$weather['windchill_f'] = \"".$row['Wind Chill']."\";\n";
$dataFile .= "\$weather['windchill_c'] = \"".$xml->windchill_c."\";\n";
$dataFile .= "\$weather['visibility_mi'] = \"".$xml->visibility_mi."\";\n";

$dataFile .= "\$weather['humidity'] = \"".$row['Humidity']."\";\n";
$dataFile .= "\$weather['total_rain'] = \"".$row['Tot Rain']."\";\n";

$dataFile .= "\$weather['ozone'] = \"".$today_ozone_value."\";\n";
$dataFile .= "\$weather['ozone_range'] = \"".$today_ozone_word."\";\n";
$dataFile .= "\$weather['pm25'] = \"".$today_pm25_value."\";\n";
$dataFile .= "\$weather['pm25_range'] = \"".$today_pm25_word."\";\n";
$dataFile .= "\$weather['pm10'] = \"".$today_pm10_value."\";\n";
$dataFile .= "\$weather['pm10_range'] = \"".$today_pm10_word."\";\n";
$dataFile .= "\$weather['co'] = \"".$today_co_value."\";\n";
$dataFile .= "\$weather['co_range'] = \"".$today_co_word."\";\n";
$dataFile .= "\$weather['tom_ozone'] = \"".$tom_ozone_value."\";\n";
$dataFile .= "\$weather['tom_ozone_range'] = \"".$tom_ozone_word."\";\n";
$dataFile .= "\$weather['tom_pm25'] = \"".$tom_pm10_value."\";\n";
$dataFile .= "\$weather['tom_pm25_range'] = \"".$tom_pm25_word."\";\n";
$dataFile .= "\$weather['tom_pm10'] = \"".$tom_pm10_value."\";\n";
$dataFile .= "\$weather['tom_pm10_range'] = \"".$tom_pm10_word."\";\n";
$dataFile .= "\$weather['tom_co'] = \"".$tom_co_value."\";\n";
$dataFile .= "\$weather['tom_co_range'] = \"".$tom_co_word."\";\n";

$dataFile .= "\$weather['sunrise'] = \"".date("g:ia",$sunrise)."\";\n";
$dataFile .= "\$weather['sunset'] = \"".date("g:ia",$sunset)."\";\n";

$dataFile .= "ADD_PHP>\n";

$dataFile = str_replace("ADD_PHP","?",$dataFile);

$fp = fopen("/apps/generated/weather/generated/weatherinfo.php","w");
fputs($fp,$dataFile,strlen($dataFile));
fclose($fp);
#sync_file("/apps/generated/weather/generated/weatherinfo.php");
   
###### END OF WRITING WEATHER DATAFILE ######

###### WRITE CURRENT IMAGE TO FILE ######
/*
$fp = fopen($xml->icon_url_base.$xml->icon_url_name, "r");
while ($xyz = fread($fp, 4096)) {
  $image .= $xyz;
}
$fp = fopen("/dev_www/azc/htdocs/incs/weatherinfo.jpg","w");
fputs($fp,$image,strlen($image));
fclose($fp);
sync_file("/dev_www/azc/htdocs/incs/weatherinfo.jpg");
*/
###### END OF WRITING IMAGE TO FILE ######


?>
