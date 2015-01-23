<? 
$g = new UpNext(self::$config->route->type); 
if($g->checkIfGame()) { ?>

<div class="widgetContainer" style="margin-top:15px; width:280px;">
<?=Format::formatTopper('Up Next');?>
<table  style="background-color:#F0E1CE; margin:0 0 10px 0; width:280px; font-size:12px; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr valign="top">
<td colspan="2" style="margin:7px 0 5px 0; padding:0;"><p style="margin:7px 10px 0 5px; font-weight:bold; font-size:17px;"><?=$g->game[$g->index]->Away.' @ '.$g->game[$g->index]->Home;?></p></td>
</tr>
<tr valign="top">
	<td style="margin:5px 0; padding:0;"  width="83"><p style="margin:0 10px 0 5px; font-weight:bold; font-size:13px; line-height:1.4;">Date/Time:</p></td>
	<td style="margin:5px 0; padding:0;"><p style="margin:0 10px 0 5px; font-size:13px; line-height:1.4;"><?=UpNext::formatDate($g->game[$g->index]->DisplayDate).' at '.UpNext::formatTime($g->game[$g->index]->DisplayTime);?></p></td>
</tr>
<tr valign="top">
	<td style="margin:5px 0; padding:0;" width="83"><p style="margin:0 10px 10px 5px;  font-weight:bold; font-size:13px; line-height:1.4;">Watch on:</p></td>
	<td style="margin:5px 00; padding:0;"><p style="margin:0 10px 10px 5px; font-size:13px; line-height:1.4;"><?=$g->game[$g->index]->TV;?></p></td>
</tr>
</table>

<div>
<? } ?>



	






