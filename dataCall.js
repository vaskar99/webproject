function checkData(name,pass)
{
    if(name || pass =='')
    {
        document.getElementById("textHint").innerHTML ="";
        return;
    }
    else
    {
        var xmlhttp = XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status ==200)
            {
                document.getElementById("textHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST","Welcome.php?inputname=vaskar",true);
        xmlhttp.send();
        xmlhttp.open("POST","Welcome.php?inputpass=1234",true);
        xmlhttp.send();
    }
}