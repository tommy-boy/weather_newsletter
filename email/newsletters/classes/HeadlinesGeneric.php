<?


class HeadlinesGeneric {
	
	public function __construct($datasource) {
		(is_null($datasource->number) ? $this->number = 5 : $this->number = $datasource->number);
		$this->heds = file_get_html($datasource->src);
		$this->index = $datasource->index;
	}
		
	public function getHeadlines(){
		$links = $this->heds->find('ul',$this->index)->find('li');
		$i = 0;
		$set = NULL;
		foreach($links as $link){
			if($i == $this->number) break;
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
		$this->heds->clear();
	}
	
	
}


?>

