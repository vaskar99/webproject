<?php
	session_start();

	if (!isset($_SESSION["username"]) || !isset($_SESSION["loggedIn"])) {
			header("Location: login.php");
			exit();
	}
?>      