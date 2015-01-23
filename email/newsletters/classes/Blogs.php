<?

class Blogs {
	
	public $data;
	public $post;
	
	public function __construct($id){
		$devcheck = ('devwww'==substr($_SERVER['HTTP_HOST'],0,6)) ? 'devic' : '';
		$this->data = json_decode(file_get_contents('http://'.$devcheck.'www.azcentral.com/insiders/embed/json.php?id='.$id));
		$this->post = $this->data->posts;
	}
	
	public function checkIfNew(){
		$now = date('Y-m-d H:i:s');
		$posted = $this->data->posts[0]->date;
		$diff = round(((strtotime($now)-strtotime($posted))/60)/60,1);
		if($diff <= 23){
			return true;
		} else {
			return false;
		}		
	}
	
	public function friendly_date(){
		return date('M j, Y g:i A', strtotime($this->data->posts[0]->date));
		
	}
	
	public function remove_ms($string){
		return mb_convert_encoding($string,'HTML-ENTITIES','UTF-8');		
	}
	
	
}

?>