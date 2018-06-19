<?php
    date_default_timezone_set('Europe/Tallinn');
    // Prepare variables for database connection
    $host='localhost';
    $dbusername = "id6141049_suvepraktika";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "ryhm13";  // enter database password, I used "arduinotest" in step 2.2
    $server = "sisekliima.000webhostapp.com"; // IMPORTANT: if you are using XAMPP enter "localhost", but if you have an online website enter its address, ie."www.yourwebsite.com"
    $database = "id6141049_sensor";
    $date = new DateTime();
    $date = $date->format('Y-m-d H:i:s') . "\n";
    echo $date;
   

    // Execute SQL statement
    $ruum = 457;
    $temperatuur = $_REQUEST["temperatuur"];
    $ohuniiskus = $_REQUEST["ohuniiskus"];
    $valgus = $_REQUEST["valgus"];

    
    //mysql_query($sql);
    $mysqli = new mysqli($GLOBALS['host'], $GLOBALS['dbusername'], $GLOBALS['dbpassword'], $GLOBALS['database']);
		$stmt = $mysqli->prepare("INSERT INTO sensor(id, time, ruum, temperatuur, ohuniiskus, valgus) VALUES (DEFAULT, ?, ?, ?, ?, ?)");
		//$result = $mysqli->query($stmt);
		$stmt->bind_param("siddi", $date, $ruum, $temperatuur, $ohuniiskus, $valgus);
		$stmt->execute();
    echo "saadetud";
	echo $mysqli->error;
	$stmt->close();
	$mysqli->close();
?>	
