<?
class App{
	static $config;
	static $channel;
	static $type;
	static $datatype;
	
	function __construct(){
		
	}
	
	// Load config object/array and instantiate App	
	static function loadApp($config, $load = TRUE){
		function __autoload($class) {
			if(file_exists('classes/'.$class.'.php')) {
				require_once('classes/'.$class.'.php');    
			} else {
				throw new Exception("__autoLoad failure: unable to load $class. \n");
			}
	}
	
		// transform php array to object to pass to view
		function arrayToObject($array) {
			if (is_array($array)) {
				return (object) array_map(__FUNCTION__, $array);
			}
			else {
				return $array;
			}
		}
		
		self::$config = arrayToObject($config);
		if($load == TRUE) self::loadView();
	}

	
	// Load controllers and views	
	static function loadView(){
		$channel = self::$config->route->channel;
		$type = self::$config->route->type;
		$datatype = self::$config->route->datatype;
		$wobject = self::$config->widgets->$channel->$type;
		$title = self::$config->options->$channel->$type->title;
		
		self::$channel = $channel;
		self::$type = $type;
		self::$datatype = $datatype;
	
		if($datatype == 'content'){
			require_once 'controllers/ContentController.php';
		} 
		if($datatype == 'subject'){
			require_once 'controllers/SubjectController.php';
		} 
		//unset($config);
	}
	
	// validate url parameter to avoid ugly php warning
	static function validateCall(){
		foreach(self::$config->widgets as $key=>$value){
			if($value === self::$config->route->channel){
				foreach($value as $key2=>$value2){
					if($value2 === self::$config->route->type){
						break;
						return TRUE;
					} else {
						echo 'The url parameter "'.self::$config->route->type.'" does not exist';
						break;
						return FALSE;
					}
				}
			} else {
				echo '<p>The url parameter "'.self::$config->route->type. '" does not exist.  Please correct the argument "'.self::$config->route->datatype.'/'.self::$config->route->channel.'/'.self::$config->route->type.'"<p>';
				break;
				return FALSE;
				
			}
		}
		
	}
	
	static function loadBrowserTitle(){
		if(self::$config->route->channel == 'sports'){
			return self::$config->route->type.' News Now';
		} else {
			return self::$config->route->channel.' News Now';
		}
		
	}
	
	static function loadWidget($widget,$datasource){
		require 'widgets/widget-'.$widget.'.php';
	}
	
	static function loadEnews(){
		return '<table width="280" style="margin:10px 0 0 0; padding:0;">
			<tr valign="top">
				<td width="131">
					<a href="httpgetwrap|https://fullaccess.azcentral.com/subscribers/tecnavia">
						<img src="http://nocache.azcentral.com/generated/dailypaper.jpg" border="0" style="margin:0; padding:0;" width="131" height="275"/>
					</a>
				</td>
				<td style="font-weight:bold;"><span style="color:#d90303;">Good morning!</span> Your Arizona Republic <br/>e-Newspaper is ready.<br/>
				<br/>
				<a href="httpgetwrap|http://arizonarepublic.az.newsmemory.com/"><img src="http://'.self::$config->www.'/'.self::$config->directory.'images/browser-version.jpg" style="margin:5px 0; padding:0; width:138px; height:48px;" /></a>
				<a href="httpgetwrap|https://itunes.apple.com/us/app/arizona-republic-enewspaper/id571079187?mt=8"><img src="http://'.self::$config->www.'/'.self::$config->directory.'images/mobile-version.jpg" style="margin:5px 0; padding:0; width:138px; height:48px;" /></a>						
				<a href="httpgetwrap|https://play.google.com/store/apps/details?id=com.arizonarepublic.android.prod&feature=nav_other#?t=W251bGwsMSwyLDYsImNvbS5hcml6b25hcmVwdWJsaWMuYW5kcm9pZC5wcm9kIl0"><img src="http://'.self::$config->www.'/'.self::$config->directory.'images/android-promo.gif" style="margin:5px 0; padding:0; width:138px; height:49px;" /></a>														
				</td>
			</tr>
			
		</table>';
	}
	
	static function getUnsubscribe(){
		$options = self::$config->options;
		$channel = self::$config->route->channel;
		$type = self::$config->route->type;
		if(isset($options->$channel->$type->unsubscribe)){
			return $options->$channel->$type->unsubscribe;
		} else {
			return 'nope';
		}
	}
	
