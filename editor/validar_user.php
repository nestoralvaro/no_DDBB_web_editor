<?php
session_start();
function validar_user() {
	$resultado = 99;
	$storedUser = "STORED_USER";
	$storedPass = "STORED_PASS";
	if (trim($_POST["user_login"]) != "" && trim($_POST["password_login"]) != "") {
		$nick = trim($_POST["user_login"]);
		$pass = trim($_POST["password_login"]);
		if ($nick == $storedUser && $pass == $storedPass) {
			$_SESSION["nick"] = $nick;
			$_SESSION["pass"] = $pass;
			$resultado = 1;
		} else {
			return 2;
		}
	} else if(($_SESSION["nick"] == $storedUser) && ($_SESSION["pass"] == $storedPass)) {
		$resultado = 0;
	} else { 
		$resultado = 3;
	}
//    return 1;
	return $resultado;
}
?>

