<? $m = new HighSchoolSports($datasource); ?>

<div class="" style="margin:0; padding:0; width:280px; ">

<table width="280" style="margin-top:3px; width:280px; font-family:Arial, Helvetica, sans-serif; ">
<tr>
<td>

<p style="text-decoration:none; font-size:23px; color:#000; line-height:23px; font-weight:bold; margin:10px 0 0 0; display:block;">High School Sports</p>

<? if($m->getElement('img','div.first-item img',0)) { ?>
<a href="<?=$m->getElement('a','div.first-item a',0)?>"><img width="280" src="<?=$m->img?>" style="margin:0; padding:5px 0; width:280px; height:auto;"/></a>
<p style="margin:0; padding:10px 0; width:100%; border-bottom:1px solid #cccccc;"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#205788;" href="<?=$m->getElement('a','div.first-item a',0)?>" ><?=$m->getElement('h2','div.first-item a',0);?></a></p>
<? } else { ?>
<p style="margin:0; padding:10px 0; width:100%; border-bottom:1px solid #cccccc;"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#205788;" href="<?=$m->getElement('a','div.first-item a',0)?>" ><?=$m->getElement('h2','div.first-item a',0);?></a></p>
<? } ?>
</td>
</tr>
</table>
</div>

<div class="widgetContainer" style="margin:0 0 20px 0; padding:0;">

<table width="280" style="width:280px; margin:0; padding:0; font-size:15px; line-height:17px; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr valign="top">
<? if($m->getElement('img','div.item1 img',0)){?>
<td width="100" style="border-bottom:1px solid #cccccc; padding:10px 10px 10px 0;"><img src="<?=$m->img;?>" border="0" width="100"  height="67" align="left"></td>
<td style="border-bottom:1px solid #cccccc;"><p style="margin:0 0; width:100%; padding:10px 10px 10px 0;"><a style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#205788;" href="<?=$m->getElement('a','div.item1 a',0)?>" ><?=$m->getElement('h2','div.item1 a',0);?></a></p></td></tr>
<? } else { ?>
<td style="border-bottom:1px solid #cccccc; margin:10px 0 0 0; padding:10px 5px 0 5px;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#205788;" href="<?=$m->getElement('a','div.item1 a',0)?>" ><?=$m->getElement('h2','div.item1 a',0);?></a></p>
<p style="margin:0; padding:0; width:100%;"><?=$m->getElement('p','div.item1 p',0);?></p>
<br/>
</td></tr>
<? } ?>
</table>

<table width="280" style="width:280px; margin:0; padding:0; font-size:15px; line-height:17px; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr valign="top">
<? if($m->getElement('img','div.item2 img',0)){?>
<td width="100" style="border-bottom:1px solid #cccccc; padding:10px 10px 10px 0;"><img src="<?=$m->img;?>" border="0" width="100"  height="67" align="left"></td>
<td style="border-bottom:1px solid #cccccc;"><p style="margin:0 0; width:100%; padding:10px 10px 10px 0;"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item2 a',0)?>" ><?=$m->getElement('h2','div.item2 a',0);?></a></p></td></tr>
<? } else { ?>
<td style="border-bottom:1px solid #cccccc; margin:10px 0 0 0; padding:10px 5px 0 5px;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item2 a',0)?>" ><?=$m->getElement('h2','div.item2 a',0);?></a></p>
<p style="margin:0; padding:0; width:100%;"><?=$m->getElement('p','div.item2 p',0);?></p>
<br/>
</td></tr>
<? } ?>

</table>

<table width="280" style="width:280px; margin:0; padding:0; font-size:15px; line-height:17px; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr valign="top">
<? if($m->getElement('img','div.item3 img',0)){?>
<td width="100" style="border-bottom:1px solid #cccccc; padding:10px 10px 10px 0;"><img src="<?=$m->img;?>" border="0" width="100"  height="67" align="left"></td>
<td style="border-bottom:1px solid #cccccc;"><p style="margin:0 0; width:100%; padding:10px 10px 10px 0;"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item3 a',0)?>" ><?=$m->getElement('h2','div.item3 a',0);?></a></p></td></tr>
<? } else { ?>
<td style="border-bottom:1px solid #cccccc; margin:10px 0 0 0; padding:10px 5px 0 5px;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item3 a',0)?>" ><?=$m->getElement('h2','div.item3 a',0);?></a></p>
<p style="margin:0; padding:0; width:100%;"><?=$m->getElement('p','div.item3 p',0);?></p>
<br/>
</td></tr>
<? } ?>
</table>

<table width="280" style="width:280px; margin:0; padding:0; font-size:15px; line-height:17px; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr valign="top">
<? if($m->getElement('img','div.item4 img',0)){?>
<td width="100" style="border-bottom:1px solid #cccccc; padding:10px 10px 10px 0;"><img src="<?=$m->img;?>" border="0" width="100"  height="67" align="left"></td>
<td style="border-bottom:1px solid #cccccc; padding:10px 10px 10px 0;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item4 a',0)?>" ><?=$m->getElement('h2','div.item4 a',0);?></a></p></td></tr>
<? } else { ?>
<td style="margin:10px 0 0 0; padding:10px 5px 0 5px;"><p style="margin:0 0; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; text-decoration:none; color:#124f7d;" href="<?=$m->getElement('a','div.item4 a',0)?>" ><?=$m->getElement('h2','div.item4 a',0);?></a></p>
<p style="margin:0; padding:0; width:100%;"><?=$m->getElement('p','div.item4 p',0);?></p>
<br/>
</td></tr>
<? } ?>
</table>

</div>

