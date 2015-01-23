#!/usr/local/bin/php -q
<?
$string = file_get_contents("http://www.azcentral.com/weather.json");
$json_a = json_decode($string, true);
foreach ($json_a['primary_modules'] as $key => $result) {
    if (array_key_exists('weather_seven_day', $result)) {
        for($offset = 1; $offset < 4; $offset++) {
            foreach($json_a['primary_modules'][$key]['weather_seven_day'] as $pos => $forecast) {
                print_r($pos);
                if ($pos === $offset) { 
                $high = 'Hi: '.$forecast['tempFHi'].'    ';
                $low = 'Lo: '.$forecast['tempFLo'].'    ';
                $dayCode = 'Day: '.$forecast['dayCode'].'    ';
                $condition = $forecast['dayTime']['weatherIcon'];
                //print_r ($condition);
                print_r ($dayCode);
                print_r ($high);
                print_r ($low);
                echo("\r\n");
                }
            }
        }
    }
}
$story = file_get_contents("http://www.king5.com/story/weather/2014/08/19/seattle-wa-area-forecast/14286163.json");
$json = json_decode($story, true);
$narrative = $json['article']['body'][4]['value'];
print_r ($narrative);  
?>
