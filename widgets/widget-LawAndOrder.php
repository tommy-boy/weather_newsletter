<div class="widgetContainer" style="margin:10px 0;">
<? 
echo Format::formatTopper($datasource->topper);
?>
<table width="280" class="headlines" style="font-family:Arial, Helvetica, sans-serif;">
<? $c = new LawAndOrder($datasource);?>
<? 
$links = NULL;
$i = 0;
foreach($c->stories as $element){
	$i++;
	if($i == 10) {
			$links .= '<tr valign="top"><td style="border-bottom:none; padding:8px 8px 10px 8px; font-weight:bold;"><a style="color:#124f7d; font-size:16px; text-decoration:none;" href="httpgetwrap|http://www.azcentral.com'.$element->href.'">'.Format::cleanContent($element->innertext).'</a></td></tr>';
break;
	} else {
	$links .= '<tr valign="top"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;"><a style="color:#124f7d; font-size:16px; text-decoration:none;" href="httpgetwrap|http://www.azcentral.com'.$element->href.'">'.Format::cleanContent($element->innertext).'</a></td></tr>';
	}
}
echo $links;
?>
</table>
<div>






