<?php
session_start();
require_once("classes/Admin.php");

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
$admin = new Admin();
$categorys = $admin->fetch_categories();

if(isset($_POST["btn_addcat"])){
    $category_name = $_POST["category"];
    if(empty($category_name)){
        echo "Input correctly";
    }

    $new_Category = new Admin();
    $new=$new_Category->add_category($category_name);
    
}

if(isset($_POST["btndelete"])){
    $category = $_POST['categorydel'];
    $del = new Admin();
    $deleteCon = $del->delete_category($category);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Category</title>
    <link href="bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css'>
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <link href="fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
    <link rel="stylesheet" type="text/css" href="css/admin_dash.css">
    <script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">                        
                <p class="text-center">
                            <strong>Add categories</strong>
                        </p>
                        <form class="form-control mx-auto w-50" action="process/controller.php" method="post">
                            <label class="pt-2 pb-4 text-center">Enter a category</label>
                            <input class="form-control" type="text" id="category" placeholder="Enter a category" name="category">
                            <br>
                            <input type="button" class="form-control  btn btn-primary"  value="Add a category">
                            <div class="error pt-2"></div><div class="pt-2 success"></div>
                        </form></div>
            <div class="col-md-8">
                <table class="table table-border">
                    <thead>
                        <tr>
                        
                        <th scope="col">NAME</th>
                        <th scope="col">Book Count</th>
                        
                        <!-- <th><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        ADD CATEGORY
                                        </button></th> -->
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                        if(count($categorys) < 1){?>
                        <h1 class="text-danger text-center">NO Categories to diksplay</h1>
                        <?php }?>
                        <?php foreach($categorys as $category){?>
                            
                        <tr>
                        
                        <td><?php echo $category["cat_name"]?></td>    

                        <td>
                            <?php 
                              $conn = new mysqli('localhost', 'cislqikb_cislib', 'Superman56!@', 'cislqikb_cislib');

                              if ($conn->connect_error) {
                                  die("Connection failed: " . $conn->connect_error);
                              }
                              $categoryid = $category["id"];
                              $sql = "SELECT COUNT(*) AS count FROM books JOIN book_category ON books.book_cat_id=book_category.id WHERE books.book_cat_id=$categoryid";
          
                              $result = $conn->query($sql);
          
                              if ($result->num_rows > 0) {
                                  // Output the book count
                                  $results = $result->fetch_assoc();
                                  $count = $results['count'];
                                  echo $count;
                              } else {
                                  echo "0";
                              }
          
                              // Close the database connection
                              $conn->close();
                            ?>
                        </td>
                        </tr>

                        <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="col-md"></div>
        </div>
        

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <label for="" class="form-label m-3"> ADD CATEGORY</label>
            <input type="text" name="category" id="add_cat" class="form-control m-2">
            <button type="submit" class="btn btn-secondary" name="btn_addcat">SUBMIT</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <script src="jquery.min.js"></script>           
    <script src="javascript/admin_style.js"></script>
    <script type="text/javascript">
                        
                        function addcategory(){
                            var x = $('#category').val();
                            var input = {
                                "category" : x,
                                "action" : 'addcategory'
                            

                            };
                            $.ajax({
                                url : 'process/controller.php',
                                type : 'POST',
                                dataType : "json",
                                data : input,
                                success : function(response)
                                {
                                    var response = JSON.parse(response)
                                    $('.success').html(response.message).show();
                                    $('.error').hide();
                                    alert(response);
                                },
                                error : function(response)
                                {
                                    console.log(error);
                                     $('.error').html("Category already exist.").show();
                                     $('.success').hide();
                                     alert(error);
                                }
                            });
                            
                        }
                       
                    </script>
                </div>
            </div>
        </div>
    </div>
        
    <script src="jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>