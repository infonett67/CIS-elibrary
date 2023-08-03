<?php 
session_start();

if(isset($_POST['uname']) && 
   isset($_POST['pass']) &&
   isset($_POST['cis'])){

    include "../db_conn.php";

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $cis = $_POST['cis'];

    $data = "uname=".$uname;
    
    if(empty($uname)){
    	$em = "User name is required";
    	header("Location: ../login_page.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../login_page.php?error=$em&$data");
	    exit;
    }
    else if(empty($cis)){
        $em = "CIS NO is required";
    	header("Location: ../login_page.php?error=$em&$data");
	    exit;
    }else {

    	$sql = "SELECT * FROM user_table WHERE user_email = ?";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$uname]);

      if($stmt->rowCount() == 1){
          $user = $stmt->fetch();

          $username =  $user['user_name'];
          $password =  $user['user_password'];
          $email = $user['user_email'];
          $id =  $user['user_id'];
          $pp =  $user['user_profile_pic'];
            $cis = $user['cis_no'];
          if($email === $uname){
             if(password_verify($pass, $password)){
                 $_SESSION['user_id'] = $id;
                 $_SESSION['username'] = $username;
                 $_SESSION['pp'] = $pp;
                $_SESSION['cisno'] = $cis;
                $_SESSION['useremail'] = $email;
                $_SESSION["is_logged_in"] = true;
        // return "SUCCESS";  
                 header("Location: ../category.php");
                 exit;
             }else {
               $em = "Incorect User name, CIS No or password";
               header("Location: ../login_page.php?error=$em&$data");
               exit;
            }

          }else {
            $em = "Incorect User name, CIS No or password";
            header("Location: ../login_page.php?error=$em&$data");
            exit;
         }

      }else {
         $em = "Incorect User name, CIS No or password";
         header("Location: ../login_page.php?error=$em&$data");
         exit;
      }
    }


}else {
	header("Location: ../login_page.php?error=error");
	exit;
}
