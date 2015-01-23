<? if(self::$type == 'popular') {
	echo '<p></p>';
}
	?>
<div class="widgetContainer" style="containerMA">
<?=Format::formatTopper('most popular');?>
<table width="280" class="headlines" style="font-family:Arial, Helvetica, sans-serif;">
<? 
echo MostPopular::getHeadlines($datasource,$datasource->number);
?>
</table>
<?=Format::readMore('http://www.azcentral.com/main/','More headlines');?>

<div>





