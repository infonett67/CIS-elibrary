<?php
session_start();
    require_once("classes/Admin.php");
    require_once("classes/Users.php");
    require_once("classes/Books.php");
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

    if(isset($_GET['bookid'])){
        $productId = $_GET['bookid'];
        $productd= new Books();
        $productDetails = $productd->get_book_data($productId);
        // $similar_books = $productd->select_category($productId);
    }
    
    if(isset($_GET['id'])){
        $simi = $_GET['id'];
        $new_book = new Books();
        $similar_books = $new_book->select_category($simi);
    }

    $books = new Books();
    $all_books = $books->select_all_books();

    $admin = new Admin();
    // $get_category = $admin->get_category($all_books["book_category"]);

// Include your database connection and any required dependencies

// Get the file ID or filename from the AJAX request
// $fileId = $_POST['file_id'];

// // Fetch the file data from the database based on the file ID or filename
// // Assuming you have a 'files' table with 'id', 'filename', and 'filedata' columns
// $query = "SELECT book_name, book_category FROM books WHERE id = :file_id";
// $stmt = $pdo->prepare($query);
// $stmt->bindParam(':file_id', $fileId);
// $stmt->execute();

// // Check if the file record exists
// if ($stmt->rowCount() > 0) {
//     // Fetch the file data
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);
//     $filename = $row['filename'];
//     $filedata = $row['filedata'];

//     // Set the appropriate headers for the file download
//     header('Content-Type: application/octet-stream');
//     header('Content-Disposition: attachment; filename="' . $filename . '"');
    
//     // Output the file data
//     echo $filedata;
//     exit;
// } else {
//     // File not found in the database
//     echo 'File not found';
//     exit;
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <link href="fontawesome/css/solid.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
    <link rel="stylesheet" href="css/line-icons.css">
    <link rel="stylesheet" href="style.css">
    <link href="bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css'>
        <link href="bootstrap/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
        <link href="bootstrap/js/bootstrap.bundle.js" rel='stylesheet' type='text/js'>
        <link href="bootstrap/js/bootstrap.bundle.min.js" rel='stylesheet' type='text/js'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <link href="bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css'>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <link href="fontawesome/css/all.min.css" rel="stylesheet">
        <link href="fontawesome/css/solid.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
        <script src="javascript/browser.js" defer></script>
        <style>
            @media screen and (max-width:1024px) {
                embed{
                    display: none;
                }
            }
        </style>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar">

<nav class="navbar navbar-expand-lg navbar-light bg-white text-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="images/cis-100-dark-1.png" alt="" width=10px height="50px" class="bg-light"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 400px;">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="browser.php">Browser</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="category.php">Books</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li class="nav-item dropend">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#1107fe">
                  Subscription
                </a>
                <ul class="dropdown-menu">
                <li>
                    <h2 class="dropdown-header" style="z-index: 1000000000000000000000000000000000000; font-size:15px">Economist Intelligence(EIU)<span>&nbsp;</h2>
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
            <a class="nav-link" href="contact.php">Contact us</a>
        </li>
        <li class="nav-item">
        <form action="" method="post">
                        <button class="nav-link btn" name="logout">Sign Out</button>
                        </form>
        </li>
        </ul>
      </div>
    </div>
</nav>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <?php foreach ($productDetails as $product) { ?>
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 mt-3">
                            <img src="images/learning.png" alt="Learning picture" class="card-img" width="200px" height="200px">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['book_name'] ?></h5>
                                <hr>
                                <?php
                                // Fetch file list from the database
                                $conn = new mysqli('localhost', 'cislqikb_cislib', 'Superman56!@', 'cislqikb_cislib');

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $productId = $product['id'];
                                $query = "SELECT * FROM files WHERE file_id = '$productId'";
                                $result = $conn->query($query);

                                if ($result->num_rows == 1) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="embed-responsive embed-responsive-16by9 mb-3">';
                                        echo '<embed src="' . $product['filename'] . '" class="embed-responsive-item" style="width:700px;height:800px"></embed>';
                                        echo '</div>';
                                        echo '<a class="btn btn-dark text-light" href="download.php?id=' . $row['file_id'] . '">DOWNLOAD</a>';
                                    }
                                } else {
                                    echo '<p>No files found</p>';
                                    echo $productId;
                                    echo $result->fetch_assoc();
                                }

                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>




<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-md-12">
            <section id="about" class="bg-cover" style="background-image: url(img/cover_3.jpg);">
                    <div class="overlay"></div>
                
            </section>
            </div>
    </div>
</div>

</div>
<footer class="py-4">
         <div class="container">
               <div class="row">
                  <div class="col-md-6">
                     <p class="mb-0">Powered by Synercom Limited</p>
                  </div>
                  <div class="col-md-6 text-md-end">
                     <!-- <div>
                           <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                           <a href="#"><i class='bx bxl-twitter'></i></a>
                           <a href="#"><i class='bx bxl-dribbble'></i></a>
                           <a href="#"><i class='bx bxl-instagram'></i></a>
                           <a href="#"><i class='bx bxl-github'></i></a>
                     </div> -->
                  </div>
               </div>
         </div>
      </footer>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="jquery.min.js"></script>
    <script src="jqueryanimation.js"></script>
    <script src="javascript/index.js"></script>

    <script type="text/javascript" language="javascript">
       
    </script>
</body>
</html>