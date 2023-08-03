<?php
if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Retrieve file details from the database
    $conn = new mysqli('localhost', 'root', '', 'cis_lib');
    $stmt = $conn->prepare('SELECT file_name FROM files WHERE file_id = ?');
    $stmt->bind_param('i', $fileId);
    $stmt->execute();
    $stmt->bind_result($filename);
    $stmt->fetch();
    $stmt->close();
    $conn->close();


    if ($filename) {
        $filePath = 'book_folder/' . $filename;

        if (file_exists($filePath)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit();
        }
    }
}
// echo($filename);
// exit();
header('Location: index.php'); // Redirect back to the main page if the file is not found
exit();
?>
