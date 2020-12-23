<?php
	session_start();

	if (isset($_SESSION['username']) && isset($_SESSION['loggedIn'])) {
		//if we are still at the same session and username is set, direct immediately to index
		header("Location: index.php");
		exit();
	    }

	if(!empty($_POST['username'])){
		$connection = new mysqli("localhost", "root", "", "web_prod");
		
		$username = $connection->real_escape_string($_POST['username']);
		$password = sha1($connection->real_escape_string($_POST['password']));
		$data = $connection->query("SELECT username FROM user WHERE username='$username' AND password='$password'");

		//if the username inserted exists in our database set it as the session username and direct to index page
		if ($data->num_rows > 0) {
			$_SESSION['username'] = $username;
			$_SESSION['loggedIn'] = 1;
			
			header("Location: index.php");
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
        <button  type="submit" id="button_submit" class="btn btn-primary">Login</button>
		</div>					
		
	</form>    

<!-- insert the jquery library -->  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script type="text/javascript">

//when we press the Login button
    $(document).ready(function () {
    $('.btn-primary').click(function () {
            var username = $('#username').val();
            var password = $('#password').val(); 

            $.ajax(
                {
                    url: 'login.php',
                    type: 'POST',
                    data: {
                        'username': username,
                        'password': password
                    },

                    success: function(response) {
                    $("#response").html(response);
                    //if the login fields are correct, then redirect 
                    if (response.indexOf('success') >=0 )
                        window.location='index.php';
                },
                dataType:'json'
            }
            );          
    });
});
</script>
    
	<p id = "response"></p>
	<p>Want to sign up?<a href="register.php"><b>Sign Up</b></a></p>
</body>
</html>