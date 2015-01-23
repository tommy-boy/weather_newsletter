<?

class HeadlinesPreps {
	
	var $html;
		
	public function __construct($datasource) {
		$this->path = $datasource;
		$this->html = file_get_html($datasource);
		
	}
	
	public function getIntro(){	
		return Format::cleanContent($this->html->find('span.intro',0)->plaintext);
	}
	
	public function getAbstract(){
	    $this->one = Format::cleanContent($this->html->find('div.first-item p',1)->plaintext);
	    $this->two = Format::cleanContent($this->html->find('div.first-item p',2)->plaintext);
	    $this->three = Format::cleanContent($this->html->find('div.first-item p',3)->plaintext);
	    return;
	}
	
	public function getLink(){
		return Format::httpWrap($this->html->find('div.first-item a',0)->href);
	}

	public function getImage(){
		return Format::cleanContent($this->html->find('img',0)->src);
	}	
}

?>
