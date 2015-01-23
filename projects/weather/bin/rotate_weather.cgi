#!/usr/local/bin/php -q
<?

include("/projects/weather/bin/common.inc");

$db = new Db("weatherdata");
#$db->set_debug(1);
$db->query("SELECT * FROM narrative WHERE id='2'");
$temp = $db->get_next();
extract($temp);
$narrative = addslashes($narrative);
$db->query("UPDATE narrative SET narrative='$narrative' WHERE id='1'");
$db->query("UPDATE narrative SET narrative='' WHERE id='2'");

$db->query("SELECT day_id FROM tool_forecast ORDER BY day_id LIMIT 1");
$temp = $db->get_next();
extract($temp);
$db->query("DELETE FROM tool_forecast WHERE day_id='$day_id'");

/****** Added for spanish processing (following existing code style) -eric.brown@pni.com- *********/
$db->query("SELECT * FROM narrative_spanish WHERE id='2'");
$temp2 = $db->get_next();
extract($temp2); // 'extract()' ?? lol .. WHO uses THAT??!??
$narrative = addslashes($narrative);
$db->query("UPDATE narrative_spanish SET narrative ='$narrative' WHERE id='1'");
$db->query("UPDATE narrative_spanish SET narrative ='' WHERE id='2'");
/************END spanish *******************/

/*
$db->query("DELETE FROM tool_forecast WHERE day_id < DATE_FORMAT(NOW(),'%Y/%m/%d')");
$new_time = time();
$new_time = (7 * 86400) + $new_time;
$tday = date("w",$new_time);
$tday++;
$tid_day = date("Y/m/d",$new_time);
$db->query("INSERT INTO tool_forecast VALUES ('$tday','$tid_day','$new_time','sunny.gif','0','0')");
*/
?>

