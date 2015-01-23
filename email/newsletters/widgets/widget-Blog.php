<div class="widgetContainer" style="margin:0 0 10px 0;">
<? 

// add the topper if at least one of the bloggers is new
foreach($datasource->id as $data){
	$blogtopper = new Blogs($data); 

	if($blogtopper->checkIfNew()){
		$check = TRUE;
		echo Format::formatTopper($datasource->topper);
		break;
	} else {
		$check = FALSE;
	}
}

foreach($datasource->id as $data){ 
	$blog = new Blogs($data);
	if($blog->checkIfNew()){
?>

<table  class="blog" class="widget" style="width:270px; clear:both; margin:0 auto; padding:0; font-family:Arial, Helvetica, sans-serif;">
	<tr valign="top">
	<td style="margin:0 5px; padding:5px 0;">
		<img src="<?=$blog->data->image?>" width="85" height="auto" align="left" style="margin:0 10px 5px 0; padding:0; width:85px; height:auto;" />
	</td>
	<td style="margin:0; padding:5px 0;">
		<div class="author" style="
		display:block;
		text-transform: uppercase;
		color:#ac0e0e;
		font-size:11px;
		line-height:14px;
		letter-spacing: 2px;
		width:100%;
		margin:3px 0 0 5px; font-family:Arial, Helvetica, sans-serif;"><?=$blog->data->blogger?>
		</div>
		<a class="title" style="display:block;
		color:#215786;
		font-size:16px;
		font-weight: bold; text-decoration:none; line-height:18px; margin:3px 0 0 5px; font-family:Arial, Helvetica, sans-serif;" href="<?=$blog->post[0]->url?>"><?=Format::cleanContent($blog->post[0]->title)?></a>
	</td>
	</tr>
</table>
<? } ?>
<? } ?>

</div>


