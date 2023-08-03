<?php 
session_start();
require_once("classes/Admin.php");
require_once("classes/Users.php");

if(isset($_SESSION["admin_id"])){
    header("location:admin_login.php");
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
    <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
        <link href="fontawesome/css/solid.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="css/reg.css"> -->
    <style>
        .w-450 {
	width: 450px;
}
.vh-100 {
	min-height: 100vh;
}
.w-350 {
	width: 350px;
}
    </style>
</head>
<body>
    <div class=" text-light  d-flex justify-content-center align-items-center vh-100" style="background-color: #260269;">
    	
    	<form class="shadow w-450 p-3 border border-light" 
    	      action="process/adminsignup.php" 
    	      method="post"
    	      enctype="multipart/form-data">

    		<h4 class="display-4  fs-1">ADMIN REG<span><img src="images/cis-100-dark-1.png" alt="" width="150px" height="50px" style="background-color: #fff;"></span></h4><br>
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

		    <?php if(isset($_GET['success'])){ ?>
    		<div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
			</div>
		    <?php } ?>
		  <div class="mb-3">
		    <label class="form-label">User Name</label>
		    <input type="text" 
		           class="form-control"
		           name="fname"
		           value="<?php echo (isset($_GET['fname']))?$_GET['fname']:"" ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Email</label>
		    <input type="email" 
		           class="form-control"
		           name="uname"
		           value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <input type="password" 
		           class="form-control"
		           name="pass"
				   value="<?php echo (isset($_GET['pass']))?$_GET['pass']:"" ?>">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Cis No</label>
		    <input type="text" 
		           class="form-control"
		           name="cis"
				   value="<?php echo (isset($_GET['cisno']))?$_GET['cisno']:"" ?>">
		  </div>
		  <div style="text-align: center;">
        <a href="index.php"><i class="fa-solid fa-home"></i></a>
        </div>
            <div style="text-align:center" class="p-3">
		  <button type="submit" class="btn btn-primary">Sign Up</button>
		  <a href="adminlogin.php" class="link-secondary btn btn-light">Login</a>
          </div>
        </form>
    </div>
</body>
</html>
