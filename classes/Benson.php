<?

class Benson {
	
	public function __construct($datasource) {
		$this->html = file_get_html($datasource->src);
		$this->img = Format::absPath($this->html->find('img',0)->src);
		$this->date = $this->html->find('p.toondate',0)->plaintext;
	}
		
	public function __destruct(){
		$this->html->clear();
	}
	
	
}


?>

