<?


class Hotlists {
	
	public function __construct($datasource) {
		$this->items = file_get_html($datasource->src);
	}
		
	public function getItems($element,$index){
		switch($element){
			case 'img':
				return Format::absPath($this->items->find('ul li img',$index)->src);
				break;
			case 'a':
				return Format::httpWrap($this->items->find('ul li a',$index)->href);
				break;
			case 'text':
				return Format::cleanContent($this->items->find('ul li',$index)->plaintext);
				break;
		}
	}

	public function __destruct(){
		$this->items->clear();
	}
	
	
}


?>

