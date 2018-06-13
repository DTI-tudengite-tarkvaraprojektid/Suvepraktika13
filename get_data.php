<?php
     date_default_timezone_set('Europe/Vilnius');
    
    // Prepare variables for database connection
    $host='localhost';
    $dbusername = "id6141049_suvepraktika";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "ryhm13";  // enter database password, I used "arduinotest" in step 2.2
    $server = "sisekliima.000webhostapp.com"; // IMPORTANT: if you are using XAMPP enter "localhost", but if you have an online website enter its address, ie."www.yourwebsite.com"
    $database = "id6141049_sensor";
   

    // Execute SQL statement
    $lux = 742387427;
    //mysql_query($sql);
    $mysqli = new mysqli($GLOBALS['host'], $GLOBALS['dbusername'], $GLOBALS['dbpassword'], $GLOBALS['database']);
		$stmt = $mysqli->prepare("INSERT INTO sensor(id, time, value) VALUES (DEFAULT, DEFAULT, ?)");
		//$result = $mysqli->query($stmt);
		$stmt->bind_param("i", $lux);
		$stmt->execute();
    echo "saadetud";
	echo $mysqli->error;
	$stmt->close();
	$mysqli->close();
?>
