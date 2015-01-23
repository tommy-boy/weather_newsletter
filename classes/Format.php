<?
class Format {
	
	# add httpWrap to links
	static function httpWrap($link){
		return 'http://archive.azcentral.com/'.$link;
	}
	
	# make images absolute
	static function absPath($src){
		return 'http://nocache.azcentral.com'.$src;
	}
	
	# make images absolute when in html tag
	static function absPath1($src){
		$find = array('src="http://www.azcentral.com/','src="/');
		$replace = array('src="http://nocache.azcentral.com/', 'href="http://archive.azcentral.com/');
		return str_replace($find,$replace,$src);
	}
	
		# make images absolute when in html tag
	static function absPath2($src){
		$find = array('src="/','href="/');
		$replace = array('src="http://nocache.azcentral.com/','href="http://archive.azcentral.com/');
		return str_replace($find,$replace,$src);
	}
	
	static function stripHTML($string){
		return strip_tags($string);
	}
	
	static function sanHTML($htmlsanitize){
		$a = htmlentities($htmlsanitize);
    	return $htmlsanitize = html_entity_decode($a, ENT_QUOTES, 'UTF-8');
	}

	static function cleanContent($content){
		//return $content;
		
		$trans=Array("\x0F"=>"",
                 "\x0D\x0A"=>"\n",
                 "\x0F"=>"",
                 "\x0D\x0A"=>"\n",
                 "\x0A\x0D"=>"\n",
                 "\x0B"=>"",
                 "\x0C"=>"",
                 "\x0E"=>"",
                 "\x1D"=>"",             
                 "\x85"=>"...",
                 "\x90"=>" ",
                 "\x91"=>"'",
                 "\x92"=>"'",
                 "\x93"=>"\"",
                 "\x94"=>"\"",
                 "\x96"=>"-",
                 "\x97"=>"-",
                 "\x98"=>"&#152;",
                 "\x99"=>"&#153;",
                 "\x9A"=>"&#154;",
                 "\x9B"=>"&#155;",
                 "\x9C"=>"&#156;",
                 "\x9D"=>"&#157;",
                 "\x9E"=>"&#158;",
                 "\x9F"=>"&#159;",
                 "\xA0"=>" ",
                 "\xA1"=>"&#161;",
                 "\xA1"=>"&#162;",
                 "\xA3"=>"&pound;",
                 "\xA4"=>"&#164;",
                 "\xA5"=>"&#165;",
                 "\xA6"=>"&#166;",
                 "\xA7"=>"&#167;",
                 "\xA8"=>"&#168;",
                 "\xA9"=>"&copy;",
                 "\xAA"=>"&#170;",
                 "\xAB"=>"&#171;",
                 "\xAC"=>"&#172;",
                 "\xAD"=>"&#173;",
                 "\xAE"=>"&#174;",
                 "\xAF"=>"&#175;",
                 "\xB0"=>"&#176;",
                 "\xB1"=>"&#177;",
                 "\xB2"=>"&#178;",
                 "\xB3"=>"&#179;",
                 "\xB4"=>"&#180;",
                 "\xB5"=>"&#181;",
                 "\xB6"=>"&#182;",
                 "\xB7"=>"&#183;",
                 "\xB8"=>"&#184;",
                 "\xB9"=>"&#185;",
                 "\xBA"=>"&#186;",
                 "\xBB"=>"&#187;",
                 "\xBC"=>"&#188;",
                 "\xBD"=>"&#189;",
                 "\xBE"=>"&#190;",
                 "\xBF"=>"&#191;",
                 "\xC0"=>"&#192;",
                 "\xC1"=>"&#193;",
                 "\xC2"=>"&#194;",
                 "\xC3"=>"&#195;",
                 "\xC4"=>"&#196;",
                 "\xC5"=>"&#197;",
                 "\xC6"=>"&#198;",
                 "\xC7"=>"&#199;",
                 "\xC8"=>"&#200;",
                 "\xC9"=>"&#201;",
                 "\xCA"=>"&#202;",
                 "\xCB"=>"&#203;",
                 "\xCC"=>"&#204;",
                 "\xCD"=>"&#205;",
                 "\xCE"=>"&#206;",
                 "\xCF"=>"&#207;",
                 "\xD0"=>"&#208;",
                 "\xD1"=>"&#209;",
                 "\xD2"=>"&#210;",
                 "\xD3"=>"&#211;",
                 "\xD4"=>"&#212;",
                 "\xD5"=>"&#213;",
                 "\xD6"=>"&#214;",
                 "\xD7"=>"&#215;",
                 "\xD8"=>"&#216;",
                 "\xD9"=>"&#217;",
                 "\xDA"=>"&#218;",
                 "\xDB"=>"&#219;",
                 "\xDC"=>"&#220;",
                 "\xDD"=>"&#221;",
                 "\xDE"=>"&#222;",
                 "\xDF"=>"&#223;",                 
                 "\xE0"=>"&#224;",
                 "\xE1"=>"&#225;",
                 "\xE2"=>"&#226",
                 "\xE3"=>"&#227;",
                 "\xE4"=>"&#228;",
                 "\xE5"=>"&#229;",
                 "\xE6"=>"&#230;",
                 "\xE7"=>"&#231;",
                 "\xE8"=>"&#232;",
                 "\xE9"=>"&#233;",
                 "\xEA"=>"&#234;",
                 "\xEB"=>"&#235;",
                 "\xEC"=>"&#236;",
                 "\xED"=>"&#237;",
                 "\xEE"=>"&#238;",
                 "\xEF"=>"&#239;",
                 "\xF0"=>"&#240;",
                 "\xF1"=>"&#241;",
                 "\xF2"=>"&#242;",
                 "\xF3"=>"&#243;",
                 "\xF4"=>"&#244;",
                 "\xF5"=>"&#245;",                         
                 "\xF6"=>"&#246;",
                 "\xF7"=>"&#247;",
                 "\xF8"=>"&#248;",
                 "\xF9"=>"&#249;",
                 "\xFA"=>"&#250;",
                 "\xFB"=>"&#251;",
                 "\xFC"=>"&#252;",
                 "\xFD"=>"&#253;",
                 "\xFE"=>"&#254;",
                 "\xFF"=>"&#255;");
     
     //$stage1 = mb_convert_encoding($content,'HTML-ENTITIES','UTF-8');
     $stage1 = $content;

     $stage2 = strtr($stage1,$trans); 
     return $stage2;
	
		//step 1: write the content cleaning rules later
		//return mb_convert_encoding($search,'HTML-ENTITIES','UTF-8');	
	}
	
