<? if(self::$config->FA == 0) include 'message.php';?>
<!-- BODY -->
<table class="body-wrap" align="center" style="width: 640px; margin:0 auto; padding:0; background-color: #fff; font-family:Arial, Helvetica, sans-serif; cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td>
			<table cellpadding="0" cellspacing="0" style="margin:0 10px 0 10px; padding:0; width:290px;">
				<tr>
					<td style="padding:0; margin:0;"><br/>
						<div class="date" style="font-size:11px; text-transform: uppercase; letter-spacing: 2px; margin:0 0 10px 0; margin-left:5px; font-family:Arial, Helvetica, sans-serif;"><?= App::loadDate();?></div>
						<?
						/** loads the widgets.  Views are in the /widgets folder and the class is in the object folder.  These are configured in config/common.php  
						look for # sign.  Signifies a widget being cloned.  Removes the # to App::loadWidget to run **/
						foreach($wobject as $widget => $datasource){
								$widget = str_replace('#','',$widget);
								if($widget != 'Hotlists') App::loadWidget($widget,$datasource);
						}
						?>
					</td>
				</tr>
			</table>
		</td>
		<td>
		    <table cellpadding="0" cellspacing="0" style="margin:0 10px 0 10px; padding:0; width:290px; font-family:Arial, Helvetica, sans-serif;">
				<tr>
					<td style="padding:10px 0">
					<? if(self::$config->mode != 'development'){
					
						if(self::$config->route->type == 'prepsco' || self::$config->route->type == 'prepsad') {
							echo App::loadPreps();
							echo App::loadSocial();
							echo App::loadNominate();
						}
						else {									
							echo App::loadSocial(); 
							if(self::$config->route->type == 'top5') {
								echo App::loadENews();
								echo App::loadTopPromo();
							}
							echo App::loadAd();
							if(self::$config->route->channel != 'breaking') echo App::loadPromo();
							if(self::$config->route->type == 'weekend') echo App::loadTTDPromo();
							if(self::$config->route->type == 'insider') echo App::loadVolunteer();
						}
						
					} ?>
					</td>
				</tr>
			</table>					
		</td>
	</tr>	
</table>
<? 
if(!empty($wobject) && !empty($wobject->Hotlists)):
 ?>
<table class="body-wrap" style="width: 100%; margin:0 auto; font-family:Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
	<tr>
		<td class="container" style="display:block!important; max-width:600px!important; margin:0 auto!important; clear:both!important;" bgcolor="#FFFFFF">			
															
			<?  
			foreach($wobject as $widget => $datasource){
					if($widget == 'Hotlists') App::loadWidget($widget,$datasource);
			}
			?>
																
		</td>
	</tr>	
</table>
<?  endif; ?>







