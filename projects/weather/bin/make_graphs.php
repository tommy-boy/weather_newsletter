#!/usr/local/bin/php5.0.4-cli
<?
  require("/projects/weather/jpgraph-2.0beta/src/jpgraph.php");
  require("/projects/weather/jpgraph-2.0beta/src/jpgraph_line.php");

  mysql_connect("calcutta.azcentral.com","webuser","web*User");
  mysql_select_db("weatherstation");
  $sql="select `Time`,`Temp`, `Humidity`,`Heat Index` from `observations` order by `Time` DESC limit 60"; // Get the last 60 entries
  if(!$result=mysql_query($sql)) {
    echo "Error: ".mysql_error()."\n";
  } else {
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)) {
      $temp[]=$row['Temp'];
      $humidity[]=$row['Humidity'];
      $heatindex[]=$row['Heat Index'];
      $time[]=date("g:i a",$row['Time']);
    }
    mysql_free_result($result);
  }

  $temp=array_reverse($temp,false);
  $humidity=array_reverse($humidity,false);
  $heatindex=array_reverse($heatindex,false);
  $time=array_reverse($time,false);

  // Create the graph.  These two calls are always required
  $graph = new Graph(440,300,"auto");
  $graph->SetScale("textlin");
  $graph->SetFrame(false);
  $graph->SetY2Scale("lin",0,100);

  $graph->img->SetMargin(60,120,40,60);
  $graph->title->Set("Observations Last Hour");

  $graph->yaxis->title->SetMargin(20);
  $graph->yaxis->title->Set("Temperature F");
  $graph->yaxis->SetColor("red");
  $graph->yaxis->scale->SetGrace(100,100);

  $graph->y2axis->SetColor("blue");
  $graph->y2axis->title->Set("Humidity %");

  $graph->ygrid->Show(true,true);

  $graph->xgrid->Show(true);

  $graph->xaxis->SetTickLabels($time);
  $graph->xaxis->SetTextTickInterval(5,0);
  $graph->xaxis->SetLabelAngle(90);


  $graph->legend->Pos(0,0);

  $tempplot = new LinePlot($temp);
  $tempplot->SetColor("red");
  $tempplot->SetLegend("Temperature");
  $tempplot->mark->SetType(MARK_IMG_MBALL,'red',.4);

  $humplot = new LinePlot($humidity);
  $humplot->SetColor("blue");
  $humplot->SetLegend("Humidity");

  $heatplot = new LinePlot($heatindex);
  $heatplot->SetColor("red");
  $heatplot->SetLegend("Heat Index");
  $heatplot->mark->SetType(MARK_IMG_DIAMOND,'red',.25);

  // Add the plots to the graph
  $graph->Add($tempplot);
  $graph->Add($heatplot);
  $graph->AddY2($humplot);

  // Display the graph
  $graph->Stroke("/dev_www/azc/htdocs/test/cwalsh/graph.png");

/*
print_r(gd_info());
if(imagetypes() && IMG_GIF) echo "GIF Support is enabled\n";
if(imagetypes() && IMG_JPG) echo "JPG Support is enabled\n";
if(imagetypes() && IMG_PNG) echo "PNG Support is enabled\n";
if(imagetypes() && IMG_WBMP) echo "WBMP Support is enabled\n";
if(imagetypes() && IMG_XPM) echo "XPM Support is enabled\n";
*/
?>
