<?php
session_start();
if(isset($_POST['register']) == 1)
{                    
   //make sure none of the fields are empty 
    while(!empty($_POST['username']) || !empty($_POST['email']) || !empty($_POST['password']))
    {   
        $connection = new mysqli("localhost", "root", "", "web_test");
		
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
        {  
            echo "Your have been signed up - please log in now ";
            $data = $connection->query("INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')");
            break;
        }
    }	               
}

if(isset($_POST['login'])==1)
{
    if (isset($_SESSION['username']) && isset($_SESSION['loggedIn'])) 
    {
        //if we are still at the same session and username is set, direct immediately to index
        header("Location: index.php");
        exit();
    }

    if(!empty($_POST['username']))
    {
        $connection = new mysqli("localhost", "root", "", "web_test");
        
        $username = $connection->real_escape_string($_POST['username']);
        $password = sha1($connection->real_escape_string($_POST['password']));
        $data = $connection->query("SELECT username FROM user WHERE username='$username' AND password='$password'");

        //if the username inserted exists in our database set it as the session username and direct to index page
        if ($data->num_rows > 0) 
        {
            $_SESSION['username'] = $username;
            $_SESSION['loggedIn'] = 1;
            
            header("Location: index.php");
        } 
        else 
        {			
            echo "Username or password were incorrect. Try again.";
        }
    }
}	
?>  