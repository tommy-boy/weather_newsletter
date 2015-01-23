#!/usr/local/bin/php5-cli
<?
  // These are the cities and locations of the the XML files
  $f["Phoenix"]="http://weather.gov/data/current_obs/KPHX.xml";
  $f["Tucson"]="http://weather.gov/data/current_obs/KTUS.xml";
  $f["Flagstaff"]="http://weather.gov/data/current_obs/KFLG.xml";

  $f["Phoenix"]="ftp://weather.noaa.gov/data/observations/metar/decoded/KPHX.TXT";
  $f["Tucson"]="ftp://weather.noaa.gov/data/observations/metar/decoded/KTUS.TXT";
  $f["Flagstaff"]="ftp://weather.noaa.gov/data/observations/metar/decoded/KFLG.TXT";
  
  $output="";
  $error=0;

  // Require the icon mapping to include the pretty little weather image on the homepage
  require("weather_icons.inc");


  $pre_image="homepage_";

  // Determine the daytime or nighttime image based on sunrise/sunset time for today
  $latitude = 33.26;    
  $longitude = -112.03;
  $timezone = -7;
  require("includes/sunriseset.php");

  if(time()>=$sunrise && time()<$sunset) $pre_image.="daytime_";
  else $pre_image.="nighttime_";

  foreach($f as $city=>$txtfile) {
    if($file=file($txtfile)) {
      $temp=preg_split("/\s+/",$file[5]);   
      $class="weatherothercities";
      if($city=="Phoenix") {
        $alttext=trim(end(split(":",$file[4])));
        $class="weatherphoenix";
        $index=trim(strtolower($alttext));
        if($weather_icons["$index"]!="") {
          if($weather_icons["$index"]=="sunny" && floatval($temp[1])>104) {
            $alttext="Hot";
            $imgsrc="/weather/imgs/".$pre_image."hot3.jpg";
          } else {
            $imgsrc="/weather/imgs/".$pre_image.$weather_icons["$index"].".jpg";
          }
        } else {
          ob_start();
          print_r($weather_icons);
          $printr=ob_get_contents();
          ob_end_clean();
          mail("web.crew@pni.com","Unrecognized sky condition:".trim($alttext),"The weather processing script saw a sky condition that it did not recognize:".trim($xml->weather)."\n".$printr);
          $imgsrc="/imgs/clear.gif";
        }
      }
      $output.="<span class=\"".$class."\">".$city." ".number_format(floatval($temp[1]))."&deg;</span><br>\n";
    } else {
      $error++;
    }
  }  
  echo $output;
  if($error==0) {
    $fp = fopen("/dev_www/azc/htdocs/incs/skycond.inc","w");
    fputs($fp,"<img src=\"".$imgsrc."\" width=\"70\" height=\"55\" border=\"0\" alt=\"".$alttext."\">");
    fclose($fp);
    sync_file("/dev_www/azc/htdocs/incs/skycond.inc");
    //$ftp=ftp_connect("ftp1");
    //ftp_login($ftp,"cronuser","black1");
    //ftp_put($ftp,"/www_live/azc/htdocs/incs/skycond.inc","/www/azc/htdocs/incs/skycond.inc",FTP_BINARY);
    //copy("/www/azc/htdocs/incs/skycond.inc","/www_live/azc/htdocs/incs/skycond.inc");
    
    $fp = fopen("/dev_www/azc/htdocs/incs/currtemps.inc","w");
    fputs($fp,$output,strlen($output));
    fclose($fp);
    sync_file("/dev_www/azc/htdocs/incs/currtemps.inc");
    //ftp_put($ftp,"/www_live/azc/htdocs/incs/currtemps.inc","/www/azc/htdocs/incs/currtemps.inc",FTP_BINARY);
    //copy("/www/azc/htdocs/incs/currtemps.inc","/www_live/azc/htdocs/incs/currtemps.inc");
    //ftp_close($ftp);
  } else {
    echo "Errors: ".$error."\n";
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

?>
