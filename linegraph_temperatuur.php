<?php
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
?>
<!DOCTYPE html>
<html>
  <head>
       <meta http-equiv="refresh" content="60">
       <link rel="stylesheet" type="text/css" href="style.css"> 
       <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <title>TEMPERATUUR</title>
    <style>
      .chart-container {
        width: auto;
        height: auto;
      }
    </style>
  </head>
  <body>
    <h1>Töökeskkonna Monitoorimise Seade</h1>
    <a href="https://www.tlu.ee"><img class="graphLogo" src="logo.svg" alt="Tallinna Ülikool"></a><br>
    <p class="logout"><a href="?logout=1">Logi välja!</a></p>
    <div class="button-container">

            <a href="https://sisekliima.000webhostapp.com">
            <input class = "button" type="button" value="RUUMI VAHETUS" />
            </a>
            
            <a href="http://sisekliima.000webhostapp.com/get_data.php">
            <input class = "button" type="button" value="ANDMED" />
            </a>
            
            <a href="https://sisekliima.000webhostapp.com/katse.php">
            <input class = "button" type="button" value="LAE ANDMED ALLA" />
            </a>

            <a href="http://sisekliima.000webhostapp.com/linegraph_valgus.php">
            <input class = "button" type="button" value="VALGUSTIHEDUS" />
            </a>            

            <a href="http://sisekliima.000webhostapp.com/linegraph_ohuniiskus.php">
            <input class = "button" type="button" value="ÕHUNIISKUS" />
            </a>

    </div>
    <div class="chart-container">
      <canvas id="mycanvas"></canvas>
    </div>
    
    <!-- javascript -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript" src="/js/linegraph_temperatuur.js"></script>
    <script src="https://rawgit.com/chartjs/chartjs-plugin-annotation/master/chartjs-plugin-annotation.js"></script>  
  </body>
</html>