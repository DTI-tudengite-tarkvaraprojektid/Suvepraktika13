<?php

    // Prepare variables for database connection
    $host='sql203.epizy.com';
    $dbusername = "epiz_22225394";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "ryhm13";  // enter database password, I used "arduinotest" in step 2.2
    $server = "suvepraktika.epizy.com"; // IMPORTANT: if you are using XAMPP enter "localhost", but if you have an online website enter its address, ie."www.yourwebsite.com"

    // Connect to your database

    $dbconnect = mysql_connect($host, $dbusername, $dbpassword);
    $dbselect = mysql_select_db("epiz_22225394_suvepraktika13",$dbconnect);
   echo "yhendatud";
    echo mysql_error();
    // Prepare the SQL statement

    $sql = "INSERT INTO epiz_22225394_suvepraktika13.sensor (value) VALUES ('".$_GET["value"]."')";    

    // Execute SQL statement

    mysql_query($sql);
  echo "saadetud";
    echo mysql_error();
?>
