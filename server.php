<?php 

session_start();

//Variables initilisation

$username = "";
$email = "";


//Error handling

$errors = array();

//Connect to DB with SQLi

$db = mysqli_connect('localhost','root','','web_test') or die("Could not connect to database");

//Register users
if(isset($_POST['reg_user'])) 
{
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

//Form validation

if(empty($username))
    {
        array_push($errors, "Username is required");
    }
if(empty($email))
    {
        array_push($errors, "Email is required");
    }
if(empty($password_1))
    {
        array_push($errors, "Password is required");
    }
if($password_1 != $password_2)
    {
        array_push($errors, "Passwords need to be the same");
    }

//Check with DB if username and email is unique

    $user_check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email' LIMIT 1";

    $results = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($results);

    if($user)
    {
        if($user['username'] == $username)
        {
            array_push($errors,"Username already exists");
        }
        if($user['email'] == $email)
        {
            array_push($errors,"Email is already registered to another user");
        }
    }
//Check if password is minimum 8 characters, one capital letter, one number and a special symbol.
    
$uppercase = preg_match('@[A-Z]@', $password_1);
$lowercase = preg_match('@[a-z]@', $password_1);
$number    = preg_match('@[0-9]@', $password_1);
$specialChars = preg_match('@[^\w]@', $password_1);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password_1) < 8)
{
    array_push($errors,"Password must contain at least 8 characters and should include at least one upper case letter, one number, and one special character.");
}

//Register user no error

    if(count($errors) == 0)
    {
        $password = password_hash($password_1, PASSWORD_DEFAULT); //PHP Standard for password encryption is bcrypt.
        $query = "INSERT INTO user (username, password, email) VALUES ('$username','$password','$email')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in.";

        header('location: index.php');
    }
}

//LOGIN USERS

if(isset($_POST['login_user']))
{
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password_1']);
    
    if(empty($username))
    {
        array_push($errors,"Username is required");
    }
    if(empty($password))
    {
        array_push($errors,"Password is required");
    }
    if(count($errors) == 0)
    {
        $query = "SELECT * FROM user WHERE username='$username'";
        $results = mysqli_query($db, $query);
        if(mysqli_num_rows($results) > 0)
        {
            $query = mysqli_query($db,"SELECT password FROM user WHERE username='$username'");
            $result = mysqli_fetch_array($query);
            $hash = $result['0'];
            if(password_verify($password, $hash))  //Matching the input password with the hashed password in db.
            {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Logged in successfuly";
                header('location: index.php');
            }
            else
            {
                array_push($errors,"Wrong username or password. Please try again!");
                echo "Wrong username or password. Please try again!";
            }
        }
        else
        {
            array_push($errors,"Wrong username or password. Please try again!");
            echo "Wrong username or password. Please try again!";
        }
    } 
}







?>