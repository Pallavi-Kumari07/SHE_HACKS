$(function(e){
    $(document).on("click","#btnlogout",function(ee){
        $.ajax({
            url:"ajaxHandler/logoutAjax.php",
            type:"POST",
            dataType:"json",
            data:{id:1},
            beforeSend:function(e){
    
            },
            success:function(e){
                document.location.replace("main.php");
            },
            error:function(e){
                alert("Something went WRONG...");
            }
        });
    });
    
});
