<?


class MainArtBreaking {
	//this is for ttd sub pages
	
	var $html;
		
	public function __construct($datasource) {
		$this->path = $datasource;
		$this->html = file_get_html($datasource);
		
	}
	
	public function getHeadline(){
		return Format::cleanContent($this->html->find('a',0)->plaintext);
	}
	
	public function getLink(){
		return Format::httpWrap($this->html->find('a',0)->href);
	}

	public function getImage(){
		if(!isset($this->html->find('img',0)->src)){
			return false;
		} else {
			$this->image = Format::absPath($this->html->find('img',0)->src);
			return;
		}
	
	}
	
	public function getAbstract(){
		return Format::cleanContent($this->html->find('p',0)->innertext);
	}
	
	public function __destruct(){
		$this->html->clear();
	}
	
	
}


?>
