function validatepass()
{
    var pass=document.getElementById('password').value;
    var conpass=document.getElementById('confirm_password').value;
    if(conpass !== pass)
	{
		var td_err = document.getElementById("errPass");
        td_err.innerText = "password doesnt match";
        document.getElementById("confirm_password").focus();
        return false;
	}
    return true;
							 
}