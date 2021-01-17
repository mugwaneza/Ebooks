<?php

	session_start();
	
	if (!isset($_SESSION['user'])) {
		header("Location: signinuser.php");
	} 

	if (isset($_GET['logout'])) {
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		header("Location: signinuser.php");
		exit;
	}

?>