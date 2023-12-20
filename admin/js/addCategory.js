function addCategory() {
    var compName = document.getElementById("compName").value;
    var compDesc = document.getElementById("compDesc").value;
    var dept = document.getElementById("val").value;
    if (compName == "" && compDesc == "") {
        document.getElementById("validCategory").innerHTML = "*Both fields are mandatory";
    }
    else if (compName == "") {
        document.getElementById("validCategory").innerHTML = "* Enter complaint name";
    }
    else if (compDesc == "") {
        document.getElementById("validCategory").innerHTML = "* Enter complaint description";
    }
    else {
        var finalString = compName +"|" + compDesc +"|"+ dept;
    //     alert(finalString);
    // }
        var data = { myJsonString: finalString };
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "addCategory.php");
        xhr.onreadystatechange = function () {

            if (xhr.readyState === 4 && xhr.status === 200) {
                //console.log(xhr.responseText); 

                if (xhr.responseText === "Success") {
                    //alert("The Reviewer with registration number: "+reg_no+" has been approved and has been assigned ID: "+reviewer_id+".");
                    var head = document.createElement('h3');
                    head.innerText = "Success!!";
                    var successMsg = document.createElement('p');
                    successMsg.innerText = "Complaint Category added.";
                    var td = document.getElementById('msgCategory');
                    document.getElementById('msgCategory').className = "successmsg";
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
                    var td = document.getElementById('msgCategory');
                    document.getElementById('msgCategory').className = "errmsg";
                    td.appendChild(head);
                    td.appendChild(errorMsg);
                    setTimeout(function () {
                        window.location.reload();
                    }, 5000);
                }

            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/json") // or "text/plain"
    xhr.send(JSON.stringify(data));
}
