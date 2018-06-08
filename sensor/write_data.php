<?php

    // Prepare variables for database connection
   
    $dbusername = "if17";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "if17";  // enter database password, I used "arduinotest" in step 2.2
    $server = "localhost"; // IMPORTANT: if you are using XAMPP enter "localhost", but if you have an online website enter its address, ie."www.yourwebsite.com"

    // Connect to your database

    $dbconnect = mysql_pconnect($server, $dbusername, $dbpassword);
    $dbselect = mysql_select_db("if17_ryhm13",$dbconnect);

    // Prepare the SQL statement

    $sql = "INSERT INTO if17_ryhm13.sensor (value) VALUES ('".$_GET["value"]."')";    

    // Execute SQL statement

    mysql_query($sql);

?>