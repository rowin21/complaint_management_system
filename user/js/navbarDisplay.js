var li_elements = document.querySelectorAll(".navigation ul li");
var item_elements = document.querySelectorAll(".tab");
for (var i = 0; i < li_elements.length; i++) {
    li_elements[i].addEventListener("click", function () {
        li_elements.forEach(function (li) {
            li.classList.remove("active");
        });
        this.classList.add("active");
        var li_value = this.getAttribute("data-li");
        item_elements.forEach(function (item) {
            item.style.display = "none";
        });
        document.querySelector(".dash").style.display = "none";
        if (li_value == "Account") {
            document.querySelector("." + li_value).style.display = "block";
        } else if (li_value == "RegisterComplaint") {
            document.querySelector("." + li_value).style.display = "block";
        } else if (li_value == "Track") {
            document.querySelector("." + li_value).style.display = "block";
        } else if (li_value == "View") {
            document.querySelector("." + li_value).style.display = "block";
        } else if (li_value == "Report") {
            document.querySelector("." + li_value).style.display = "block";
        } else if (li_value == "ChangePassword") {
            document.querySelector("." + li_value).style.display = "block";
        } else {
            document.querySelector(".dash").style.display = "block";
        }
    });
}