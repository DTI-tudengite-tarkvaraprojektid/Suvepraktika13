<?php
$url=$_SERVER['REQUEST_URI'];
$myFile = fopen("tekst.txt", "r");
$ruum = fgets($myFile);

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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="getData.css">
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
            <a href="http://sisekliima.000webhostapp.com/linegraph_temperatuur.php">
            <input class = "button" type="button" value="TEMPERATUUR" />
            </a>

            <a href="http://sisekliima.000webhostapp.com/linegraph_valgus.php">
            <input class = "button" type="button" value="VALGUSTIHEDUS" />
            </a>            

            <a href="http://sisekliima.000webhostapp.com/linegraph_ohuniiskus.php">
            <input class = "button" type="button" value="ÕHUNIISKUS" />
            </a>
            
            <a href="https://sisekliima.000webhostapp.com/keskmised.php">
            <input class = "button" type="button" value="KESKMISED" />
            </a>
    </div>
    <div class="sorting">
        <label>Sorteeri kuupäeva järgi</label>
        <form action="" method="post">
            <input type="date" name="kalender" value="<?php echo date('Y-m-d'); ?>">
            <input class="searchButton" type="submit" name="submit" value="Vali"></td>
        </form>
    </div>
    <div class="sorting">
        <label>Sorteeri ruumi järgi</label>
        <form action="" method="post">
            <select name="maja">
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
                Ruum:<input name="ruum" type="text" required>
            <input type="submit" name="submit1" value="Vali"></td>
        </form>
    </div>
    <table border="0" cellspacing="0" cellpadding="25">
      <tr class="header">
            <td>ID</td>
            <td><a href="get_data.php?sort=aeg">Aeg</a></td>
            <td><a href="get_data.php?sort=ruumid">Ruum</a></td>
            <td><a href="get_data.php?sort=temp">Temperatuur</a></td>
            <td><a href="get_data.php?sort=ohk">Ohuniiskus</a></td>
            <td><a href="?orderBy=light">Valgus</a></td>
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
    $ruum = 1;
    
    if(isset($_POST['submit'])) 
    {
    $new_date = date('Y-m-d', strtotime($_POST['kalender']));
    list($year, $month, $day) =explode("-",$new_date);
    echo connection2();
    }else{
        if(isset($_POST['submit1'])){
        $ruum = $_POST['maja'].'-'.$_POST['ruum'];
        echo connection3();
        }else{
            echo connection();
             }
    }

	function connection(){
		$conn = new mysqli($GLOBALS["host"], $GLOBALS["dbusername"], $GLOBALS["dbpassword"], $GLOBALS["server"]);
		$sql = "SELECT * FROM sensor ORDER BY time DESC LIMIT 50";
		$result = $conn->query($sql);


		if ($result->num_rows > 0) {


			while($row = $result->fetch_assoc()) {
			     echo "<tr>";
                 echo "<td>" . $row['id'] . "</td>";
                 echo "<td>" . $row['time'] . "</td>";
                 echo "<td>" . $row['ruum'] . "</td>";
                 echo "<td>" . $row['temperatuur'] . "&deg;C" ."</td>";
                 echo "<td>" . $row['ohuniiskus'] . "%" . "</td>";
                 echo "<td>" . $row['valgus'] . " lux" . "</td>";
                 echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		
	}
		function connection2(){
		$conn = new mysqli($GLOBALS["host"], $GLOBALS["dbusername"], $GLOBALS["dbpassword"], $GLOBALS["server"]);
		$sql2 = 'SELECT * FROM sensor WHERE (MONTH(time) = "'.$GLOBALS["month"].'") AND (DAY(time) = "'.$GLOBALS["day"].'") AND (YEAR(time) = "'.$GLOBALS["year"].'")';
		$result2 = $conn->query($sql2);


		if ($result2->num_rows > 0) {


			while($row = $result2->fetch_assoc()) {
			     echo "<tr>";
                 echo "<td>" . $row['id'] . "</td>";
                 echo "<td>" . $row['time'] . "</td>";
                 echo "<td>" . $row['ruum'] . "</td>";
                 echo "<td>" . $row['temperatuur'] . "&deg;C" ."</td>";
                 echo "<td>" . $row['ohuniiskus'] . "%" . "</td>";
                 echo "<td>" . $row['valgus'] . " lux" . "</td>";
                 echo "</tr>";
			}

		} else {
			echo "Otsitud kuupäeva kohta andmed puuduvad";
		}
			echo "</table>";
	    }
	    
		function connection3(){
		$conn = new mysqli($GLOBALS["host"], $GLOBALS["dbusername"], $GLOBALS["dbpassword"], $GLOBALS["server"]);
		$sql3 = 'SELECT * FROM sensor WHERE ruum LIKE "'.$GLOBALS["ruum"].'%"';
		$result3 = $conn->query($sql3);


		if ($result3->num_rows > 0) {


			while($row = $result3->fetch_assoc()) {
			     echo "<tr>";
                 echo "<td>" . $row['id'] . "</td>";
                 echo "<td>" . $row['time'] . "</td>";
                 echo "<td>" . $row['ruum'] . "</td>";
                 echo "<td>" . $row['temperatuur'] . "&deg;C" ."</td>";
                 echo "<td>" . $row['ohuniiskus'] . "%" . "</td>";
                 echo "<td>" . $row['valgus'] . " lux" . "</td>";
                 echo "</tr>";
			}

		} else {
			echo "Otsitud ruumi kohta andmed puuduvad";
		}
			echo "</table>";
		
	}
?>
    </table>
    </body>
</html>	