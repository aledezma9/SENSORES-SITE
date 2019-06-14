<?php

/**
* Funciones
*/

/**
* Buscar el nombre de un sensor en el JSON y cambiarlo
* $key_to_change: Este es el nombre del tipo de valor a ser cambiado
*   Ej: name, sensorType, etc.
*
* $value_to_change: Este es el valor de la propiedad antes descrita.
*   Ej: "Pasillo Frio"
*
* $new_val: Este es el valor que tendrá finalmente la propiedad antes descrita.
*   Ej: "Pasillo Frio2"
*
* $sensors_array: Array de sensores en el que se va a buscar.
*
* $sensor_id: Este es el valor único del sensor, es decir gpio
*   Ej: "22"
*/
function changeSensorValue($key_to_change, $value_to_change, $new_val, $sensors_array, $sensor_id){

  $nombre_buscado = $value_to_change;
  foreach ($sensors_array as $value) {

    $test_passed = 0;
    $value_index_to_change_val = -1;
    for($i = 0; $i <= sizeof($value); $i++ ){

      if(array_key_exists($key_to_change,$value[$i])){
        $test_passed += 1;
        $value_index_to_change_val = $i;
      }

      if(array_key_exists("gpio",$value[$i] )){
        if ($value[$i]->gpio == $sensor_id){
            $test_passed += 1;
        }

      }
    }

    if($test_passed == 2){
      if($value_index_to_change_val > -1 ){
        if($nombre_buscado == $value[$value_index_to_change_val]->$key_to_change){
            $value[$value_index_to_change_val]->$key_to_change = $new_val;
        }
      }
    }

  }


}



define('JSON_FILE', '/home/pi/DHT22-TemperatureLogger/config.json');

$obj_data = json_decode(file_get_contents(JSON_FILE));


foreach ($obj_data->sensors[0] as $key) {
  //print_r($key->name);
  changeSensorValue("name",$key->name,$_POST['name_1'],$obj_data->sensors,"22");

  changeSensorValue("temperatureLowLimit",$key->temperatureLowLimit,$_POST['temperatureLowLimit_1'],$obj_data->sensors,"22");
  changeSensorValue("temperatureHighLimit",$key->temperatureHighLimit,$_POST['temperatureHighLimit_1'],$obj_data->sensors,"22");
  changeSensorValue("temperatureThreshold",$key->temperatureThreshold,$_POST['temperatureThreshold_1'],$obj_data->sensors,"22");
  changeSensorValue("humidityLowLimit",$key->humidityLowLimit,$_POST['humidityLowLimit_1'],$obj_data->sensors,"22");
  changeSensorValue("humidityHighLimit",$key->humidityHighLimit,$_POST['humidityHighLimit_1'],$obj_data->sensors,"22");
  changeSensorValue("humidityThreshold",$key->humidityThreshold,$_POST['humidityThreshold_1'],$obj_data->sensors,"22");
}

foreach ($obj_data->sensors[1] as $key) {
  //print_r($key->name);
  changeSensorValue("name",$key->name,$_POST['name_2'],$obj_data->sensors,"23");

  changeSensorValue("temperatureLowLimit",$key->temperatureLowLimit,$_POST['temperatureLowLimit_2'],$obj_data->sensors,"23");
  changeSensorValue("temperatureHighLimit",$key->temperatureHighLimit,$_POST['temperatureHighLimit_2'],$obj_data->sensors,"23");
  changeSensorValue("temperatureThreshold",$key->temperatureThreshold,$_POST['temperatureThreshold_2'],$obj_data->sensors,"23");
  changeSensorValue("humidityLowLimit",$key->humidityLowLimit,$_POST['humidityLowLimit_2'],$obj_data->sensors,"23");
  changeSensorValue("humidityHighLimit",$key->humidityHighLimit,$_POST['humidityHighLimit_2'],$obj_data->sensors,"23");
  changeSensorValue("humidityThreshold",$key->humidityThreshold,$_POST['humidityThreshold_2'],$obj_data->sensors,"23");
}

foreach ($obj_data->mysql as $db) {
  $db->host = $_POST['host'];
  $db->user = $_POST['user'];
  $db->password = $_POST['password'];
  $db->database = $_POST['database'];

}
foreach ($obj_data->mailInfo as $mail) {
  $mail->senderaddress = $_POST['senderaddress'];
  $mail->receiveraddress = $_POST['receiveraddress'];
  $mail->username = $_POST['username'];
  $mail->password = $_POST['password_e'];
  $mail->subjectmessage = $_POST['subjectmessage'];
  $mail->subjectwarning = $_POST['subjectwarning'];


}

$obj_data->useFahrenheits = $_POST['useFahrenheits'];
$obj_data->mailSendingTimeoutInFullHours = $_POST['mailSendingTimeoutInFullHours'];


foreach ($obj_data->zonas as $zone) {
  $zone->zona = $_POST['zona'];
  $zone->ubicacion = $_POST['ubicacion'];
  

}






/*  $host = $_POST['host'];
  $user = $_POST['user'];
  $password = $_POST['password'];
  $database = $_POST['database'];
  $name_1 = $_POST['name_1'];
  $gpio_1 = $_POST['gpio_1'];
  $type_1 = $_POST['type_1'];
  $temperatureLowLimit_1 = $_POST['temperatureLowLimit_1'];
  $temperatureThreshold_1 =$_POST['temperatureThreshold_1'];
  $humidityLowLimit_1 = $_POST['humidityLowLimit_1'];
  $humidityHighLimit_1 = $_POST['humidityHighLimit_1'];
  $humidityThreshold_1 = $_POST['humidityThreshold_1'];
  $name_2 = $_POST['name_2'];
  $gpio_2 = $_POST['gpio_2'];
  $type_2 = $_POST['type_2'];
  $temperatureLowLimit_2 = $_POST['temperatureLowLimit_2'];
  $temperatureThreshold_2 =$_POST['temperatureThreshold_2'];
  $humidityLowLimit_2 = $_POST['humidityLowLimit_2'];
  $humidityHighLimit_2 = $_POST['humidityHighLimit_2'];
  $humidityThreshold_2 = $_POST['humidityThreshold_2'];
  $senderaddress = $_POST['senderaddress'];
  $receiveraddress = $_POST['receiveraddress'];
  $username = $_POST['username'];
  $password_e = $_POST['password_e'];
  $subjectmessage = $_POST['subjectmessage'];
  $subjectwarning = $_POST['subjectwarning'];
  $useFahrenheits = $_POST['useFahrenheits'];


  //echo   $host." ".$user." ".$password." ".$database." ".$name_2." ".$gpio_1;

  //echo $_POST['name_1'];


foreach($obj_data->sensors[1] as $value)
{


    $value->name = $_POST['name_1'];
    print_r($value->name);



}*/









  $int_bytes = file_put_contents(JSON_FILE, json_encode($obj_data));
//  header('Location: config.php');








 ?>
