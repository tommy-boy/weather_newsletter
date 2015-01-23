<?


class HeadlinesSports {
	
	public function __construct($datasource, $number = NULL) {	
		$this->main = file_get_html($datasource->src1);
		$this->heds = file_get_html($datasource->src2);
	}
	
	public function getFromMain(){
		$links = Format::absolutePath($this->main->find('ul',0)->find('li'));
		$i = 0;
		$set = NULL;
		foreach($links as $link){
			$i++;
			if($i == 5) break;
			if($i == 4) $set .= Format::formatLists($link);
			$set .= Format::formatLists($link);
		}
		return $set;	
	}
	
	/*public function getHeadlines(){
		return Format::formatLists($this->heds->find('ul',0)->find('li',0),'last');
	}*/
	
	public function getHeadlines(){
		$links = $this->heds->find('ul',0)->find('li',0);
		$i = 0;
		$set = NULL;
		foreach($links as $link){
			$i++;
			if($i == 2) break;
			if($i == 1) {
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


	

