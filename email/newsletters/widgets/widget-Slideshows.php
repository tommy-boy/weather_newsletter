
<? $s = new Slideshows($datasource); ?>
<div class="" style="margin:10px 0; width:280px;" width="280px;">

<table width="280" style="width:280px; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif;">
<tr>
	<td><a href="<?=$s->getLink()?>" style="text-decoration:none;"><h1 class="mainArt" style="font-size:23px; color:#215786; line-height:23px; font-weight:bold; margin:-4px 0 5px 0; width:100%;"><?=$s->getHeadline()?></h1></a><a href="<?=$s->getLink()?>"><img class="mainArt" src="<?=$s->getImage()?>" style="width:280px; height:auto;" width="280" /></a>
		<p class="mainArt" style="font-size:15px; margin:5px 0px;	color:#333; line-height:16px;"><?=$s->getAbstract()?></p>
		<?=Format::readMore($s->getLink(),'View this slideshow on azcentral')?>
		
	</td>
</tr>
</table>
</div>


<div class="widgetContainer" style="margin:10px 0; width:280px;" width="280">
<?=Format::formatTopper($datasource->topper);?>
<table width="280" style="width:280px; font-family:Arial, Helvetica, sans-serif;">
<? 
$i = 1;
while($i <= 4){
?>
<? if($s->getElement('img',$i)){ ?>
<tr valign="top">
<td width="105"><a href="<?=$s->getElement('a',$i);?>"><img src="http://www.azcentral.com<?=$s->getElement('img',$i);?>" border="0" width="100" style="margin:5px;" height="67" align="left"></a></td>
<td><p style="margin:5px; width:100%"><a style="font-size:16px; line-height:18px; font-weight:bold; color:#124f7d; text-decoration:none;" href="<? $s->getElement('a',$i)?>" ><?=$s->getElement('h2',$i);?></a></p></td>
</tr>
<? } ?>
<? ++$i; }?>
</table>
<?=Format::readMore($datasource->more->url,$datasource->more->message);?>
</div>





