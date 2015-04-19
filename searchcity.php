<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php include "myfunction.php"; ?>
	
	<div id="searchcity-cont">
	  <form method="POST">
		<span class="mytitle">Please input your city</span> <br/>
		If the result is not the city you're looking for, please add country id behind.<br/>
		Eg: Melbourne,AU<br/>
		<input type="text" name="mycity" id="mycity" /> <br />
		<input type="submit" id="submitCity" name="submitCity" value="Gooo" />
	  </form>
		<?php
			if (isset($_POST["submitCity"])) {
				$mycity = $_POST["mycity"];
				$weathers = get_weather_from_api($mycity);
				
				$exrate = get_exchangerate_from_api();
				
				$country_info = array();
				
				if (isset($weathers->sys->country) && !empty($weathers->sys->country)) {
					$country_info = get_country_info_from_countrycode($weathers->sys->country);					
				}
				
				//var_dump(get_photos_from_flickr());
		?>
			<div id="searchResultContainer">			
				<table class="search-table">
					<tr class="search-table-title">
						<td colspan="2">Data</td>
					</tr>
				<?php if (isset($weathers) && !empty($weathers)) { ?>
					<?php if (isset($weathers->name) && !empty($weathers->name)) { ?>
					<tr class="odd">
						<td>City</td>
						<td><?php echo $weathers->name;?></td>
					</tr>
					<?php } ?>
					<?php if (isset($country_info->name) && !empty($country_info->name)) { ?>
					<tr>
						<td>Country</td>
						<td><?php echo $country_info->name;?></td>
					</tr>
					<?php } ?>
					<?php if (isset($country_info->region) && !empty($country_info->region)) { ?>
					<tr class="odd">
						<td>Region</td>
						<td><?php echo $country_info->region;?></td>
					</tr>
					<?php } ?>
					<?php if (isset($country_info->callingCodes) && !empty($country_info->callingCodes)) { ?>
					<tr>
						<td>Calling Codes</td>
						<td><?php echo $country_info->callingCodes[0];?></td>
					</tr>
					<?php } ?>
					<?php if (isset($country_info->currencies) && !empty($country_info->currencies)) { ?>
					<tr class="odd">
						<td>Currency</td>
						<td><?php echo $country_info->currencies[0];?></td>
					</tr>
						<?php if (isset($exrate) && !empty($exrate)) { ?>
						<tr>
							<td>Rate (from USD)</td>
							<td>
								<?php 
									$currency_code = $country_info->currencies[0];
									echo $exrate->rates->$currency_code; 
								?>
							</td>
						</tr>
						<?php } ?>
					<?php } ?>
					
					<?php if (isset($weathers->main->temp) && !empty($weathers->main->temp)) { ?>
					<tr class="odd">
						<td>Temp</td>
						<td><?php echo ($weathers->main->temp - 273.15)."&deg;"; ?><br/>
							Min:<?php echo ($weathers->main->temp_min - 273.15)."&deg;"; ?><br/>
							Max:<?php echo ($weathers->main->temp_max - 273.15)."&deg;"; ?><br/>
						</td>
					</tr>
					<?php } ?>
					<?php if (isset($weathers->weather[0]->main) && !empty($weathers->weather[0]->main)) { ?>
					<tr>
						<td>Weather</td>
						<td><?php echo $weathers->weather[0]->main." (".$weathers->weather[0]->description.")"; ?></td>
					</tr>
					<?php } ?>
					<?php if (isset($weathers->wind->speed) && !empty($weathers->wind->speed)) { ?>
					<tr class="odd">
						<td>Wind</td>
						<td>
							Speed: <?php echo $weathers->wind->speed." m/s"; ?><br/>
							Direction: <?php echo $weathers->wind->deg."&deg;"; ?>
						</td>
					</tr>
					<?php } ?>
					<?php if (isset($weathers->main->pressure) && !empty($weathers->main->pressure)) { ?>
					<tr>
						<td>Preasure</td>
						<td><?php echo $weathers->main->pressure." hpa"; ?></td>
					</tr>
					<?php } ?>
					<?php if (isset($weathers->main->humidity) && !empty($weathers->main->humidity)) { ?>
					<tr class="odd">
						<td>Humidity</td>
						<td><?php echo $weathers->main->humidity." %";?></td>
					</tr>
					<?php } ?>
					<?php if (isset($weathers->rain->{'3h'}) && !empty($weathers->rain->{'3h'})) { ?>
					<tr>
						<td>Rain (3h)</td>
						<td><?php echo $weathers->rain->{'3h'};?></td>
					</tr>
					<?php } ?>
					<?php if (isset($weathers->coord->lon) && !empty($weathers->coord->lon)) { ?>
					<tr class="odd">
						<td>Geo Coord</td>
						<td><?php echo "[".$weathers->coord->lon.",".$weathers->coord->lat."]";?></td>
					</tr>
					<?php } ?>
				<?php } ?>
				</table>
			</div>
		<?php	
			}
		?>
	</div>
	
</body>
