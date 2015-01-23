<? $w = new MainArtWeather($datasource); ?>

<div class="widgetContainer">
<?=Format::formatTopper('azcentral forecast')?>

<table width="280" style="font-family:Arial, Helvetica, sans-serif;">
<tr>
<td>
<img src="http://nocache.azcentral.com/imgs/staff-bios/staff-bio-<?=$w->image;?>.jpg" align="left" style="margin:0 7px 7px 0; width:85px; height:85px;" width="85" height="85"/>
<p style="margin:0 0 0 8px; font-size:15px;"><?=$w->forecast?></p>
</td>
</tr>

<?$w->getCurrent();
$i = 0;
?>
<tr>
<?
echo '<td style="text-align:center; margin:0; padding:0;"><strong>'.$w->header[$i].'</strong></td>';
?>
</tr>
<tr>
<?
echo '<td style="text-align:center; margin:0; padding:0;">'.$w->img[$i].'</td>';
?>
</tr>
<tr>
<? 
echo '<td style="text-align:center; margin:0; padding:0 0 20px;">'.$w->high[$i].'/ <span style="color:#7088b4;">'.$w->low[$i].'</span></td>';
?>
</tr>
</table>
</div>


<div class="widgetContainer">
<?=Format::formatTopper('Three-Day Forecast');
	$w->getThreeDay();
?>
<table width="280" cellpadding="0" cellspacing="0" style="background:#F7FBFE; border-bottom:1px solid #ccc; margin:0; padding:0; font-family:Arial, Helvetica, sans-serif;">
<tr>
<? 
for($i = 0; $i < 3; $i++){
	echo '<td style="margin:0; padding:5px 0; text-align:center;"><strong>'.$w->header[$i].'</strong></td>';
}
?>
</tr>
<tr>
<? 
for($i = 0; $i < 3; $i++){
	echo '<td style="margin:0; padding:0; text-align:center;">'.$w->img[$i].'</td>';
}
?>
</tr>
<tr>
<? 
for($i = 0; $i < 3; $i++){
	echo '<td style="margin:0; padding:5px 0; text-align:center;">'.$w->high[$i].' <span style="color:#7088b4;">'.$w->low[$i].'</span></td>';
}
?>
</tr>

</table>
<?=Format::readMore('http://weather.azcentral.com','Complete weather coverage')?>

</div>

<div class="widgetContainer">
<?=Format::formatTopper('Your Photos and Videos')?>
<table width="280" style="font-family:Arial, Helvetica, sans-serif;">
<tr valign="top">
<td colspan="2" style="margin:0; padding:0;">You can upload your weather photos and videos to azcentral.com in just a few easy steps! Get started here:</td></tr>
<tr valign="top">
<td style="margin:0; padding:0; text-align:center;"><a href="https://www.formstack.com/forms/azcentral-photoupload"><img src="http://nocache.azcentral.com/ic/email/channels/weather/images/upload-photos.jpg" border="0" alt="upload a weather photo" /></a></td>
<td style="margin:0; padding:0; text-align:center;"><a href="http://nocache.azcentral.com/ugc"><img src="http://nocache.azcentral.com/ic/email/channels/weather/images/upload-videos.jpg" border="0" alt="upload a weather video" /></a></td>
</tr>
<!--<tr valign="top">
<td style="margin:0; padding:0; text-align:center;"><a href="http://www.azcentral.com/photo/News/Weather"><img src="http://nocache.azcentral.com/ic/email/channels/weather/images/view-photos.jpg" border="0" alt="view weather photos"/></a></td>
<td style="margin:0; padding:0; text-align:center;"><a href="http://www.azcentral.com/video/#/Weather"><img src="http://nocache.azcentral.com/ic/email/channels/weather/images/view-videos.jpg" border="0" alt="view weather videos" /></a></td>
</tr>-->

</table>
</div>