	static function formatLists($list,$option = NULL){
		$find = array('<li>','<li class="first">','</li>','<a');
		if($option == 'last'){
			$replace = array('<tr valign="top" style=" padding:5px; border-bottom:none;"><td style="font-family: Arial, Helvetica, sans-serif; border-bottom:none; padding:8px 8px 10px 8px; font-weight:bold; width:280px;">','<tr valign="top" style=" padding:5px; border-bottom:none;"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;">','</td></tr>','<a style="font-family:Arial, Helvetica, sans-serif; color:#124f7d; text-decoration:none; font-size:16px;"');
		} else {
			$replace = array('<tr valign="top" style=" padding:5px; border-bottom:none;"><td style="font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold; width:280px;">','<tr valign="top" style=" padding:5px;"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;">','</td></tr>','<a style="font-family:Arial, Helvetica, sans-serif; color:#124f7d; text-decoration:none; font-size:16px;"');
		}
		return self::absolutePath(str_replace($find, $replace, self::cleanContent($list)));
	}
	
	static function formatExt($list,$option = NULL){
		$find = array('<li>','<li class="first">','</li>','<a');
		if($option == 'last'){
			$replace = array('<tr valign="top" style="padding:5px; border-bottom:none;"><td style="font-family: Arial, Helvetica, sans-serif; border-bottom:none; padding:8px 8px 10px 8px; font-weight:bold; width:280px;">','<tr valign="top" style=" padding:5px; border-bottom:none;"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;">','</td></tr>','<a style="font-family:Arial, Helvetica, sans-serif; color:#124f7d; text-decoration:none; font-size:16px;"');
		} else {
			$replace = array('<tr valign="top" style="padding:5px; border-bottom:none;"><td style="font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold; width:280px;">','<tr valign="top" style=" padding:5px;"><td style="border-bottom:1px solid #cf8522; padding:8px 8px 10px 8px; font-weight:bold;">','</td></tr>','<a style="font-family:Arial, Helvetica, sans-serif; color:#124f7d; text-decoration:none; font-size:16px;"');
		}
		return str_replace($find, $replace, self::cleanContent($list));
	}
	
