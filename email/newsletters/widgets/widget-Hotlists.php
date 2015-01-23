<? 
 		echo '<div style="margin:0; padding:0; display:block;">'.Format::formatTopper(''.$datasource->title	).'</div>';
 ?>
 <table cellpadding="0" cellspacing="0" style="margin:0; padding:0; border:none; font-family:Arial, Helvetica, sans-serif;">
						<tr valign="top" style="margin:0; padding:0;" id="hotlists">

<? $item = new Hotlists($datasource); 
	for($i = 0; $i < 4; $i++){ 
?>
<td width="150" style="margin:0; padding:0; text-align:center;" cellpadding="0" cellspacing="0">
	<a href="<?=$item->getItems('a',$i);?>" style="text-decoration:none;"><img src="<?=$item->getItems('img',$i);?>" width="150" height="111" border="none" style="margin:0; padding:0; text-decoration:none; " /><p style="font-size:14px; color:#333; font-weight:bold; line-height:15px; margin:5px 0; text-decoration:none;"><?=$item->getItems('text',$i);?><p></a>
</td>		
<? } ?>
</tr>
					</table>

	

