<? $m = new Top5($datasource); ?>
<div class="" style="margin:0 0 20px 0; padding:0; width:280px; ">
<img src="http://www.azcentral.com/email/newsletters/images/topfive-logo.gif" width="288" height="76" border="0"/>
<table width="280" style="margin-top:3px; width:280px; font-family:Arial, Helvetica, sans-serif; ">
<tr>
<td style="margin:0; padding:0;">

<a href="<?=$m->getElement('a','div.first-item a',0)?>" style="text-decoration:none; font-size:23px; color:#215786; line-height:23px; font-weight:bold; margin:-4px 0 0 0; display:block;">
<?=$m->getElement('h2','div.first-item a',0)?></a>

<? if($m->getElement('img','div.first-item img',0)) { ?>
<a href="<?=$m->getElement('a','div.first-item a',0)?>"><img width="280" src="<?=$m->img?>" style="margin:0; padding:5px 0; width:280px; height:auto;"/></a>
<? } ?>
<p class="mainArt" style="font-size:15px; margin:5px 0px; color:#333; line-height:16px;"><?=$m->getElement('p','.first-item p',0)?></p>
<?=Format::readMore($m->getElement('a','div.first-item a',0),'Read the full story');?>
</td>
</tr>
</table>
</div>


<div class="widgetContainer" style="margin:0 0 20px 0; padding:0;">


<table width="280" style="width:280px; margin:0; padding:0; font-size:15px; line-height:17px; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr valign="top">
<? if($m->getElement('img','div.item1 img',0)){?>
<td width="100" style="border-bottom:1px solid #cf8522; padding:10px 10px 10px 0;"><img src="<?=$m->img;?>" border="0" width="100"  height="67" align="left"></td>
<td style="border-bottom:1px solid #cf8522; "><p style="margin:0 0; width:100%; padding:10px 10px 10px 0;"><a style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item1 a',0)?>" ><?=$m->getElement('h2','div.item1 a',0);?></a></p></td></tr>
<? } else { ?>
<td style="border-bottom:1px solid #cf8522; margin:10px 0 0 0; padding:10px 5px 0 5px;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item1 a',0)?>" ><?=$m->getElement('h2','div.item1 a',0);?></a></p>
<p style="margin:0; padding:0; width:100%;"><?=$m->getElement('p','div.item1 p',0);?></p>
<?=Format::readMore($m->getElement('a','div.item1 a',0,'margin:0 0 5px 0;'),'Read the full story'); ?>
<br/>
</td></tr>
<? } ?>
</table>

<table width="280" style="width:280px; margin:0; padding:0; font-size:15px; line-height:17px; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr valign="top">
<? if($m->getElement('img','div.item2 img',0)){?>
<td width="100" style="border-bottom:1px solid #cf8522; padding:10px 10px 10px 0;"><img src="<?=$m->img;?>" border="0" width="100"  height="67" align="left"></td>
<td style="border-bottom:1px solid #cf8522;"><p style="margin:0 0; width:100%; padding:10px 10px 10px 0;"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item2 a',0)?>" ><?=$m->getElement('h2','div.item2 a',0);?></a></p></td></tr>
<? } else { ?>
<td style="border-bottom:1px solid #cf8522; margin:10px 0 0 0; padding:10px 5px 0 5px;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item2 a',0)?>" ><?=$m->getElement('h2','div.item2 a',0);?></a></p>
<p style="margin:0; padding:0; width:100%;"><?=$m->getElement('p','div.item2 p',0);?></p>
<?=Format::readMore($m->getElement('a','div.item2 a',0,'margin:0 0 5px 0;'),'Read the full story'); ?>
<br/>
</td></tr>
<? } ?>

</table>

<table width="280" style="width:280px; margin:0; padding:0; font-size:15px; line-height:17px; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr valign="top">
<? if($m->getElement('img','div.item3 img',0)){?>
<td width="100" style="border-bottom:1px solid #cf8522; padding:10px 10px 10px 0;"><img src="<?=$m->img;?>" border="0" width="100"  height="67" align="left"></td>
<td style="border-bottom:1px solid #cf8522;"><p style="margin:0 0; width:100%; padding:10px 10px 10px 0;"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item3 a',0)?>" ><?=$m->getElement('h2','div.item3 a',0);?></a></p></td></tr>
<? } else { ?>
<td style="border-bottom:1px solid #cf8522; margin:10px 0 0 0; padding:10px 5px 0 5px;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item3 a',0)?>" ><?=$m->getElement('h2','div.item3 a',0);?></a></p>
<p style="margin:0; padding:0; width:100%;"><?=$m->getElement('p','div.item3 p',0);?></p>
<?=Format::readMore($m->getElement('a','div.item3 a',0,'margin:0 0 5px 0;'),'Read the full story'); ?>
<br/>
</td></tr>
<? } ?>
</table>

<table width="280" style="width:280px; margin:0; padding:0; font-size:15px; line-height:17px; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr valign="top">
<? if($m->getElement('img','div.item4 img',0)){?>
<td width="100" style="border-bottom:1px solid #cf8522; padding:10px 10px 10px 0;"><img src="<?=$m->img;?>" border="0" width="100"  height="67" align="left"></td>
<td style="border-bottom:1px solid #cf8522; padding:10px 10px 10px 0;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item4 a',0)?>" ><?=$m->getElement('h2','div.item4 a',0);?></a></p></td></tr>
<? } else { ?>
<td style="margin:10px 0 0 0; padding:10px 5px 0 5px;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item4 a',0)?>" ><?=$m->getElement('h2','div.item4 a',0);?></a></p>
<p style="margin:0; padding:0; width:100%;"><?=$m->getElement('p','div.item4 p',0);?></p>
<?=Format::readMore($m->getElement('a','div.item4 a',0,'margin:0 0 5px 0;'),'Read the full story'); ?>
<br/>
</td></tr>
<? } ?>
</table>


</div>

