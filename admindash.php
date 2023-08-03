<?php
session_start();
require_once("classes/Books.php"); 
require_once("classes/Admin.php");
require_once("classes/Users.php");

$contactd= new Admin();
$contactDetails = $contactd->fetchAdmin($_SESSION["admin_id"]);

$new_Category = new Users();
$getNumber=$new_Category->count_admin();

$new_User = new Users();
$getUser=$new_User->count_user();
$getmessage = $new_User->count_message();

$new_books = new Books();
$getbooks = $new_books->count_books();

$new_category = new Admin();
$getcategory = $new_category->count_category();

if (!isset($_SESSION['is_logged_in'])) {
	header("location: adminlogin.php");
}

if (isset($_POST['logout'])) {
   if(isset($_SESSION["admin_id"])){
   session_destroy();
      header("location: adminlogin.php");
   exit();
   }
} 




?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>
   <link href="bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css'>
   <link href="bootstrap/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
   <link href="bootstrap/js/bootstrap.bundle.js" rel='stylesheet' type='text/js'>
   <link href="bootstrap/js/bootstrap.bundle.min.js" rel='stylesheet' type='text/js'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   <link href="fontawesome/css/all.min.css" rel="stylesheet">
   <link href="fontawesome/css/solid.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <!-- <link rel="stylesheet" href="style.css"> -->
      <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
      <link rel="stylesheet" type="text/css" href="css/admin_dash.css">

   <style type="text/css">
      a{
         text-decoration: none;
         color: #fff;
      }
      .header-container {
   display: flex;
   flex-direction: row;
   align-items: center;
   justify-content: space-between;
   padding: 10px;
}

@media (max-width: 768px) {
   .header-container {
      flex-direction: row;
      align-items: flex-start;
   }

}

@media (max-width: 768px) {
   .navbar {
      margin-top: 10px;
      margin-left: 0;
   }
}