	static function loadDate(){
		return date('F j');
	}
			
	static function loadSocial(){
		$options = self::$config->options;
		$channel = self::$config->route->channel;
		$type = self::$config->route->type;	
		
		if(isset($options->$channel->$type->facebook)){
			$facebook = $options->$channel->$type->facebook;
		} else {
			$facebook = $options->$channel->facebook;
		}
		
		if(isset($options->$channel->$type->twitter)){
			$twitter = $options->$channel->$type->twitter;
		} else {
			$twitter = $options->$channel->twitter;
		}
		
		if(self::$config->route->type == 'prepsco' || self::$config->route->type == 'prepsad') {
		return '<table width="280" id="social" style="font-size:13px; font-family:Arial, Helvetica, sans-serif; margin:5px 0 0; padding:0; font-size:13px;" cellpadding="0" cellspacing="0"><tr><td>
		<h2 style="background-color:#1366ac; padding:4px; color:#ffffff; font-size:13px; font-weight:normal; line-height:18px;">JOIN THE DISCUSSION</h2>
		<p>Join the conversation about high school football on Facebook and Twitter. Tweet scores and photos with #azcFNF.</p>	
		<a style="vertical-align:middle; text-decoration:none;" href="http://www.twitter.com/azcpreps"><img width="20" height="20" src="http://'.self::$config->www.'/'.self::$config->directory.'/images/twitter-shadow.png" style="width:20px; height:20px; vertical-align:middle;">&nbsp;&nbsp;@azcpreps</a>
		<br><br>		
		<a style="vertical-align:middle; text-decoration:none;" href="http://www.twitter.com/'.$twitter.'"><img width="20" height="20" src="http://'.self::$config->www.'/'.self::$config->directory.'/images/twitter-shadow.png" style="width:20px; height:20px; vertical-align:middle;"/>&nbsp;&nbsp;@azcsports</a>
		<br><br>
		<a style="vertical-align:middle; text-decoration:none;" href="http://www.facebook.com/azcentralsports"><img width="20" height="20" src="http://'.self::$config->www.'/'.self::$config->directory.'images/facebook-shadow.png" style="width:20px; height:20px; vertical-align:middle;"/>&nbsp;&nbsp; azcentral sports</a>
		</td></tr></table>';
		}else {
		return '<br/><table width="280" id="social" style="margin:5px 0 0 0; padding:0;" cellpadding="0" cellspacing="0"><tr><td><a href="http://www.facebook.com/'.$facebook.'"><img width="90" height="27" src="http://'.self::$config->www.'/'.self::$config->directory.'/images/facebook.jpg" style="margin:0; padding:0; width:90px; height:27px; vertical-align:middle;"/></a><a href="http://www.twitter.com/'.$twitter.'"><img width="90" height="27" src="http://'.self::$config->www.'/'.self::$config->directory.'/images/twitter.jpg" align="right" style="margin:0; padding:0; width:90px; height:27px; vertical-align:middle;"/></a></td></tr></table>';
		}		
	}
	
	static function loadAd(){
	    $random = rand(100000,999999);
	    $channel = self::$config->route->channel;
		$type = self::$config->route->type;
		$alias = self::$config->options->$channel->$type->ad;
		return '<table width="300" id="ad" style="margin:0; padding:0; text-align:center;" cellpadding="0" cellspacing="0">
		<tr><td width="100%" style="text-align:center;padding-top:10px;padding-bottom:10px;">
		
		<!--
		%%[
			VAR @alias, @random, @adurl, @imgurl
			set @alias = "'.$alias.'"
			set @random = "'.$random.'"
			set @adurl = Concat("http://pubads.g.doubleclick.net/gampad/jump?co=1&iu=/7103/az-phoenix-C1531/Flex_static/",@alias,"&sz=160x600|300x250|300x600&c=",@random)
			set @imgurl = Concat("http://pubads.g.doubleclick.net/gampad/ad?co=1&iu=/7103/az-phoenix-C1531/Flex_static/",@alias,"&sz=160x600|300x250|300x600&c=",@random)
		]%%
        -->      
		<a href="%%=RedirectTo(v(@adurl))=%%"><img src="%%=v(@imgurl)=%%"></a>
		</td></tr></table>';
	}
	
