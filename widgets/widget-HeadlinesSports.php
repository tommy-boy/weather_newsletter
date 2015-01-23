<div class="widgetContainer">

<?=Format::formatTopper('headlines');?>

<table class="headlines" style="width:280px; font-family:Arial, Helvetica, sans-serif;">
<? $h = new HeadlinesSports($datasource); ?>
<?=$h->getFromMain();?>
</table>

<?=Format::readMore($datasource->more,'More '.ucfirst(self::$config->route->type).' News');?>
</div>