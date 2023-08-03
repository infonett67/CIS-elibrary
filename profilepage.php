<?php
session_start();
require_once("classes/Admin.php");
require_once("classes/Users.php");
require_once("config.php");


if (!isset($_SESSION['is_logged_in'])) {
	header("location: login_page.php");
}

if (isset($_POST['logout'])) {
    if(isset($_SESSION["user_id"])){
    session_destroy();
    header("location: login_page.php");
    exit();
    }
} 

$user = new Users();
$select_user = $user->select_user_details($_SESSION["user_id"]);

if(isset($_POST["btn_upload"])){
    $file = $_FILES["pictures"];
    if($_FILES["pictures"]["error"] !=0){
    echo "Error Inputing File";
    exit();
    }
    $extension =  explode(".",$file["name"])[1];
    $allowed = ["png","jpg","jpeg"];
    if(!in_array($extension,$allowed))
    {
        echo "Invalid type, please upload a better file file.<br>";
        exit();
    }
    $filename =  "profile_pictures".time().".".$extension;
    $destination = "profile_pictures/".$filename;
    if(move_uploaded_file($file["tmp_name"],$destination)){
        echo "$filename File uploaded successfully";
        
    }
    


    $username  = $_POST['username'];
    $contactid  = $_POST['userid'];
    $location= $_POST["location"];
    $email = $_POST["email"]; 

    
    if (empty($email) || empty($username)){
    echo "These fields are required are required";
    exit();
    }
    $newContact = new Users();
    $result = $newContact->update_user_details( $username, $email,$location,$_SESSION["user_id"]);
    $picture = $newContact->updateProfileImage($destination,$_SESSION["user_id"]);
    if ($result == 1 && $picture == 1){
        echo "<div class='alert alert-dark' role='alert'>Contact Uploaded Successfully</div>";
    header("location:profilepage.php");
    exit();

    }
}
if(isset($_POST['change_password'])){
    $oldpassword=$_SESSION['userpwd']; 
     $password=$_POST['new_password'];  
    $passwordConfirm=$_POST['c_new_password']; 
   $sql="SELECT user_password from user_table where user_email='$_SESSION[useremail]'";
   $res = mysqli_query($conn,$sql);
         $res=mysqli_query($conn,$sql);
           $row = mysqli_fetch_assoc($res);
          if(password_verify($password,$passwordConfirm)){
   if($passwordConfirm ==''){
               $error[] = 'Please confirm the password.';
           }
           if($password != $passwordConfirm){
               $error[] = 'Passwords do not match.';
           }
             if(strlen($password)<5){ // min 
               $error[] = 'The password is 6 characters long.';
           }
           
            if(strlen($password)>20){ // Max 
               $error[] = 'Password: Max length 20 Characters Not allowed';
           }
   if(!isset($error))
   {
         $options = array("cost"=>4);
       $password = password_hash($password,PASSWORD_BCRYPT,$options);
   
        $result = mysqli_query($conn,"UPDATE user_table SET password='$password' WHERE user_email='$_SESSION[useremail]'");
              if($result)
              {
          header("location:profilepage.php");
              }
              else 
              {
               $error[]='Something went wrong';
              }
   }
   
           } 
           else 
           {
               $error[]='Current password does not match.'; 
           }   
       }
           if(isset($error)){ 
   
   foreach($error as $error){ 
     echo '<p class="errmsg">'.$error.'</p>'; 
   }
   }

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="css/header.css">
    <link href="bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css'>
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <link href="fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
        <script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white text-dark" data-aos="fade-down" style="background-color: #bd9e55; margin-left:-50px">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="images/cis-100-dark-1.png" alt="" width=200px class="bg-light"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="browser.php">Browse
                        </a>
                    </li>
                    <li class="nav-item dropdown ">
                     <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >Category</a>

                     <ul class="dropdown-menu" style="z-index: 1000000000000000000000000000000000000;width:190px">
                  
                     <li><a class="dropdown-item" href="category.php">Books</a></li>
                     <li><hr class="dropdown-divider"></li>

                     <li><h2 class="dropdown-header" style="z-index: 1000000000000000000000000000000000000; font-size:15px">Economist Intelligence(EIU)</h2>
                        <ul>
                           <li><a class="dropdown-item" href="#" style="font-size:10px">Country</a></li>
                           <!-- <li><a class="dropdown-item" href="#" style="font-size:10px"></a></li> -->
                        </ul>
                     </li> 

                     <li><h2 class="dropdown-header" style="z-index: 1000000000000000000000000000000000000; font-size:15px">IG Public<span>&nbsp;<img src="images/IG-Publishing-logo80.png" alt="" style="width:50px" ></span></h2>
                        <ul>
                           <li><a class="dropdown-item" href="#" style="font-size:10px">E-books</a></li>
                           <li><a class="dropdown-item" href="#" style="font-size:10px">E-Journals</a></li>
                        </ul>
                     </li>

                     <li><h1 class="dropdown-header" href="#" style="z-index: 1000000000000000000000000000000000000;font-size:15px">Proquest<span>&nbsp;&nbsp;<img src="images/pq-logo-gray.jpg" alt="" style="width:50px" ></span></h1>
                        <ul>
                           <li><a class="dropdown-item" href="#" style="font-size:10px">E-books</a></li>
                           <li><a class="dropdown-item" href="#" style="font-size:10px">E-Journals</a></li>
                        </ul>
                     </li>
                     </ul>
                  </li>
                    <li class="nav-item">
                        <form action="" method="post">
                        <button class="nav-link btn " name="logout">Sign Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
