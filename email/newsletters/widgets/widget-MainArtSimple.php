
<? $m = new MainArtSimple($datasource); ?>
<div class="widgetContainerMA" style="margin:5px 0 5px 0; width:280px;">

<table width="280" style="width:280px; margin:0; padding:0; font-family:Arial, Helvetica, sans-serif;">
<tr valign="top">
<td>
<a href="<?=$m->getLink()?>" style="text-decoration:none;"><h1 class="mainArt" style="	font-size:23px; color:#215786; line-height:23px; font-weight:bold; margin:-4px 0 5px 0;"><?=$m->getHeadline()?></h1></a>
<a href="<?=$m->getLink()?>"><img width="280" src="<?=$m->getImage()?>" style="width:280px; height:auto;"/></a>
<p class="mainArt" style="font-size:15px; margin:5px 0px;	color:#333; line-height:16px;"	><?=$m->getAbstract()?></p>
</td>
</tr>
</table>
<table width="280" style="margin:0; padding:0; width:280px; text-align:right; font-family:Arial, Helvetica, sans-serif;" ><tr><td style=" margin:0; padding:0;" ><a style="vertical-align:middle; font-size:14px; font-weight:bold; color:#124f7d; text-decoration:none;" href="<?=$m->getLink()?>">
<? if(self::$config->route->type == 'movies' || self::$config->route->type == 'dining'){?>
	Read the full review
<? } ?>
<? if(self::$config->route->channel == 'sports'){?>
	Read the full story on azcentral sports
<? } ?>
<? if(self::$config->route->channel == 'opinions'){?>
	Read more at opinions.azcentral.com
<? } ?>
<img src="http://www.azcentral.com/email/newsletters/images/read-more.jpg" border="0" style="margin:0 0 0 3px; padding:0; vertical-align:middle;" /></a>
</td>
</tr>
</table>
</div>





