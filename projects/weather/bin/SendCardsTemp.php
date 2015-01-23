#!/usr/local/bin/php -q
<?

// <comment developer="eric.brown@pni.com" date="2004-09-13">
// This FTP's the file 'cards_phoenix_temp.inc' that get_cards_temp.sh creates a minute before.
// This runs every 15 minutes in cron under the cronuser
// </comment>

$ftpConn = ftp_connect("venice.pni.com");
echo "Connection handle: $ftpConn\n";
if(ftp_login($ftpConn,"azcards","eightysixed"))
	echo "Login successful\n";
if(ftp_put($ftpConn,"/webhome/htdocs/includes/temperature.inc","/www_live/azc/htdocs/includes/cards_phoenix_temp.inc",FTP_ASCII))
	echo "Put successful\n";

ftp_close($ftpConn);

?>
