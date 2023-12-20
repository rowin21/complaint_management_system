function openForm() {
    var list = document.getElementById("officerList");
    list.style.display = "none";
    var b = document.getElementById("backButton");
    b.style.display = "block";
    var tab = document.getElementById("officerForm");
    tab.style.display = "block";
}

// var b = document.getElementById("backButton");
// b.addEventListener("click", function () {
//     var tab = document.getElementById("officerForm");
//     tab.style.display = "none";
//     b.style.display = "none";
// });


// backBtn.addEventListener("click",function(){
//     var tab = document.getElementById("officerForm");
//      tab.style.display = "none";
// });
function closeForm(){
    var list = document.getElementById("officerList");
    list.style.display = "block";
    var b = document.getElementById("backButton");
    b.style.display = "none";
    var tab = document.getElementById("officerForm");
    tab.style.display = "none";
}