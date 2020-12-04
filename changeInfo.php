<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>

    <title>Change Settings</title>
</head>
<body>

<div class="container">

        <div class="header">

            <h2>Change Info</h2>

        </div>
        <form action="changeInfo.php" method="POST">

        <?php include('errors.php') //Include error display file. ?> 

        <div>

            <label for="username">New username : </label>
            <input type="text" name="username" required>

        </div>       

        <div>

            <label for="password">New password : </label>
            <input type="password" name="password_1" required>

        </div>

        <div>

            <label for="password">Confirm password : </label>
            <input type="password" name="password_2" required>

        </div>

        <button type="submit" name="sub_changes"> Submit changes </button>

    
</body>
</html>