<?php 
session_start();
require_once("classes/Books.php"); 
require_once("classes/Admin.php");
require_once("classes/DB.php");
require_once("classes/Users.php");
include 'config.php';

if (!isset($_SESSION['is_logged_in'])) {
	header("location: adminlogin.php");
}

$userid = $_SESSION["admin_id"];

$books = new Books();
$all_books = $books->select_all_books();

$cat = new Admin();
$all_cat = $cat->fetch_categories();

if (isset($_POST['logout'])) {
    if(isset($_SESSION["admin_id"])){
    session_destroy();
    header("location: adminlogin.php");
    exit();
    }
} 

$user = new Users();
$messages = $user->show_message();

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `messages` WHERE id = '$delete_id'") or die('query failed');
  header('location:admin_message.php');
}


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Message</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="css/admindash.css">
        <link href="bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css'>
        <link href="fontawesome/css/all.min.css" rel="stylesheet">
        <link href="fontawesome/css/solid.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
        <link rel="stylesheet" type="text/css" href="css/admin_dash.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
          .messages .box-container{
            display: grid;
            grid-template-columns: repeat(auto-fit, 35rem);
            justify-content: center;
            gap:1.5rem;
            max-width: 1200px;
            margin:0 auto;
            align-items: flex-start;
          }

          .messages .box-container .box{
            background-color: #bd9e55;
            padding:2rem;
            border:1px solid grey;
            box-shadow: black;
            border-radius: .5rem;
          }

          .messages .box-container .box p{
            padding-bottom: 1.5rem;
            font-size: 2rem;
            color:black;
            line-height: 1.5;
          }

          .messages .box-container .box p span{
            color:black;
          }

          .messages .box-container .box .delete-btn{
            margin-top: 0;
          }
          .empty{
            padding:1.5rem;
            text-align: center;
            border:1px solid black;
            background-color:grey;
            color:red;
            font-size: 2rem;
          }
        </style>
    </head>
    <body data-bs-spy="scroll" data-bs-target=".navbar">

            <nav class="navbar navbar-expand-lg text-dark" style="background-color:#bd9e55">
               <div class="container-fluid">
               <a class="navbar-brand" href="admindash.php" style="font-size: 20pt;">Admin <span style="color: #000;"> Dash</span></a>
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
                        <li class="nav-item dropdown">
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
            
        <section class="messages">

            <h1 class="title"> messages </h1>

            <div class="box-container">
            <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `messages`") or die('query failed');
            if(mysqli_num_rows($select_message) > 0){
               while($fetch_message = mysqli_fetch_assoc($select_message)){
            
            ?>
            <div class="box">
                <p> user id : <span><?php echo $fetch_message['id']; ?></span> </p>
                <p> name : <span><?php echo $fetch_message['user_name']; ?></span> </p>
                <p> email : <span><?php echo $fetch_message['user_email']; ?></span> </p>
                <p> message : <span><?php echo $fetch_message['user_message']; ?></span> </p>
                <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn btn btn-danger">delete message</a>
            </div>
            <?php
               };
          }else{
             echo '<p class="empty">You have no messages!</p>';
          }        
            ?>
            </div>

        </section>
    </body>
</html>
<script src="jquery.min.js"></script>
<script src="javascript/admin_script.js"></script>
<script src="javascript/admin_style.js"></script>

</body>
</html>