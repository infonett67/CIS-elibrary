<?php
session_start();
    require_once("classes/Admin.php");
    require_once("classes/Users.php");


    
$userid = $_POST["user_id"];

$users= new Users();
$show = $users->select_user_details($userid);
// echo "<pre>";
// print_r($show);
// echo "</pre>";
// exit();

foreach($show as $values){?>
<table border="0" width=100%>
    <tr>
        <td width="300"><img src="<?php echo $values['user_profile_pic']?>" width="300" height="300" alt="No picture">
        <td style="padding:20px">
        <p><b>Name :</b> <?php echo $values['user_name']?> </p>
        <p><b>Email:</b> <?php echo $values['user_email']?> </p>
        <p><b>Cis No:</b><?php echo $values['cis_no']?> </p>
        

    </tr>
</table>
<?php }

?>