<?php
header("Content-type:application/json");
define('JSON_FILE', '/home/pi/DHT22-TemperatureLogger/config.json');

// Create the empty file
$host = "localhost";
$user = "logger";
$password = "password";
$database = "temperatures";

//how many hours backwards do you want results to be shown in web page.
$hours = 24;

// make connection to database
$connectdb = mysqli_connect($host,$user,$password)
or die ("Cannot reach database");

// select db
mysqli_select_db($connectdb,$database)
or die ("Cannot select database");

// sql command that selects all entires from current time and X hours backwards
//$sql="SELECT * FROM temperaturedata WHERE dateandtime >= (NOW() - INTERVAL $hours HOUR) order by dateandtime desc";
$sql="SELECT * FROM temperaturedata WHERE dateandtime >= (NOW() - INTERVAL $hours HOUR) order by id desc LIMIT 2";

//NOTE: If you want to show all entries from current date in web page uncomment line below by removing //
//$sql="select * from temperaturedata where date(dateandtime) = curdate();";

// set query to variable
$result = mysqli_query($connectdb, $sql);
//$row = mysqli_fetch_array($result);
while($row = mysqli_fetch_array($result)){

  $resultado[]= array(
    'sensor' =>$row['sensor'],
    'fecha' =>$row['dateandtime'],
    'temperatura' =>$row['temperature'],
    'humedad' =>$row['humidity']

  );
};

echo json_encode($resultado);

 ?>
