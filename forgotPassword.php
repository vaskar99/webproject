<?php
	if (isset($_POST["forgotPass"])) {
		$connection = new mysqli("localhost", "root", "", "web_prod");
		
		$username = $connection->real_escape_string($_POST["username"]);
		
		$data = $connection->query("SELECT username FROM user WHERE username='$username'");

		if ($data->num_rows > 0) {
			$str = "0123456789qwertzuioplkjhgfdsayxcvbnm";
			$str = str_shuffle($str);
			$str = substr($str, 0, 10);
			$url = "http://domain.com/members/resetPassword.php?token=$str&username=$username";

			$connection->query("UPDATE user SET token='$str', expire = DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE username='$username'");

			echo "Please check your username!";
		} else {
			echo "Please fill out the username field";
		}
	}
?>
<html>
	<body>
		<form action="forgotPassword.php" method="post">
			<input type="text" name="username" placeholder="Username"><br>
			<input type="submit" name="forgotPass" value="Request Password">
		</form>
	</body>
</html>