	static function loadPreps(){
		$html = file_get_html('http://nocache.azcentral.com/sports/preps/incs/newsletter-prepscoverage.inc');
		$headline = Format::cleanContent($html->find('h1',0)->plaintext);
		$title = '<h2 style="background-color:#1366ac; color:#ffffff; font-size:13px; padding:4px; font-weight:normal; text-transform:uppercase;">'.$headline.'</h2>';
		$more = $html->find('span a',0)->href;
		$coverage ='';
		$links = $html->find('li a');
		foreach($links as $link){	
			$buffer = '<li style="margin:12px 0; font-size:13px; border-bottom:#cccccc 1px dotted; list-style:none; display:block;">'.$link.'</li>';
			$coverage .= preg_replace("#\<a href=\"([^\"]*)\"#", '<a href="http://nocache.azcentral.com/$1" style="text-decoration:none;"', $buffer);			
		}
		return '<table id="coverage" width="280" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0;"><tr><td style="line-height:18px;">'.$title.'</td></tr>
		    <tr><td>
		    	<ul style="margin:0; padding:0;">'.$coverage.'</ul>	
				<p style="text-align:right; vertical-align:middle; margin:0; padding:0 0 8px 0;" >
				<a href="httpgetwrap|http://nocache.azcentral.com'.$more.'" style="font-size:13px; font-weight:bold; color:#124f7d; text-decoration:none;">
    			For the rest of this week’s coverage
    			<img src="http://nocache.azcentral.com/email/newsletters/images/read-more.jpg" border="0" style="margin-left:3px; vertical-align:middle;" /></a></p>
			</td></tr>
		</table>';
		}
	
	static function loadTopPromo(){
		if(self::$config->route->type == 'top5'){
			$html = file_get_html('http://nocache.azcentral.com/12news/incs/12news-todaypromo-newsletter.inc');
			$tplink = Format::absPath($html->find('a',0)->href);
			$chatter = Format::cleanContent($html->find('.content',0)->plaintext);
			$promo ='';
			$promo .= $chatter;
			}
			return '<br/><table id="today-promo" width="300" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:0; ">
			<img src="http://nocache.azcentral.com/email/newsletters/images/ret_subcentralnewslett_ban.jpg" width="300" height="200" />
			<tr><td style="background-color:#a3d4e3; font-size:19px; font-weight:700; padding:10px; text-align:left;"><a style="text-decoration: none; color:#215786;" href="'.$tplink.'">'.$promo.'</a></td></tr>
			</table>';
		}
	
	static function loadPromo(){
	    $channel = self::$config->route->channel;
		switch ($channel) {
    		case 'news':
        		$html = file_get_html('http://nocache.azcentral.com/ic-projects/incs/newsletter-marketingazpromo.inc');
		        break;
    		case 'sports':
        		$html = file_get_html('http://nocache.azcentral.com/ic-projects/incs/newsletter-sports-rightrailpromo.inc');
        		break;
        	case 'business':
        		$html = file_get_html('http://nocache.azcentral.com/ic-projects/incs/newsletter-business-rightrailpromo.inc');
        		break;
        	case 'politics':
        		$html = file_get_html('http://nocache.azcentral.com/ic-projects/incs/newsletter-politics-rightrailpromo.inc');
        		break;
        	case 'thingstodo':
        		$html = file_get_html('http://nocache.azcentral.com/ic-projects/incs/newsletter-thingstodo-rightrailpromo.inc');
        		break;
        	case 'community':
        		$html = file_get_html('http://nocache.azcentral.com/ic-projects/incs/newsletter-marketingazpromo.inc');
        		break;
    		default:
        		$html = file_get_html('http://nocache.azcentral.com/ic-projects/incs/newsletter-marketingazpromo.inc');
                break;
			}
					
			$headline = Format::cleanContent($html->find('h1',0)->plaintext);
			$chatter = Format::cleanContent($html->find('p.ic-deck',0)->plaintext);
			//$link = Format::httpWrap($html->find('a',0)->href);
			$link = Format::cleanContent($html->find('a',0)->href);
			$img = Format::absPath($html->find('img.az-promo-image',0)->src);
			$promo ='';
			$promo .= '<h1 style="margin:3px 0; padding:0; text-decoration:none;"><a href="'.$link.'" style="color:#124f7d; margin:5px 0 0 0; padding:0; font-size:26px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-decoration:none;">'.$headline.'</a></h1>';
			$promo .= '<p style="line-height:16px; font-family:Arial, Helvetica, sans-serif; font-size:14px; margin:0;padding:0;">'.$chatter.'</p>';
			$promo .= '<a href="'.$link.'"><img src="'.$img.'" style="font-family:Arial, Helvetica, sans-serif; margin:5px 0; width:280px;" width="280px;"/></a>';
			
			return '<br/><table id="promo" width="280" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0;"><tr><td >'.$promo.'</td></tr></table>';	
		}
		
