$(document).ready(function() 
{
    //Process the form
    $('registration').submit(function(event)
    {
        const form =
        {
            username : document.getElementById('username'),
            email : document.getElementById('email'),
            password_1 : document.getElementById('password_1'),
            password_2 : document.getElementById('password_2')
        };
        console.log(form);
        event.preventDefault();
        //Process the form
        $.ajax
        ({
            type        : 'POST',
            url         : 'ajax_process.php', // the url where we want to POST
            data        : $(this).serialize(), 
            success: function(response)
            {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1")
                {
                    location.href = 'index.php';
                }
                else
                {
                    alert('Error!');
                }
            }
        });         
    });
});


