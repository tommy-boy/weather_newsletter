<?
class LawAndOrder {
	public function __construct($datasource) {
		$this->html = file_get_html($datasource->src);
		$this->stories = $this->html->find('h2 a');
	}

	public function __destruct(){
		$this->html->clear();
	}
}


?>

