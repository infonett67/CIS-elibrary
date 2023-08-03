<?php 
session_start();
require_once("classes/Admin.php");
require_once("classes/Users.php");
require_once("classes/Books.php");

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

$books = new Books();
$all_books = $books->select_all_books();

$cat = new Admin();
$all_cat = $cat->fetch_categories();

$recent_books = new Books();
$recent = $recent_books->new_books();

if(isset($_POST["btn_search"])){

   $search= $_POST["search"];

   $books = new Books();
   $all_books = $books->select_all_books();
   $all= $books->check_if_book_exist($search);

   $cat = new Admin();
   $all_cat = $cat->fetch_categories();
   $allCat = $cat->check_if_category_exist($search);

   if($all<=0|| $allCat<=0){
      echo "Work doesnt exist";
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
   <title>Home</title>
   <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
   <link rel="stylesheet" href="style.css">
   <!-- <link rel="stylesheet" href="bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css"> -->
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" /> -->

   <link href="fontawesome/css/all.min.css" rel="stylesheet">
   <link href="fontawesome/css/solid.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
   <!-- <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'> -->
   <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
   <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
   <!-- <link href="fontawesome/css/all.min.css" rel="stylesheet"> -->
   <!-- <link href="fontawesome/css/solid.min.css" rel="stylesheet"> -->
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
      .home{
         min-height: 70vh;
         background:linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url(images/book.jpg) no-repeat;
         background-size: cover;
         background-position: center;
         display: flex;
         align-items: center;
         justify-content: center;
      }

      .home .content{
         text-align: center;
         width: 60rem;
      }

      .home .content h3{
         font-size: 5.5rem;
         color:#fff;
         text-transform: uppercase;
      }

      .home .content p{
         font-size:1.8rem;
         color:grey;
         padding:1rem 0;
         line-height: 1.5;
      }
      .about .flex{
      max-width: 1200px;
      margin:0 auto;
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      }


      .about .flex .image{
         flex:1 1 40rem;
      }

      .about .flex .image img{
         width: 100%;
      }

      .about .flex .content{
         flex:1 1 40rem;
         padding:2rem;
         background-color: #ccc;
      }

      .about .flex .content h3{
         font-size: 3rem;
         color:#000;
         text-transform: uppercase;
      }

      .about .flex .content p{
         padding:1rem 0;
         line-height: 2;
         font-size: 1.7rem;
         color:#fff;
      }
      .home-contact{
         background-color: #1107fe;
      }

      .home-contact .content{
         max-width: 60rem;
         text-align: center;
         margin:0 auto;
      }

      .home-contact .content h3{
         font-size: 3rem;
         text-transform: uppercase;
         color:#fff;
      }

      .home-contact .content p{
         padding:1rem 0;
         line-height: 1.5;
         color:#fff;
         font-size: 1.7rem;
      }
         .wrapper {
      max-width: 1150px;
      width: 100%;
      position: relative;
      padding-left: 20px;
      margin-left: 40px;
      }
         .wrapper i {
      top: 50%;
      height: 50px;
      width: 50px;
      cursor: pointer;
      font-size: 1.25rem;
      position: absolute;
      text-align: center;
      line-height: 50px;
      background: #fff;
      border-radius: 50%;
      box-shadow: 0 3px 6px rgba(0,0,0,0.23);
      transform: translateY(-50%);
      transition: transform 0.1s linear;
      }
      .wrapper i:active{
      transform: translateY(-50%) scale(0.85);
      }
      .wrapper i:first-child{
      left: -30px;
      }
      .wrapper i:last-child{
      right: -22px;
      }
      .wrapper .carousel{
      display: grid;
      grid-auto-flow: column;
      grid-auto-columns: calc((100% / 3) - 12px);
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      gap: 16px;
      border-radius: 8px;
      scroll-behavior: smooth;
      scrollbar-width: none;
      }
      .carousel::-webkit-scrollbar {
      display: none;
      }
      .carousel.no-transition {
      scroll-behavior: auto;
      }
      .carousel.dragging {
      scroll-snap-type: none;
      scroll-behavior: auto;
      }
      .carousel.dragging .card {
      cursor: grab;
      user-select: none;
      }
      .carousel :where(.card, .img) {
      display: flex;
      justify-content: center;
      align-items: center;
      }
      .carousel .card {
      scroll-snap-align: start;
      height: 342px;
      list-style: none;
      background: #fff;
      cursor: pointer;
      padding-bottom: 15px;
      flex-direction: column;
      border-radius: 8px;
      }
      .carousel .card .img {
      background: #fff;
      height: 148px;
      width: 148px;
      border-radius: 50%;
      }
      .card .img img {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      }
      .carousel .card h2 {
      font-weight: 200px;
      font-size: 1.42rem;
      margin: 30px 0 5px;
      }
      .carousel .card span {
      color: #6A6D78;
      font-size: 1.31rem;
      }

      @media screen and (max-width: 900px) {
      .wrapper .carousel {
         grid-auto-columns: calc((100% / 2) - 9px);
      }
      }

      @media screen and (max-width: 600px) {
      .wrapper .carousel {
         grid-auto-columns: 100%;
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
                        <button class="nav-link btn" name="logout">Sign Out</button>
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


<section class="home mb-5">

   <div class="content">
      <h3>HERE LIES INSIDE THE MINDS OF MANY MEN.</h3>
      <p>Explore and gain from their wisdom.</p>
      <a href="browser.php" class="white-btn btn btn-secondary">discover more</a>
   </div>

</section>


<!-- <div class="container-fluid mb-3">
   <div class="row">
      <div class="col-md-12">
      <section id="about" class="bg-cover" style="background-image: url(img/cover_3.jpg);">
         <div class="overlay"></div>
         <div class="container text-white text-center">
               <form action="" method="post">
                  <label for="">Search Here</label>
                  <input type="search" name="search" id="search" class="form-control">
                  <button type="submit" name="btn_search" class="btn btn-secondary m-3" id="searchbtn">Search</button>
               </form>
         </div>
      </section>
         </div>
   </div>
</div> -->


<!-- <div class="container-fluid" id="all_books">
   <div class="row row-cols-1 row-cols-md-2 g-4">
     
         
         <div class="col">
            <div class="card">
               <h1 class="ms-5"><i class="fas fa-book"></i></h1>
               <div class="card-body">
                  <h5 class="card-title"></h5>

                  
               </div>
            </div>
         </div>
   </div>
</div> -->


<div class="wrapper">
   <h2 class="m-5 p-2" >LATEST BOOKS</h2>
   <i id="left" class="fa-solid fa-angle-left"></i>
   <ul class="carousel">
      <?php foreach ($recent as $recent){?>
      <li class="card">
         <div class="img"><img src="images/open-book.png" alt=""></div>
         <h2><?php echo $recent["book_name"]?></h2>
         <a href="view_book.php?bookid=<?php echo $recent["id"]?>" class="btn btn-dark">VIEW BOOK</a>
      </li>

      <?php }?>
      <!-- <li class="card">
         <div class="img"><img src="images/img-2.jpg" alt="img" draggable="false"></div>
         <h2>Joenas Brauers</h2>
         <span>Web Developer</span>
      </li>
      <li class="card">
         <div class="img"><img src="images/img-3.jpg" alt="img" draggable="false"></div>
         <h2>Lariach French</h2>
         <span>Online Teacher</span>
      </li>
      <li class="card">
         <div class="img"><img src="images/img-4.jpg" alt="img" draggable="false"></div>
         <h2>James Khosravi</h2>
         <span>Freelancer</span>
      </li>
      <li class="card">
         <div class="img"><img src="images/img-5.jpg" alt="img" draggable="false"></div>
         <h2>Kristina Zasiadko</h2>
         <span>Bank Manager</span>
      </li>
      <li class="card">
         <div class="img"><img src="images/img-6.jpg" alt="img" draggable="false"></div>
         <h2>Donald Horton</h2>
         <span>App Designer</span>
      </li> -->
   </ul>
   <i id="right" class="fa-solid fa-angle-right"></i>
</div>


<section class="about mt-4">
      <div class="row ">
         <div class="flex">
                  <div class="col-md-6">
                     <div class="image">
                        <img src="images/about-img.jpg" alt="">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="content">
                        <h3>Categories</h3>
                        <p>Explore a wide range of categories to choose FROM....</p>
                        <a href="category.php" class="btn btn-dark">read more</a>
                     </div>
            </div>
         </div>
      </div>
   
      
      <!-- <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>Categories</h3>
         <p>Explore a wide range of categories to choose FROM....</p>
         <a href="category.php" class="btn">read more</a>
      </div>

   </div> -->

</section>
<!--  -->
<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>Direct your questions here!!!!!</p>
      <a href="contact.php" class="white-btn btn btn-light">contact us</a>
   </div>

</section>
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
      <script src="jqueryanimation.js"></script>
      <!-- <script src="javascript/index.js"></script> -->
      <script src="scripte.js"></script>
      <script type="text/javascript" language="javascript">
         $(document).ready(function(){
               
                  // alert('msg');
         })
      </script>
</body>
</html>