<?

class MainArtWeather {
	
	var $html;
		
	public function __construct($datasource) {
		$this->html = file_get_html($datasource->src);
		$string = Format::cleanContent($this->html->find('p',0)->plaintext);
        
        if(preg_match('/~/',$string)){
	        $split = explode('~',$string);
	        $this->person = $split[1];
	        $this->forecast = $this->limit_text($split[0], 30);
	        $this->image = str_replace(' ','',$split[1]);
        } else {
	        $this->person = 'azcentral';
	        $this->forecast = $this->limit_text($string, 30);
	        $this->image = '12News';
        } 
    }
	
/**
 * This function truncates text
 * @param string $text to truncate
 * @param type $limit number 
 * @return string the truncated text
 */
        
        private function limit_text($text, $limit) {
        	if(preg_match('/James/',$this->person)){
	                $this->person2 = 'James Quinones\'';     
	                $this->intro = 'Read ';
	                $this->status = ' complete forecast';
                }	
                if(preg_match('/Caribe/',$this->person)){
	                $this->person2 = 'Caribe Devine\'s';
	                $this->intro = 'Read ';
	                $this->status = ' complete forecast';
                }
                if(preg_match('/Matt/',$this->person)){
	                $this->person2 = 'Matt Pace\'s';
	                $this->intro = '';
	                $this->status = ' complete weather coverage';
                }
                if(preg_match('/Krystle/',$this->person)){
	                $this->person2 = 'Krystle Henderson\'s';
	                $this->intro = 'Read ';
	                $this->status = ' complete forecast';
                }    
                if($this->person == 'azcentral'){
	                $this->person2 = 'azcentral\'s';
	                $this->intro = 'Read ';
	                $this->status = ' complete forecast';
                }
                
            if (str_word_count($text, 0) > $limit) {              
                $words = str_word_count($text, 2);
                $pos = array_keys($words);
                $text = substr($text, 0, $pos[$limit]) . '...' .Format::readMore('http://weather.azcentral.com', $this->intro.$this->person2.$this->status);
            }
            return $text;
        }
        
    public function getCurrent(){
    	$this->header = array();
    	$this->high = array();
    	$this->low = array();
    	$this->img = array();
    	$this->today = file_get_html('http://nocache.azcentral.com/php-bin/exacttarget.php?page=/weather/generated/newsletter_forecast.inc');
    	
    	$day = $this->today->find('li',0);
    	$header = $day->find('span',0)->plaintext;
    	$this->header[] = Format::stripHTML($header);
    	$img = $day->find('img',0);
    	$this->img[] = Format::absPath1($img);
    	$high = $day->find('span',1)->plaintext;
    	$this->high[] =  Format::stripHTML($high);
    	$alltext = explode('/',$day->plaintext);
    	$low = $alltext[1];
    	$this->low[] = Format::stripHTML($low);
    }

	public function getThreeDay(){
		$this->header = array();
		$this->high = array();
		$this->low = array();
		$this->img = array();
		
		foreach($this->html->find('div.sevenDayCol') as $div) {
			foreach($div->find('span.header') as $header){
				$this->header[] = Format::stripHTML($header);
			}
			foreach($div->find('span.high') as $high){
				$this->high[] =  Format::stripHTML($high);
			}
			foreach($div->find('span.low') as $low){
				$this->low[] =  Format::stripHTML($low);
			}
			foreach($div->find('img') as $img){
				$this->img[] = Format::absPath2($img);
			}

		}
		
	}
		
	public function __destruct(){
		$this->html->clear();
	}
	
	
}

?>
