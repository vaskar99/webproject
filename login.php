
<html>
<body>            
	<form name="login" method="post"> 

	    <div>		 	                    			
    	<input type="text" name="username" placeholder="Username"/><br />		
		</div>	
		<div>													
		<input type="password" name="password" placeholder="Password"/> <br />	
		</div>	
		<div>						                         
        <button  type="submit" name="login" id="login">Login</button>
		</div>					
		
	</form>    

<!-- insert the jquery library -->  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

//when we press the Login button
    $(document).ready(function () 
{
    $("#login").on('click',function () 
    {
            let username = $("#username").val();
            let password = $("#password").val(); 
			$.ajax(
                {
                    url: 'server.php',
                    type: 'POST',
                    data: 
                    {
                        login:1,
                        'username': username,
						'password': password
                    },
                    success: function(response) 
                    {
                        console.log(typeof response)
                        data=JSON.parse(response)
                        console.log(typeof data)
                        if(data.response==true)
                        {
                            alert("Success!Logged in.")
                            window.location.href = "index.php"
                            console.log("Komple");
                        }
                        else
                        {
                            alert("Unsuccessful login.")
                            console.log("Rip")
                        }
                    },    
                }
            );          
    });
});
</script>
    
	<p id = "response"></p>
	<p>Want to sign up?<a href="register.php"><b>Sign Up</b></a></p>
</body>
</html>