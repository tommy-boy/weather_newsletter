<?
// library file for weather tool

function ConditionSelect($intName,$strDefault=""){
	$sql = "SELECT * from weather_images where language = 'English'";
	$res = mysql_query($sql);
	echo "<select name=day[condition$intName]>\n";
	while($r = mysql_fetch_object($res)){
		echo "<option name=$r->filename";
		if($strDefault==$r->filename)
			echo " SELECTED";
		echo ">$r->condition</option>\n";
	}
	echo "</select>\n";
}

function getDOW($day)  {
  switch ($day)  {
    case 1:
      return "Sunday\n";
      break;
    case 2:
      return "Monday\n";
      break;
    case 3:
      return "Tuesday\n";
      break;
    case 4:
      return "Wednesday\n";
      break;
    case 5:
      return "Thursday\n";
      break;
    case 6:
      return "Friday\n";
      break;
    case 7:
      return "Saturday\n";
      break;
    default:
    	return "default\n";
	break;
  }
}

function generate_dropdown($condition)  {
	global $dayofweek;
	$conditions[] = array("sunny.gif","Sunny");
	$conditions[] = array("mostly_sunny.gif","Mostly Sunny");
	$conditions[] = array("high_clouds.gif","High Clouds");
	$conditions[] = array("partly_cloudy.gif","Partly Cloudy");
	$conditions[] = array("mostlycloudy.gif","Mostly Cloudy");
	$conditions[] = array("cloudy.gif","Cloudy");
	$conditions[] = array("rain.gif","Rain");
	$conditions[] = array("moderate_rain.gif","Moderate Rain");
	$conditions[] = array("light_rain.gif","Light Rain");
	$conditions[] = array("drizzle.gif","Drizzle");
	$conditions[] = array("storms.gif","Storms");
	$conditions[] = array("t_storms.gif","Thunderstorms");
	$conditions[] = array("chance_storms.gif","Chance of Thunderstorms");
	$conditions[] = array("noon_storms.gif","Afternoon Thunderstorms");
	$conditions[] = array("haze.gif","Haze");
	$conditions[] = array("windy.gif","Windy");
	$conditions[] = array("dust_storms.gif","Dust");
	$conditions[] = array("fog.gif","Fog");
	$conditions[] = array("mon_fog.gif","Morning Fog");
	$conditions[] = array("frigid.gif","Cold");
	$conditions[] = array("flurries.gif","Flurries");
	$conditions[] = array("frzrain.gif","Freezing Rain");
	$conditions[] = array("rainsnow.gif","Rain & Snow");
	$conditions[] = array("snow.gif","Snow");
// print_r($conditions); 
  
  $output = "";
  $hide = "";
  $output .= "<SELECT NAME=\"day[condition".(++$dayofweek)."]\">\n";
  while (list($k,$v) = each($conditions))  {
    if ($v[0] == $condition)  {
      $selected = " SELECTED";
      $hide .= "<input type=hidden name=\"text[$dayofweek]\" value=\"$v[1]\">";
    } else {
      $selected = "";
    }
    $output .= "<OPTION VALUE=\"$v[0]\"$selected>$v[1]\n";
  }
  $output .= "</SELECT>\n";
  
  return $output.$hide;
}

function return_condition($image) {
 /* 
	$condition = array("cloudy.gif"=>"Cloudy","drizzle.gif"=>"Drizzle","flurries.gif"=>"Flurries","fog.gif"=>"Fog","frzrain.gif"=>"Freezing Rain","haze.gif"=>"Haze","partly_cloudy.gif"=>"Partly Cloudy","rain.gif"=>"Rain","snow.gif"=>"Snow","rainsnow.gif"=>"Rain & Snow","storms.gif"=>"Storms","storms.gif"=>"Storms","sunny.gif"=>"Sunny","t_storms.gif"=>"Thunderstorms","mostly_sunny.gif"=>"Mostly Sunny","mostlycloudy.gif"=>"Mostly Cloudy","high_clouds.gif"=>"High Clouds","chance_storms.gif"=>"Chance of Thunderstorms","noon_storms.gif"=>"Afternoon Thunderstorms","moderate_rain.gif"=>"Moderate Rain","light_rain.gif"=>"Light Rain","dust_storms.gif"=>"Dust","mon_fog.gif"=>"Morning Fog","frigid.gif"=>"Cold");
  */
$condition = array("sunny.gif"=>"Sunny",
"mostly_sunny.gif"=>"Mostly Sunny",
"high_clouds.gif"=>"High Clouds",
"partly_cloudy.gif"=>"Partly Cloudy",
"mostlycloudy.gif"=>"Mostly Cloudy",
"cloudy.gif"=>"Cloudy",
"rain.gif"=>"Rain",
"moderate_rain.gif"=>"Moderate Rain",
"light_rain.gif"=>"Light Rain",
"drizzle.gif"=>"Drizzle",
"storms.gif"=>"Storms",
"t_storms.gif"=>"Thunderstorms",
"chance_storms.gif"=>"Chance of Thunderstorms",
"pm_storms.gif"=>"P.M. Thunderstorms",
"haze.gif"=>"Haze",
"windy.gif"=>"Windy",
"dust_storms.gif"=>"Dust",
"fog.gif"=>"Fog",
"am_fog.gif"=>"A.M. Fog",
"cold.gif"=>"Cold",
"flurries.gif"=>"Flurries",
"frzrain.gif"=>"Freezing Rain",
"rainsnow.gif"=>"Rain & Snow",
"snow.gif"=>"Snow",
"am_rain.gif"=>"A.M. Rain",
"am_storms.gif"=>"A.M. Thunderstorms",
"night_rain.gif"=>"Night Rain",
"night_tstorms.gif"=>"Night Thunderstorms",
"pc_rain.gif"=>"P. Cloudy, Chance Rain",
"pm_dust_storms.gif"=>"P.M. Dust",
"pm_rain.gif"=>"P.M. Rain",
"sprinkles.gif"=>"Sprinkles",
"thin_clouds.gif"=>"Thin Clouds");
return $condition[$image];
}


function GetCondition($con){
	$sql = "SELECT condition from weather_images where filename = '$con' and language = 'English'";
	$res = mysql_query($sql);
	$r = mysql_fetch_object($res);
	return $r->condition;
}

function SaveImage(){
	global $_FILES, $imagepath,$azcentralimagepath;
	if(is_uploaded_file($_FILES['imagename']['tmp_name'])){
		$realname = $_FILES[imagename]['name'];
		if(move_uploaded_file($_FILES['imagename']['tmp_name'],$imagepath.$realname)){
			$destination = $azcentralimagepath.$realname;
			copy($imagepath.$realname,$destination);
			/*chown($destination,"junger");
			chgrp($destination,"staff");
			chmod($destination, 0644);
			echo "upload and move complete";*/
		}
		else
			echo "uploaded (but move failed	 file: ". $realname;
	}
	else
		echo "Not uploaded";
}

function DeleteImage(){
	global $originalfilename,$imagepath,$azcentralimagepath;
	if(file_exists($imagepath.$originalfilename))
		unlink($imagepath.$originalfilename);
	if(file_exists($azcentralimagepath.$originalfilename))
		unlink($azcentralimagepath.$originalfilename);
}

?>
