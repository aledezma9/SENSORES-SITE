<?php
header("Content-type:application/json");
define('JSON_FILE', '/home/pi/DHT22-TemperatureLogger/config.json');


$resultado[] = json_decode(file_get_contents(JSON_FILE), true);


echo json_encode($resultado);

 ?>
