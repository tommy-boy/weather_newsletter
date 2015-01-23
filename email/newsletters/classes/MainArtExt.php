
<?

class MainArtExt {
	
	var $html;
	
	public function __construct($datasource) {
		$this->html = file_get_html($datasource);
	}
	
	public function getLink($index){
		return Format::httpWrap($this->html->find('li',$index)->find('a',0)->href);
	}
	
	public function getImg($index){
		$getpath = $this->html->find('li',$index)->find('img',0)->src;
		$findstr = '/brightcove';
		$pos = strpos($getpath, $findstr);
			if ($pos !== false) {
				return $this->html->find('li',$index)->find('img',0)->src;
			} else {
				return Format::absPath($this->html->find('li',$index)->find('img',0)->src);
			}
	
	}
	
	public function getHead($index){		
		return Format::cleanContent($this->html->find('div#showcase-'.$index,0)->find('a.headline',0)->plaintext);
	}
	
	public function getSummary($index){
		return Format::cleanContent($this->html->find('div#showcase-'.$index,0)->find('p',0)->innertext);
	}
	
	
    public function checkBullets($index){
        $number = count($this->html->find('span.extra',$index)->find('a'));
        if($number == 0){ 
            return false;
        } else {
            return true;
        }
            
    }
        
	public function getBullets($index){
		return $this->html->find('span.extra',$index)->find('a');
	}
	

	public function __destruct(){
		$this->html->clear();
	}
	
	
}


?>
			