@media (max-width: 576px) {
   .navbar {
      display: flex;
      flex-direction: row;
      align-items: flex-start;
   }
   .navbar .navbar-collapse {
      margin-left: 0;
   }
}


   </style>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar">

            <nav class="navbar navbar-expand-lg text-dark" style="background-color:#bd9e55;color:#000">
               <div class="container-fluid">
               <a class="navbar-brand" href="admindash.php" style="font-size: 20pt;">Admin <span style="color: #000;"> Dashboard</span></a>
               <button class="navbar-toggler border-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon" ><i class="fa-solid fa-bars" style="font-size: 20px;"></i></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 400px;">
                  <ul class="nav me-auto mb-2 mb-lg-0 justify-content-end" style="font-size: 1.5rem;color:#000;">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admindash.php">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin_books.php">Books</a>
                        </li>
                        <li class="nav-item dropend">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Categories
                        </a>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="admincat.php">Categories</a></li>
                           <li>
                           <hr class="dropdown-divider">
                           </li>
                           <li class="nav-item dropend">
                           <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#1107fe">
                           Subscription
                           </a>
                           <ul class="dropdown-menu">
                           <li>
                              <h2 class="dropdown-header" style="z-index: 1000000000000000000000000000000000000; font-size:15px">Economist Intelligence(EIU)</h2>
                              <ul>
                              <li><a class="dropdown-item" href="#" style="font-size:10px">Country's Content</a></li>
                              <!-- <li><a class="dropdown-item" href="#" style="font-size:10px">E-Journals</a></li> -->
                              </ul>
                           </li> 
                           <li>
                              <h2 class="dropdown-header" style="z-index: 1000000000000000000000000000000000000; font-size:15px">IG Public<span>&nbsp;<img src="images/IG-Publishing-logo80.png" alt="" style="width:50px" ></span></h2>
                              <ul>
                              <li><a class="dropdown-item" href="#" style="font-size:10px">E-books</a></li>
                              <li><a class="dropdown-item" href="#" style="font-size:10px">E-Journals</a></li>
                              </ul>
                           </li>

                           <li>
                              <h1 class="dropdown-header" href="#" style="z-index: 1000000000000000000000000000000000000;font-size:15px">Proquest<span>&nbsp;&nbsp;<img src="images/pq-logo-gray.jpg" alt="" style="width:50px" ></span></h1>
                              <ul>
                              <li><a class="dropdown-item" href="#" style="font-size:10px">E-books</a></li>
                              <li><a class="dropdown-item" href="#" style="font-size:10px">E-Journals</a></li>
                              </ul>
                           </li>
                           </ul>
                           </li>
                        </ul>
                        </li>
                  <li class="nav-item">
                        <a class="nav-link" href="admin_message.php">Messages</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="admin_users.php">users</a>
               </li>
               
                  <li class="nav-item">
                  <form action="" method="post">
                              <button class="nav-link btn " name="logout">Sign Out</button>
                              </form>
                  </li>
                  </ul>
                  <!-- <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                  </form> -->
               </div>
               </div>
            </nav>




   <!-- <header class="header">
      <div class="header-container">

   <div class="flex"> 
   <nav class="navbar navbar-expand-lg text-dark" id="nav" style="background-color:#bd9e55">
         <div class="container-fluid">
            <a href="admindash.php" class="logo">Admin<span>Panel</span></a>
         <button class="navbar-toggler bg-dark text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
         </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 400px;">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="admindash.php">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="admin_books.php">Books</a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Category
                  </a>
                  <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="admincat.php">Books</a></li>
                  <li>
                     <hr class="dropdown-divider">
                  </li>
                  <li class="nav-item dropend">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#1107fe">
                        Subscription
                     </a>
                     <ul class="dropdown-menu">
                     <li>
                        <h2 class="dropdown-header" style="z-index: 1000000000000000000000000000000000000; font-size:15px">Economist Intelligence(EIU)</h2>
                        <ul>
                        <li><a class="dropdown-item" href="#" style="font-size:10px">Country's Content</a></li>
                        </ul>
                     </li> 
                     <li>
                        <h2 class="dropdown-header" style="z-index: 1000000000000000000000000000000000000; font-size:15px">IG Public<span>&nbsp;<img src="images/IG-Publishing-logo80.png" alt="" style="width:50px" ></span></h2>
                        <ul>
                        <li><a class="dropdown-item" href="#" style="font-size:10px">E-books</a></li>
                        <li><a class="dropdown-item" href="#" style="font-size:10px">E-Journals</a></li>
                        </ul>
                     </li>

                     <li>
                        <h1 class="dropdown-header" href="#" style="z-index: 1000000000000000000000000000000000000;font-size:15px">Proquest<span>&nbsp;&nbsp;<img src="images/pq-logo-gray.jpg" alt="" style="width:50px" ></span></h1>
                        <ul>
                        <li><a class="dropdown-item" href="#" style="font-size:10px">E-books</a></li>
                        <li><a class="dropdown-item" href="#" style="font-size:10px">E-Journals</a></li>
                        </ul>
                     </li>
                     </ul>
                  </li>
                  </ul>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="admin_users.php">users</a>
            </li>
            <li class="nav-item">
                  <a class="nav-link" href="admin_message.php">messages</a>
            </li>
            <li class="nav-item">
               <form action="" method="post">
                  <button class="nav-link btn" name="logout" style="font-size: 18px;">Logout</button>
               </form>
            </li>
            </ul>
            </div>
         </div>
      </nav>



   </div>
   </div>
   </header> -->
<section class="dashboard">

<h1 class="title">E-LIBRARY Management</h1>

<div class="box-container">

   <div class="box">
      <a href="admin_books.php">
      <h1><?php echo $getbooks ?></h1>
      <h3><?php echo $getbooks ?></h3>
      <p>Total number of books</p>
      </a>
   </div>

   <div class="box">
      <a href="admincat.php">
      <h1><?php echo $getcategory?></h1>
      <h3><?php echo $getcategory?></h3>
      <p>Number of categories</p>
      </a>
   </div>

   <div class="box">
      <a href="admin_users.php">
      <h1>1</h1>
      <h3>1</h3>
      <p>number of downloads</p>
      </a>
   </div>


   <div class="box">
      <a href="admin_users.php">
      <h1><?php echo $getUser ?></h1>
      <h3><?php echo $getUser ?></h3>
      <p>CIS Members</p>
      </a>
   </div>

   <div class="box">
      <a href="admin_users.php">
      <h1><?php echo $getNumber ?></h1>
      <h3><?php echo $getNumber ?></h3>
      <p>CIS admin users</p>
      </a>
   </div>


   <div class="box">
      <a href="admin_message.php">
      <h1><?php echo $getmessage ?></h1>
      <h3><?php echo $getmessage ?></h3>
      <p>new messages</p>
      </a>
   </div>

</div>

</section>
<script src="jquery.min.js"></script>
<script src="javascript/admin_script.js"></script>
<script src="javascript/admin_style.js"></script>
<script>

</script>
</body>
</html>