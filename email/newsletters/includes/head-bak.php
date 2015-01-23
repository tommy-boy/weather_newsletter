<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<!-- If you delete this meta tag, Earth will fall into the sun. -->
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$title?></title>
<? require_once('css/responsive.php');?>
</head>
 
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="width:600px; font-family: Arial, Helvetica, sans-serif;">

<? echo App::omniturePixel($title); ?>

<table name="outer" class="null" width="600" align="center" style="font-family:Arial, Helvetica, sans-serif; padding:0; margin:0; width:600px;" cellpadding="0" cellspacing="0">
<tr valign="top"><td style="padding:0; margin:0;">
<p align="center" style="margin:0 auto; font-size:11px; font-family:Arial; width:600px; height:16px; line-height:16px;">Having trouble viewing this email? | <a href="%%view_email_url%%">View it in your browser.</a></p>

<?
if(self::$config->route->type == 'prepsco' || self::$config->route->type == 'prepsad') {
?>

<!-- PREPS HEADER -->
<table class="" bgcolor="#FFF" cellpadding="0" cellspacing="0" style="width:600px; padding:0; font-family:Arial, Helvetica, sans-serif;" align="center">
	<tr>
		<td class="header container" style="padding:0; margin:0; display:block; width:600px; margin:0 auto!important;  clear:both!important;" >				
				<div class="content" style="padding:0;  margin:0 auto; display:block;">
				<table style="border-spacing:0;">
					<tr>
						<td class="logo" style="padding:0px; margin:0px;"><a href="http://www.azcentral.com/sports/preps/"><img style="padding:0px; margin:0px;" src="http://www.azcentral.com/email/newsletters/images/fnf-newsletter-banner.png" border="0" width="599" height="197"/></a></td>
						<td align="right" style="padding:0px; margin:0px;"></td>
					</tr>
				</table>
				</div>
		</td>
	</tr>
</table><!-- /PREPS HEADER -->

<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:700; margin:5px auto 0;" align="center">To report scores for any high school sport, call our score takers hotline: 602-444-8641 or 1-800-331-9269.</p>

<?
}
elseif (self::$config->route->type == 'insider') {
?>
<!-- 12NEWS INSIDER -->
<table class="" bgcolor="#FFF" cellpadding="0" cellspacing="0" style="width:600px; padding:0; font-family:Arial, Helvetica, sans-serif;" align="center">
	<tr>
		<td class="header container" style="padding:0; margin:0; display:block; width:600px; margin:0 auto!important;  clear:both!important;" >				
				<div class="content" style="padding:0;  margin:0 auto; display:block;">
				<table style="border-spacing:0;">
					<tr>
						<td class="logo" style="padding:0px; margin:0px;"><a href="http://www.azcentral.com/12news/"><img style="padding:0px; margin:0px;" src="http://www.azcentral.com/email/newsletters/images/insider-header.gif" border="0" width="599" height="76"/></a></td>
						<td align="right" style="padding:0px; margin:0px;"></td>
					</tr>
				</table>
				</div>
		</td>
	</tr>
</table><!-- /12NEWS INSIDER -->
<?
}
else {
?>
<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; margin:4px auto;" align="center"><?=$title?></p>
<!-- MAIN HEADER -->
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#000000" style="width:614px; font-family:Arial,Helvetica,sans-serif;" width="614">
	<tbody><tr>
		<td bgcolor="#141414" style="padding:0;margin:0;display:block;width:600px;margin:0 auto!important;clear:both!important">
				<div style="padding:5px 0;margin:0 auto;display:block">
				<table bgcolor="#141414" width="600">
					<tbody><tr>
						<td style="padding:0px;margin:0px"><a href="http://www.azcentral.com" target="_blank"><img style="padding:0 0 0 15px;margin:0px" src="https://ci5.googleusercontent.com/proxy/iQtpgJHfD5P4SfU719sqjv_P_ErLoEzAHLqo2UCO0SpL3KICVr2IexNILFMgLAiDXxVyC79UkeV1cW-kn1AZTl6gpesLwcX-9eIx-MknykjcML5zIuzJE4rEulvsXzCyTA=s0-d-e1-ft#http://www.gannett-cdn.com/sites/azcentral/images/site-masthead-logo@2x.png" border="0" height="80" alt="AZCentral"></a></td>
						<td align="right" style="padding:0px;margin:0px"></td>
					</tr>
				</tbody></table>
				</div>
		</td>
	</tr>
</tbody></table>

<!-- AZC Nav -->
<table class="body-wrap" id="main-nav" border="0" cellspacing="0" cellpadding="0" style="width:614px; font-family:Arial, Helvetica, sans-serif;" width="614">
	<tr valign="top">
		<td style="margin:0;"></td>
		<td class="container" bgcolor="#141414" style="display:block!important; max-width:100%!important; margin:0 auto!important;  clear:both!important;">
			<table style="background:#141414; width:100%; margin:0; padding:0; font-family:'Futura Today Bold', Helvetica,Arial,sans-serif; font-size: 11px; color: #ffffff;" cellpadding="0" cellspacing="0" align="center" width="100%">
				<tr valign="top">
					<td style="-webkit-text-size-adjust: none; text-align:center; white-space: nowrap; border-top-color: rgb(0, 155, 255); border-style: solid; border-width: 1px 1px 0 0; border-right-color: #343434; margin: 0 0 0 -1px; height: 40px; line-height:40px; padding:5px 0;"><a style="-webkit-text-size-adjust: none; text-decoration:none; color: #ffffff;" href="http://www.azcentral.com/local/" target="_parent" data-ht="Headerlocal">LOCAL</a></td>
					<td style="-webkit-text-size-adjust: none; text-align:center; white-space: nowrap; border-top-color: rgb(0, 177, 188); border-style: solid; border-width: 1px 1px 0 0; border-right-color: #343434; margin: 0 0 0 -1px; height: 40px; line-height:40px; padding:5px 0;"><a style="-webkit-text-size-adjust: none; text-decoration:none; color: #ffffff;" href="http://www.azcentral.com/nation/" target="_parent" data-ht="Headernation">NATION</a></td>
					<td style="-webkit-text-size-adjust: none; text-align:center; white-space: nowrap; border-top-color: rgb(158, 29, 10); border-style: solid; border-width: 1px 1px 0 0; border-right-color: #343434; margin: 0 0 0 -1px; height: 40px; line-height:40px; padding:5px 0;"><a style="-webkit-text-size-adjust: none; text-decoration:none; color: #ffffff;" href="http://www.azcentral.com/sports/" target="_parent" data-ht="Headersports">SPORTS</a></td>
					<td style="-webkit-text-size-adjust: none; text-align:center; white-space: nowrap; border-top-color: rgb(116, 23, 132); border-style: solid; border-width: 1px 1px 0 0; border-right-color: #343434; margin: 0 0 0 -1px; height: 40px; line-height:40px; padding:5px 0;"><a style="-webkit-text-size-adjust: none; text-decoration:none; color: #ffffff;" href="http://www.azcentral.com/things-to-do/" target="_parent" data-ht="Headerthings-to-do">THINGS TO DO</a></td>
					<td style="-webkit-text-size-adjust: none; text-align:center; white-space: nowrap; border-top-color: rgb(19, 127, 57); border-style: solid; border-width: 1px 1px 0 0; border-right-color: #343434; margin: 0 0 0 -1px; height: 40px; line-height:40px; padding:5px 0;"><a style="-webkit-text-size-adjust: none; text-decoration:none; color: #ffffff;" href="http://www.azcentral.com/business/" target="_parent" data-ht="Headerbusiness">BUSINESS</a></td>
					<td style="-webkit-text-size-adjust: none; text-align:center; white-space: nowrap; border-top-color: rgb(116, 23, 132); border-style: solid; border-width: 1px 1px 0 0; border-right-color: #343434; margin: 0 0 0 -1px; height: 40px; line-height:40px; padding:5px 0;"><a style="-webkit-text-size-adjust: none; text-decoration:none; color: #ffffff;" href="http://www.azcentral.com/az-living/" target="_parent" data-ht="Headeraz-living">AZ LIVING</a></td>
					<td style="-webkit-text-size-adjust: none; text-align:center; white-space: nowrap; border-top-color: rgb(0, 177, 188); border-style: solid; border-width: 1px 1px 0 0; border-right-color: #343434; margin: 0 0 0 -1px; height: 40px; line-height:40px; padding:5px 0;"><a style="-webkit-text-size-adjust: none; text-decoration:none; color: #ffffff;" href="http://www.azcentral.com/travel-explore/" target="_parent" data-ht="Headertravel-explore">TRAVEL & EXPLORE</a></td>
					<td style="-webkit-text-size-adjust: none; text-align:center; white-space: nowrap; border-top-color: rgb(247, 96, 31); border-style: solid; border-width: 1px 1px 0 0; border-right-color: #343434; margin: 0 0 0 -1px; height: 40px; line-height:40px; padding:5px 0;"><a style="-webkit-text-size-adjust: none; text-decoration:none; color: #ffffff;" href="http://www.azcentral.com/politics/" target="_parent" data-ht="Headerpolitics">POLITICS</a></td>
					<td style="-webkit-text-size-adjust: none; text-align:center; white-space: nowrap; border-top-color: rgb(102,102,102); border-style: solid; border-width: 1px 0 0 0; margin: 0 0 0 -1px; height: 40px; line-height:40px; padding:5px 0;"><a style="-webkit-text-size-adjust: none; text-decoration:none; color: #ffffff;" href="http://www.azcentral.com/viewpoints/" target="_parent" data-ht="Headeropinion">OPINION</a></td>
				</tr>
			</table>
		</td>
		<td style="margin:0; "></td>
	</tr>	
</table>
<!-- /End NAV -->
<?
}
?>
