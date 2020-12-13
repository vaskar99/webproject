<!--  -->
<!DOCTYPE HTML>  
<html>
<head>
    <title>Registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
          $(document).ready(function(){
              $("form").submit(function(event){
                  event.preventDefault();
                  var username = $("#username").val();
                  var email = $("#email").val();
                  var password_1 = $("#password_1").val();
                  var password_2 = $("#password_2").val();

                  $(".form-message").load("registration.php", {
                      username : username,
                      email : email,
                      password_1 : password_1,
                      password_2 : password_2
                      
                  });
              });
          });
      </script>
</head>
<body>

    <div class="container">

        <div class="header">

            <h2>Register</h2>

        </div>
        <form method="POST" action="registration.php">  

            <div>

                <label for="username">Username : </label>
                <input type="text" name="username" id="username" required>

            </div>

            <div>

                <label for="email">E-mail : </label>
                <input type="text" name="email" id="email" required>

            </div>            

            <div>

                <label for="password">Password : </label>
                <input type="password" name="password_1" id="password_1" required>

            </div>

            <div>

                <label for="password">Repeat Password : </label>
                <input type="password" name="password_2" id="password_2" required>

            </div>

            <button type="submit"name="reg_user"> Submit </button>

            <p>Already a user?<a href="login.php"><b>Log in</b></a></p>

        </form>
        
    </div>

</body>
</html>