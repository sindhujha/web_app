<?php
$address = $_GET["address"];
$city = $_GET["city"];
$State = $_GET["state"];
$key = $_GET["key"];
$degree = $_GET["degree"];
if($_GET["degree"]=="Fahrenheit")
		{
			$unit = "us";
			$sym = "F";
			$wsunit = "mph";
			$visunit = "mi";
		}
else if ($_GET["degree"]=="Celsius")
		{
			$unit = "si";
			$sym = "C";
			$wsunit = "mps";
			$visunit = "km";
		}
//echo '<br> address: '.$address.'city: '.$city.'State:'.$State.'degree: '.$degree;
$urlstr = urlencode("https://maps.googleapis.com/maps/api/geocode/xml?address=".$address.",".$city.",".$State."&key=AIzaSyDXofHUvtxNr2UCmUUWRKSQ68p5zBN6tgQ"); 
$xmlstring=simplexml_load_file($urlstr) or die("Error: Cannot create object");
$latitude=$xmlstring->result->geometry->location->lat; 
$longitude=$xmlstring->result->geometry->location->lng;
$forecasturl="https://api.forecast.io/forecast/"."a06f959d2b72534de5818c3248e25606/".$latitude.",".$longitude."?"."units=".$unit."&exclude=flags";
//echo $forecasturl;
$jsonresponse = file_get_contents($forecasturl);
//$json_arr = json_decode($jsonresponse, true);
echo $jsonresponse;
//echo '<pre>' . print_r($json_arr, true) . '</pre>';
?>
