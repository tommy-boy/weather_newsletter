<?


class MainArtSimple {
	//this is for ttd sub pages
	
	var $html;
		
	public function __construct($datasource) {
		$this->path = $datasource;
		$this->html = file_get_html($datasource);
		
	}
	
	public function getHeadline(){
		return Format::cleanContent($this->html->find('span.title',0)->plaintext);
	}
	
	public function getLink(){
		return Format::httpWrap($this->html->find('a',0)->href);
	}
	
	public function getImage(){
		if(!isset($this->html->find('img',0)->src)){
			return false;
		} else {
			return Format::absPath($this->html->find('img',0)->src);
		}
	}
	
	
	public function getAbstract(){
		return Format::cleanContent($this->html->find('p.abstract',0)->innertext);
	}
	
	public function __destruct(){
		//echo 'its over';
	}
	
}


?>
