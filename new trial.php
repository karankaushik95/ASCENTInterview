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
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Distance Calculation</title>
	</head>	
	<body>
		<form method="post">
			Latitude: <input type="text" name="Latitude">&nbsp&nbsp&nbsp&nbsp&nbsp
			Longitude: <input type="text" name="Longitude"><br><br>
			<input type="submit">
		</form>
	<script>
		var origin1 = new google.maps.LatLng("<?php echo $lat1 ?>", "<?php echo $long1 ?>");
		var origin2 = new google.maps.LatLng("<?php echo $lat2 ?>", "<?php echo $long2 ?>");
		var destinationA = new google.maps.LatLng("<?php echo $lat2 ?>", "<?php echo $long2 ?>");
		var destinationB = new google.maps.LatLng("<?php echo $lat3 ?>", "<?php echo $long3 ?>");

		var service = new google.maps.DistanceMatrixService();
		service.getDistanceMatrix(
		{
			origins: [origin1, origin2],
			destinations: [destinationA, destinationB],
			travelMode: 'DRIVING',
			drivingOptions:{departureTime: new Date(Date.now())},
			unitSystem: google.maps.UnitSystem.METRIC,
			avoidHighways: False,
			avoidTolls: False,
		}, callback);

		function callback(response, status) {
			if (status == 'OK') {
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
		}
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6vwsPFlyQtLcW39ctJBKGn59yPGFU7Ew&callback=initMap">
    </script>	
	</body>
</html>
