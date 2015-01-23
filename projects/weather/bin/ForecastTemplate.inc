<html>
<head>
<link rel="stylesheet" href="/styles/azcindexes.css" type="text/css">
<link rel="stylesheet" href="/styles/calendar.css" type="text/css">

<script>
var Narrative = '';
Days = new Array();
Days[0] = new Array();
Days[0]["hi"] = 115;
Days[0]["lo"] = 78;
Days[0]["name"] = "Today";
Days[0]["image"] = "cloudy.gif";
Days[1] = new Array();
Days[1]["hi"] = 123;
Days[1]["lo"] = 74;
Days[1]["name"] = "Thurs";
Days[1]["image"] = "rain.gif";
Days[2] = new Array();
Days[2]["hi"] = 111;
Days[2]["lo"] = 88;
Days[2]["name"] = "Fri";
Days[2]["image"] = "drizzle.gif";
Days[3] = new Array();
Days[3]["hi"] = 99;
Days[3]["lo"] = 95;
Days[3]["name"] = "Sat";
Days[3]["image"] = "haze.gif";
Days[4] = new Array();
Days[4]["hi"] = 110;
Days[4]["lo"] = 98;
Days[4]["name"] = "Sun";
Days[4]["image"] = "windy.gif";
Days[5] = new Array();
Days[5]["hi"] = 103;
Days[5]["lo"] = 88;
Days[5]["name"] = "Mon";
Days[5]["image"] = "fog.gif";
Days[6] = new Array();
Days[6]["hi"] = 112;
Days[6]["lo"] = 89;
Days[6]["name"] = "Tues";
Days[6]["image"] = "cold.gif";
</script>

<script>
function FahrenheitToCelcius(val){
	return ((val - 32) / 1.8);
}
function CelciusToFahrenheit(val){
	return ((val + 32) * 1.8);
}
function roundFloat(fltValue, intDecimal) {
       return Math.round(fltValue * Math.pow(10, intDecimal)) / Math.pow(10, intDecimal)
}
function ChangeToCelcius(){
		for(i=0;i<7;i++){
			document.getElementById("day" + i + "_hi").innerHTML = roundFloat(parseFloat(FahrenheitToCelcius(Days[i]["hi"])),0);
			document.getElementById("day" + i + "_lo").innerHTML = roundFloat(parseFloat(FahrenheitToCelcius(Days[i]["lo"])),0);
		}
}
function ChangeToFahrenheit(){
		for(i=0;i<7;i++){
			document.getElementById("day" + i + "_hi").innerHTML = Days[i]["hi"];
			document.getElementById("day" + i + "_lo").innerHTML = Days[i]["lo"];
		}
}
function InitWeather(){
	document.getElementById("narrative").innerHTML = Narrative;
	for(i=0;i<7;i++){
		document.getElementById("day" + i + "_image").src ="/weather/images2/" + Days[i]["image"];
		document.getElementById("day" + i + "_name").innerHTML = Days[i]["name"];
	}
	ChangeToFahrenheit();
}
</script>
</head>






<!-- START -->
<!-- AZCENTRAL FORECAST AND CURRENTS TABLE -->
<table width="529" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="350" valign="top">

<!-- WEATHER TABLE TRIAL -->
<table width="350" border="0" cellpadding="2" cellspacing="0">
<tr><td colspan="7" valign="top" span class="h3hed">Metro Phoenix forecast<br></td></tr>

<tr>
<td span class="sidebar">
<b><span id="day0_name">Today</span></b><br>
<img src="/weather/images2/mostly_sunny.gif" width="46" height="35"><br>
<b>H:</b> <span id="day0_hi" ></span><br>
<b>L:</b> <span id="day0_lo"></span><br>
</td>

<td span class="sidebar">
<b><span id="day1_name">Fri</span></b><br>
<img src="/weather/images2/high_clouds.gif" width="46" height="35"><br>
<b>H:</b> <span id="day1_hi" ></span><br>
<b>L:</b> <span id="day1_lo"></span><br>
</td>

<td span class="sidebar">
<b><span id="day2_name">Sat</span></b><br>
<img src="/weather/images2/partly_cloudy.gif" width="46" height="35"><br>
<b>H:</b> <span id="day2_hi" ></span><br>
<b>L:</b> <span id="day2_lo"></span><br>
</td>

<td span class="sidebar">
<b><span id="day3_name">Sun</span></b><br>
<img src="/weather/images2/mostly_sunny.gif" width="46" height="35"><br>
<b>H:</b> <span id="day3_hi" ></span><br>
<b>L:</b> <span id="day3_lo"></span><br>
</td>

<td span class="sidebar">
<b><span id="day4_name">Mon</span></b><br>
<img src="/weather/images2/partly_cloudy.gif" width="46" height="35"><br>
<b>H:</b> <span id="day4_hi" ></span><br>
<b>L:</b> <span id="day4_lo"></span><br>
</td>

<td span class="sidebar">
<b><span id="day5_name">Tue</span></b><br>
<img src="/weather/images2/mostly_sunny.gif" width="46" height="35"><br>
<b>H:</b> <span id="day5_hi" ></span><br>
<b>L:</b> <span id="day5_lo"></span><br>
</td>

<td span class="sidebar">
<b><span id="day6_name">Wed</span></b><br>
<img src="/weather/images2/mostly_sunny.gif" width="46" height="35"><br>
<b>H:</b> <span id="day6_hi" ></span><br>
<b>L:</b> <span id="day6_lo"></span><br>
</td>
</tr>
</table>
<!-- END WEATHER TABLE TRIAL -->

</td>

<td width="10"><img src="/images/clear.gif" width="10" height="10"></td>
<td width="1" bgcolor="#666666" height="100%"><img src="/images/clear.gif" width="1" height="1"></td>
<td width="10"><img src="/images/clear.gif" width="10" height="10"></td>

<td width="158" valign="top">
<span class="sidebar">Morning rain, heavy at times spread throughout the Valley, turning to showers by the afternoon. This is a major Winter Storm with plenty of snow for the High Country...maybe a foot or more at the highest spots. Travel will be tricky on Tuesday, we'll keep you in the loop!
</span>
</td>
</tr>

<tr>
<td colspan="3"><img src="/images/clear.gif" width="10" height="10"></td>
</tr>

<tr>
<td colspan="5">
<img src="/images2/grayrule.gif" width="529" height="1">
<br>
<a name=foo onClick="ChangeToCelcius();">Celcius</a> &nbsp; <a name=foo2 onClick="ChangeToFahrenheit();">Fahrenheit</a>
</td>
</tr>

</table>

<script>
InitWeather();
</script>

<!-- END AZCENTRAL FORECAST AND CURRENTS TABLE -->
<!-- END -->


