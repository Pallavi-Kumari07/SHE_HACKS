$(document).ready(function () {
    $("#username").focus();
});


$(function (e) {
    $(document).on("keyup", "input", function (e) {
        $("#diverror").removeClass("applydiverror");
        $("#errormessage").text("");
        
        let inputsFilled = $("#username").val().trim() !== "" && $("#password").val().trim() !== "" &&
                           $("#fname").val().trim() !== "" && $("#lname").val().trim() !== "" &&
                           $("#dob").val().trim() !== "" && $("#email").val().trim() !== "" &&
                           $("#phone").val().trim() !== "";
        
        if (inputsFilled) {
            $("#regbutton").removeClass("inactive").addClass("active");
        } else {
            $("#regbutton").removeClass("active").addClass("inactive");
        }
    });

    $(document).on("click", "#regbutton", function (e) {
        e.preventDefault();
        tryRegister();
    });
});

function tryRegister() {
    let username = $("#username").val();
    let password = $("#password").val();
    let fname = $("#fname").val();
    let lname = $("#lname").val();
    let dob = $("#dob").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    let address = $("#address").val();

    $.ajax({
        url: "ajaxHandler/registerAjax.php",
        type: "POST",
        dataType: "json",
        data: {
            action: "registerUser",
            username: username,
            password: password,
            fname: fname,
            lname: lname,
            dob: dob,
            email: email,
            phone: phone,
            address: address
        },
        beforeSend: function () {
            $("#diverror").removeClass("applydiverror");
            $("#lockscreen").addClass("applylockscreen");
        },
        success: function (response) {
            $("#lockscreen").removeClass("applylockscreen");
            if (response.success) {
                alert("Registration successful!");
                window.location.href = "login.php";
            } else {
                $("#diverror").addClass("applydiverror");
                $("#errormessage").text(response.message);
            }
        },
        error: function () {
            $("#lockscreen").removeClass("applylockscreen");
            $("#diverror").addClass("applydiverror");
            $("#errormessage").text("An error occurred");
        }
    });
}
