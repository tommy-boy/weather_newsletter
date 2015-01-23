#!/bin/sh
cd /projects/weather/incoming

SUFFIX=tif
# Loop through the tifs and rename to include a timestamp
for FILE in *."$SUFFIX"
do
  NEWSUFFIX=`date -r $FILE +%s`
  NEWNAME=`echo "$FILE" | sed -e "s/${SUFFIX}\$/$NEWSUFFIX/"`."$SUFFIX"
#  echo "Moving $FILE"
  mv "$FILE" /projects/weather/working/"$NEWNAME"
done

# Create the gifs
find /projects/weather/working -type f -name "*.tif" -exec /usr/X11R6/bin/convert -quality 100 {} -resize 508x508 {}.gif \;
find /projects/weather/working -type f -name "*.tif" -exec mv {} /projects/weather/archive \;

cd /projects/weather/working

function loop {
  i=0
  for FILE in $1*.tif.gif
  do
    FILELIST[$i]=$FILE
    i=$i+1
  done
  unset i
  # we only want the last 5 images... move the other to the archive
  i=0
  j=${#FILELIST[*]}
  let j=j-5
  while (( $i < ${#FILELIST[*]} )); do
    if [[ $i -lt $j ]]; then
      mv /projects/weather/working/${FILELIST[$i]} /projects/weather/archive/${FILELIST[$i]}
#       echo "Moving: ${FILELIST[$i]}"
    else
#       echo "Keeping: ${FILELIST[$i]}"
      LIST="$LIST /projects/weather/working/${FILELIST[$i]}"
    fi
    let i=$i+1
  done
  # This version of convert doesn't support -pause, so instead just add the last image twice
  LIST="$LIST /projects/weather/working/${FILELIST[$i-1]}"
  /usr/X11R6/bin/convert -delay 75  -loop 0 $LIST /dev_www/azc/htdocs/weather/wsi_images/$1.gif
  /usr/X11R6/bin/convert -quality 100 /dev_www/azc/htdocs/weather/wsi_images/$1.gif -resize 249X249 /dev_www/azc/htdocs/weather/wsi_images/$1_tn.gif
  unset LIST FILE FILELIST i
}
loop satrad.jpg
loop satrad_sw
loop rad
loop RAD_PHX_STILL.jpg
loop Lightning_AZ_Still.jpg
loop Lightning_SAZ_Still.jpg
loop MS_Radar_Flagstaff.jpg
loop MS_RADAR_Flagstaff_Still.jpg

#/projects/weather/bin/ftp_loops.exp
/usr/bin/rsync -aq -essh /dev_www/azc/htdocs/weather/wsi_images/*.gif /apps/jumble/weather/wsi_images/ >/dev/null 2>&1
/usr/bin/rsync -aq -essh /apps/jumble/weather/wsi_images/ content:/web/jumble/weather/wsi_images/ >/dev/null 2>&1

