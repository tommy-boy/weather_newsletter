<? $s = new HeadlinesPreps($datasource); ?>
<div class="" style="margin:10px 0; width:280px;" width="280px;">
<table width="280" style="width:280px; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333;">
<? $s->getAbstract();?>
<tr>
	<td>
	 	<p style="margin:5px 0px;"><?=$s->getIntro()?></p>
		<p style="margin:5px 0px;"><img src="https://cipher.azcentral.com/uploads/photo/i/4/d/3/S43_CIFR39ed445425154af7021927f06fb4e3d4.jpg" align="right" width="130" height="98" />
		<?=$s->one?>
		</p>		
		<p style="margin:5px 0px;"><?=$s->two?><a href="<?=$s->getLink()?>">here</a>.</p>
		<p style="margin:5px 0px;"><?=$s->three?></p>
		<p style="margin:5px 0px;">Don’t miss all of our game stories tomorrow at <a href="http://highschools.azcentral.com">highschools.azcentral.com</a></p>
		<p style="margin:5px 0px;">Connect with us on Twitter and Facebook!<br />Please contact me if you have any questions and thank you so much for your effort in helping us promote our coverage of high school sports!</p>	
		<p style="margin:5px 0px;">Cheers,</p>
		<p>Jordan Johnson<br />
		jjohnson@azcentral.com</p>
	</td>
</tr>
</table>
</div>