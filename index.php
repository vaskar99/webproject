<?php 
//Adding some logic to make sure that index.php is visible only to logged in users
session_start();

if(($_SESSION['username'] == 1))
{
    $_SESSION['msg'] = "You must login to access this page";
    header("location: login.php");
}

if(isset($_GET['logout']))
{
    session_destroy();
    $_SESSION['username'] == 1;
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>    
    <title>Home Page</title>
</head>
<body>

    <div class="header">
        <h2>This is the homepage</h2>
    </div>
    <div class="content">
        <?php 
        if(isset($_SESSION['success'])) : ?>
            <div class="error success">
       
                <h3>

                    <?php 
            
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
            
                    ?>

                </h3>
            </div>    
        <?php endif ?>
    


        <?php if(isset($_SESSION['username'])) : ?>
            <h3>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h3>
            <button><a href="index.php?logout=1">Logout</a></button>          
        <?php endif ?>
    </div>
</body>
</html>