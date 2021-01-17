<?php

	session_start();
	
	if (!isset($_SESSION['admin'])) {
		header("Location: login_admin.php");
	} 

	if (isset($_GET['logout'])) {
		unset($_SESSION['admin']);
		session_unset();
		session_destroy();
		header("Location: login_admin.php");
		exit;
	}

?>