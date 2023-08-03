<?php
include_once ("config.php");

$enroll = $_GET['en'];

$sql = " UPDATE user_table SET `status` = 1 WHERE  = $enroll ";

mysqli_query($conn,$sql);

header("location: admin_users.php");














?>