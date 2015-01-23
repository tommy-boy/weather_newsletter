#!/bin/bash

#publish the weather info table....
/apps/projects/weather/bin/RedesignWeatherNew.php
echo "Done publishing weather info table...";

#rysnc the file out to content
rsync -av /apps/generated/weather/generated/weatherinfo.php content:/web/generated/weather/generated/weatherinfo.php >/dev/null 2>&1
echo "Done rsync'ing file...";
