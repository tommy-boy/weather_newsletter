<div class="widgetContainer" style="margin:10px 0;">
<?=Format::formatTopper('Top Stories');?>
<table width="280" class="headlines" style="font-family:Arial, Helvetica, sans-serif;">
<? $h = new HeadlinesPolitics($datasource,3); ?>
<? $h->getFromMain();?>
<? $h->getFromMiddle();?>
<? //$h->getHeadlines();?>

<tr valign="top"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;"><?=$h->one?></td></tr>
<tr valign="top"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;"><?=$h->two?></td></tr>
<tr valign="top"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;"><?=$h->three?></td></tr>
<tr valign="top"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;"><?=$h->four?></td></tr>
</table>
<div>


<!--<div class="widgetContainer">
<? echo Format::formatTopper('Arizona Politics');?>
<table width="100%" class="headlines">

<?=$h->getHeadlines();?>


</table>
<div>-->



