<?php
$myFile = fopen("tekst.txt", "r");
$ruum = fgets($myFile);
require("functions.php");

if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	
if(!isset($_SESSION["userId"])){
	header("Location: login.php");
	exit();
}

// retrieve and show the data :)
?>
<html>
    <head>
    <title class="title">Ruum</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="getData.css">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
</head>
<body>
    <h1>Töökeskkonna Monitoorimise Seade</h1>
    <p class="logout"><a href="?logout=1">Logi välja!</a></p>
     <div class="button-container">
        <a href="http://sisekliima.000webhostapp.com/get_data.php">
         <input class = "button" type="button" value="ANDMED" />
        </a>
        <a href="https://sisekliima.000webhostapp.com/katse.php">
        <input class = "button" type="button" value="LAE ANDMED ALLA" />
        </a>
        <a href="http://sisekliima.000webhostapp.com/linegraph_temperatuur.php">
        <input class = "button" type="button" value="TEMPERATUUR" />
        </a>
        <a href="http://sisekliima.000webhostapp.com/linegraph_valgus.php">
         <input class = "button" type="button" value="VALGUSTIHEDUS" />
        </a>
        <a href="http://sisekliima.000webhostapp.com/linegraph_ohuniiskus.php">
         <input class = "button" type="button" value="ÕHUNIISKUS" />
        </a>
        <br>
     </div>
    <form action="process-form-data.php" method="POST">
        Hoone:<select name="formHoone">
          <option value="A">ASTRA (A)</option>
          <option value="if">e-õpe if (if)</option>
          <option value="moodle">e-õpe moodle (moodle)</option>
          <option value="Li12">Haapsalu (Li12)</option>
          <option value="M">MARE (M)</option>
          <option value="muu">Muu (muu)</option>
          <option value="N">NOVA (N)</option>
          <option value="0">Rakvere 0 (0)</option>
          <option value="Rakvere I">Rakvere I (I)</option>
          <option value="Rakvere II">Rakvere II (II)</option>
          <option value="Rä49">Räägu (Rä49)</option>
          <option value="S">SILVA (S)</option>
          <option value="hki-Sa5C">Soome Sa5C (hki-Sa5C)</option>
          <option value="hki-Yr29C">Soome Yr29C (hki-Yr29C)</option>
          <option value="T">TERA (T)</option>
          <option value="U">URSA (U)</option>
        </select>
        Ruum:<input name="field1" type="text" required
        >
        <input type="submit" name="submit" value="Save Data">
    
    </form>
     <div>
        <?php
            echo "Seade viibib hetkel ruumis $ruum";
        ?>
     </div>
    

</body>
</html>