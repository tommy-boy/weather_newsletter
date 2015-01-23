<?


class HeadlinesPolitics {
	
	public function __construct($datasource) {
		$this->main = file_get_html($datasource->src1);
		$this->middle = file_get_html($datasource->src2);
		$this->heads = file_get_html($datasource->src3);
	}
	
	public function getFromMain(){
		$this->one = Format::absolutePath($this->main->find('div.box',0)->find('a',0));
		$this->two = Format::absolutePath($this->main->find('div.box',1)->find('a',0));
		return;		
	}
	
	public function getFromMiddle(){
		$this->three = Format::absolutePath($this->middle->find('a',0)->outertext);
		$this->four = Format::absolutePath($this->middle->find('a',1)->outertext);
		return;		
	}

	
	public function getHeadlines($number = NULL){
		(is_null($number) ? $number = 5 : $number = $number);
	
		$links = $this->heads->find('li');
		$i = 0;
		
		$set = NULL;
		foreach($links as $link){
			if(++$i === $number) {
				$set .= Format::formatLists($link,'last');
				break;
			} else {
				$set .= Format::formatLists($link);
			}
		}
		return $set;
	}

	public function __destruct(){
		$this->main->clear();
		$this->middle->clear();
		$this->heads->clear();
	}
	
	
}


?>

