#!/bin/bash

#publish the Weather Page Forecast Table in its template....
/apps/projects/weather/bin/RedesignWeatherTable.php
echo "Done publishing Weather Page Forecast Table Template...";

#rysnc the file out to content
rsync -av /apps/generated/weather/generated/weatherpage_forecast.inc content:/web/generated/weather/generated/weatherpage_forecast.inc >/dev/null 2>&1
echo "Done rsync'ing file...";