</nav>
	<section class="py-5 my-5">
		<div class="container-fluid" id="work">
			<h1 class="mb-5">Account Settings</h1>
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
							<img src="<?php echo $select_user['user_profile_pic']?>" alt="Image" class="shadow">
						</div>
						<h4 class="text-center"><?php echo $_SESSION['username']?></h4>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Account
						</a>
						<!-- <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Password
						</a> -->
						<!-- <a class="nav-link" id="security-tab" data-toggle="pill" href="#books" role="tab" aria-controls="security" aria-selected="false">
							<i class="fa fa-book text-center mr-1"></i> 
							Books
						</a> -->
					</div>
				</div>
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
						<h3 class="mb-4">Account Settings</h3>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 mx-1 my-2">
                                    <label for="" class="form-label" hidden>ID</label>
                                    <input type="text" name="userid" id="userid" placeholder="" class="form-control" hidden value="<?php echo $_SESSION["user_id"];?>">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" value="<?php echo $select_user['user_name']?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label>CIS Number</label>
                                            <input type="text" class="form-control" name="cisnumber" readonly value="<?php echo $select_user['cis_no']?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Profile Picture</label>
                                            <input type="file" class="form-control" name="pictures" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" value="<?php echo $select_user['user_email']?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Company Location</label>
                                            <input type="text" class="form-control" name="location" value="<?php echo $select_user["user_office_location"] ?>">
                                    </div>
                                </div>
                            </div>
                                <div>
                                    <button class="btn btn-primary" style="background-color: #260269;" name="btn_upload">Update</button>
                                    <button class="btn btn-light">Cancel</button>
						        </div>
                        </form>
						
					</div>
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<h3 class="mb-4">Password Settings</h3>
                        <form action="" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
                                        <label>Old password</label>
                                        <input type="password" class="form-control" name="old_password">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>New password</label>
								  	<input type="password" class="form-control" name="new_password">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Confirm new password</label>
								  	<input type="password" class="form-control" name="c_new_password">
								</div>
							</div>
						</div>
						<div>
							<button class="btn text-light" style="background-color: #260269;" name="change_password">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
</form>
					</div>
					<!-- <div class="tab-pane fade" id="books" role="tabpanel" aria-labelledby="security-tab">
						<h3 class="mb-4">Book archive</h3>
                        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('images/unsplash-photo-1.jpg');">
            <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Short title, long jacket</h2>
                <ul class="d-flex list-unstyled mt-auto">
                <li class="me-auto">
                    <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                </li>
                <li class="d-flex align-items-center me-3">
                    <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                    <small>Earth</small>
                </li>
                <li class="d-flex align-items-center">
                    <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                    <small>3d</small>
                </li>
                </ul>
            </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('images/unsplash-photo-2.jpg');">
            <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Much longer title that wraps to multiple lines</h2>
                <ul class="d-flex list-unstyled mt-auto">
                <li class="me-auto">
                    <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                </li>
                <li class="d-flex align-items-center me-3">
                    <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                    <small>Pakistan</small>
                </li>
                <li class="d-flex align-items-center">
                    <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                    <small>4d</small>
                </li>
                </ul>
            </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('images/unsplash-photo-3.jpg');">
                <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                    <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Another longer title belongs here</h2>
                    <ul class="d-flex list-unstyled mt-auto">
                        <li class="me-auto">
                            <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                        </li>
                        <li class="d-flex align-items-center me-3">
                            <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                            <small>Title</small>
                        </li>
                        <li class="d-flex align-items-center">
                            <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                            <small>Author</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
					</div> -->
				</div>
			</div>
		</div>
	</section>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="jquery.min.js"></script>
    <script src='bootstrap/js/bootstrap.bundle.min.js' type=''></script>
    <script src="javascript/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="javascript/index.js"></script>
</body>
</html>