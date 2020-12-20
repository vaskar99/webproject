<?php                     
    if (isset($_POST["register"])) {
        $connection = new mysqli("localhost", "root", "", "web_prod");
		
		$username = $connection->real_escape_string($_POST["username"]);  				
		$email = $connection->real_escape_string($_POST["email"]);  
		$password = sha1($connection->real_escape_string($_POST["password"])); 
			
		$data = $connection->query("INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')");

    	if ($data === false)
            echo "Connection error!";
    	else
           echo "Your have been signed up - please log in now ";
	}	                 
?>
<html>
    <body>
        <form method="post" action="register.php">      
            <div>
            <input type="text" name="username" placeholder="Username"  />         
            </div>
            <div>
            <input type="email" name="email" placeholder="Email"  />
            </div>
            <div>
            <input type="password" name="password" placeholder="Password"  />
            </div>
            <input type="submit" name="register" value="Register" />    
          
        </form>
     <p><a href="login.php"><b>Log In</b></a></p>
    </body>
</html>