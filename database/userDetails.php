<?php

require_once "C:/xampp/htdocs/SHE_HACKS/database/database.php";
class user_details
{

    public function verifyUser($dbo,$un,$pw){
        
        $rv = ["user_id"=>-1,"status"=>"ERROR"];
        $dbo->conn->exec("USE she_hacks");
        $c = "SELECT user_id, password FROM user_details WHERE user_name = :un";
        $s = $dbo->conn->prepare($c);
        try{
            
            $s->execute([":un"=>$un]);
            if($s->rowCount()>0){
                $result = $s->fetchAll(PDO::FETCH_ASSOC)[0];
                if($result['password']==$pw){
                    $rv = ["user_id"=>$result['user_id'],"status"=>"ALL OK"];
                }
                else{
                    $rv = ["user_id"=>$result['user_id'],"status"=>"Wrong Password"];
                }
            }
            else{
                $rv = ["user_id"=>-1,"status"=>"USERNAME DOESN'T EXIST"];
            }
        }catch(PDOException $e){
        }
        return $rv;
    }
    
    public function checkUserExists($dbo, $username, $email) {
        $dbo->conn->exec("USE she_hacks;");
        $query = "SELECT * FROM user_details WHERE user_name = :username OR email = :email";
        $stmt = $dbo->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function registerUser($dbo, $username, $password, $fname, $lname, $dob, $email, $phone, $address) {
        $query = "INSERT INTO user_details (user_name, password, first_name, last_name, date_of_birth, email, phone_number, address) 
                  VALUES (:username, :password, :fname, :lname, :dob, :email, :phone, :addr)";
        $stmt = $dbo->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":fname", $fname);
        $stmt->bindParam(":lname", $lname);
        $stmt->bindParam(":dob", $dob);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":addr", $address);
        return $stmt->execute();
    }
}

?>
