<?php 
require_once("../classes/Admin.php");
if(isset($_POST["name"])){
    $fullname =  $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    


    $password = password_hash($password,PASSWORD_DEFAULT);
        $user_one= new Admin();
        $response=$user_one->register_admin($fullname,$email,$password);

        if($response==1){
            $data = [
                 "success" => true,
                 "message" => "Account created successfully"
            ];
            $encoded_data = json_encode($data);
            return $encoded_data;
        }
        else{
            $data = [
                "success" => false,
                "message" => $response
            ];
            $encoded_data = json_encode($data);
            return $encoded_data;
        }
}














?>