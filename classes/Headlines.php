<?


class Headlines {
	
	public function __construct($datasource, $number = NULL) {
		(is_null($number) ? $this->number = 5 : $this->number = $number);
		$this->main = file_get_html($datasource->src1);
		$this->heds = file_get_html($datasource->src2);
	}
	
	public function getFromMain(){
		$this->one = Format::absolutePath($this->main->find('div.box',0)->find('a',0));
		$this->two = Format::absolutePath($this->main->find('div.box',1)->find('a',0));
		return;		
	}
	
	public function getHeadlines(){
		$links = $this->heds->find('ul',0)->find('li');
		$i = 0;
		
		$set = NULL;
		foreach($links as $link){
			if(++$i === $this->number) {
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
		$this->heds->clear();
	}
	
	
}


?>

