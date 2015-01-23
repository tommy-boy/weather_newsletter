<?
if(preg_match('/top5/',$_GET['url'])){
	echo '<a href="httpgetwrap|http://www.azcentral.com/news/traffic" border="0"><img src="http://www.azcentral.com/email/newsletters/ads/images/12news_traffic.jpg" border="0" width="100%" height="65" border="0" style="margin:0; padding:0; width:100%px; height:54px;"  /></a>
	<a href="httpgetwrap|http://www.azcentral.com/news/traffic"><h2 style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-decoration:none; font-weight:bold; color:#0E457B; margin:5px 8px 0 8px; padding:0; text-align:center;">Map your route and get there faster </h2></a>
	<p style="padding:0; margin:5px 8px 12px 8px; font-size:12px;" >
	12 News Beat the Traffic with its interactive map is your tool to get around wrecks, construction and traffic tie-ups when you are on the road.
	</p>';



} else {


function returnAd($age, $zip, $gender){

	// set control values for zip
	$zones = array('85028', '85032', '85050', '85054', '85254', '85255','85259','85260','85262','85263','85264','85266','85268','85331', '85018', '85250', '85251', '85253', '85256', '85257', '85258');

	// default option
	$content1 ='<a href="httpgetwrap|https://fullaccess.azcentral.com/" border="0"><img src="http://dellpe1955-10.azcentral.com/emailtemplates/email/ads/images/circulation.jpg" border="0" width="100%" height="54" border="0" style="margin:0; padding:0; width:100%px; height:54px;"  /></a>
	<a href="httpgetwrap|https://fullaccess.azcentral.com/" style="text-decoration:none;"><h2 style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none; color:#0E457B; margin:5px 8px 0 8px; padding:0; text-align:center">Subscribe and Save</h2></a>
	<p style="padding:0; margin:5px 8px 12px 8px; font-size:12px; font-family: arial, sans-serif;" >
	Start saving with the best deals and bargains, exclusive to <em>The Arizona Republic</em> - it\'s value you can\'t afford to miss!
	</p>';
	
	$content2 ='<a href="httpgetwrap|https://subscribe.azcentral.com/circpromos/promopages/p6_2012_smart_tag_smtag.php" border="0"><img src="http://dellpe1955-10.azcentral.com/emailtemplates/email/ads/images/circulation.jpg" border="0" width="100%" height="54" border="0" style="margin:0; padding:0; width:100%px; height:54px;"  /></a>
	<a href="httpgetwrap|https://subscribe.azcentral.com/circpromos/promopages/p6_2012_smart_tag_smtag.php" style="text-decoration:none;"><h2 style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none; color:#0E457B; margin:5px 8px 0 8px; padding:0; text-align:center">Coupons, Deals and Things to Do</h2></a>
	<p style="padding:0; margin:5px 8px 12px 8px; font-size:12px; font-family: arial, sans-serif;" >
	For a limited time, get the Sunday & Wednesday <i>Arizona Republic</i> for only $7 per month. Find the best coupons, deals, grocery ads and things to do and get 50% off - start saving today!</p>';
	
	$content3 ='<a href="httpgetwrap|https://subscribe.azcentral.com/circpromos/promopages/p6_2012_smart_tag_smtag.php" border="0"><img src="http://dellpe1955-10.azcentral.com/emailtemplates/email/ads/images/circulation.jpg" border="0" width="100%" height="54" border="0" style="margin:0; padding:0; width:100%px; height:54px;"  /></a>
	<a href="httpgetwrap|https://subscribe.azcentral.com/circpromos/promopages/p6_2012_smart_tag_smtag.php" style="text-decoration:none;"><h2 style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none; color:#0E457B; margin:5px 8px 0 8px; padding:0; text-align:center">News, Sports, Deals and More</h2></a>
	<p style="padding:0; margin:5px 8px 12px 8px; font-size:12px; font-family: arial, sans-serif;" >
	Special offer - sign up for daily home delivery of The Arizona Republic and save 50%. That\'s just $13.25 per month to get the best source for local news, information, sports, deals and so much more. Subscribe today!</p>';
	
	$content4 ='<a href="httpgetwrap|https://subscribe.azcentral.com/circpromos/promopages/p6_2012_smart_tag_smtag.php" border="0"><img src="http://dellpe1955-10.azcentral.com/emailtemplates/email/ads/images/circulation.jpg" border="0" width="100%" height="54" border="0" style="margin:0; padding:0; width:100%px; height:54px;"  /></a>
	<a href="httpgetwrap|https://subscribe.azcentral.com/circpromos/promopages/p6_2012_smart_tag_smtag.php" style="text-decoration:none;"><h2 style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none; color:#0E457B; margin:5px 8px 0 8px; padding:0; text-align:center">Limited Time Subscription Offer</h2></a>
	<p style="padding:0; margin:5px 8px 12px 8px; font-size:12px; font-family: arial, sans-serif;" >
	Sign up today to get 50% off home delivery of The Arizona Republic We\'re YOUR source for the best news, information, deals and more. Subscribe now!
	</p>';
	
	$default ='<a href="httpgetwrap|https://fullaccess.azcentral.com/" border="0"><img src="http://dellpe1955-10.azcentral.com/emailtemplates/email/ads/images/circulation.jpg" border="0" width="100%" height="54" border="0" style="margin:0; padding:0; width:100%px; height:54px;"  /></a>
	<a href="httpgetwrap|https://fullaccess.azcentral.com/" style="text-decoration:none;"><h2 style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none; color:#0E457B; margin:5px 8px 0 8px; padding:0; text-align:center">Subscribe and Save</h2></a>
	<p style="padding:0; margin:5px 8px 12px 8px; font-size:12px; font-family: arial, sans-serif;" >
	Start saving with the best deals and bargains, exclusive to <em>The Arizona Republic</em> - it\'s value you can\'t afford to miss!
	</p>';
	

	//control for under 25
	if($age <= 24) {
			$ad = $content1;
			echo $ad;
			return;
	} 

	//control for female
	elseif($gender == 'F'  && $age >= 25 && $age <= 44) {
			$ad = $content2;
			echo $ad;
			return;
	} 
	
	//control for 45+ within zones 7,8 and 9
	elseif($age >= 45) {
		foreach($zones as $zone) {
			if($zip == $zone) {
				$ad = $content3;
				echo $ad;
				return;
			} 
		}
	} 
	
	//control for 45+ NOT within zones 7,8 and 9
	elseif($age >= 45) {
		foreach($zones as $zone) {
			if($zip != $zone) {
				$ad = $content4;
				echo $ad;
				return;
			} 
		}
	} 
	else {
		echo $default;
		
	}
}
returnAd($age, $zip, $gender);


}
?>