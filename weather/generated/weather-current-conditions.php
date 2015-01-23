<?php
include("weatherinfo.php");
?>

<div class="weather-currentConditionsTopper"></div>
        <div id="weather-currentConditions">
        	<span class="heading">TODAY</span>
        	<div class="inset">
            	<div class="weatherNow">
					RIGHT NOW<br />
					<!-- <div class="currentCol">
						<img src="/weather/imgs/icons/weather-shower2.png" align="middle"><?#=round($weather['temp_f'],0);?>&deg;
					</div>
					<div class="tempsCol">
						109&deg; H<br />
						72&deg; L<br />
					</div>-->
          <?php include("v8_weathertoday.inc"); ?>
					<div class="clear"></div>
				</div><br />
                <span class="listhead">CURRENT CONDITIONS</span><br />
                	<table id="weatherConditions">
                    	<tr>
                        	<td class="left">
                            	Heat Index:
                            </td>
                            <td class="right">
                            	<?=$weather['heat_index_f'];?>
                            </td>
                        </tr>
                        <tr>
                        	<td class="left">
                            	Sunrise:
                            </td>
                            <td class="right">
                            	<?=$weather['sunrise'];?>
                            </td>
                        </tr>
                        <tr>
                        	<td class="left">
                            	Sunset:
                            </td>
                            <td class="right">
                            	<?=$weather['sunset'];?>
                            </td>
                        </tr>
                        <tr>
                        	<td class="left">&nbsp;
                            	
                            </td>
                            <td class="right">&nbsp;
                            	
                            </td>
                        </tr>
                        <tr>
                        	<td class="left">
                            	Humidity:
                            </td>
                            <td class="right">
                            	<?=$weather['relative_humidity'];?>%
                            </td>
                        </tr>
                        <tr>
                        	<td class="left">
                            	Winds:
                            </td>
                            <td class="right">
                            	<?=$weather['wind_mph'];?>mph
                            </td>
                        </tr>
                        <tr>
                        	<td class="left">
                            	Dew Point:
                            </td>
                            <td class="right">
                            	<?=$weather['dewpoint_f'];?>&deg;
                            </td>
                        </tr>
                        <tr>
                        	<td class="left">
                            	Pressure:
                            </td>
                            <td class="right">
                            	<?=$weather['pressure_in'];?>&nbsp;IN
                            </td>
                        </tr>
                    </table><br />
                <!-- <span class="listhead">AIR QUALITY</span><br />
                <table id="weatherConditions">
                    	<tr>
                        	<td class="left">
                            	Today:
                            </td>
                            <td class="right">
                            	
                            </td>
                        </tr>
                        <tr>
                        	<td class="left">
                            	Tomorrow:
                            </td>
                            <td class="right">
                            	
                            </td>
                        </tr>
                    </table> -->
            </div>
        </div>
