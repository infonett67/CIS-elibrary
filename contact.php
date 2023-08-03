<?php 
    session_start();
    require_once("classes/Admin.php");
    require_once("classes/Users.php");
    require_once("classes/Books.php");

    if (!isset($_SESSION['is_logged_in'])) 
    {
        header("location: login_page.php");
    }

    if (isset($_POST['logout'])) 
    {
        if(isset($_SESSION["user_id"]))
        {
            session_destroy();
                header("location: login_page.php");
            exit();
        }
    }
    
    if(isset($_POST['send'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $messages = $_POST['message'];

        $newmessage = new Users();
        $insertmessage = $newmessage->insert_message($name,$email,$messages);
    }


    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Browser</title>
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
            .heading{
            min-height: 30vh;
            display: flex;
            flex-flow: column;
            align-items: center;
            justify-content: center;
            gap:1rem;
            background: url(images/unsplash-photo-3.jpg) no-repeat;
            background-size: cover;
            background-position: center;
            text-align: center;
            }

            .heading h3{
            font-size: 5rem;
            color:var(--black);
            text-transform: uppercase;
            }

            .heading p{
            font-size: 2.5rem;
            color:var(--light-color);
            }

            .heading p a{
            color:var(--purple);
            }

            .heading p a:hover{
            text-decoration: underline;
            }
            .contact form{
            margin:0 auto;
            background-color: var(--light-bg);
            border-radius: .5rem;
            border:6px solid black;
            padding:2rem;
            max-width: 50rem;
            margin:0 auto;
            text-align: center;
            }

            .contact form h3{
            font-size: 2.5rem;
            text-transform: uppercase;
            margin-bottom: 1rem;
            color:grey !important;
            }

            .contact form .box{
            margin:1rem 0;
            width: 100%;
            border:1px solid #1107fe;
            background-color: #fff;
            padding:1.2rem 1.4rem;
            font-size: 1.8rem;
            color:#000;
            border-radius: .5rem;
            }

            .contact form textarea{
            height: 20rem;
            resize: none;
            }
        </style>
    </head>
    <body data-bs-spy="scroll" data-bs-target=".navbar">
    <!-- style="background-color:#1107fe" -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white text-dark" >
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

    <div class="heading">
        <h3>contact us</h3>
        <p> <a href="home.php">home</a> / contact </p>
    </div>

    <section class="contact">

        <form action="" method="post">
            <h3>say something!</h3>
            <input type="text" name="name" required placeholder="enter your name" class="box">
            <input type="email" name="email" required placeholder="enter your email" class="box">
            <!-- <input type="number" name="number" required placeholder="enter your number" class="box"> -->
            <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn btn-primary">
        </form>

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