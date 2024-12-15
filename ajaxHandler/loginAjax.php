<?php

require_once "C:/xampp/htdocs/SHE_HACKS/database/database.php";
require_once "C:/xampp/htdocs/SHE_HACKS/database/userDetails.php";

$action = $_REQUEST["action"];
if(!empty($action)){

    if($action=="verifyUser"){
        
        $un = $_POST["user_name"];
        $pw = $_POST["password"];

        $dbo = new Database();
        $fdo = new user_details();
        $rv = $fdo->verifyUser($dbo,$un,$pw);
        if($rv['status']=="ALL OK"){
            session_start();
            $_SESSION['current_user']=$rv['user_id'];
        }
        for($i=0; $i<100000; $i++){
            for($j=0; $j<1000; $j++){
                
            }
        }
        echo json_encode($rv);
    }
}

?>
