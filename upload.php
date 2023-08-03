<?php
session_start();
require_once("classes/Books.php"); 
require_once("classes/Admin.php");
require_once("classes/DB.php");
require_once("classes/Users.php");
include 'config.php';
// print_r($_FILES);
if ($_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
    $pdf_size = $_FILES['pdf']['size'];
    $filename = time() . '_' . $_FILES['pdf']['name'];
    $destination = 'book_folder/' . $filename;
    // print_r($destination);
    // print_r($filename);
    // exit();
    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $destination)) {
        $conn = new mysqli('localhost', 'root', '', 'cis_lib');

        $stmt = $conn->prepare('INSERT INTO files (file_name) VALUES (?)');
        $stmt->bind_param('s', $filename);
        $stmt->execute();
        $file_id = $stmt->insert_id; // Get the inserted file ID
        $stmt->close();

        $name = $_POST['book_name'];
        $project_category = $_POST["category"];

        if (empty($name) || empty($project_category)) {
            echo "Name, author, and category fields are required.";
            exit();
        } 

        // Insert book details into the database
        $stmt = $conn->prepare('INSERT INTO books (book_name,filename, book_size, book_cat_id,file_id) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssii', $name, $destination,$pdf_size, $project_category,$file_id,);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo "$filename uploaded successfully.";
    } else {
        echo "Error uploading file.";
        exit();
    }
    header("location: admin_books.php");
    exit();
}
?>
