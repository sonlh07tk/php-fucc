<?php	session_start();
	$_tmpLogin = "NO";
	$_tmpAdmin = "NO";
	
	if (isset($_SESSION["login_user"])) {
		$_tmpLogin = $_SESSION["login_user"];
	}
	if (isset($_SESSION["admin"]))
		$_tmpAdmin = $_SESSION["admin"];
?>