	static function loadTTDPromo(){
			$html = file_get_html('http://nocache.azcentral.com/ic-projects/incs/newsletter-ttdpromo.inc');
			$headline = Format::cleanContent($html->find('h1',0)->plaintext);
			$chatter = Format::cleanContent($html->find('p.ic-deck',0)->plaintext);
			$link = Format::cleanContent($html->find('a',0)->href);
			$img = Format::absPath($html->find('img.az-promo-image',0)->src);
			$promo ='';
			$promo .= '<h1 style="margin:3px 0; padding:0; text-decoration:none;"><a href="'.$link.'" style="color:#124f7d; margin:5px 0 0 0; padding:0; font-size:26px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-decoration:none;">'.$headline.'</a></h1>';
			$promo .= '<p style="line-height:16px; font-family:Arial, Helvetica, sans-serif; font-size:14px; margin:0;padding:0;">'.$chatter.'</p>';
			$promo .= '<a href="'.$link.'"><img src="'.$img.'" style="font-family:Arial, Helvetica, sans-serif; margin:5px 0; width:280px;" width="280px;"/></a>';
			
			return '<br/><table id="promo" width="280" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0;"><tr><td >'.$promo.'</td></tr></table>';
		}
		
	static function loadNominate(){
		$link = 'httpgetwrap|http://hsforms.azcentral.com';
		$img = 'http://nocache.azcentral.com/email/newsletters/images/preps-nominate.png';
		$promo ='';
		$promo .= '<a href="'.$link.'"><img src="'.$img.'" style="font-family:Arial, Helvetica, sans-serif; margin:5px 0; width:280px; text-decoration:none;" width="280" border="0"/></a>';
		return '<br/><table id="promo" width="280" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:20px 0; padding:0;"><tr><td >'.$promo.'</td></tr></table>';
	}
	
	static function loadVolunteer(){
		$link = 'http://www.volunteermatch.org/?gclid=CJ792N61tbsCFQlgMgodNUQAew';
		$img = 'http://nocache.azcentral.com/email/newsletters/images/volunteer.png';
		$promo ='';
		$promo .= '<a href="'.$link.'"><img src="'.$img.'" style="font-family:Arial, Helvetica, sans-serif; margin:5px 0; width:280px; text-decoration:none;" width="280" border="0"/></a>';
		return '<br/><table id="promo" width="280" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:20px 0; padding:0;"><tr><td >'.$promo.'</td></tr></table>';
	}
	
	static function loadEditorial(){
		$adfile = '';
		$channel = self::$config->route->channel;
		$type = self::$config->route->type;
				
		if(isset(self::$config->options->$channel->editorialpromo)){
			include_once('ads/'.self::$config->options->$channel->editorialpromo);
		} else {
			include_once('ads/'.self::$config->options->$channel->$type->editorialpromo);
		}
	}
	
	static function loadMarketing(){
		$gender = self::$config->edata->eGender;
		$age = self::$config->edata->eAge;
		$zip = self::$config->edata->eZip;
		include_once('ads/marketing.php');
	}
	
	static function loadCirculation(){
		$gender = self::$config->edata->eGender;
		$age = self::$config->edata->eAge;
		$zip = self::$config->edata->eZip;
		include_once('ads/circulation.php');
	}
	
	static function omniturePixel($title) {
		$channel = self::$config->route->channel;
		$type = self::$config->route->type;
		$titleurl = strtolower(str_replace(' ','-',$title));
		$trackingImg = '<img src="http://gpaper158.112.2O7.net/b/ss/gpaper158/5/H.17--WAP?pageName=http://nocache.azcentral.com/email/newsletter/'.$channel.'/'.$titleurl.'.html" width="1" height="1"/>';
		$trackingImg2 = '<img src="http://pixel.monitor1.returnpath.net/pixel.gif?r=98f74abc946efc0187d22f2fc58d3e4d7b8f5d3a&c='.urlencode($title).'" width="1" height="1" />';
		return $trackingImg.''.$trackingImg2;
	}
	
}

?>