<?php
$inputname = $_POST['inputname']; 
$inputpass = $_POST['inputpass'];
$db = mysqli_connect('localhost','root','','web_test') or die("could not connect to database");
$sql = "SELECT username, password FROM user";
$result=mysqli_query($db,$sql);
$test1=mysqli_fetch_array($result);
$name = $test1[0];
$pass = $test1[1];
//input1 einai to username kai input2 einai to password
if($name==$inputname && $pass==$inputpass)
{
    echo "OK";
}
else
{
    echo "MISTAKE";
}


?>