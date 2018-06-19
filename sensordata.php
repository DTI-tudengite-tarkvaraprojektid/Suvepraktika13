<?php

//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', "localhost");
define('DB_USERNAME', "id6141049_suvepraktika");
define('DB_PASSWORD', "ryhm13");
define('DB_NAME', "id6141049_sensor");
define('DB_SERVER', "sisekliima.000webhostapp.com");


//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);


if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT id, time, ruum, temperatuur, ohuniiskus, valgus FROM sensor");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}
//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
?>