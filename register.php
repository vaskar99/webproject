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
            <button  type="submit" name ="button_submit" id="button_submit" class="btn btn-primary">Sign Up</button>    
          
        </form>

    <!-- insert the jquery library--> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn-primary').click(function (){
                var username = $('#username').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var button_submit = $('#button_submit').val(); 

                    $.ajax(
                    {
                        url: 'server.php',
                        type: 'POST',
                        data: {
                            'username': username,
                            'email': email,
                            'password': password,
                            'button_submit': button_submit
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