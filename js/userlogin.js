function tryLogin(){
    let un = $("#username").val();
    let pw = $("#password").val();
    if(un.trim()!=="" && pw.trim()!==""){
        $.ajax({
            url:"ajaxHandler/loginAjax.php",
            type:"POST",
            dataType:"json",
            data:{user_name:un,password:pw,action:"verifyUser"},
            beforeSend:function(){
                $("#diverror").removeClass("applydiverror");
                $("#lockscreen").addClass("applylockscreen");
            },
            success:function(rv){
                $("#lockscreen").removeClass("applylockscreen");
                if(rv['status']=="ALL OK"){
                    document.location.replace("user.php");
                }
                else{
                    $("#diverror").addClass("applydiverror");
                    $("#errormessage").text(rv['status']);
                }
            },
            error:function(){
                alert("Oops! An error has occurred...")
            },
        })
    }
}

$(function(e){
    $(document).on("keyup","input",function(e){
        $("#diverror").removeClass("applydiverror");
        $("#errormessage").text("");
        let un = $("#username").val();
        let pw = $("#password").val();
        if(un.trim()!=="" && pw.trim()!==""){
            $(".logbutton").removeClass("inactive");
            $(".logbutton").addClass("active");
        }
        else{
            $(".logbutton").removeClass("active");
            $(".logbutton").addClass("inactive");
        }
    });
    $(document).on("click",".logbutton",function(e){
        tryLogin();
    });
})