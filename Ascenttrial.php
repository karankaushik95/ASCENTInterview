<?php
$lat1  = 19.027732;	//Karan Latitude
$long1 = 72.858293; //Karan Longitude
$lat2  = 19.079030; //ASCENT Latitude
$long2 = 72.896224; //ASCENT Longitude

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	global $lat1, $long1, $lat2, $long2;
	$lat3;
	$long3;
	$directtime;
	$indirecttime;
	$lat3  = $_POST['Latitude']; //Third point Latitude
	$long3 = $_POST['Longitude']; //Third point Longitude
	echo '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6vwsPFlyQtLcW39ctJBKGn59yPGFU7Ew&callback=initMap">';
	echo 'var origin = new google.maps.LatLng($lat1, $long1)';
	echo 'var destination = new google.maps.LatLng($lat2, $long2)';
	echo 'var thirdpoint = new google.maps.LatLng($lat3,$long3)';
	echo 'var service = new google.maps.DistanceMatrixService()';
	echo 'service.getDistanceMatrix(
		{
			origins: [origin, destination],
			destinations: [destination, thirdpoint],
			travelMode: \'DRIVING\',
			drivingOptions:{departureTime: new Date(Date.now())},
			unitSystem: google.maps.UnitSystem.METRIC,
			avoidHighways: false,
			avoidTolls: false,
		}, callback);
		function callback(response,status){
			if (status == \'OK\') {
				var origins = response.originAddresses;
				var destinations = response.destinationAddresses;
				for (var i = 0; i < origins.length; i++) {
					var results = response.rows[i].elements;
					for (var j = 0; j < results.length; j++) {
						var element = results[j];
						var distance = element.distance.text;
						var duration = element.duration.text;
						var from = origins[i];
						var to = destinations[j];
					}				
				}
			}
		}';							
	echo '</script>';
}
?>
