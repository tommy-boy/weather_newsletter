<?

class Subject {

	var $html;
		
	static function getSubject($datasource,$element,$channel = 'NULL') {
		if(preg_match('/v8_weatherforecast/',$datasource)){
			$html = file_get_html($datasource);
			$a = explode('~',Format::decodeHtmlString($html->find($element,0)->plaintext));	
			echo '12 News Weather '.$a[1];
		} elseif($channel == 'opinions'){
			$html = file_get_html($datasource);
			echo 'Opinions: '.Format::decodeHtmlString($html->find($element,0)->plaintext);	
		} 
		else {
			$html = file_get_html($datasource);
			echo Format::decodeHtmlString($html->find($element,0)->plaintext);	
		}
		unset($html);
	}

}


?>