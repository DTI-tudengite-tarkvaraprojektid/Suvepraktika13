<?php
require ("../vpconfig.php");

$DB_DATABASE = "id6141049_sensor";

session_start();
    
//sisselogimise funktsioon
	function signIn($loginUser, $password){
		$notice = "";
		//andmebaasi ühendus
		$mysqli = new mysqli($GLOBALS["DB_SERVER"], $GLOBALS["DB_USERNAME"], $GLOBALS["DB_PASSWORD"], $GLOBALS["DB_DATABASE"]);
		$stmt = $mysqli->prepare("SELECT id, password, kasutaja FROM login WHERE kasutaja = ?");
		$stmt->bind_param("s", $loginUser);
		$stmt->bind_result($id, $passwordFromDb, $userFromDb);
		$stmt->execute();
		
		//kontrollin vastavust
		if($stmt->fetch()){
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb){
				$notice = "Kõik õige! Logisite sisse!";
				
				//määrame sessioonimuutujad
				$_SESSION["userId"] = $id;
				$_SESSION["user"] = $userFromDb;
				
				//liigume pealehele
				header("Location: get_data.php");
				exit();
			} else {
				$notice = "Vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$loginUser .") ei leitud!";
		}
		$stmt->close();
		$mysqli->close();
		return $notice;
    }
?>