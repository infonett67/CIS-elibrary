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


if(isset($_POST["search_btn"])){

$search= $_POST["search"];

$books = new Books();
$category = $books->check_if_category_exist($search);
$checkWork = $books->check_if_book_exist($search);
if(empty($search)){
    echo "<script>alert('No such book or category found');</script>";
}
$searching= $books->filterSearch($search);
}

?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search Page</title>
        <link rel="stylesheet" href="style.css">
        <link href="fontawesome/css/all.min.css" rel="stylesheet">
        <link href="fontawesome/css/solid.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
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
        <script src="javascript/browser.js" defer></script>
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

    <div class="container-fluid mb-3">
    <div class="row">
        <div class="col-md-12">
        <section id="about" class="bg-cover" style="background-image: url(img/cover_3.jpg);">
            <div class="overlay"></div>
            <div class="container text-white text-center">
                <form action="" method="post">
                    <label for="">Search Here</label>
                    <input type="search" name="search" id="search" class="form-control">
                    <button type="submit" name="search_btn" class="btn btn-secondary m-3" id="searchbtn">Search</button>
                </form>
            </div>
        </section>
            </div>
    </div>
    </div>

    <section id="reviews" class="text-center">
        <div class="container">
            <div class="row g-4 text-start" >
    <?php
        if(count($searching) < 1){
            echo "<h1 class='text-center'>No Books Found</h1>";
        }else if(empty($searching)){
            echo "<h1 class='text-center'>No Books Found</h1>";
        }
        else{
            foreach ($searching as $searching){?>
                     <div class="col-md-4" data-aos="fade-up">
                    <div class="review p-4">
                        <div class="person">
                            <img src="images/open-book.png" width='100px' height="100px">
                            <div class="text ms-3">
                                    <h6 class="mb-2" style="color:#bd9e55"><?php echo $searching["book_name"]?></h6>
                                    <small><a href="view_book.php?bookid=<?php echo $searching["id"]?>" class="btn btn-light btn-sm" >VIEW</a></small>
                            </div>
                        </div>                
                    </div>
                </div>

            <?php
            }
        }
        ?>
</div>
        </div>
    </div>
    <button id="goUpBtn" class="goBtn" style="border-radius: 50%;"><i class="fas fa-arrow-up"></i></button>
    <button id="goDownBtn" class="goBtn" style="border-radius: 50%;"><i class="fas fa-arrow-down"></i></button>
    </section>
 
    <!--  -->

    <!--footer-->
        <footer class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0">Powered by Synercom Limited</p>
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

        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script> -->
        <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="nttps://ajax.goggleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
        <script src="jquery.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="javascript/index.js"></script>
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