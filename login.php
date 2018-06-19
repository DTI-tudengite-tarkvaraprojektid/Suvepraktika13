<?php
	require("../vpconfig.php");
	require("functions.php");
	
	//kui on sisselogitud, siis otse pealehele
	if(isset($_SESSION["userId"])){
		header("Location: get_data.php");
        exit();
	}
	
	$loginUserError ="";
	$loginUser = "";
	$notice = "";
            
    if(isset($_POST["signinButton"])){
	//kas on kasutajanimi sisestatud
	    if (isset ($_POST["loginUser"])){
		    if (empty ($_POST["loginUser"])){
			    $loginUserError ="NB! Sisselogimiseks on vajalik kasutajatunnus!";
		    } else {
			    $loginUser= $_POST["loginUser"];
		    }
	    }
	
	if(!empty($loginUser) and !empty($_POST["loginPassword"])){
		//echo "Hakkan sisse logima!";
		$notice = signIn($loginUser, $_POST["loginPassword"]);
	}
	
	}
?>    

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
	<title>Sisselogimine</title>
</head>
<body>
    <div class="loginBody">
        <img alt="Tallinna Ülikool" src="logo.svg">
        <h1>Sisselogimine</h1>
    
    	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    		<input name="loginUser" placeholder="Username" type="user" value="<?php echo $loginUser; ?>"><br>
    		<span><?php echo $loginUserError; ?></span>
    		<br>
    		<input name="loginPassword" placeholder="Password" type="password"><span></span>
    		<br>
    		<input class ="button" name="signinButton" type="submit" value="Logi sisse"><span><?php echo $notice; ?></span>
    	</form>
    </div>
</body>
</html>
