function userReg(){
        var fname = document.getElementById("fname").value;
        var lname = document.getElementById("lname").value;
        var phone = document.getElementById("phone").value;
        var email = document.getElementById("email").value;
        var dist = document.getElementById("district").value;
        var pin = document.getElementById("pincode").value;
        var gender = document.getElementById("gender").value;
        var street = document.getElementById("Street").value;
        var finalString = fname + "|" + lname + "|" + email + "|" + gender + "|" + phone + "|" + street +"|"+dist+"|"+ pin;
        //alert(finalString);
        var data = { myJsonString: finalString };
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "userData.php");
        xhr.onreadystatechange = function () {

            if (xhr.readyState === 4 && xhr.status === 200) {
                //console.log(xhr.responseText); 

                if (xhr.responseText === "Success") {
                    //alert("The Reviewer with registration number: "+reg_no+" has been approved and has been assigned ID: "+reviewer_id+".");
                    var head = document.createElement('h3');
                    head.innerText = "Success!!";
                    var successMsg = document.createElement('p');
                    successMsg.innerText = "Registration Successful.";
                    var td = document.getElementById('msg');
                    document.getElementById('msg').className = "successmsg";
                    td.appendChild(head);
                    td.appendChild(successMsg);
                    setTimeout(function () {
                        window.location.reload();
                    }, 5000);
                }
                else {
                    //alert("Something went wrong.");
                    var head = document.createElement('h3');
                    head.innerText = "Something went wrong.";
                    var errorMsg = document.createElement('p');
                    errorMsg.innerText = "Error: " + xhr.responseText;
                    var td = document.getElementById('msg');
                    document.getElementById('msg').className = "errmsg";
                    td.appendChild(head);
                    td.appendChild(errorMsg);
                }

            }
        }
    xhr.setRequestHeader("Content-type", "application/json") // or "text/plain"
    xhr.send(JSON.stringify(data));
}