	static function decodeHtmlString($string){	
		$find = array('&lsquo;','&rsquo;','&ldquo;','&rdquo;','&ndash;','&mdash;','&bdquo;','&sbquo;');
		$replace = array('\'','\'','"','"','-','--','"',',');
		return str_replace($find,$replace,ltrim($string,' '));
	}

	
	## Absolute path and httpgetwrap for ET AMPScript
	static function absolutePath($content){
		$find = array('http://','href="http://','href="/');
		$replace = array('style="color:#124f7d; text-decoration:none;" http://','style="color:#124f7d; text-decoration:none;" href="http://','style="color:#124f7d; text-decoration:none;" href="http://archive.azcentral.com/');
		$search = str_replace($find,$replace,$content);
		return $search;
	}
	
	
	static function formatTopper($text){
		return '<table style="margin:0; padding:0; width:280px; display:block; border-bottom:1px solid #CF8522;" cellpadding="0" cellspacing="0">
			<tr valign="middle">
				<td width="11" style="margin:0; padding:0; background:#CF8522;"><img src="http://nocache.azcentral.com/email/newsletters/images/column-left.jpg" style="float:left; margin:0; padding:0;" /></td>
				<td style="font-family: Arial, Helvetica, sans-serif; background:#CF8522;"><span style="float:left; background:#CF8522; height:23px; line-height:23px; text-transform:uppercase; font-size:13px; font-weight:bold; letter-spacing:2px; color:#fff; margin:0; padding:0;">'.$text.'</span></td>
				<td width="11" style="margin:0; padding:0; background:#CF8522;"><img src="http://nocache.azcentral.com/email/newsletters/images/column-right.jpg" style="float:left; margin:0; padding:0;" /></td>
			</tr></table><div style="clear:both;  width:280px; margin:0; padding:0;" />';
	
	
		/*return '<img src="http://www.azcentral.com/email/newsletters/images/column-left.jpg" style="float:left; margin:0; padding:0;" /><span style="float:left; background:#CF8522; height:23px; line-height:23px; text-transform:uppercase; font-size:13px; font-weight:bold; letter-spacing:2px; color:#fff; margin:0; padding:0;">'.$text.'</span><img src="http://nocache.azcentral.com/email/newsletters/images/column-right.jpg" style="float:left;" /><div style="clear:both; border-top:1px solid #CF8522; width:280px; margin:0; padding:0;" />';*/
	}
	
	
	static function readMore($link,$text,$margin = NULL){
                (!is_null($margin)? $m = $margin : $m = 'margin:0 0 20px 0;');
		return '<table style="'.$m.' padding:0; width:280px;" width="280"><tr><td align="right" style="margin:0; padding:0;" ><a href="'.$link.'" style="vertical-align:middle; font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none; color:#124f7d;" >'.$text.' </td><td><img src="http://nocache.azcentral.com/email/newsletters/images/read-more.jpg" border="0" style="margin:0 0 0 3px; padding:0; vertical-align:middle;" /></a></td></tr></table>';

	}
		

	
}

?>
