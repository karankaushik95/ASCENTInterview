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
	$json = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=Washington,DC&destinations=New+York+City,NY&key=AIzaSyB6vwsPFlyQtLcW39ctJBKGn59yPGFU7Ew');//testing if api works 
	//$data = json_decode($json, true);
	//var_dump ($json);// 
	echo $json["rows"][0]["elements"][0]["distance"]["duration"]["text"];
	
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
	</body>
</html>
