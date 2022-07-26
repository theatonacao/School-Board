
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


require ('../config.php');
    $StudentNo = $_SESSION['LRN'];
    $index = 1;
    $x = 0;

    //connect to database
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


    // $sql = "SELECT * FROM profile_img";
    // $result = mysqli_query($conn, $sql);

    // while($files = $result->fetch_array())
    // {
    // $rows[] = $files;
    // }  



    // Uploads files
    //if (isset($_POST['upload'])) { // if save button on the form is clicked
        // name of the uploaded file
        $existing = $_POST['imgstatus'];
        $e_filename = $_FILES['file']['name'];

        // destination of the file on the server
        //$destination = 'profileimg/' . $e_filename;
        //echo $destination;

        // get the file extension
        $extension = pathinfo($e_filename, PATHINFO_EXTENSION);

        // the physical file on a temporary uploads directory on the server
        $file = $_FILES['file']['tmp_name'];
        $size = $_FILES['file']['size'];

       if ($_FILES['file']['size'] > 25000000) {// file shouldn't be larger than 25Megabyte
           // echo "Image too large!";
            echo '<script type="text/javascript">';
            echo ' alert("File too large! Choose a different image.")';  //not showing an alert box.
            echo '</script>';
        }else {

            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = $StudentNo . '.' . end($temp);
            $destination = 'profileimg/' . $newfilename;

            //move_uploaded_file($file, "../img/imageDirectory/" . $newfilename);


            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {

                //insert if not in table
                if($existing==0){
                $sql = "INSERT INTO profile_img  VALUES ('$StudentNo',1,'$newfilename')";
                    if (mysqli_query($conn, $sql)) {
                        echo '<script type="text/javascript"> alert("File uploaded successfully")</script>';
                         header("location: profile.php");
                    }
                }else if($existing==1){

                    $sql ="UPDATE profile_img
                    SET profile_img.file_name = '$newfilename' 
                    WHERE profile_img.LRN = $StudentNo" ;

                    if( $conn->query($sql)===TRUE){
                        echo '<script type="text/javascript">alert("File uploaded successfully")</script>';
                        header("location: profile.php");
                    }
                }
                
            }else {
                    echo "Failed to upload file.";
                    echo '<script type="text/javascript">';
                    echo ' alert("Failed to upload file diri nisulod.")';  //not showing an alert box.
                    echo '</script>';
            }
        }
//}

     // Close connection
 mysqli_close($conn);  

 ?> 