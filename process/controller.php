<?php
require_once ("../classes/Admin.php");

if(isset($_POST["category"])){
    $categorys = $_POST["category"];
    // echo $categorys;
    // exit();

    $category = new Admin();
    $response = $category->add_category($categorys);

    if($response==1){
        $data = [
             "success" => true,
             "message" => "Category created successfully"
        ];
        $encoded_data = json_encode($data);
        return $encoded_data;
    }
    else{
        $data = [
            "success" => false,
            "message" => $response
        ];
        $encoded_data = json_encode($data);
        return $encoded_data;
    }
}






?>
