<?php
$url=$_SERVER['REQUEST_URI'];

require("functions.php");
	
	//kas pole sisse loginud
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}


// retrieve and show the data :)
?>
<html>
<head>
    <title class="title">Tabel</title>
    <link rel="stylesheet" type="text/css" href="getData.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
</head>
    <body>
    <h1>Töökeskkonna Monitoorimise Seade</h1>
    <p class="logout"><a href="?logout=1">Logi välja!</a></p>
    <div class="logo-container">
        <a href="https://www.tlu.ee"><img class="logo" src="logo.svg" alt="Tallinna Ülikool"></a>
    </div>
    <div class="button-container">

            <a href="https://sisekliima.000webhostapp.com">
            <input class = "button" type="button" value="RUUMI VAHETUS" />
            </a>
            
            <a href="https://sisekliima.000webhostapp.com/katse.php">
            <input class = "button" type="button" value="LAE ANDMED ALLA" />
            </a>
            
            <br>
            
            <a href="http://sisekliima.000webhostapp.com/get_data.php">
            <input class = "button" type="button" value="ANDMED" />
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
            
    </div>
    <div class="calender">
        Leia keskmised kuupäeva järgi:
        <br>
        <form action="" method="post">
            <input type="date" name="kalender" value="<?php echo date('Y-m-d'); ?>">
            <input class="searchButton" type="submit" name="submit" value="Vali"></td>
        </form>
    </div>
    <table border="0" cellspacing="0" cellpadding="25">
      <tr class="header">
            <td id="temperatuur">Temperatuur</td>
            <td id="ohuniiskus">Ohuniiskus</td>
            <td id="valgus">Valgus</td>
            <br>
      </tr>
      
<?php
    date_default_timezone_set('Europe/Tallinn');
    $host='localhost';
    $dbusername = "id6141049_suvepraktika";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "ryhm13";  // enter database password, I used "arduinotest" in step 2.2
    $server = "id6141049_sensor";
    $paev = 01;
    $kuu = 01;
    $kalender = 2018-06-15;
    $day = 1;
    $month = 1;
    $year = 1;

    
    if(isset($_POST['submit'])) 
    {
    $new_date = date('Y-m-d', strtotime($_POST['kalender']));
    list($year, $month, $day) =explode("-",$new_date);
    echo $day . "-" . $month . "-" . $year . "\n";
    echo connection2();
    }
        
 

		function connection2(){
		$conn = new mysqli($GLOBALS["host"], $GLOBALS["dbusername"], $GLOBALS["dbpassword"], $GLOBALS["server"]);
		$sql2 = 'SELECT ROUND(AVG(temperatuur)) as temp, round(AVG(ohuniiskus)) as ohk, ROUND(AVG(valgus)) as lux FROM sensor WHERE (MONTH(time) = "'.$GLOBALS["month"].'") AND (DAY(time) = "'.$GLOBALS["day"].'") AND (YEAR(time) = "'.$GLOBALS["year"].'")';
		$result2 = $conn->query($sql2);


		if ($result2->num_rows > 0) {


			while($row = $result2->fetch_assoc()) {
			     echo "<tr>";
                 echo "<td>" . $row['temp'] . "&deg;C" ."</td>";
                 echo "<td>" . $row['ohk'] . "%" . "</td>";
                 echo "<td>" . $row['lux'] . " lux" . "</td>";
                 echo "</tr>";
			}

		} else {
			echo "0 results";
		}
			echo "</table>";
	}
?>