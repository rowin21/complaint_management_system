function assignWork(comp) {
    var compID = comp;
    var officer = document.getElementById("off").value;
        var finalString = compID +"|" + officer;
        //alert(finalString);
        var data = { myJsonString: finalString };
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "assign.php");
        xhr.onreadystatechange = function () {

            if (xhr.readyState === 4 && xhr.status === 200) {
                //console.log(xhr.responseText); 

                if (xhr.responseText === "Success") {
                    //alert("The Reviewer with registration number: "+reg_no+" has been approved and has been assigned ID: "+reviewer_id+".");
                    var head = document.createElement('h3');
                    head.innerText = "Success!!";
                    var successMsg = document.createElement('p');
                    successMsg.innerText = "Work assigned sucessfully.";
                    var td = document.getElementById('msgAssign');
                    document.getElementById('msgAssign').className = "successmsg";
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
                    var td = document.getElementById('msgAssign');
                    document.getElementById('msgAssign').className = "errmsg";
                    td.appendChild(head);
                    td.appendChild(errorMsg);
                    setTimeout(function () {
                        window.location.reload();
                    }, 5000);
                }

            }
        }
    xhr.setRequestHeader("Content-type", "application/json") // or "text/plain"
    xhr.send(JSON.stringify(data));
}
