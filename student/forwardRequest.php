<!-- This file will insert request infos to the database -->


<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


  if(!empty($_POST)){
      

        $LRN = $_POST["lrn"];
        $Height = $_POST["height"];
        $Weight = $_POST["weight"];
        $Street = $_POST["street"];
        $Barangay = $_POST["brgy"];
        $City = $_POST["city"];
        $Province = $_POST["province"];

        $Mobile = $_POST["mobileno"];
        $Email = $_POST["email"];
    
        $GAddress = $_POST["gaddress"];
        $GContact = $_POST["gcontact"];
        
    }else{
        echo "NO DATA LOADED";
    }


require ('../config.php');
    $StudentNo = $_SESSION['LRN'];
    $index = 1;
    $x = 0;

    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// LRN Weight  Height  Street  Barangay  City  Province  Tele_num  Email Mobile_num  Guardian_contact  Guardian_address  

    $height = number_format($Height, 2);
    $weight = number_format($Weight, 2);

$sql = "INSERT INTO student_update (LRN, Weight, Height, Street, Barangay, City, Province, Email, Mobile_num , Guardian_contact,  Guardian_address) VALUES ('$LRN', '$weight', '$height', '$Street', '$Barangay', '$City', '$Province', '$Email','$Mobile', '$GContact', '$GAddress')";

if ($conn->query($sql) === TRUE) {
 
header('Location: profile.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>


