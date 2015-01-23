<div class="widgetContainer" style="margin:10px 0; font-family:Arial, Helvetica, sans-serif;">
<? 
	if(self::$config->route->channel == 'news'){
 		echo Format::formatTopper('headlines');
 	} 
 	if(self::$config->route->channel == 'business'){
 		echo Format::formatTopper('more headlines');
 	} 
 	if(self::$config->route->channel == 'community'){
 		echo Format::formatTopper('more '.self::$config->route->type.' headlines');
 	}
 	if(self::$config->route->channel == '12news'){
 		echo Format::formatTopper('community focus');
 	}
 ?>
 
<?
//var_dump($config);
?>
<table width="280" class="headlines" style="font-size:14px;">
<? (self::$config->route->channel == 'news' ? $h = new Headlines($datasource) : $h = new Headlines($datasource,3)); ?>
<?=$h->getFromMain();?>
<tr valign="top"><td style="font-family:Arial, Helvetica, sans-serif; border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold; font-size:16px;"><?=$h->one?></td></tr>
<tr valign="top"><td style="font-family:Arial, Helvetica, sans-serif; border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold; font-size:16px;"><?=$h->two?></td></tr>
<?=$h->getHeadlines();?>

</table>
<div>






