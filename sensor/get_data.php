
<?php
$url=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url");  // Refresh the webpage every 5 seconds
?>
<html>
<head>
    <title>Light Sensor</title>
</head>
    <body>
        <h1>Light sensor readings</h1>
    <table border="0" cellspacing="0" cellpadding="25">
      <tr>
            <td>ID</td>
            <td>Timestamp</td>
            <td>Ruum</td>
            <td>Temperatuur</td>
            <td>Ohuniiskus</td>
            <td>Valgus</td>
      </tr>
      
<?php
    date_default_timezone_set('Europe/Tallinn');
    $host='localhost';
    $dbusername = "id6141049_suvepraktika";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "ryhm13";  // enter database password, I used "arduinotest" in step 2.2
    $server = "id6141049_sensor";

	function connection(){
		$conn = new mysqli($GLOBALS["host"], $GLOBALS["dbusername"], $GLOBALS["dbpassword"], $GLOBALS["server"]);
		$sql = "SELECT * FROM sensor";
		$result = $conn->query($sql);


		if ($result->num_rows > 0) {


			while($row = $result->fetch_assoc()) {
			     echo "<tr>";
                 echo "<td>" . $row['id'] . "</td>";
                 echo "<td>" . $row['time'] . "</td>";
                 echo "<td>" ."&#8470; ". $row['ruum'] . "</td>";
                 echo "<td>" . $row['temperatuur'] . "&deg;C" ."</td>";
                 echo "<td>" . $row['ohuniiskus'] . "%" . "</td>";
                 echo "<td>" . $row['valgus'] . "lux" . "</td>";
                 echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		
	}
echo connection();
?>
    </table>
    </body>
</html>	
