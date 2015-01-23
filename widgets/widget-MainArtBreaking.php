<? $m = new MainArtBreaking($datasource); ?>

<div class="widgetContainerMA" style="margin:5px 0 5px 0;">

<table width="280" style="font-family:Arial, Helvetica, sans-serif;">
<tr>
<td>
<a href="<?=$m->getLink()?>" style="text-decoration:none;"><h1 class="mainArt" style="font-size:23px;
	color:#215786;
	line-height:23px;
	font-weight:bold;
	margin:-4px 0 5px 0;
	width:100%;"><?=$m->getHeadline()?></h1></a>
<? if($m->getImage() == TRUE){ ?>
<a href="<?=$m->getLink()?>"><img class="mainArt" src="<?=$m->image?>" style="width:280px; height:auto;"/></a>
<? } else {}?>
<p class="mainArt" style="font-size:15px;
	margin:5px 0px;	
	color:#333;
	line-height:16px;"><?=$m->getAbstract()?></p>

<table style="margin:0; padding:0; width:280px;"><tr><td align="right"><a style="font-size:12px; font-family:Arial; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getLink()?>">Follow this story on azcentral</td><td><img src="http://www.azcentral.com/email/newsletters/images/read-more.jpg" border="0" style="margin-left: 5px; padding:0; vertical-align:middle;" /></a></td></tr></table>

</td>

</tr>
</table>
</div>





