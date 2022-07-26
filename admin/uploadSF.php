<?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'users_db');

$sql = "SELECT * FROM sffiles";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Uploads files
if (isset($_POST['upload'])) { // if save button on the form is clicked
    // name of the uploaded file
    $sfNumber =  $_REQUEST['sfNo'];
    $sfTitle = $_REQUEST['title'];
    $sfdesc =  $_REQUEST['sfdesc'];
    $preppedby = $_REQUEST['prepBY'];
    $sfMode = $_REQUEST['prepMode'];
    $sfsched = $_REQUEST['sfsched'];
    $filename = $_FILES['file']['name'];

    // destination of the file on the server
    $destination = 'SFUploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO sffiles  VALUES ('$sfNumber', '$sfTitle','$sfdesc','$preppedby','$sfMode','$sfsched','$filename')";
            if (mysqli_query($conn, $sql)) {
                echo "File uploaded successfully";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}
 // Close connection
mysqli_close($conn);
?>
