<?php
session_start();

//Connect to DB with SQLi

$db = mysqli_connect('localhost','root','','web_test') or die("Could not connect to database");

//Establish an array to hold errors. If we encounter any error. Push the error to the errors array.
$errors = array();


//Register users
if (empty($_POST['username']))
{
    echo "".$_POST['username'];
    array_push($errors,"Username is required.");
}
if(empty($_POST['email']))
{
    array_push($errors,"Email is required.");
}
if(empty($_POST['password_1']))
{
    array_push($errors,"Password is required.");
}
if($_POST['password_1'] != $_POST['password_2'])
{
    array_push($errors,"Passwords do not match!");
}
$username = $_POST['username'];
$email = $_POST['email'];

//Check with DB if username and email is unique

$user_check_query = "SELECT * FROM user WHERE username = '' OR email = '$email' LIMIT 1";
$results = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($results);
if($user)
{
    if($user['username'] == $username)
    {
        array_push($errors,"Username already exist!");
    }
    if($user['email'] == $email)
    {
        array_push($errors,"Email already exist!");
    }
}

//Check if password is minimum 8 characters, one capital letter, one number and a special symbol.
    
$uppercase = preg_match('@[A-Z]@', $_POST['password_1']);
$lowercase = preg_match('@[a-z]@', $_POST['password_1']);
$number    = preg_match('@[0-9]@', $_POST['password_1']);
$specialChars = preg_match('@[^\w]@', $_POST['password_1']);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password_1']) < 8)
{
    array_push($errors,"Password must contain at least 8 characters and should include at least one upper case letter, one number, and one special character.");
}

    //Register user no error
    if(count($errors) == 0)
    {
        $password = password_hash($_POST['password_1'], PASSWORD_DEFAULT); //PHP Standard for password encryption is bcrypt.
        $query = "INSERT INTO user (username, password, email) VALUES ('$username','$password','$email')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in.";
        echo json_encode(array('success' => 1));
        header('location: index.php');
    }
    else
    {
        echo json_encode(array('success' => 0));
    }

?>