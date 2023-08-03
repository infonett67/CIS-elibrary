<?php 

if(isset($_POST['fname']) && 
   isset($_POST['uname']) &&  
   isset($_POST['pass'])){

    include "../config.php";
	// include '../db_conn.php';

    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $cis = $_POST['cis'];
    $pass = $_POST['pass'];

    $data = "fname=".$fname."&uname=".$uname;
    
    if (empty($fname)) {
    	$em = "Full name is required";
    	header("Location: ../adminreg.php?error=$em&$data");
	    exit;
    }else if(empty($uname)){
    	$em = "User name is required";
    	header("Location: ../adminreg.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../adminreg.php?error=$em&$data");
	    exit;
    }
	else if(empty($cis)){
		$em = "Cis No is required";
    	header("Location: ../adminreg.php?error=$em&$data");
	    exit;
	}
	else {
      // hashing the password
      $pass = password_hash($pass, PASSWORD_DEFAULT);
       	$sql = "INSERT INTO admin_table(admin_name, admin_email, admin_password,admin_cis_no) 
       	        VALUES(?,?,?,?)";
       	$stmt = $conn->prepare($sql);
       	$stmt->execute([$fname, $uname, $pass,$cis]);

       	header("Location: ../adminreg.php?success=Your account has been created successfully");
   	    exit;
      }
    }

else {
	header("Location: ../index.php?error=error");
	exit;
}
