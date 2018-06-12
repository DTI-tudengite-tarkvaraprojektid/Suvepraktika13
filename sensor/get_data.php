<?php
$url=$_SERVER['REQUEST_URI'];
header("Refresh: 1; URL=$url");  // Refresh the webpage every 5 seconds
?>
<html>
<head>
    <title>Light Sensor</title>
</head>
    <body>
        <h1>Light sensor readings</h1>
    <table border="0" cellspacing="0" cellpadding="4">
      <tr>
            <td>ID</td>
            <td>Timestamp</td>
            <td>Value</td>
      </tr>
      
<?php
    $host='sql203.epizy.com';
    $dbusername = "epiz_22225394";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "ryhm13";  // enter database password, I used "arduinotest" in step 2.2
    $server = "epiz_22225394_suvepraktika13";

	function connection(){
		$conn = new mysqli($GLOBALS["host"], $GLOBALS["dbusername"], $GLOBALS["dbpassword"], $GLOBALS["server"]);
		$sql = "SELECT * FROM sensor";
		$result = $conn->query($sql);


		if ($result->num_rows > 0) {


			while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row['id'] . "</td><td>" . $row['time'] . "</td><td>" . $row['value'] . "</td></tr>"; 
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
