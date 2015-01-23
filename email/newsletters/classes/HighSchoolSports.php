<?

class HighSchoolSports {
	
	var $html;
	var $img;
		
	public function __construct($datasource) {
		$this->path = $datasource;
		$this->html = file_get_html($datasource);
	}
	
	public function getElement($element,$path,$index){
		if($element == 'a'){
			return Format::httpWrap($this->html->find($path,$index)->href);
		}
		elseif($element == 'img'){
			if($this->html->find($path,$index)->src){
				$this->img = Format::absPath($this->html->find($path,$index)->src);
				return true;
			} else {
				return false;
			}
		} else {
			return Format::cleanContent($this->html->find($path,$index)->plaintext);
		}		
	}
	
	public function __destruct(){
		$this->html->clear();
	}
}


?>
