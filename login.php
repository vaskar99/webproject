<?php
	session_start();

	if (isset($_SESSION["username"]) && isset($_SESSION["loggedIn"])) {
		//if we are still at the same session and username is set, direct immediately to index
		header("Location: index.php");
		exit();
	}

	if (isset($_POST["logIn"])) {
		$connection = new mysqli("localhost", "root", "", "web_prod");
		
		$username = $connection->real_escape_string($_POST["username"]);
		$password = sha1($connection->real_escape_string($_POST["password"]));
		$data = $connection->query("SELECT username FROM user WHERE username='$username' AND password='$password'");

		//if the username inserted exists in our database set it as the session username and direct to index page
		if ($data->num_rows > 0) {
			$_SESSION["username"] = $username;
			$_SESSION["loggedIn"] = 1;
			
			header("Location: index.php");
			exit('Logic was successful');

		} 
		else {			
			echo "Username or password were incorrect. Try again.";
		}
	}	
?>      
<html>
<body>            
	<form action="login.php" method="post"> 	
	    <div>		 	                    			
    	<input type="text" name="username" placeholder="Username"/><br />		
		</div>	
		<div>													
		<input type="password" name="password" placeholder="Password"/> <br />	
		</div>	
		<div>						                         
		<input type="submit" value="Log In" name= "logIn" > 
		</div>					
    </form>    

    <!-- insert the jquery library--> 
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>   
     <script type="text/javascript">
        $(document).ready(function () {
            $("login").on('click', function (){
                var username = $("username").val();
                var password = $("password").val(); 

                if(username == "" || password == "")
                    alert('You must complete all login fields');
                else {
                    $.ajax(
                    {
                        url: 'login.php',
                        method: 'POST',
                        data: {
                            login:1,
                            usernamePHP: username,
                            passwordPHP: password
                    },
                    success: function(response) {
                        $("#response").html(response);
                        //if the login fields are correct, then redirect 
						if (response.indexOf('success') >=0 )
							window.location='index.php';
                    },
                    dataType:'text'
                }
            );

                }
                
        });
    });
    </script>

	<p>Forgot your password?<a href="forgotPassword.php"><b>Reset password</b></a></p>
	<p>Want to sign up?<a href="register.php"><b>Sign Up</b></a></p>
</body>
</html>