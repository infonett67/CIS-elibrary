<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="Hugo 0.88.1">
        <title>CIS INDEX</title>
        <link href="fontawesome/css/all.min.css" rel="stylesheet">
        <link href="fontawesome/css/solid.min.css" rel="stylesheet">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">
        <!-- <link rel="icon" type="image/png" sizes="16x16" href="fav/favicon-16x16.png"> -->
        <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
        <!-- <link rel="icon" type="image/png" sizes="96x96" href="fav/favicon-96x96.png"> -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
            <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/carousel.css">

        <!-- Bootstrap core CSS -->
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <!-- <link rel="stylesheet" href="css/indespage.css"> -->
        <style>
            @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

            * {
                box-sizing: border-box;
            }

            body{
                    font-family: 'Montserrat', sans-serif;
                    font-size: 10px;
                    line-height: 1.5;
                    height: 100vh;
            } 

            h1,h2,h3,h4,h5,h6 {
                font-weight: 900 !important;
            }

            a {
                text-decoration: none;
                transition: all 0.4s ease;
                font-weight: 10;
                color: #bd9e55;
            }
            
            img {
                width: 100%;
                /* height: 100px; */
            }

            section {
                /* padding-top: 20px; */
                /* padding-bottom: 20px; */
                z-index: 2;
                position: relative;
            }

            .navbar {
                box-shadow: 0 12px 20px rgba(0,0,0,0.1);
            }

            .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .show>.nav-link {
                background: -webkit-linear-gradient(#260269, #bd9e55);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            footer {
                background: linear-gradient(to right,#260269, #bd9e55);
                color: #fff;
            }
            footer a {
                color: #fff;
            }


        </style>
    </head>

    <body data-bs-spy="scroll" data-bs-target="navbar">
    
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white" data-aos="fade-down">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="images/cis-100-dark-1.png" alt="" width=100px class="bg-light" height="70px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#home"><i class="fa-solid fa-arrow-left"></i>BACK TO HOME PAGE</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> USER LOG IN</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="login_page.php">Member login</a></li>
                                <li><a class="dropdown-item" href="registeruser.php">Member registration</a></li>
                                <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                            </ul>
                        </li>
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" id="member" data-bs-toggle="dropdown" aria-expanded="false">CIS ADMIN</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="member">
                                <li><a class="dropdown-item" href="adminlogin.php">Admin Login</a></li>
                                <li><a class="dropdown-item" href="adminreg.php">Admin registration</a></li>
                                <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                            </ul>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>

        <!--hero-->
        <!-- <div class="container-fluid"> -->
        <!-- <section id="home" class="bg-cover hero-section mt-5">
            <div class="overlay"></div>
            <div class="container text-white text-center">
                <h1 class="text-dark" style="padding-top: 100px;">WELCOME TO CIS e-Library</h1>
                <div class="row" style="width:100%;margin-top:20px;margin-bottom:40px ;height:350px">
                    <div class="col-md-12 bg-cover">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="images/carousel1.png" class="d-block w-100" height="350px" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/carousel2.png" class="d-block w-100" height="350px" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/carousel3.png" class="d-block w-100" height="350px" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/carousel4.png" class="d-block w-100"  height="350px" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/carousel5.png" class="d-block w-100" height="350px" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- </div> -->
        <section class="home">
            <hr>
        <h1 class="text-dark text-center" style="padding-top: 100px;">WELCOME TO CIS e-Library</h1>
  <div id="carousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-controls">
    <ol class="carousel-indicators">
      <li data-target="#carousel" data-slide-to="0" class="active" style="background-image:url('images/anniversary.jpg')"></li>
      <li data-target="#carousel" data-slide-to="1" style="background-image:url('images/carousel2.png')"></li>
      <li data-target="#carousel" data-slide-to="2" style="background-image:url('images/carousel3.png')"></li>
      <li data-target="#carousel" data-slide-to="3" style="background-image:url('images/carousel4.png')"></li>
      <li data-target="#carousel" data-slide-to="4" style="background-image:url('images/carousel5.png')"></li>
      <li data-target="#carousel" data-slide-to="5" style="background-image:url('images/team.jpg')"></li>
      <li data-target="#carousel" data-slide-to="6" style="background-image:url('images/training.jpg')"></li>
      <li data-target="#carousel" data-slide-to="7" style="background-image:url('images/office.jpg')"></li>
      <li data-target="#carousel" data-slide-to="8" style="background-image:url('images/carousel1.png')"></li>
      
    </ol>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
     <img src="images/left-arrow.svg" alt="Prev"> 
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <img src="images/right-arrow.svg" alt="Next">
  </a>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" style="background-image:url('images/anniversary.jpg')">
      <div class="container">
         
      </div>
    </div>
    <div class="carousel-item" style="background-image:url('images/carousel2.png')">
      <div class="container">
         
      </div>
    </div>
    <div class="carousel-item" style="background-image:url('images/carousel3.png')">
      <div class="container">
        
      </div>
    </div>
    <div class="carousel-item" style="background-image:url('images/carousel4.png')">
      <div class="container">
        
      </div>
    </div>
    <div class="carousel-item" style="background-image:url('images/carousel5.png')">
      <div class="container">
        
      </div>
    </div>
    <div class="carousel-item" style="background-image:url('images/team.jpg')">
      <div class="container">
        
      </div>
    </div>
    <div class="carousel-item" style="background-image:url('images/training.jpg')">
      <div class="container">
        
      </div>
    </div>
    <div class="carousel-item" style="background-image:url('images/office.jpg')">
      <div class="container">
        
      </div>
    </div>
    <div class="carousel-item" style="background-image:url('images/carousel1.png')">
      <div class="container">
        
      </div>
    </div>
    
  </div>
</div>
 </section>

        <footer class="py-4">
            <div class="container">
                <div class="row" >
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


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="javascript/index.js"></script>
        <script src="javascript/bootstrap.bundle.min.js"></script>
    </body>
</html>
