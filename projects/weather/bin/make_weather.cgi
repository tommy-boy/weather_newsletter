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
	if ($today == $day) {
	?>
       		 <table width="300" border="0" cellpadding="2" cellspacing="0">
        	<tr><td colspan="6" span class="h2hed">Metro Phoenix forecast<br></td></tr>
        	<tr>
        	<td colspan="1" span class="story">
        	<b>Today</b><br>
        	<img src="/weather/images2/<? echo $condition; ?>" width="46" height="35"><br>
        	<b>H:</b> <? echo $hi; ?><br>
        	<b>L:</b> <? echo $lo; ?><br></td>
        	<td colspan="5" span class="sidebar" valign="top"><? echo $narrative; ?></td>
        	</tr>
<!--                 <tr><td colspan="6"><hr size="1"></td></tr> -->
                <tr>
	<?
	}
//$db->set_reset();
while ($temp = $db->get_next()) {
	extract($temp);
		$tmp_day = getDOW($day);
	
                echo '  <td span class="story">
                  <b>'.$tmp_day.'</b><br>
		<img src="/weather/images2/'.$condition.'" width="46" height="35"><br>
                  <b>H:</b> '.$hi.'<br>
                  <b>L:</b> '.$lo.'<br></td>
	';
}
?>
</td>
<tr><td colspan="6"><hr size="1"></td></tr>
</table>

