<div class="widgetContainer" style="margin:12px 0; font-family:Arial, Helvetica, sans-serif;">
<?=Format::formatTopper($datasource->topper);?>

<table width="280" class="headlines" style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">
<? $h = new HeadlinesInsider($datasource); ?>
<?=$h->getHeadlines();?>

</table>
<? if($datasource->more != '') echo Format::readMore($datasource->more->url, $datasource->more->message);?>

<div>