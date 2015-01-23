#!/usr/local/bin/php -q
<?
exit; // FIXME
  // set to 1 to get some information on stdout.
  define( 'DEBUG', 0 );

  //print date_default_timezone_get();
  //date_default_timezone_set('US/Arizona'); // version >= 5 only
  //print date_default_timezone_get();
  require("mysql_connect.inc");
  if (!defined("DBCONNECTION"))  {
    exit;
  }
  //mysql_select_db("weatherstation");
  if (!mysql_select_db("weatherstation")) {exit;}
  $result=mysql_query("select max(`Time`) from `observations`");
  $row=mysql_fetch_array($result, MYSQL_NUM);
  mysql_free_result($result);
  $lasttime=$row[0];
  if( DEBUG ) {
    echo "\$lasttime == '$lasttime'\n";
  }


  $dailycsv="/projects/weather/incoming/weatherstation/daily.csv";
  $data=file($dailycsv);
  $date=trim($data[0]);

  if( DEBUG ) {
    echo "\$date == '$date'\n";
  }

//  $sql = "replace into `observations` (`Time`,`WindDirection`,`WindSpeed`,`WindGust`,`HumidityInside`,`HumidityOutside`,`TempInside`,`TempOutside`,`RawBarometer`,`TotalRain`,`WindChill`,`WindDirectionRate`,`WindSpeedRate`,`WindGustRate`,`HumidityInsideRate`,`HumidityOutsideRate`,`TempInsideRate`,`TempOutsideRate`,`BarometerRate`,`TotalRainRate`,`WindChillRate`,`WindDirectionAverage`,`WindSpeedAverage`,`WindGustAverage`,`HumidityInsideAverage`,`HumidityOutsideAverage`,`TempInsideAverage`,`TempOutsideAverage`,`BarometerAverage`,`TotalRainAverage`,`WindChillAverage`,`WindDirectionHigh`,`WindSpeedHigh`,`WindGustHigh`,`HumidityInsideHigh`,`HumidityOutsideHigh`,`TempInsideHigh`,`TempOutsideHigh`,`BarometerHigh`,`TotalRainHigh`,`WindChillHigh`,`WindDirLow`,`WindSpeedLow`,`WindGustLow`,`HumidityInsideLow`,`HumidityOutsideLow`,`TempInsideLow`,`TempOutsideLow`,`BarometerLow`,`TotalRainLow`,`WindChillLow`) values ";
  $sql = "replace into `observations` (`Time`,`Wind Dir`,`Wind Spd`,`Wind Gust`,`Humidity`,`Temp`,`Raw Barom`,`Tot Rain`,`Wind Chill`,`Heat Index`,`Dew Point`,`Wind Dir R`,`Wind Spd R`,`WindGust R`,`Humidity R`,`Temp Out R`,`Barom Rate`,`Tot Rain R`,`WindCh R`,`HeatIx R`,`Dew Pt R`,`Wind Dir A`,`Wind Spd A`,`WindGust A`,`Humidity A`,`Temp Out A`,`Barom A`,`Tot Rain A`,`WindCh A`,`HeatIx A`,`Dew Pt A`,`Wind Dir H`,`Wind Spd H`,`WindGust H`,`Humidity H`,`Temp Out H`,`Barom H`,`Tot Rain H`,`WindCh H`,`HeatIx H`,`Dew Pt H`,`Wind Dir L`,`Wind Spd L`,`WindGust L`,`Humidity L`,`Temp Out L`,`Barom L`,`Tot Rain L`,`WindCh L`,`HeatIx L`,`Dew Pt L`) values ";
  $j=-1;
  $k=0;
  foreach($data as $value) {
    $j++;
    if($j<3) continue;
    //print "value: $value\n";
    $value=split(",",trim($value));
    $time=strtotime($date." ".trim($value[0]));
    if( DEBUG ) {
      print "$date $value[0]   $time <= $lasttime " . ($time <= $lasttime) . "\n";
    }
    if($time<=$lasttime) continue;

    if($k>0) $sql.= ",\n\n";
    $sql .= "(";
    for($i=0;$i<count($value);$i++) {
      $time=strtotime($date." ".trim($value[$i]));
      if($i==0) $sql .=$time;
      else $sql .= ",'".trim($value[$i])."'";
    }
    $sql .=")";
    $runsql=true;
    $k++;
  }
  if($runsql) {
    mysql_query($sql) || die(mysql_error()."\n\n".$sql);
    if( DEBUG ) {
      echo $sql;
      echo mysql_affected_rows();
    }
  }
  #copy($dailcsv,$lastcsv);
?>
