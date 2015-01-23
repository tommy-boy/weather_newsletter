#!/bin/bash

#publish the Weather Page Forecast Table in its template....
/apps/projects/weather/bin/v8_WeatherTable.php
echo "Done publishing Weather Page Forecast Table Template...";

#rysnc the file out to content
rsync -av /apps/generated/weather/generated/v8_weatherforecast.inc content:/web/generated/weather/generated/v8_weatherforecast.inc >/dev/null 2>&1
rsync -av /apps/generated/weather/generated/12newspreview.inc content:/web/generated/weather/generated/12newspreview.inc >/dev/null 2>&1
echo "Done rsync'ing file...";
