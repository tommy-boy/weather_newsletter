#!/bin/sh

echo "Converting...";
cd /projects/weather/incoming/weatherstation || exit


#/usr/bin/find /projects/weather/incoming/weatherstation -type f -name "cable1.jpg" -exec /usr/X11R6/bin/convert -crop 600X390 cable1.jpg -resize 508X508 current.jpg \; || exit
#/usr/bin/find /projects/weather/incoming/weatherstation -type f -name "cable1.jpg" -exec /usr/X11R6/bin/convert -crop 600X390 cable1.jpg -resize 365X365 current_304.jpg \; || exit
#/usr/bin/find /projects/weather/incoming/weatherstation -type f -name "cable2.jpg" -exec /usr/X11R6/bin/convert -crop 600X390 cable2.jpg -resize 508X508 today.jpg \; || exit

/usr/bin/convert -crop 600X390 /projects/weather/incoming/weatherstation/cable1.jpg /projects/weather/incoming/weatherstation/temp.jpg
/usr/bin/convert -resize 508X508 /projects/weather/incoming/weatherstation/temp.jpg.0 /projects/weather/incoming/weatherstation/current.jpg
/usr/bin/convert -resize 365X365 /projects/weather/incoming/weatherstation/temp.jpg.0 /projects/weather/incoming/weatherstation/current_304.jpg
rm /projects/weather/incoming/weatherstation/temp.jpg*
/usr/bin/convert -crop 600X390 /projects/weather/incoming/weatherstation/cable2.jpg /projects/weather/incoming/weatherstation/temp.jpg
/usr/bin/convert -resize 508X508 /projects/weather/incoming/weatherstation/temp.jpg.0 /projects/weather/incoming/weatherstation/today.jpg
 echo "Done.";


echo "Cleaning up...";

rm -f /projects/weather/incoming/weatherstation/cable1.jpg /projects/weather/incoming/weatherstation/cable2.jpg /projects/weather/incoming/weatherstation/temp.jpg* /projects/weather/incoming/weatherstation/current.jpg.*
#mv /projects/weather/incoming/weatherstation/current.jpg /projects/weather/incoming/weatherstation/current_304.jpg /projects/weather/incoming/weatherstation/today.jpg /dev_www/azc/htdocs/weather/wsi_images || exit
mv /projects/weather/incoming/weatherstation/current.jpg /projects/weather/incoming/weatherstation/current_304.jpg /projects/weather/incoming/weatherstation/today.jpg /apps/jumble/weather/wsi_images 
echo "Done";

#echo "Syncing live...";
#/projects/weather/bin/ftp_cable.exp
/bin/nice /usr/bin/rsync -aqz -essh --exclude=".svn*" --bwlimit=1000 /apps/jumble/weather/wsi_images/ content:/web/jumble/weather/wsi_images/ >/dev/null 2>&1
#echo "Done";
