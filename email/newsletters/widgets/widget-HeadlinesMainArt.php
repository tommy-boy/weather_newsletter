<div class="widgetContainer" style="margin:10px 0; width:280px; font-family:Arial, Helvetica, sans-serif;">
<? 
 		echo Format::formatTopper($datasource->topper);
 		
 ?>
<table width="280" style="width:280px;">
<? $h = new HeadlinesMainArt($datasource); ?>
<?=$h->getHeadlines();?>

</table>
<div>






