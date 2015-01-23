<?

class UpNext {
		
		private $authkey;
	
	public function __construct($team){
		$authkey = 'AZC18356MCS7733COM';
		
		if(isset($_GET['startdate']) && isset($_GET['enddate'])){
			$fromDate = $_GET['startdate'];
			$toDate = $_GET['enddate'];
		} else {
			$fromDate = date('Y-m-d');
			$toDate = date('Y-m-d', strtotime("+10 days"));
		}
		$team = $team;
		$sport = NULL;
		$league = NULL;
		$this->index = 0;
		switch($team){
			case 'asu':
				$sport = 'football'; 
				$league = 'ncaa_basketball';
				break;
			case 'cardinals':
				$sport = 'football';
				$league = 'nfl';
				break;
			case 'coyotes':
				$sport = 'hockey';
				$league = 'nhl';
				break;
			case 'diamondbacks':
				$sport = 'baseball';
				$league = 'mlb';
				break;
			case 'suns':
				$sport = 'basketball';
				$league = 'nba';
				break;
		}
		$index = NULL;
		$dataurl = 'http://www.azcentral.com/private/sports/app.php?sport='.$sport.'&league='.$league.'&team='.$team.'&from_date='.$fromDate.'&to_date='.$toDate.'&authkey='.$authkey;
		$this->game = json_decode(file_get_contents($dataurl));
		$this->index = (count($this->game)-1);
	}
	
	public function checkIfGame(){
		
		if(count($this->game) == 0){
			return false;
		} else {
			return true;
		}
				
	}
	
	static function formatDate($date){
		$find = array('January','February','March','April','May','June','July','August','September','October','November','December','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$replace = array('Jan.','Feb.','Mar.','Apr.','May.','Jun.','Jul.','Aug.','Sept','Oct.','Nov.','Dec.','Sun','Mon','Tues','Wed','Thurs','Fri','Sat');
		return str_replace($find,$replace,$date);
	}
	
	static function formatTime($time){
		return ltrim($time, '0'); 		
	}
	
	
			
	
	
	
	
}

?>

