
<? $c = new MainArtExt($datasource); ?>
<? $i = 0; for($i; $i < 3; $i++){ ?>

<div class="widgetContainerMA" style="margin:10px 0 5px 0;">
<table width="280" style="font-family:Arial, Helvetica, sans-serif;">
<tr>
<td>
    <a href="<?=$c->getLink($i)?>" style="text-decoration:none;"><h1 class="mainArt" style="font-size:23px; color:#215786; line-height:23px;font-weight:bold; margin:-4px 0 5px 0;width:100%;"><?=$c->getHead($i)?></h1></a>
    <a href="<?=$c->getLink($i)?>"><img src="<?=$c->getImg($i)?>" border="0" width="280" style="width:280px; height:auto; display:block;" /></a>
    <p style="font-size:15px; margin:5px 0px; color:#333; line-height:16px;"><?=$c->getSummary($i);?></p>
    <?=Format::readMore($c->getLink($i), 'Read the full story','margin:0px 0 5px 0;')?>

<?
if(self::$config->route->type != 'daily'){
if($c->checkBullets($i)){
$row = NULL;
?>
<table class="headlines" style="width:280px; margin:0px 0; padding:0; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
<tr>

<td colspan="2" style="border-bottom:1px solid #cf8522; height:10px;"></td>
</tr>    
    
<? foreach($c->getBullets($i) as $element){

    $row .= '<tr valign="middle">
            <td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-family: Arial, Helvetica, sans-serif; font-weight:bold;">
                <a style="color:#124f7d; text-decoration:none;" href="'.Format::httpWrap($element->href).'">'.Format::cleanContent($element->plaintext).'</a>
            </td>
            </tr>';
}
echo $row;
?>
</table>
<? } } ?>
</td>
</tr>
</table>
</div>
<? } ?>








