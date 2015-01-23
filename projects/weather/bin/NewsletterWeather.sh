#!/bin/bash

#publish the Weather Newsletter in its template....
/apps/projects/weather/bin/NewsletterWeather.php
echo "Done publishing Newsletter weather template...";

#rysnc the file out to content
rsync -av /apps/generated/weather/generated/newsletter_forecast.inc content:/web/generated/weather/generated/newsletter_forecast.inc >/dev/null 2>&1
echo "Done rsync'ing file...";
