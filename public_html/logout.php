<?php 
	session_start();
	$_SESSION["login_user"] = "NO";
	$_SESSION["admin"] = "NO";
	header("location: index.php");
?>