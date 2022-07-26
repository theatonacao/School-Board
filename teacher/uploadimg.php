<?php 
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'schoolBoard';
$DATABASE_PASS = '54HPneK7CC9NLhj';
$DATABASE_NAME = 'schoolBoard_database';
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$employeenum = $_SESSION['name'];

$existing = $_POST['imgstatus'];
$e_filename = $_FILES['file']['name'];
$extension = pathinfo($e_filename, PATHINFO_EXTENSION);
$file = $_FILES['file']['tmp_name'];
        $size = $_FILES['file']['size'];

if ($_FILES['file']['size'] > 25000000) {// file shouldn't be larger than 25Megabyte
           // echo "Image too large!";
            echo '<script type="text/javascript">';
            echo ' alert("File too large! Choose a different image.")';  //not showing an alert box.
            echo '</script>';
        }else {

            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = $employeenum . '.' . end($temp);
            $destination = 'teacherimg/' . $newfilename;

            //move_uploaded_file($file, "../img/imageDirectory/" . $newfilename);


            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {

                //insert if not in table
                if($existing==0){
                $sql = "INSERT INTO teacher_img  VALUES ('$',1,'$newfilename')";
                    if (mysqli_query($conn, $sql)) {
                        echo '<script type="text/javascript"> alert("File uploaded successfully")</script>';
                         header("location: profile.php");
                    }
                }else if($existing==1){

                    $sql ="UPDATE teacher_img
                    SET teacher_img.file_name = '$newfilename' 
                    WHERE profile_img.LRN = $employeenum" ;

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