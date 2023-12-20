function openComplaint(){
    var pendingTab = document.getElementById("complaintListPending");
    var closed = document.getElementById("complaintListClosed");
    closed.style.display = "block";
    pendingTab.style.display = "none";
        
}


function openComplaintPending(){
    var pendingTab = document.getElementById("complaintListPending");
    var closed = document.getElementById("complaintListClosed");
    pendingTab.style.display = "block";
    closed.style.display = "none";
        
}