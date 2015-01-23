<?


class MostPopular {
	
	static function getHeadlines($datasource, $number = NULL){
		$html = file_get_html($datasource->src);
		
		$links = $html->find('ul',0)->find('li');
		$i = 0;
		$set = NULL;
		
		foreach($links as $link){
			$i++;
			if($i == $number) {
				$set .= '<tr valign="top" style=" padding:5px; border-bottom:none;"><td style="border-bottom:none; padding:8px 8px 10px 8px; font-weight:bold;"><a style="color:#124f7d; font-size:16px; text-decoration:none" href="httpgetwrap|http://www.azcentral.com'.$link->find('a',0)->href.'">'.Format::cleanContent($link->find('a',0)->plaintext).'</a></td></tr>';
				break;
			} else {
				$set .= '<tr valign="top" style=" padding:5px; border-bottom:none;"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;"><a style="color:#124f7d; font-size:16px; text-decoration:none" href="httpgetwrap|http://www.azcentral.com'.$link->find('a',0)->href.'">'.Format::cleanContent($link->find('a',0)->plaintext).'</a></td></tr>';
			}
		}
		$html->clear();
		return $set;
	}
}


?>

