<?php                     
   //make sure none of the fields are empty 
    while(!empty($_POST['username']) || !empty($_POST['email']) || !empty($_POST['password'])){   
        $connection = new mysqli("localhost", "root", "", "web_prod");
		
		$username = $connection->real_escape_string($_POST['username']);  				
		$email = $connection->real_escape_string($_POST['email']);  
		$password = sha1($connection->real_escape_string($_POST['password'])); 
        
        if(empty($_POST['username']))
        {
            echo("Username is required.");
            break;
        }

        if(empty($_POST['email']))
        {
            echo("Email is required.");
            break;
        }

        if(empty($_POST['password']))
        {
            echo("Password is required.");
            break;
        }
        
        //check if username is taken or if user is already signed up under that email
        $user2 = $connection->query("SELECT email FROM user WHERE email = '$email'");
        $user = $connection->query("SELECT username FROM user WHERE username = '$username'");
        $uppercase = preg_match('@[A-Z]@', $_POST['password']);
        $lowercase = preg_match('@[a-z]@', $_POST['password']);                
        $number    = preg_match('@[0-9]@', $_POST['password']);
        $specialChars = preg_match('@[^\w]@', $_POST['password']);
       
            if(($user2->num_rows > 0))
                 {
                        echo("You have already signed up under this email!");
                 }


            else if(($user->num_rows > 0))
                {
                         echo("Username already exists, please choose another one.");
                }

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password']) < 8)
        {
            echo("Password must contain at least 8 characters and should include at least one upper case letter, one number, and one special character.");
            break;
        }

    else 
         {  echo "Your have been signed up - please log in now ";
           $data = $connection->query("INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')");
           break;
         }
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
            <button  type="submit" id="button_submit" class="btn btn-primary">Sign Up</button>    
          
        </form>

    <!-- insert the jquery library--> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn-primary').click(function (){
                var username = $('#username').val();
                var email = $('#email').val();
                var password = $('#password').val(); 

                    $.ajax(
                    {
                        url: 'register.php',
                        type: 'POST',
                        data: {
                            'username': username,
                            'email': email,
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

     <p><a href="login.php"><b>Log In</b></a></p>
    </body>
</html>