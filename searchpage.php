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
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $category = new Books;
    $filter_cat = $category->join_books($id);
    $getname = $category->join_books($id);
    
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $category = new Books;
    $getname = $category->join_booksname($id);
}


$books = new Books();
$all_books = $books->select_all_books();

$cat = new Admin();
$all_cat = $cat->fetch_categories();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
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

    <title><?php echo $getname['cat_name']?></title>
    <style>
         .goBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        background-color: #bd9e55;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: none;
    }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!--navbar-->
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
            <!-- <li class="nav-item">
                <a class="nav-link" href="profilepage.php">Profile</a>
            </li> -->
            <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact us</a>
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


    <!--reviews-->
    <section id="reviews" class="text-center">
        <div class="container">
            <div class="row">
                
                <div class="col-12 section-intro text-center">
                    <?php if(!$getname){
                        echo '<h1 style="color:#bd9e55">NO BOOKS HERE</h1>';
                    }else{?>
                        <h1 style="color:#bd9e55"><?php echo $getname['cat_name']?></h1>
                    <?php }?>
                    
                    <div class="divider"></div>
                    <p>
                    </p>
                </div>
                
            </div>
            <div class="row g-4 text-start" >
                 <?php foreach($filter_cat as $filter_cat){?>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="review p-4">
                        <div class="person">
                            <!-- <i class="fas fa-book fa-5x" style="color:#1107fe"></i> -->
                            <img src="images/book.png" alt="">
                            <div class="text ms-3">
                                    <h5 class="mb-0" style="color:#bd9e55"><?php echo $filter_cat["book_name"]?></h5>
                                    <a href="view_book.php?bookid=<?php echo $filter_cat["file_id"]?>" class="btn btn-dark btn-sm text-center" style="height:px">View</a>
                            </div>
                        </div>                
                    </div>
                </div>
                <?php }?>
        </div>
        </div>
        <button id="goUpBtn" class="goBtn" style="border-radius: 50%;"><i class="fas fa-arrow-up"></i></button>
<button id="goDownBtn" class="goBtn" style="border-radius: 50%;"><i class="fas fa-arrow-down"></i></button>
    </section>

    



    <!--footer-->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">Powered by Synercom Limited </p>
                </div>
                <!-- <div class="col-md-6 text-md-end">
                    <div>
                        <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                        <a href="#"><i class='bx bxl-twitter'></i></a>
                        <a href="#"><i class='bx bxl-dribbble'></i></a>
                        <a href="#"><i class='bx bxl-instagram'></i></a>
                        <a href="#"><i class='bx bxl-github'></i></a>
                    </div>
                </div> -->
            </div>
        </div>
    </footer>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="jquery.min.js"></script>
    <script src="jqueryanimation.js"></script>
    <script src="javascript/index.js"></script>
    <script type="text/javascript" language="javascript">
    const goUpBtn = document.getElementById('goUpBtn');
    const goDownBtn = document.getElementById('goDownBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 0) {
            goUpBtn.style.display = 'block';
        } else {
            goUpBtn.style.display = 'none';
        }

        if (window.scrollY + window.innerHeight < document.documentElement.scrollHeight) {
            goDownBtn.style.display = 'block';
        } else {
            goDownBtn.style.display = 'none';
        }
    });

    goUpBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    goDownBtn.addEventListener('click', () => {
        window.scrollTo({ top: document.documentElement.scrollHeight, behavior: 'smooth' });
    });

        </script>
</body>

</html>