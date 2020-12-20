<?php
	if (isset($_GET["token"]) && isset($_GET["username"])) {
		$connection = new mysqli("localhost", "root", "", "web_prod");
		
		$username = $connection->real_escape_string($_GET["username"]);
		$token = $connection->real_escape_string($_GET["token"]);

		$data = $connection->query("SELECT username FROM user WHERE username='$username' AND token='$token' AND token <> '' AND expire > NOW()");

		if ($data->num_rows > 0) {
			$str = "0123456789qwertzuioplkjhgfdsayxcvbnm";
			$str = str_shuffle($str);
			$str = substr($str, 0, 15);

			$password = sha1($str);

			$connection->query("UPDATE user SET password = '$password', token = '' WHERE username='$username'");

			echo "Your new password is: $str";
		} else {
			echo "Please check your link!";
		}
	} else {
		header("Location: login.php");
		exit();
	}
?>