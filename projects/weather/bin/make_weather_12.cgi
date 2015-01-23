#!/usr/local/bin/php -q
<?
include("/projects/weather/bin/common.inc");

function today () {
		 $temp = getdate();
		 $temp = $temp['wday'];
		 return $temp;
}

function getDOW($day)  {
		 switch ($day)  {
		 		 case 1:
		 		 		 return "Sun\n";
		 		 		 break;
		 		 case 2:
		 		 		 return "Mon\n";
		 		 		 break;
		 		 case 3:
		 		 		 return "Tue\n";
		 		 		 break;
		 		 case 4:
		 		 		 return "Wed\n";
		 		 		 break;
		 		 case 5:
		 		 		 return "Thu\n";
		 		 		 break;
		 		 case 6:
		 		 		 return "Fri\n";
		 		 		 break;
		 		 case 7:
		 		 		 return "Sat\n";
		 		 		 break;
		 }
}

$db = new Db("weatherdata");
//$db->set_debug(1);
$db->query("SELECT * FROM tool_forecast,narrative WHERE id='1' ORDER BY day_stamp LIMIT 7");
		 $temp = $db->get_next();
		 extract($temp);
		 $narrative = stripslashes($narrative);
		 $today = today();
		 $today++;
//		 if ($today == $day) {
		 ?>
       		 		  <table width="267" border="0" cellpadding="2" cellspacing="0">
        		 <tr>
        		 <td width="50" span class="story">
        		 <b>Today</b><br>
        		 <img src="/weather/images2/<? echo $condition; ?>" width="46" height="35"><br>
        		 <b>H:</b> <? echo $hi; ?><br>
        		 <b>L:</b> <? echo $lo; ?><br></td>
        		 <td width="217" span class="sidebar" valign="top"><? echo $narrative; ?></td>
        		 </tr>
</table>
