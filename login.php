<?php include('server.php') ?>
<!DOCTYPE HTML>  
<html>
<head>
    <title>Log in</title>
</head>
<body>

    <div class="container">

        <div class="header">

            <h2>Log in</h2>

        </div>
        <form action="login.php" method="POST">

        <?php include('errors.php') //Include error display file. ?>

            <div>

                <label for="username">Username : </label>
                <input type="text" name="username" required>

            </div>         

            <div>

                <label for="password">Password : </label>
                <input type="password" name="password_1" required>

            </div>

            <button type="submit" name="login_user"> Log in </button>

            <p>Not a user?<a href="registration.php"><b>Sign up</b></a></p>

        </form>

    </div>

</body>
</html>