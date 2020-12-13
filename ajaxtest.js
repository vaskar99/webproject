function _(el) {
    return document.getElementById(el);
}

function ajax_data(php_file, el, send_data) {
    _(el).innerHTML = "Please wait..";
    var hr = new XMLHttpRequest();
    hr.open('POST', php_file, true);
    hr.setRequestHelper("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState === 4 && hr.status === 200) {
            _(el).innerHTML = hr.responseText;
        }
    };
    hr.send(send_data);
}

function signup() {
    var formdata = new FormData();
    var ajax = new XMLHttpRequest();
    
    var username = _("username").value;
    var email = _("email").value;
    var password = _("password_1").value;
    var profile = _("password_2").value;
    
  
    formdata.append("username", username);
    formdata.append("email", email);
    formdata.append("password_2", password_1);
    formdata.append("password_2", password_2);
    
    ajax.open("POST", "ajax_process.php");
    ajax.send(formdata);
  ajax.onreadystatechange = function () {
            _("signup_response").innerHTML = ajax.responseText;
    };
   
}