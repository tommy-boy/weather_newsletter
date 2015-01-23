#!/usr/local/bin/php -q
<?

srand(time());

if (rand() % 2)  {
  $prevent_scraping = true;
}

require ("/www/php.inc/mysql_connect.inc");
mysql_select_db("weatherdata");

$search = mysql_query("SELECT temp,formatcity FROM weatherdata WHERE rawcity IN ('PHOENIX','TUCSON','FLAGSTAFF ARPT','GRAND CANYON')");
print mysql_error();
while ($row = mysql_fetch_array($search,MYSQL_ASSOC))  {
  $class = 'weatherothercities';
  $city = obfuscate($row[formatcity]);
  if (preg_match("/phoenix/i",$row[formatcity])){
    $class = 'weatherphoenix';
    $city = strtoupper(obfuscate($row[formatcity]));
  }
  $outputarray[$row[formatcity]] = "<span class=\"".$class."\">".$city." ".$row[temp]."&deg;</span><br>\n";
}

$output = $outputarray["Phoenix"];
$output .= $outputarray["Tucson"];
$output .= $outputarray["Flagstaff"];
//$output .= $outputarray["Grand Canyon"];

srand(time());

function obfuscate($input)  {
  global $prevent_scraping;
  
  if (!$prevent_scraping)  {
    return $input;
  }
  
  for ($c=0; $c<strlen($input); $c++)  {
    if (rand() % 2)  {
      if (substr($input,$c,1) == " ")  {
        if (rand() % 2)  {
          $output .= " ";
        } elseif (rand() % 2)  {
          $output .= "\n";
        } elseif (rand() % 2)  {
          $output .= "&nbsp;";
        } else {
          $output .= "&#".ord(substr($input,$c,1)).";";
        }
      } else {
        $output .= "&#".ord(substr($input,$c,1)).";";
      }
    } else {
      $output .= substr($input,$c,1);
    }
  }
  return $output;
}

//$output  = obfuscate("Phoenix: ")."$PHOENIX<br>\n";
//$output .= obfuscate("Tucson: ")."$TUCSON<br>\n";
//$output .= obfuscate("Flagstaff: ")."$FLAGSTAFF<br>\n";
//$output .= obfuscate("Grand Canyon: ")."$GRAND_CANYON\n";


$fp = fopen("/www/azc/htdocs/incs/currtemps.inc.tmp","w");
fputs($fp,$output,strlen($output));
fclose($fp);

rename("/www/azc/htdocs/incs/currtemps.inc.tmp","/data/live_www/azc/htdocs/incs/currtemps.inc");
echo $output;

?>
