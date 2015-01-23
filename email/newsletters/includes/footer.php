<!-- FOOTER -->
<? if(self::$config->FA == 1){ ?>
<table width="640" cellpadding="0" cellspacing="0" border="0" style="background-color:#ececec;" class="deviceWidth">
    <tbody><tr>
        <td width="100%">
            <img src="http://images.e.usatoday.com/lib/fefb1576716306/i/1/c713ed0c-0.jpg" border="0" style="display:block;" width="100%">
            <!-- footer Logo-->
            <table width="49%" cellpadding="0" cellspacing="0" border="0" align="left" class="deviceWidth">
                <tbody><tr>
                    <td style="text-align:center;">
                        <img src="http://www.gannett-cdn.com/sites/azcentral/images/footer-logo@2x.png" width="197" alt="azcentral">
                    </td>   
                </tr>
            </tbody></table>
            <!-- end footer logo -->

            <!--  Footer text -->   
            <table width="49%" cellpadding="0" cellspacing="0" border="0" align="right" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;line-height:1.5em;" class="deviceWidth">
                <tbody><tr>
                    <td style="padding-right: 5px; padding-bottom:20px;">
                        You are currently subscribed to this newsletter. To UNSUBSCRIBE, please <a href="http://account.azcentral.com/newsletter-unsubscribe/?email=%%EmailAddr%%&listId=7506218" target="_blank" style="color:#272727;font-weight:bold;">click here</a>.                                          
                    </td>   
                </tr>
                <tr>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:10px;padding-bottom:20px;">
                        © 2013 azcentral, a division of Gannett Co. Inc.<br>
                        7950 Jones Branch Drive, McLean, VA 22108
                    </td>   
                </tr>
            </tbody></table>
            <!-- end footer text -->
        </td>   
    </tr>   
</tbody>
</table><!-- /FOOTER -->
<? } else { ?>
<table class="footer-wrap" style="width: 100%;	clear:both!important; margin:0 auto;">
	<tr>
		<td></td>
		<td class="container">
				<!-- content -->
				<div class="content" bgcolor="#ebebeb">
				<table align="center">
				<tr>
					<td align="center">
					<p align="center" style="font-size:10px;"><a href="httpgetwrap|https://fullaccess.azcentral.com/" style="font-family:\'Calibri\',Arial,Helvetica,sans-serif; font-size: 10px; color: #205788; text-decoration:none;">Sign up for Full Access.</a>&nbsp;&nbsp;|&nbsp;&nbsp;
					<a href="httpgetwrap|http://www.azcentral.com/help/articles/comment-form.php" style="font-family:\'Calibri\',Arial,Helvetica,sans-serif; font-size: 10px;  color: #205788; text-decoration:none;">Contact us</a> &nbsp;&nbsp;|&nbsp;&nbsp;
					<a href="httpgetwrap|http://www.azcentral.com/email/unsubscribe/index.php?nl=<?=App::getUnsubscribe();?>&eid=%%emailaddr%%" style="font-family:\'Calibri\',Arial,Helvetica,sans-serif; font-size: 10px;  color: #205788; text-decoration:none;">Unsubscribe</a> <br/>
					
					<span style="color:#990000; font-size:11px; display:block;">Add azcentral@azcentral.com to your address book to ensure proper delivery of your newsletters</span><br/>

					&copy; 2014 azcentral.com. All rights reserved. | 200 East Van Buren Phoenix, AZ 85004<br/>Users of this site agree to the <a href="httpgetwrap|http://www.azcentral.com/help/articles/info-privacy.html" class="footer" style="color: #205788; text-decoration:none;">Terms of Service</a>, 
					<a href="httpgetwrap|http://www.azcentral.com/help/articles/privacy_en.html" class="footer" style="color: #205788; text-decoration:none;">Privacy Policy/Your California Privacy Rights</a> and <a href="httpgetwrap|http://www.azcentral.com/help/articles/privacy_en.html#adchoices" style="color: #205788; text-decoration:none;">Ad Choices</a><
					</p>
					<img src="http://archive.azcentral.com/email/newsletters/images/footer-logo@2x.png" style="margin:3px auto; border:none; width:150px; height:27px;" />
					</td>
				</tr>
			</table>
				</div><!-- /content -->
				
		</td>
		<td></td>
	</tr>
</table><!-- /FOOTER -->

<? } ?>


</td></tr></table>
<!--#include virtual="/incs/superswitch.inc"-->
</body>
</html>