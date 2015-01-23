#!/bin/sh

# Turn satrad into a tiff so we can make it into a loop
find /projects/weather/incoming -type f -name "satrad.jpg" -exec /usr/X11R6/bin/convert -quality 100 {} {}.tif \;
find /projects/weather/incoming -type f -name "satrad.jpg" -exec rm {} \;

# Turn RAD_PHX_STILL into a tiff so we can make it into a loop
find /projects/weather/incoming -type f -name "RAD_PHX_STILL.jpg" -exec /usr/X11R6/bin/convert -quality 100 {} {}.tif \;
find /projects/weather/incoming -type f -name "RAD_PHX_STILL.jpg" -exec rm {} \;

# Turn Lightning_AZ_Still into a tiff so we can make it into a loop
find /projects/weather/incoming -type f -name "Lightning_AZ_Still.jpg" -exec /usr/X11R6/bin/convert -quality 100 {} {}.tif \;
find /projects/weather/incoming -type f -name "Lightning_AZ_Still.jpg" -exec rm {} \;

# Turn Lightning_SAZ_Still into a tiff so we can make it into a loop
find /projects/weather/incoming -type f -name "Lightning_SAZ_Still.jpg" -exec /usr/X11R6/bin/convert -quality 100 {} {}.tif \;
find /projects/weather/incoming -type f -name "Lightning_SAZ_Still.jpg" -exec rm {} \;

# move the files to working dir
find /projects/weather/incoming -type f -name "*.tif" -exec mv {} /projects/weather/working \;
find /projects/weather/incoming -type f -name tempmap.tif -exec mv {} /projects/weather/working \;
find /projects/weather/incoming -type f -name current.tif -exec mv {} /projects/weather/working \;
#find /projects/weather/incoming -type f -name "*.tifF" -exec mv {} /projects/weather/working \;

# Create the gifs
find /projects/weather/working -type f -name "*.tif" -exec /usr/X11R6/bin/convert -quality 100 {} -resize 508x508 {}.gif \;
find /projects/weather/working -type f -name tempmap.tif -exec /usr/X11R6/bin/convert -quality 100 {} -resize 508x508 {}.gif \;
find /projects/weather/working -type f -name current.tif -exec /usr/X11R6/bin/convert -quality 100 {} -resize 508x508 {}.gif \;
#find /projects/weather/working -type f -name "*.tifF" -exec /usr/X11R6/bin/convert -quality 100 {} -resize 508x508 {}.gif \;

# create the thumbnail gifs
find /projects/weather/working -type f -name "*.tif" -exec /usr/X11R6/bin/convert -quality 100 {} -resize 249X249 {}_tn.gif \;
find /projects/weather/working -type f -name tempmap.tif -exec /usr/X11R6/bin/convert -quality 100 {} -resize 249X249 {}_tn.gif \;
find /projects/weather/working -type f -name current.tif -exec /usr/X11R6/bin/convert -quality 100 {} -resize 249X249 {}_tn.gif \;
#find /projects/weather/working -type f -name "*.tifF" -exec /usr/X11R6/bin/convert -quality 100 {} -resize 249X249 {}_tn.gif \;

# move the tif files to archive dir
find /projects/weather/working -type f -name "*.tif" -exec mv {} /projects/weather/archive \;
find /projects/weather/working -type f -name tempmap.tif -exec mv {} /projects/weather/archive \;
find /projects/weather/working -type f -name current.tif -exec mv {} /projects/weather/archive \;
#find /projects/weather/working -type f -name "*.tifF" -exec mv {} /projects/weather/archive \;

# move the converted images to weather directory; they'll get moved live after the make_loop.sh script runs
find /projects/weather/working -type f -name "*.tif*.gif" ! -name "*.tif*.tif.gif"  -exec mv {} /dev_www/azc/htdocs/weather/wsi_images \;
find /projects/weather/working -type f -name tempmap.tif*.gif ! -name "*.tif*.tif.gif"  -exec mv {} /dev_www/azc/htdocs/weather/wsi_images \;
find /projects/weather/working -type f -name current.tif*.gif ! -name "*.tif*.tif.gif"  -exec mv {} /dev_www/azc/htdocs/weather/wsi_images \;
#find /projects/weather/working -type f -name "*.tifF*.gif" ! -name "*.tifF*.tif.gif"  -exec mv {} /dev_www/azc/htdocs/weather/wsi_images \;

# 2008-01-16 clean up any old files from working and archive
find /projects/weather/working -mtime +8 -type f -exec rm -f {} \;
find /projects/weather/archive -mtime +8 -type f -exec rm -f {} \;
find /projects/weather/incoming -mtime +8 -type f -exec rm -f {} \;

# 2008-01-25 keep the dev site updated too
###/usr/bin/rsync -aq -essh --delete-after /dev_www/azc/htdocs/weather/wsi_images/*.gif /apps/dev/www.azcentral.com/htdocs/weather/wsi_images/
###/usr/bin/rsync -aq -essh --delete-after /dev_www/azc/htdocs/weather/wsi_images/*.gif /apps/staging/www.azcentral.com/htdocs/weather/wsi_images/
/usr/bin/rsync -aq -essh --delete-after /dev_www/azc/htdocs/weather/wsi_images/*.gif /apps/jumble/weather/wsi_images/ >/dev/null 2>&1
/usr/bin/rsync -aq -essh /projects/weather/incoming/*.gif /apps/jumble/weather/wsi_images/ >/dev/null 2>&1
/usr/bin/rsync -aq -essh /projects/weather/incoming/*.jpg /apps/jumble/weather/wsi_images/ >/dev/null 2>&1
/usr/bin/rsync -aq -essh /apps/jumble/weather/wsi_images/ content:/web/jumble/weather/wsi_images/ >/dev/null 2>&1

