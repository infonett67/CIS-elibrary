<?php
session_start();
require_once("classes/Admin.php");
require_once("classes/Users.php");
require_once("config.php");

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

 $con=mysqli_connect('localhost','root','','cis_lib');

 if(isset($_GET['id'])){
     $id=mysqli_real_escape_string($con,$_GET['id']);
     $type=mysqli_real_escape_string($con,$_GET['type']);
     if($type=='active'){
         $status=1;
     }else{
         $status=0;
     }
     mysqli_query($con,"update user_table set status='$status' where user_id='$id'");
 }


if(isset($_POST['create_user'])){

    $email = $_POST['email'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    
    $new_user = new Users();
    $create = $new_user->create_user($name,$email,$location,$cis);
}
$users = new Users;
$all_users = $users->select_all();
$all_admin = $users->select_all_admin();
if(isset($_POST['view_user'])){
    $user_details = $users->select_user_details($all_users['user_id']);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
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
    
<div class="container-fluid">
    <div class="flex">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5">
                    <table class="table table-bordered p-3 m-3">
                        <thead>
                            <tr>
                                <th colspan="4">USERS</th>
                            </tr>
                        </thead>

                            <tr class="table-primary">
                                <th>Name</th>
                                <th>Email</th>
                                <th>CIS number</th>
                                <th>Number of Books</th>
                                <th>Payment status</th>
                                <th colspan="2">ACTION</th>

                            </tr>
                        
                            <tbody>
                                <?php
                                    if (count($all_users)<1){?>
                                    <td class="text-danger text-center">NO CONTACTS to display</td>
                                <?php }?>
                                <?php foreach($all_users as $all_users){?>
                                    <tr>
                                        <td><?php echo $all_users["user_name"]?></td>
                                        <td><?php echo $all_users["user_email"]?></td>
                                        <td><?php echo $all_users["cis_no"]?></td></td>
                                        <td></td>
                                        
                                        <td class="text-center">
                                        <?php
                                        if($all_users['status']==1){
                                            echo "<a href='?id=".$all_users['user_id']."&type=deactive' class='btn btn-primary'>Active</a>";
                                        }else{
                                            echo "<a href='?id=".$all_users['user_id']."&type=active' class='btn btn-warning'>Deactive</a>";
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <button data-id="<?php echo $all_users['user_id']; ?>" type="button" name="view_work" class="view_work btn btn-dark btn-sm " data-bs-toggle="modal" data-bs-target="#viewwork" id="<?php echo $all_users["user_id"]?>">
                                                    VIEW
                                                </button>
                                            </form>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                    <table class="table table-bordered p-4 m-4">
                        <thead>
                            <tr>
                                <th colspan="4">ADMIN</th>
                            </tr>
                        </thead>

                            <tr class="table-primary">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Cis_no</th>
                                <th>Number of Books</th>
                            </tr>
                        
                            <tbody>
                            <?php
                                    if (count($all_admin)<1){?>
                                    <h1 class="text-danger text-center">NO CONTACTS to display</h1>
                                <?php }?>
                                <?php foreach($all_admin as $all_admin){?>
                                    <tr>
                                        <td><?php echo $all_admin["admin_name"]?></td>
                                        <td><?php echo $all_admin["admin_email"]?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 ">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                CREATE USER
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">USER CREATION</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="cisno" class="form-label">CIS No</label>
                                    <input type="text" class="form-control" id="cisno" aria-describedby="emailHelp" name="cisno">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" name="location" id="location" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success" name="create_user">SUBMIT</button>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                



            </div>

        </div>

        <?php
        foreach($all_users as $values){
      ?>
                      <div class="modal fade" id="viewwork" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 10000;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                   <h5 class="modal-title" id="staticBackdropLabel">UPLOAD FORM</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>


    </div>
</div>


<script src="jquery.min.js"></script>
<script src="javascript/admin_script.js"></script>
<script src="javascript/admin_style.js"></script>

<script type="text/javascript" language="javascript">

      $(document).ready(function() {

        $('.view_work').click(function(){

            var userid = event.target.id;
            

            $.ajax({
              url:'ajaxfile.php',
              type: "post",
              data: {user_id:userid},
              success :function(response){
                  $(".modal-body").html(response);
                  $(".viewwork").modal('show');
              }
            })


        })
    })
</script>
</body>
</html>