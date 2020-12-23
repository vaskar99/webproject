<?php
	session_start();

	//if the person is not logged in redirect him to login page
	if (!isset($_SESSION["username"]) || !isset($_SESSION["loggedIn"])) {
			header("Location: login.php");
			exit();
	}
?>  
    
<html>
	<body>
		Welcome <?php echo $_SESSION["username"] ?>.
	
		<a href="logout.php"><b>Log out</b></a>
	</body>
</html>