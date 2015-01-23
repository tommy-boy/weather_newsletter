#!/usr/local/bin/php -q
<?php

//$ftp_server = "ftp.airnowdata.org";
//$ftp_server = "64.164.197.242";
$ftp_server = "12.53.233.148";
$ftp_user_name = "WSPuser";
$ftp_user_pass = "Bobcat8";

$remote_file = '/outgoing/forecasts/forecast.csv';
$local_file = '/apps/projects/weather/bin/airnow.csv';

if ($handle = fopen($local_file, 'w')) {
  if ($conn_id = ftp_connect($ftp_server)) {
    if($login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass)) {
      if (ftp_fget($conn_id, $handle, $remote_file, FTP_ASCII, 0)) {
        //echo "successfully written to $local_file\n";
      //} else {
        //echo "There was a problem while downloading $remote_file to $local_file\n";
      }
    }
    ftp_close($conn_id);
  }
  fclose($handle);
}

################################################################################

$fp = fopen("/apps/projects/weather/bin/airnow.csv", "r");
while ($xyz = fread($fp, 4096)) {
  $data .= $xyz;
}
$rows = explode("\n",$data);
for ($x = 0; $x < count($rows); $x++) {
  $values = explode("|", $rows[$x]);
  if ($values[7] == "Phoenix") {
    if ($values[4] == "1" && $values[11] == "PM10") {
      $today_pm10_value = $values[12];
      $today_pm10_word = $values[13];
    }
    if ($values[4] == "1" && $values[11] == "OZONE") {
      $today_ozone_value = $values[12];
      $today_ozone_word = $values[13];
    }
    if ($values[4] == "1" && $values[11] == "PM2.5") {
      $today_pm25_value = $values[12];
      $today_pm25_word = $values[13];
    }
    if ($values[4] == "1" && $values[11] == "CO") {
      $today_co_value = $values[12];
      $today_co_word = $values[13];
    }
    if ($values[4] == "2" && $values[11] == "PM10") {
      $tom_pm10_value = $values[12];
      $tom_pm10_word = $values[13];
    }
    if ($values[4] == "2" && $values[11] == "OZONE") {
      $tom_ozone_value = $values[12];
      $tom_ozone_word = $values[13];
    }
    if ($values[4] == "2" && $values[11] == "PM2.5") {
      $tom_pm25_value = $values[12];
      $tom_pm25_word = $values[13];
    }
    if ($values[4] == "2" && $values[11] == "CO") {
      $tom_co_value = $values[12];
      $tom_co_word = $values[13];
    }
  }
}

$dataFile = "<ADD_PHP\n";
$dataFile .= "\$today_pm10_value = \"".$today_pm10_value."\";\n";
$dataFile .= "\$today_pm10_word = \"".$today_pm10_word."\";\n";
$dataFile .= "\$today_ozone_value = \"".$today_ozone_value."\";\n";
$dataFile .= "\$today_ozone_word = \"".$today_ozone_word."\";\n";
$dataFile .= "\$today_pm25_value = \"".$today_pm25_value."\";\n";
$dataFile .= "\$today_pm25_word = \"".$today_pm25_word."\";\n";
$dataFile .= "\$today_co_value = \"".$today_co_value."\";\n";
$dataFile .= "\$today_co_word = \"".$today_co_word."\";\n";
$dataFile .= "\$tom_pm10_value = \"".$tom_pm10_value."\";\n";
$dataFile .= "\$tom_pm10_word = \"".$tom_pm10_word."\";\n";
$dataFile .= "\$tom_ozone_value = \"".$tom_ozone_value."\";\n";
$dataFile .= "\$tom_ozone_word = \"".$tom_ozone_word."\";\n";
$dataFile .= "\$tom_pm25_value = \"".$tom_pm25_value."\";\n";
$dataFile .= "\$tom_pm25_word = \"".$tom_pm25_word."\";\n";
$dataFile .= "\$tom_co_value = \"".$tom_co_value."\";\n";
$dataFile .= "\$tom_co_word = \"".$tom_co_word."\";\n";
$dataFile .= "ADD_PHP>\n";
$dataFile = str_replace("ADD_PHP","?",$dataFile);

$fp = fopen("/dev_www/azc/htdocs/incs/airnowinfo.php","w");
fputs($fp,$dataFile,strlen($dataFile));
fclose($fp);
sync_file("/dev_www/azc/htdocs/incs/airnowinfo.php");

function sync_file($from,$to="",$debug=0)  {
  if ($debug)  {
    echo "Transmitting $to<br />\n";
  }
  if ($to == "")  {
    $to = str_replace("/dev_www/","/live_www/",$from);
  }
  if (!$ftp = ftp_connect("ftp1"))  return false;
  if (!ftp_login($ftp, "cronuser", "black1"))  return false;
  if (!ftp_put($ftp, $to, $from, FTP_BINARY))  return false;
  if (!ftp_quit($ftp))  return false;
  if ($debug)  {
    echo "Success!<br />\n";
  }
  return true;
}

?>
