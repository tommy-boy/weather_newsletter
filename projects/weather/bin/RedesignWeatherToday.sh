#!/bin/bash

#publish the Weather Page Right Now info....
/apps/projects/weather/bin/RedesignWeatherToday.php
echo "Done publishing Weather Page Right Now info...";

#rysnc the file out to content
rsync -av /apps/generated/weather/generated/weather_today.inc content:/web/generated/weather/generated/weather_today.inc >/dev/null 2>&1
echo "Done rsync'ing file...";
