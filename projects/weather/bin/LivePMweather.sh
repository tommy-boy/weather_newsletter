#!/bin/bash

#publish the Home Page Forecast Table in its template....
/apps/projects/weather/bin/LivePMweather.php
echo "Done publishing Home Page Forecast Table Template...";

#rysnc the file out to content
rsync -av /apps/generated/weather/generated/homepage_weathertab.inc content:/web/generated/weather/generated/homepage_weathertab.inc >/dev/null 2>&1
echo "Done rsync'ing file...";
