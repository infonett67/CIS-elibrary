<?php 
session_start();

if(isset($_POST['uname']) && 
   isset($_POST['pass'])&&
   isset($_POST['cis'])){

    include "../db_conn.php";

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
   $cis = $_POST['cis'];

    $data = "uname=".$uname;
    
    if(empty($uname)){
    	$em = "User name is required";
    	header("Location: ../adminlogin.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../adminlogin.php?error=$em&$data");
	    exit;
    }else if(empty($cis)){
      $em = "Cis is required";
    	header("Location: ../adminlogin.php?error=$em&$data");
	    exit;
    }    else {

    	$sql = "SELECT * FROM admin_table WHERE admin_email = ?";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$uname]);

      if($stmt->rowCount() == 1){
          $user = $stmt->fetch();

          $username =  $user['admin_name'];
          $password =  $user['admin_password'];
          $email = $user['admin_email'];
          $id =  $user['admin_id'];
          $pp =  $user['admin_password'];
         $cisno = $user['admin_cis_no'];
          if($email === $uname){
             if(password_verify($pass, $password)){
                 $_SESSION['admin_id'] = $id;
                 $_SESSION['admin_name'] = $username;
                 $_SESSION['pp'] = $pp;
                $_SESSION['cisno'] = $cisno;
                $_SESSION['admin_email'] = $email;
                $_SESSION["is_logged_in"] = true;
        // return "SUCCESS";  
                 header("Location: ../admindash.php");
                 exit;
             }else {
               $em = "Incorect User name, CIS No or password";
               header("Location: ../adminlogin.php?error=$em&$data");
               exit;
            }

          }else {
            $em = "Incorect User name or password";
            header("Location: ../adminlogin.php?error=$em&$data");
            exit;
         }

      }else {
         $em = "Incorect User name or password";
         header("Location: ../adminlogin.php?error=$em&$data");
         exit;
      }
    }


}else {
	header("Location: ../adminlogin.php?error=error");
	exit;
}
