<?php 
require_once("../classes/Users.php");


if(isset($_POST["username"])){
    // $file = $_FILES["profile"];
    // if($_FILES["profile"]["error"] !=0){
    // echo "Error Inputing File";
    // exit();
    // }
    // $extension =  explode(".",$file["name"])[1];
    // $allowed = ["png","jpg","jpeg"];
    // if(!in_array($extension,$allowed))
    // {
    //     echo "Invalid type, please upload a better file file.<br>";
    //     exit();
    // }
    // $filename =  "profile_pictures".time().".".$extension;
    // $destination = "profile_pictures/".$filename;
    // if(move_uploaded_file($file["tmp_name"],$destination)){
    //     echo "$filename File uploaded successfully";
        
    // }
    $fullname =  $_POST["username"];
    $password = $_POST["pwd"];
    $password2 = $_POST["pwd2"];
    $email = $_POST["emailreg"];
    // $pic = $_POST["profile"];
    $cis = $_POST["cis"];

    if ($password != $password2){
        echo "<h1 class='alert alert-danger>' Passwords much match</h1>";
    }
    $newpassword = password_hash($password,PASSWORD_DEFAULT);
        $user_one= new Users();
        $response=$user_one->register_user($fullname,$email,$newpassword,$cis);
        // $pic = $user_one->register_pic()
        if($response==1){
            $data = [
                "success" => true,
                "message" => "Account created successfully"
            ];
            $encoded_data = json_encode($data);
            echo $encoded_data;
        }
        else{
            $data = [
                "success" => false,
                "message" => $response
            ];
            $encoded_data = json_encode($data);
            echo $encoded_data;
        }
}














?>