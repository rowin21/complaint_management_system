function addDepartment() {
    var deptName = document.getElementById("deptName").value;
    var deptLoc = document.getElementById("deptLoc").value;
    if (deptName == "" && deptLoc == "") {
        document.getElementById("validDepartment").innerHTML = "*Both fields are mandatory";
    }
    else if (deptName == "") {
        document.getElementById("validDepartment").innerHTML = "* Enter department name";
    }
    else if (deptLoc == "") {
        document.getElementById("validDepartment").innerHTML = "* Enter department location";
    }
    else {
        var finalString = deptName +"|" + deptLoc;
        //alert(finalString);
        var data = { myJsonString: finalString };
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "addDepartment.php");
        xhr.onreadystatechange = function () {

            if (xhr.readyState === 4 && xhr.status === 200) {
                //console.log(xhr.responseText); 

                if (xhr.responseText === "Success") {
                    //alert("The Reviewer with registration number: "+reg_no+" has been approved and has been assigned ID: "+reviewer_id+".");
                    var head = document.createElement('h3');
                    head.innerText = "Success!!";
                    var successMsg = document.createElement('p');
                    successMsg.innerText = "Department added.";
                    var td = document.getElementById('msgDepartment');
                    document.getElementById('msgDepartment').className = "successmsg";
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
                    var td = document.getElementById('msgDepartment');
                    document.getElementById('msgDepartment').className = "errmsg";
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
