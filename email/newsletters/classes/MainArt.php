<?


class MainArt {
	
	var $html;
		
	public function __construct($datasource) {
		$this->path = $datasource;
		$this->html = file_get_html($datasource);
		
	}
	
	public function getHeadline(){
		return Format::cleanContent($this->html->find('div.callout a.headline',0)->plaintext);
	}
	
	public function getLink(){
		return Format::httpWrap($this->html->find('div.callout a',0)->href);
	}
	
	public function getImage(){
		if(!isset($this->html->find('div.callout img',0)->src)){
			return false;
		} else {
		return Format::absPath($this->html->find('div.callout img',0)->src);
		}	
	}
	
	public function getAbstract(){
		return Format::cleanContent($this->html->find('div.callout p',0)->innertext);
	}
	
	public function __destruct(){
		//echo 'its over';
	}
	
	
}


?>
