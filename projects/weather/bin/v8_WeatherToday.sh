#!/bin/bash

#publish the Weather Page Right Now info....
/apps/projects/weather/bin/v8_WeatherToday.php
echo "Done publishing Weather Page Right Now info...";

#rysnc the file out to content
rsync -av /apps/generated/weather/generated/v8_weathertoday.inc content:/web/generated/weather/generated/v8_weathertoday.inc >/dev/null 2>&1
echo "Done rsync'ing file...";
