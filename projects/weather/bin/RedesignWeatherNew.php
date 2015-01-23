#!/usr/local/bin/php5-cli
<?php
  ini_set('display_errors', 1);
  // These are the cities and locations of the the XML files
  $f["Phoenix"]="http://weather.gov/data/current_obs/KPHX.xml";
  $f["Tucson"]="http://weather.gov/data/current_obs/KTUS.xml";
  $f["Flagstaff"]="http://weather.gov/data/current_obs/KFLG.xml";

/* If those ever stop working, you can get similar data from
 * http://www.wrh.noaa.gov/mesowest/getobextXml.php?sid=KPHX&num=1
 * The XML format there is more of a pain though.
 * temp's in description=Temp , value=NN
 * clouds in description=Clouds , value=(string)
 * weather in description=Coded Weather , value=(string)
 * - for light, + for heavy, '' for moderate,
 * TS=thunderstorm,DZ=drizzle,RA=rain,GR=hail,GS=small hail,
 * BR=mist,FG=fog,DU=dust,SA=sand,PO=dust/sand,FC=tornado,
 * SS=sandstorm,DS=duststorm
 */

  $output="";
  $error=0;
  $currtemps_index='';

  // Require the icon mapping to include the pretty little weather image on the homepage
  require("weather_icons.inc");

  // icons made from this script based on above icons, see below
  require_once('weather_icons_from_script.inc');

  $pre_image="icons/";

  // Determine the daytime or nighttime image based on sunrise/sunset time for today
  $latitude = 33.26;    
  $longitude = -112.03;
  $timezone = -7;
  require("includes/sunriseset.php");

  $havepm=array('sunny'=>'pm_clear',
    'dust_storms'=>'pm_dust_storms',
    'rainy'=>'pm_rain',
    'stormy'=>'pm_storms' );
  if(time()>=$sunrise && time()<$sunset){ $isnight=0; }
  else{ $isnight=1; }

  foreach($f as $city=>$xmlfile) {
    // time is not part of the url
    //if($xml = simplexml_load_file($xmlfile."?".time())) {
    if($xml = @simplexml_load_file($xmlfile)) {
      $class="weatherothercities";
      if($city=="Phoenix") {
        $sql = "select * from `observations` where Time <= unix_timestamp() order by `Time` DESC limit 1";
        mysql_connect("calcutta.azcentral.com","webuser","web*User");
        mysql_select_db("weatherstation");
        $result=mysql_query($sql);
        $row=mysql_fetch_assoc($result);
        if(time()-$row['Time']<3600) $xml->temp_f=round($row['Temp']);
        
        #@include("write_file.php");
        include("redesign_write_file.php");

        $alttext=$xml->weather;
        $class="weatherphoenix";
        $index=trim(strtolower($xml->weather));
        $index=str_replace("'",'',$index); // they're putting 's in these now?  GRR.

        $currtemps_index.="<span class=\"currtemps_index\">".round($xml->temp_f)."&deg;</span>\n";
        
        $imgalt=$weather_icons[$index];
//print "index = $index\n"; // remove this
        if($weather_icons[$index]!="") {
          if($isnight==1 and in_array($imgalt,array_keys($havepm))){
            $imgsrc='<img src="/weather/imgs/'.$pre_image.$havepm[$weather_icons[$index]].'.png" />';
            }
          else{
            $imgsrc='<img src="/weather/imgs/'.$pre_image.$weather_icons[$index].'.png" />';
            }
        } else {

          // try a smaller version
          $full_index = $index;
          $index = str_replace('light ','',$index);
          $index = str_replace('heavy ','',$index);
          if (strpos($index,' and ')) {
            $index = substr($index,0,strpos($index,' and '));
          }

          if($weather_icons[$index]!="") {

            // save this for next time
            $icon_filename = '/projects/weather/bin/weather_icons_from_script.inc';
            $icon_line = "\$weather_icons['$full_index']='{$weather_icons[$index]}'; // added ";
            $icon_line .= date('Y-m-d H:i:s');
            $icon_text = file_get_contents($icon_filename);
            $icon_lines = split("\n",rtrim($icon_text));
            $icon_lines[count($icon_lines)-1] = $icon_line;
            $icon_lines[] = '?>';
            $icon_text = join("\n",$icon_lines) . "\n";
            if ($fp = fopen($icon_filename,'w')) {
              fwrite($fp,$icon_text);
              fclose($fp);
            }

            $imgsrc="/imgs/clear.gif";
            $imgsrc='<img src="/weather/imgs/'.$pre_image.$weather_icons[$index].'.png" />"';

          } else {
            ob_start();
            print_r($weather_icons);
            $printr=ob_get_contents();
            ob_end_clean();
            mail("phx.it.web@gannett.com,junger@azcentral.com","Unrecognized sky condition:".$index,"The weather processing script saw a sky condition that it did not recognize:".trim($xml->weather)."\nAdd the condition to /projects/weather/bin/weather_icons.inc. (It's included by this script, /projects/weather/bin/RedesignWeatherNew.php.)\n".$printr);
            $imgsrc="/imgs/clear.gif";
          }
        }
      }
      $output.="<span class=\"".$class."\">".$city." ".$xml->temp_f."&deg;</span><br>\n";
    } else {
      $error++;
    }
  }
  //echo $output;  

  if($error==0) {
    $temperature = trim(strip_tags($currtemps_index));
    $newtext = "| <a href=\"/weather/\">$temperature</a>\n";
    #$dev_staging = array('dev','staging');
    #$incs_generated = array('incs','generated');
    #foreach ($dev_staging as $path1) {
    #  foreach ($incs_generated as $path2) {
    #    $filename = "/apps/$path1/www.azcentral.com/htdocs/$path2/phxtemperature.inc";
    #    $oldtext = file_get_contents($filename);
    #    if ($oldtext <> $newtext) {
    #      // only write out if temperature or layout changed
    #      $fp = fopen($filename,'w');
    #      fputs($fp,$newtext,strlen($newtext));
    #      fclose($fp);
    #    }
    #  }
    #}

    //just the temperature
    $filename = '/apps/generated/generated/phxtemperature.txt';
    if ($temperature !== @file_get_contents($filename)) {
      if (false === file_put_contents($filename,$temperature)) {
        //problem
      } else {
        log_for_sync($filename);
      }
    }

    //just the img alt
    #$imgname = '/imgs/'.$weather_icons[$index].'.gif';
    $filename = '/apps/generated/generated/phxweatherimgsrc2.txt';
    #if ($imgname !== @file_get_contents($filename)) {
      #if (false === file_put_contents($filename,$imgname)) {
    if ($imgsrc !== @file_get_contents($filename)) {
      if (false === file_put_contents($filename,$imgsrc)) {
        //problem
      } else {
        log_for_sync($filename);
      }
    }

    //just the img alt
    $filename = '/apps/generated/generated/phxweatherimgalt.txt';
    if ($imgalt !== @file_get_contents($filename)) {
      if (false === file_put_contents($filename,$imgalt)) {
        // problem
      } else {
        log_for_sync($filename);
      }
    }

  } else {
   # echo "Errors: ".$error."\n";
  }


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

function log_for_sync($filename) {
  $now = date('YmdHis');
  if ($loghandle = fopen("/www/enigma/pubpush/$now.log",'a')) {
    if (flock($loghandle,LOCK_EX)) { //do an exclusive lock
      fwrite($loghandle,$filename."\n");
      flock($loghandle,LOCK_UN); //release lock
    }
    fclose($loghandle);
  }
}

?>
