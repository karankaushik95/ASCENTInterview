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
	$q = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$lat1.','.$long1.'&destinations='.$lat2.','.$long2.'&key=AIzaSyB6vwsPFlyQtLcW39ctJBKGn59yPGFU7Ew';
	$json1  = file_get_contents($q);//Get time from API 
	$data1  = json_decode($json1);
	$value1 =(int)$data1->rows[0]->elements[0]->duration->value; //retrieve time taken in seconds
	echo "Time taken from Karan's house to ASCENT is: ".gmdate("H:i:s", $value1);
	echo "<br>";
	echo "<br>";
	echo "<br>";
	$r = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$lat1.','.$long1.'&destinations='.$lat3.','.$long3.'&key=AIzaSyB6vwsPFlyQtLcW39ctJBKGn59yPGFU7Ew';
	$json2 = file_get_contents($r);//Get time from API 
	$data2 = json_decode($json2);
	$value2 =(int)$data2->rows[0]->elements[0]->duration->value; //retrieve time taken in seconds
	echo "Time taken from Karan's house to random point is: ".gmdate("H:i:s", $value2);
	echo "<br>";
	echo "<br>";
	echo "<br>";
	$s = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$lat2.','.$long2.'&destinations='.$lat3.','.$long3.'&key=AIzaSyB6vwsPFlyQtLcW39ctJBKGn59yPGFU7Ew';
	$json3 = file_get_contents($s);//Get time from API 
	$data3 = json_decode($json3);
	$value3 =(int)$data3->rows[0]->elements[0]->duration->value; //retrieve time taken in seconds
	echo "Time taken from random point to ASCENT is: ".gmdate("H:i:s", $value3);
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	$timedelay = $value2 + $value3;
	$timedelay = abs($value1 - $timedelay);
	$timedelay = (float)$timedelay/60;
	if($timedelay >=15)
		echo "OUT OF THE WAY";
	else
		echo "ON THE WAY";
}
?>
