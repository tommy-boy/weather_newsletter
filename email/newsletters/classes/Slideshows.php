<?


class Slideshows {
	
	var $html;
		
	public function __construct($datasource) {
		$this->html = file_get_html($datasource->src);
	}
	
	public function getHeadline(){
		return Format::cleanContent($this->html->find('h2',0)->plaintext);
	}
	
	public function getLink(){
		return Format::httpWrap($this->html->find('a',0)->href);
	}

	public function getImage(){
		return str_replace('S32','L32',Format::absPath($this->html->find('img',0)->src));
	}
	
	public function getAbstract(){
		return Format::cleanContent($this->html->find('p',0)->innertext);
	}
	
	
	public function getElement($element, $index){
		if($element == 'img'){
			//return $index;
			return $this->html->find('img',$index)->src;
		} elseif($element == 'a') {
			//return $index;
			return 'httpgetwrap|http://www.azcentral.com'.$this->html->find('a',$index)->href;
		} else {
			//return $index;
			return Format::cleanContent($this->html->find($element,$index)->plaintext);
		}
	}


	
		
	
}


?>
