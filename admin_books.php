<?php 
session_start();
require_once("classes/Books.php"); 
require_once("classes/Admin.php");
require_once("classes/DB.php");
include 'config.php';

if (!isset($_SESSION['is_logged_in'])) {
	header("location: adminlogin.php");
}

$userid = $_SESSION["admin_id"];

$books = new Books();
$all_books = $books->join();

$cat = new Admin();
$all_cat = $cat->fetch_categories();

if (isset($_POST['logout'])) {
    if(isset($_SESSION["admin_id"])){
    session_destroy();
    header("location: adminlogin.php");
    exit();
    }
} 

// if(isset($_POST['add_product']))
// {
//     $pdf = $_FILES["pdf"];
//     $pdf_name = $_FILES['pdf']['name'];
//     $pdf_type = $_FILES['pdf']['type'];
//     $pdf_size = $_FILES['pdf']['size'];
//     $pdf_tmp_loc = $_FILES['pdf']['tmp_name'];

//     if($_FILES["pdf"]["error"] !== 0){
//         echo "Error uploading file.";
//         exit();
//     }
//     // print_r($_FILES);
//     $extension = pathinfo($pdf_name, PATHINFO_EXTENSION);
//     $allowed = ["pdf"];
//     if(!in_array($extension, $allowed)){
//         echo "Invalid file type. Please upload a PDF file.";
//         exit();
//     }

//     $filename =  "book_folder_" . time() . "." . $extension;
//     $destination = "book_folder/" . $filename;
//     // print_r($filename);
//     // print_r($destination);
//     if(move_uploaded_file($pdf_tmp_loc, $destination)){
//         echo "$filename uploaded successfully.";
//     } 
//     else {
//         echo "Error uploading file.";
//         exit();
//     }

//     $name = $_POST['book_name'];
//     $project_category = $_POST["category"];
//     // print_r($name);
//     // print_r($project_category);
//     if(empty($name) || empty($project_category)){
//         echo "Name, author, and category fields are required.";
//         exit();
//     } 

//     $newbook = new Books();
//     $add_new = $newbook->add_books($name, $pdf_size,$destination,$project_category);
//     header("location: admin_books.php");
//     exit();
    
// }




?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Books</title>
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
            
        <section class="add-products">

            <h1 class="title">E-Lib Administration</h1>

            <form action="upload.php" method="post" enctype="multipart/form-data" style="background-color: #bd9e55;">
            <h3>ADD BOOKS</h3>
            <div class="col-md-12">
            <label for="" class="form-label"><h3>BOOK NAME</h3></label>
                <input type="text" name="book_name" placeholder="enter book name" required class="form-control"><br>
            </div>
            <div class="col-md-12">
                <label class="form-label text-light"><h3>Category</h3></label>
                    <?php
                    echo "<select name='category' id='project_category' class='form-control'>";
                    echo "<option value='' class='box'>Please Select Following</option>";
                        foreach($all_cat as $values){?>
                            <option value="<?php echo $values["id"]?>" class="form-control"> <?php print_r($values["cat_name"])  ?> </option>
                        <?php }
                        echo "</select>";
                    ?>
            </div>
            
            
            <input type="file" name="pdf" required class="form-control">
            <input type="text" name="id" hidden class="form-control">
            <button type="submit" name="add_product" class="btn btn-success btn-lg m-3">SUBMIT</button>
            </form>

        </section>

        <!-- <section class="show-products">

            <div class="box-container">

                <?php
                if(count($all_books) < 1){?>
                <h1 class="text-danger text-center">NO BOOKS YET</h1>
                <?php }?>
                <?php foreach($all_books as $all_books){?>
                    <div class="box">
                        <embed src="<?php echo $all_books['filename']; ?>" width="400" height="400"alt="Book">
                        <div class="name"><?php echo $all_books['book_name']; ?></div>
                    </div>
                <?php
                    };
                ?>
            </div>

        </section> -->


    </body>
</html>
<script src="jquery.min.js"></script>
<script src="javascript/admin_script.js"></script>
<script src="javascript/admin_style.js"></script>

</body>
</html>