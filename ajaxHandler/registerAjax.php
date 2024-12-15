<?php

require_once "C:/xampp/htdocs/SHE_HACKS/database/database.php";
require_once "C:/xampp/htdocs/SHE_HACKS/database/userDetails.php";

header('Content-Type: application/json');

$action = $_REQUEST["action"] ?? "";
if (!empty($action) && $action === "registerUser") {
    $un = $_POST["username"] ?? "";
    $pw = $_POST["password"] ?? "";
    $fname = $_POST["fname"] ?? "";
    $lname = $_POST["lname"] ?? "";
    $dob = $_POST["dob"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone"] ?? "";
    $address = $_POST["address"] ?? "";
    error_log("Address value: " . $address);


    

    $dbo = new Database();
    $pdo = new user_details();

    try {
        $exists = $pdo->checkUserExists($dbo, $un, $email);
        for($i=0; $i<100000; $i++){
            for($j=0; $j<1000; $j++){}};
        if ($exists) {
            echo json_encode(["success" => false, "message" => "User already registered."]);
        } else {
            $register = $pdo->registerUser($dbo, $un, $pw, $fname, $lname, $dob, $email, $phone, $address);
            if ($register) {
                echo json_encode(["success" => true, "message" => "Registration successful!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Registration failed."]);
            }
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
}


?>
