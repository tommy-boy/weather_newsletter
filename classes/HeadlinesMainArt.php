<?
class HeadlinesMainArt {
	
	public function __construct($datasource, $number = NULL) {
		$this->main = file_get_html($datasource->src1);
	}
	
	public function getHeadlines(){
		$links = Format::absolutePath($this->main->find('ul',0)->find('li'));
		$i = 0;
		$set = NULL;
		foreach($links as $link){
		$set .= '<tr valign="top" style=" padding:5px; border-bottom:none;"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;"><a style="color:#124f7d; font-size:16px; text-decoration:none" href="httpgetwrap|http://www.azcentral.com'.$link->find('a',0)->href.'">'.$link->find('a',0)->plaintext.'</a></td></tr>';

		
		}
		return $set;	
	}

	public function __destruct(){
		$this->main->clear();
	}
	
	
}


?>

