# weather_newsletter
Exact Target azcentral weather Newsletter

Newsletter cron files
/apps/projects/weather/bin/

Datasource files to run include:  NewsletterWeather.php; v8_WeatherTable.php; v8_WeatherToday.php
These 3 files generate data to templates that are written to server side includes.

Newsletter inc files
/apps/generated/weather/generated/

There are two important include files that are used as datasource for the app weather:  newsletter_forecast.inc provides Today's forecast and v8_weatherforecast.inc provides the narrative and 3-day forecast.

The narrative is a Presto article and the forecast is data from the weather.azcentral.com which uses Accuweather api.


Newsletter App files

Directory path: /email/newsletters/
Run file: /email/newsletters/index.php
Config file: /email/newsletters/config/common.php // Used to create stdClass object for all the newsletter options and content
Main views: includes/head.php, includes/main.php, includes/footer.php, includes/ads.php


Classes (classes to use are defined in the config.php file)
	App - instantiates the newsletter and loads the objects (classes) and views (widgets) for the newsletter
	Subject - class to get the story headline (for the email subject line)
	Format - misc static library for formatting global design stuff
	simple_html_dom.php - Library to make dom object

	//content classes	
	MainArtWeather.php - formats the entire weather newsletter


Widgets (widget view is loaded when the class is instantiated)
