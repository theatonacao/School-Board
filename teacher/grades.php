<?php 
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}


$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'schoolBoard';
$DATABASE_Passed = '54HPneK7CC9NLhj';
$DATABASE_NAME = 'schoolBoard_database';
$year = $_SESSION['year'];
$section = $_SESSION['advisorysec']; 
/*$StudentNo = $_POST['lrn'];*/
$_SESSION['temp_username'] = $_POST['lrn'];
$StudentNo = $_SESSION['temp_username'];
$index = 1;
$x = 0;

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_Passed, $DATABASE_NAME);

$sql = "SELECT student_info.*, student_contact.*, student_year.*, student_guardian_info.*, student_guardian_contact.* FROM student_info
        INNER JOIN student_contact ON  student_contact.LRN = student_info.LRN
        INNER JOIN student_year ON student_year.LRN = student_contact.LRN
        INNER JOIN student_guardian_info ON student_guardian_info.LRN = student_contact.LRN
        INNER JOIN student_guardian_contact ON student_guardian_contact.LRN = student_contact.LRN
        WHERE student_info.LRN = '$StudentNo'";

    $result = mysqli_query($conn, $sql);

     if($result->num_rows > 0){
    // output data of each row
    while($row = $result->fetch_assoc() ) {
        $LRN = $row["LRN"];
        $Lastname = $row["Lastname"];
        $Firstname = $row["Firstname"];
        $Middlename = $row["Middlename"];
        $Ext = $row["Extension"];
        $Grade = $row["Year_lvl"];
        $Section = $row["Section"];
        $Adviser = $row["Adviser_name"];
        
        $Gender = $row["Sex"];
        $Birthdate = $row["Birthdate"];
        $Mothertongue = $row["Mothertongue"];
        $Ethnicity = $row["Ethnic"];
        $Religion = $row["Religion"];
        $Citizenship = $row["Citizenship"];
        $Status = $row["Status"];

        $Street = $row["Street"];
        $Barangay = $row["Barangay"];
        $City = $row["City"];
        $Province = $row["Province"];

        $Mobile = $row["Mobile_num"];
        $Email = $row["Email"];
        $Mother = $row["Mother_name"];
        $Father = $row["Father_name"];
        $GAddress = $row["Guardian_address"];
        $GContact = $row["Guardian_contact"];
        }
        // $year = $row['Year_lvl'];
    }else{
        echo '<br>';    
        echo "<h4>Student information for ".$StudentNo." is empty. </h4>";
    }
    
//mysqli_close($conn)
?>
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->

    <link rel="stylesheet" href="welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <style type="text/css">
      table, th, td {
              border: 1px solid;
              border-collapse: collapse;
            }

            table{
              align-self: center;
              margin-top: 1px;
            }

            td{
              height: 5px;
              padding: 3px;
              align-content: center;
            }
     </style>
     <title>School Board</title>
		<link href="style.css" rel="stylesheet" type= "text/css">
		<link rel="icon" href="images/SB-logo.png">

   </head>
<body>

  <div class="sidebar">
    <div class="logo-details">
      <i><img src="images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" href="profile.php"></i>
      <span class="logo_name" href="profile.php" >SchoolBoard</span>
    </div>
      <ul class="nav-links">
        
        <li>
          <a href="profile.php">
            <i class='bx bx-group' ></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
        <li>
          <a href="students.php"  class="active">
            <i class='bx bx-chalkboard' ></i>
            <span class="links_name">Manage Students</span>
          </a>
        </li>
        <li>
          <a href="record.php">
            <i class='bx bx-group' ></i>
            <span class="links_name">Class Record</span>
          </a>
        </li>

        <li>
          <a href="forms.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Form Generator</span>
          </a>
        </li>
      
        <li>
          <a href="reports.php">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Class Reports</span>
          </a>
        </li>
        
        <li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Report Card</span>
      </div>
  
      <div class="profile-details">
        <img src="images/wonwoo.png" alt="">
        

        <a href="logout.php">
            <i class='bx bx-log-out' ></i>
        </a>
        
      </div>
    </nav>

    <div class="home-content">

        
      <script type="text/javascript">
          function confirmFunc(send){
          if(confirm("You are about to set all grades as final for quarter " + send + "\n (NOTE: When grades are set to final you will not be able to update this  student's grade for quarter " + send + ")") == true){
            let ret = 1
            return ret;
          }
          else
          {
            let ret = 0;
            return ret;
          }
          }
      </script>
      
        <div class="sales-boxes">
              <?php 
              $sql_istat = "SELECT LRN, Year_lvl FROM quarter_status WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'";

              $result_istat = $conn->query($sql_istat);

              if($result_istat->num_rows > 0)
              {
                //there is a data
                //do nothing
              }
              else
              {
                //no data
                $data = "Not Final";
                $sql_insstat = "INSERT INTO quarter_status(LRN, Year_lvl, Status_Q1, Status_Q2, Status_Q3, Status_Q4) VALUES ('$StudentNo', '$year', '$data', '$data', '$data', '$data')";
                $res_insstat = $conn->query($sql_insstat);
              }
             ?>
            <?php
             $sql_view = "SELECT Status_Q1, Status_Q2, Status_Q3, Status_Q4 FROM quarter_status WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'"; 
             $retval = mysqli_query($conn, $sql_view);

             if($retval->num_rows > 0){
              while($row = $retval->fetch_assoc())
              {
                $Q1 = $row['Status_Q1'];
                $Q2 = $row['Status_Q2'];
                $Q3 = $row['Status_Q3'];
                $Q4 = $row['Status_Q4'];
              }
             }
            ?> 
               <div class="recent-sales box" style="width:60%;" >
                <!--<div class="title" style="cursor: pointer;"  onclick="history.back()"><i class="bx bxs-left-arrow-circle"></i></div>-->
                <h4>Overview</h4>
                <p>First Quarter: &nbsp;<?php echo $Q1; ?> &nbsp; &nbsp; &nbsp; Second Quarter: &nbsp; <?php echo $Q2; ?></p>
                <p>Third Quarter: &nbsp;<?php echo $Q3; ?> &nbsp; &nbsp; Fourth Quarter: &nbsp; <?php echo $Q4; ?></p>
                       
              </div>
               <div class="recent-sales box" style="width: 40%">
                <h4>Set Grade to Final</h4>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input type="Submit" name="quarter_status" value="Quarter 4"style="height: 10px; margin-left:1px; font-size: 12px; border-radius: 3px; padding: 1em 1em 2em 1em;">
                <input type="Submit" name="quarter_status" value="Quarter 3"style="height: 10px; margin-left:1px; font-size: 12px; border-radius: 3px; padding: 1em 1em 2em 1em;">
                <input type="Submit" name="quarter_status" value="Quarter 2"style="height: 10px; margin-left:1px; font-size: 12px; border-radius: 3px; padding: 1em 1em 2em 1em;">
                <input type="Submit" name="quarter_status" value="Quarter 1"style="height: 10px; margin-left:1px; font-size: 12px; border-radius: 3px; padding: 1em 1em 2em 1em;">

                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                  if(isset($_POST['quarter_status']))
                  {
                    $in_string = "Final";
                    $what_quar = $_POST['quarter_status'];
                    if($what_quar == "Quarter 1"){
                      $in_quarter = 1;
                      $i_status = "UPDATE quarter_status SET quarter_status.Status_Q1 = '$in_string' WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'";
                        $i_result = mysqli_query($conn, $i_status);
                        
                      echo '<script type="text/javascript">';
                      echo 'var ans = 1;';
                      echo 'alert("Grades for quarter " + ans + " is set as final");';
                      echo '</script>';
                     
                    }
                    else if($what_quar == "Quarter 2"){
                      $in_quarter = 2;
                      $i_status = "UPDATE quarter_status SET quarter_status.Status_Q2 = '$in_string' WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'";
                        $i_result = mysqli_query($conn, $i_status);
                      echo '<script type="text/javascript">';
                      echo 'var ans = 2;';
                      echo 'alert("Grades for quarter " + ans + "is set as final");';
                      echo '</script>';
                    }
                    else if($what_quar == "Quarter 3"){
                      $in_quarter = 3;
                      $i_status = "UPDATE quarter_status SET quarter_status.Status_Q3 = '$in_string' WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'";
                        $i_result = mysqli_query($conn, $i_status);
                      echo '<script type="text/javascript">';
                      echo 'var ans = 3;';
                      echo 'alert("Grades for quarter " + ans + " is set as final");';
                      echo '</script>';
                    }
                    else if($what_quar == "Quarter 4"){
                      $in_quarter = 4;
                      $i_status = "UPDATE quarter_status SET quarter_status.Status_Q4 = '$in_string' WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'";
                        $i_result = mysqli_query($conn, $i_status);
                      echo '<script type="text/javascript">';
                      echo 'var ans = 4;';
                      echo 'alert("Grades for quarter " + ans + " is set as final");';
                      echo '</script>';
                    }

                  }//end of inner if
                }
                ?>
              </div>
      </div>
      <br>
        <div class="sales-boxes">
        <div class="recent-sales box" style="width:80%; margin-left: 10px; margin-top: 0px;" >
            <table style="width: 100%; margin-left: 5px; font-size: 14px; margin-top: 0px; font-family: 'Poppins', sans-serif; color: #194e63;">
              <tbody>
                <tr style="height:10px;">
                  <td style="width: 200px;">Learner's Reference Number:</td>
                  <td style="width: 276px;"><?php echo $LRN;?></td>
                </tr>
                <tr style="height:10px;">
                  <td style="width: 200px;">Student Name:</td>
                  <td style="width: 276px;"><?php echo $Lastname; echo ', '.$Firstname." ". $Middlename. " ".$Ext;?>
                     </td>
                </tr>
                <tr style="height:10px;">
                  <td style="width: 200px;">Grade Level:</td>
                  <td style="width: 276px;"><?php echo $year;?></td>
                </tr>
               <tr style="height:10px;">
                  <td style="width: 200px;">Section:</td>
                  <td style="width: 276px;"><?php echo $Section;?></td>
                </tr>
                <tr style="height:10px;">
                  <td style="width: 200px;">Class Adviser:</td>
                  <td style="width: 276px;"><?php echo $Adviser;?></td>
                </tr>
              </tbody>
            </table>

            <!-- Table for the content part of the card -->
            <div id = "card">
            <table style="width: 850px80%; margin-left: 5px; font-size: 13px; margin-top: 2px; font-family: 'Poppins', sans-serif; color: #194e63;">

              <tr style="height:10px;">
                <td style="width: 160px; height: 40px;text-align: center;" rowspan="2">LEARNING AREAS</td>
                <td style="width: 257px;height: 20px;text-align: center;" colspan="4">PERIODIC RATING</td>
                <td style="width: 90px; height: 40px;text-align: center;" rowspan="2">FINAL GRADE</td>
                <td style="width: 97px; height: 40px;text-align: center;" rowspan="2">REMARKS</td>
              </tr>
              <tr style="height:10px;">
                <td style="width: 62px; height: 20px;"text-align: center;>&nbsp;1</td>
                <td style="width: 66px; height: 20px;"text-align: center;>&nbsp;2</td>
                <td style="width: 63px; height: 20px;"text-align: center;>&nbsp;3</td>
                <td style="width: 66px; height: 20px;"text-align: center;>&nbsp;4</td>
              </tr>

              <!-- Filipino -->
             <tr style="height:10px;">
                <td style="width: 141px; height: 20px;">&nbsp;Filipino</td>
                <!-- 1st quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Filipino' AND grades_per_subject.periodic_grading= 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Filipino1 =''; 
                        echo  $Filipino1;
                    }else{
                  if($result->num_rows > 0){
                      while($row = $result->fetch_assoc() ) {
                        $Filipino1= $row["grade"];
                       echo  $Filipino1;
                        }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 2nd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Filipino' AND grades_per_subject.periodic_grading= 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Filipino2 =''; 
                        echo  $Filipino2;
                    }else{
                  if($result->num_rows > 0){
                      while($row = $result->fetch_assoc() ) {
                        $Filipino2= $row["grade"];
                       echo  $Filipino2;
                        }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 3rd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Filipino' AND grades_per_subject.periodic_grading= 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Filipino3 =''; 
                        echo  $Filipino3;
                    }else{
                  if($result->num_rows > 0){
                      while($row = $result->fetch_assoc() ) {
                        $Filipino3= $row["grade"];
                       echo  $Filipino3;
                        }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 4th quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Filipino' AND grades_per_subject.periodic_grading= 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Filipino4 =''; 
                        echo  $Filipino4;
                    }else{
                  if($result->num_rows > 0){
                      while($row = $result->fetch_assoc() ) {
                        $Filipino4= $row["grade"];
                       echo  $Filipino4;
                        }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- Final grade -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    $FilipinoF ='';
                    $flag = 0;
                    if(empty($Filipino1))
                      $flag++;
                    if(empty($Filipino2))
                      $flag++;
                    if(empty($Filipino3))
                      $flag++;
                    if(empty($Filipino4))
                      $flag++;

                    if($flag > 0)
                    {

                    }
                    else
                    {
                    $FilipinoF= 0;
                    $FilipinoF = $Filipino1 + $Filipino2 + $Filipino3 + $Filipino4;
                    $FilipinoF = $FilipinoF/4;
                    echo $FilipinoF;
                    } 
                  ?>

                </td>
                <!-- Remarks -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    if(empty($FilipinoF))
                    {

                    }
                    else
                      {
                        if($FilipinoF == 75)
                      {
                        echo "Passed";
                      }

                      else if($FilipinoF > 75)
                      {
                        echo "Passed";
                      }
                      else{
                        echo "Failed";
                      }
                    }
                  ?>
                </td>
              </tr>
              <!-- English -->
              <tr style="height:10px;">
                <td style="width: 141px; height: 20px;">&nbsp;English</td>
                <!-- 1st quarter -->
                <td style="width: 62px; height: 20px;">
                 <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'English' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $English1=''; 
                        echo  $English1;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $English1= $row["grade"];
                             echo  $English1;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 2nd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'English' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $English2=''; 
                        echo  $English2;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $English2= $row["grade"];
                             echo  $English2;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 3rd quarter -->
                <td style="width: 62px; height: 20px;">
                   <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'English' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $English3=''; 
                        echo  $English3;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $English3= $row["grade"];
                             echo  $English3;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 4th quarter -->
                <td style="width: 62px; height: 20px;">
                   <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'English' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $English4=''; 
                        echo  $English4;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $English4= $row["grade"];
                             echo  $English4;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- Final grade -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    $EnglishF ='';
                    $flag = 0;
                    if(empty($English1))
                      $flag++;
                    if(empty($English2))
                      $flag++;
                    if(empty($English3))
                      $flag++;
                    if(empty($English4))
                      $flag++;

                    if($flag > 0)
                    {

                    }
                    else
                    {
                    $EnglishF= 0;
                    $EnglishF = $English1 + $English2 + $English3 + $English4;
                    $EnglishF = $EnglishF/4;
                    echo $EnglishF;
                    } 
                  ?>
                </td>
                <!-- Remarks -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    if(empty($EnglishF))
                    {

                    }
                    else
                      {
                        if($EnglishF == 75)
                      {
                        echo "Passed";
                      }

                      else if($EnglishF > 75)
                      {
                        echo "Passed";
                      }
                      else{
                        echo "Failed";
                      }
                    }
                  ?>
                </td>
              </tr>
              <!-- Mathematics -->
              <tr style="height: 20px;">
                <td style="width: 141px; height: 20px;">&nbsp;Mathematics</td>
                <!-- 1st quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Math' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Math1=''; 
                        echo  $Math1;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Math1= $row["grade"];
                             echo  $Math1;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 2nd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Math' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Math2=''; 
                        echo  $Math2;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Math2= $row["grade"];
                             echo  $Math2;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 3rd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Math' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Math3=''; 
                        echo  $Math3;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Math3= $row["grade"];
                             echo  $Math3;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 4th quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Math' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Math4=''; 
                        echo  $Math4;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Math4= $row["grade"];
                             echo  $Math4;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- Final grade -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    $MathF ='';
                    $flag = 0;
                    if(empty($Math1))
                      $flag++;
                    if(empty($Math2))
                      $flag++;
                    if(empty($Math3))
                      $flag++;
                    if(empty($Math4))
                      $flag++;

                    if($flag > 0)
                    {

                    }
                    else
                    {
                    $MathF= 0;
                    $MathF = $Math1 + $Math2 + $Math3 + $Math4;
                    $MathF = $MathF/4;
                    echo $MathF;
                    } 
                  ?>
                </td>
                <!-- Remarks -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    if(empty($MathF))
                    {

                    }
                    else
                      {
                        if($MathF == 75)
                      {
                        echo "Passed";
                      }

                      else if($MathF > 75)
                      {
                        echo "Passed";
                      }
                      else{
                        echo "Failed";
                      }
                    }
                  ?>
                </td>
              </tr>
              <!-- Science -->
              <tr style="height: 20px;">
                <td style="width: 141px; height: 20px;">&nbsp;Science</td>
                <!-- 1st quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Science' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Science1=''; 
                        echo  $Science1;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Science1= $row["grade"];
                             echo  $Science1;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 2nd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Science' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Science2=''; 
                        echo  $Science2;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Science2= $row["grade"];
                             echo  $Science2;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 3rd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Science' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Science3=''; 
                        echo  $Science3;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Science3= $row["grade"];
                             echo  $Science3;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 4th quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Science' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Science4=''; 
                        echo  $Science4;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Science4= $row["grade"];
                             echo  $Science4;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- Final grade -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    $ScienceF ='';
                    $flag = 0;
                    if(empty($Science1))
                      $flag++;
                    if(empty($Science2))
                      $flag++;
                    if(empty($Science3))
                      $flag++;
                    if(empty($Science4))
                      $flag++;

                    if($flag > 0)
                    {

                    }
                    else
                    {
                    $ScienceF= 0;
                    $ScienceF = $Science1 + $Science2 + $Science3 + $Science4;
                    $ScienceF = $ScienceF/4;
                    echo $ScienceF;
                    } 
                  ?>
                </td>
                <!-- Remarks -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    if(empty($ScienceF))
                    {

                    }
                    else
                      {
                        if($ScienceF == 75)
                      {
                        echo "Passed";
                      }

                      else if($ScienceF > 75)
                      {
                        echo "Passed";
                      }
                      else{
                        echo "Failed";
                      }
                    }
                  ?>
                </td>
              </tr>
              <!-- Araling Panlipunan -->
              <tr style="height: 20px;">
                <td style="width: 141px; height: 20px;">&nbsp;Araling Panlipunan</td>
                <!-- 1st quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Araling Panlipunan' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $AralingPanlipunan1=''; 
                        echo  $AralingPanlipunan1;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $AralingPanlipunan1= $row["grade"];
                             echo  $AralingPanlipunan1;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 2nd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Araling Panlipunan' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $AralingPanlipunan2=''; 
                        echo  $AralingPanlipunan2;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $AralingPanlipunan2= $row["grade"];
                             echo  $AralingPanlipunan2;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 3rd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Araling Panlipunan' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $AralingPanlipunan3=''; 
                        echo  $AralingPanlipunan3;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $AralingPanlipunan3= $row["grade"];
                             echo  $AralingPanlipunan3;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 4th quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Araling Panlipunan' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $AralingPanlipunan4=''; 
                        echo  $AralingPanlipunan4;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $AralingPanlipunan4= $row["grade"];
                             echo  $AralingPanlipunan4;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                 <!-- Final grade -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    $AralingPanlipunanF ='';
                    $flag = 0;
                    if(empty($AralingPanlipunan1))
                      $flag++;
                    if(empty($AralingPanlipunan2))
                      $flag++;
                    if(empty($AralingPanlipunan3))
                      $flag++;
                    if(empty($AralingPanlipunan4))
                      $flag++;

                    if($flag > 0)
                    {

                    }
                    else
                    {
                    $AralingPanlipunanF= 0;
                    $AralingPanlipunanF = $AralingPanlipunan1 + $AralingPanlipunan2 + $AralingPanlipunan3 + $AralingPanlipunan4;
                    $AralingPanlipunanF = $AralingPanlipunanF/4;
                    echo $AralingPanlipunanF;
                    } 
                  ?>
                </td>
                <!-- Remarks -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    if(empty($AralingPanlipunanF))
                    {

                    }
                    else
                      {
                        if($AralingPanlipunanF == 75)
                      {
                        echo "Passed";
                      }

                      else if($AralingPanlipunanF > 75)
                      {
                        echo "Passed";
                      }
                      else{
                        echo "Failed";
                      }
                    }
                  ?>
                </td>
              </tr>
              <!-- Edukasyon sa Pagpapakatao -->
              <tr style="height: 20px;">
                <td style="width: 141px; height: 20px;">&nbsp;Edukasyon sa Pagpapakatao</td>
                <!-- 1st quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Edukasyon sa Pagpapakatao' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $EP1=''; 
                        echo  $EP1;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $EP1= $row["grade"];
                             echo  $EP1;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 2nd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Edukasyon sa Pagpapakatao' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $EP2=''; 
                        echo  $EP2;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $EP2= $row["grade"];
                             echo  $EP2;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 3rd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Edukasyon sa Pagpapakatao' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $EP3=''; 
                        echo  $EP3;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $EP3= $row["grade"];
                             echo  $EP3;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 4th quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Edukasyon sa Pagpapakatao' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $EP4=''; 
                        echo  $EP4;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $EP4= $row["grade"];
                             echo  $EP4;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- Final grade -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    $EPF ='';
                    $flag = 0;
                    if(empty($EP1))
                      $flag++;
                    if(empty($EP2))
                      $flag++;
                    if(empty($EP3))
                      $flag++;
                    if(empty($EP4))
                      $flag++;

                    if($flag > 0)
                    {

                    }
                    else
                    {
                    $EPF= 0;
                    $EPF = $EP1 + $EP2 + $EP3 + $EP4;
                    $EPF = $EPF/4;
                    echo $EPF;
                    } 
                  ?>
                </td>
                <!-- Remarks -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    if(empty($EPF))
                    {

                    }
                    else
                      {
                        if($EPF == 75)
                      {
                        echo "Passed";
                      }

                      else if($EPF > 75)
                      {
                        echo "Passed";
                      }
                      else{
                        echo "Failed";
                      }
                    }
                  ?>
                </td>
              </tr>
              <!-- Technology and Livelihood Education -->
              <tr style="height: 20px;">
                <td style="width: 141px; height: 20px;">&nbsp;Technology and Livelihood Education</td>
                <!-- 1st quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Technology and Livelihood Education' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $TLE1=''; 
                        echo  $TLE1;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $TLE1= $row["grade"];
                             echo  $TLE1;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 2nd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Technology and Livelihood Education' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $TLE2=''; 
                        echo  $TLE2;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $TLE2= $row["grade"];
                             echo  $TLE2;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 3rd quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Technology and Livelihood Education' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $TLE3=''; 
                        echo  $TLE3;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $TLE3= $row["grade"];
                             echo  $TLE3;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- 4th quarter -->
                <td style="width: 62px; height: 20px;">
                  <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Technology and Livelihood Education' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $TLE4=''; 
                        echo  $TLE4;
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $TLE4= $row["grade"];
                             echo  $TLE4;
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- Final grade -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    $TLEF ='';
                    $flag = 0;
                    if(empty($TLE1))
                      $flag++;
                    if(empty($TLE2))
                      $flag++;
                    if(empty($TLE3))
                      $flag++;
                    if(empty($TLE4))
                      $flag++;

                    if($flag > 0)
                    {

                    }
                    else
                    {
                    $TLEF= 0;
                    $TLEF = $TLE1 + $TLE2 + $TLE3 + $TLE4;
                    $TLEF = $TLEF/4;
                    echo $TLEF;
                    } 
                  ?>
                </td>
                <!-- Remarks -->
                <td style="width: 62px; height: 20px;">
                  <?php
                    if(empty($TLEF))
                    {

                    }
                    else
                      {
                        if($TLEF == 75)
                      {
                        echo "Passed";
                      }

                      else if($TLEF > 75)
                      {
                        echo "Passed";
                      }
                      else{
                        echo "Failed";
                      }
                    }
                  ?>
                </td>
              </tr>
              <!-- MAPEH BACKEND PARTS -->
              <!-- MUSIC 1-->
              <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Music' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Music1=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Music1= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Music' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Music2=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Music2= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Music' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Music3=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Music3= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Music' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Music4=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Music4= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }
                ?>
                <!-- Arts -->
                <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Arts' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Arts1=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Arts1= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Arts' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Arts2=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Arts2= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Arts' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Arts3=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Arts3= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Arts' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Arts4=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Arts4= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }
                ?>

                <!-- PE -->
                <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Physical Education' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $PE1=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $PE1= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Physical Education' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $PE2=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $PE2= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Physical Education' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $PE3=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $PE3= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Physical Education' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $PE4=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $PE4= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }
                ?>

                <!-- Health -->
                <?php
                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Health' AND grades_per_subject.periodic_grading = 1";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Health1=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Health1= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Health' AND grades_per_subject.periodic_grading = 2";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Health2=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Health2= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Health' AND grades_per_subject.periodic_grading = 3";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Health3=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Health3= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }

                  $sql = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentNo 
                  AND grades_per_subject.subject= 'Health' AND grades_per_subject.periodic_grading = 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result)==0) { 
                        $Health4=''; 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ) 
                            {
                              $Health4= $row["grade"];
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }
                ?>

              <?php 
              $indicate_M1 = 0;
              if(empty($Music1))
                $indicate_M1++;
              if(empty($Arts1))
                $indicate_M1++;
              if(empty($PE1))
                $indicate_M1++;
              if(empty($Health1))
                $indicate_M1++;

              $indicate_M2 = 0;
              if(empty($Music2))
                $indicate_M2++;
              if(empty($Arts2))
                $indicate_M2++;
              if(empty($PE2))
                $indicate_M2++;
              if(empty($Health2))
                $indicate_M2++;

              $indicate_M3 = 0;
              if(empty($Music3))
                $indicate_M3++;
              if(empty($Arts3))
                $indicate_M3++;
              if(empty($PE3))
                $indicate_M3++;
              if(empty($Health3))
                $indicate_M3++;

              $indicate_M4 = 0;
              if(empty($Music4))
                $indicate_M4++;
              if(empty($Arts4))
                $indicate_M4++;
              if(empty($PE4))
                $indicate_M4++;
              if(empty($Health4))
                $indicate_M4++;
              ?>
              <!-- MAPEH -->
              <tr style="height:10px;">
                <td style="width: 141px; height:25px;" rowspan="5">
                  <p>MAPEH</p>
                  <div style="text-indent: 7px;">
                  <p> Music</p>
                  <p> Arts</p>
                  <p>Physical  Education</p>
                  <p>Health</p>
                  </div>
                </td>
                <!-- MAPEH -->
                <!-- 1st quarter -->
                <td style="width: 62px; height: 15px;">
                  <?php 
                  if($indicate_M1 > 0)
                    echo '';
                  else
                  {
                    $MAPEHF_1 = ($Music1 + $Arts1 + $PE1 + $Health1)/4;
                    echo $MAPEHF_1;
                  }
                  ?>
                </td>
                <!-- 2nd quarter -->
                <td style="width: 66px; height: 15px;">
                  <?php 
                  if($indicate_M2 > 0)
                    echo '';
                  else{
                    $MAPEHF_2 = ($Music2 + $Arts2 + $PE2 + $Health2)/4;
                    echo $MAPEHF_2;
                  }
                  ?>
                </td>
                <!-- 3rd quarter -->
                <td style="width: 63px; height: 15px;">
                  <?php 
                  if($indicate_M3 > 0)
                    echo '';
                  else{
                    $MAPEHF_3 = ($Music3 + $Arts3 + $PE3 + $Health3)/4;
                    echo $MAPEHF_3;
                  }
                  ?>
                </td>
                <!-- 4th quarter -->
                <td style="width: 66px; height: 15px;">
                  <?php 
                  if($indicate_M4 > 0)
                    echo '';
                  else{
                    $MAPEHF_4 = ($Music1 + $Arts1 + $PE1 + $Health1)/4;
                    echo $MAPEHF_4;
                  }
                  ?>
                </td>
                <!-- MAPEH_Final Grade -->
                <td style="width: 90px; height: 15px;">
                 <?php
                 $MAPEH_ave = '';
                 if(empty($MAPEHF_1) || empty($MAPEHF_2) || empty($MAPEHF_3) || empty($MAPEHF_4))
                 {

                 }
                 else
                 {
                  $MAPEH_ave = ($MAPEHF_1 + $MAPEHF_2 + $MAPEHF_3 + $MAPEHF_4)/4;
                  echo $MAPEH_ave;
                 }
                 ?>
                </td>
                <!-- Remarks -->
                <td style="width: 97px; height: 15px;">
                  <?php
                  if(empty($MAPEH_ave))
                  {

                  }
                  else
                  {
                    if($MAPEH_ave == 75)
                      echo "Passed";
                    else if($MAPEH_ave > 75)
                      echo "Passed";
                    else
                      echo "Failed";
                  }
                  ?>
                </td>
              </tr>
              <!-- Music -->
              <tr style="height: 15px;">
                <td style="width: 62px; height: 15px;"><?php echo $Music1; ?></td>
                <td style="width: 66px; height: 15px;"><?php echo $Music2; ?></td>
                <td style="width: 63px; height: 15px;"><?php echo $Music3; ?></td>
                <td style="width: 66px; height: 15px;"><?php echo $Music4; ?></td>
                <td style="width: 90px; height: 15px;">
                  <?php
                  if(empty($Music1) || empty($Music2) || empty($Music3) || empty($Music4))
                    echo '';
                  else{
                    $M_ave = ($Music1 + $Music2 + $Music3 + $Music4)/4;
                    echo $M_ave;
                  }
                  ?>
                </td>
                <td style="width: 97px; height: 15px;">
                  <?php 
                  if(empty($Music1) || empty($Music2) || empty($Music3) || empty($Music4))
                    echo '';
                  else
                  {
                    if($M_ave == 75)
                      echo "Passed";
                    else if($M_ave > 75)
                      echo "Passed";
                    else
                      echo "Failed";
                  }
                  ?>
                </td>
              </tr>
              <!-- Arts -->
              <tr style="height: 15px;">
                <td style="width: 62px; height: 15px;"><?php echo $Arts1; ?></td>
                <td style="width: 66px; height: 15px;"><?php echo $Arts2; ?></td>
                <td style="width: 63px; height: 15px;"><?php echo $Arts3; ?></td>
                <td style="width: 66px; height: 15px;"><?php echo $Arts4; ?></td>
                <td style="width: 90px; height: 15px;">
                  <?php
                  if(empty($Arts1) || empty($Arts2) || empty($Arts3) || empty($Arts4))
                    echo '';
                  else{
                    $A_ave = ($Arts1 + $Arts2 + $Arts3 + $Arts4)/4;
                    echo $A_ave;
                  }
                  ?>
                </td>
                <td style="width: 97px; height: 15px;">
                  <?php 
                  if(empty($Arts1) || empty($Arts2) || empty($Arts3) || empty($Arts4))
                    echo '';
                  else
                  {
                    if($A_ave == 75)
                      echo "Passed";
                    else if($A_ave > 75)
                      echo "Passed";
                    else
                      echo "Failed";
                  }
                  ?>
                </td>
              </tr>
              <!-- Physical Education -->
              <tr style="height: 15px;">
                <td style="width: 62px; height: 15px;"><?php echo $PE1; ?></td>
                <td style="width: 66px; height: 15px;"><?php echo $PE2; ?></td>
                <td style="width: 63px; height: 15px;"><?php echo $PE3; ?></td>
                <td style="width: 66px; height: 15px;"><?php echo $PE4; ?></td>
                <td style="width: 90px; height: 15px;">
                  <?php
                  if(empty($PE1) || empty($PE2) || empty($PE3) || empty($PE4))
                    echo '';
                  else{
                    $P_ave = ($PE1 + $PE2 + $PE3 + $PE4)/4;;
                    echo $P_ave;
                  }
                  ?>
                </td>
                <td style="width: 97px; height: 15px;">
                  <?php 
                  if(empty($PE1) || empty($PE2) || empty($PE3) || empty($PE4))
                    echo '';
                  else
                  {
                    if($P_ave == 75)
                      echo "Passed";
                    else if($P_ave > 75)
                      echo "Passed";
                    else
                      echo "Failed";
                  }
                  ?>
                </td>
              </tr>
              <!-- Health -->
              <tr style="height: 15px;">
                <td style="width: 62px; height: 15px;"><?php echo $Health1; ?></td>
                <td style="width: 66px; height: 15px;"><?php echo $Health2; ?></td>
                <td style="width: 63px; height: 15px;"><?php echo $Health3; ?></td>
                <td style="width: 66px; height: 15px;"><?php echo $Health4; ?></td>
                <td style="width: 90px; height: 15px;">
                  <?php
                  if(empty($Health1) || empty($Health2) || empty($Health3) || empty($Health4))
                    echo '';
                  else{
                    $H_ave = ($Health1 + $Health2 + $Health3 + $Health4)/4;
                    echo $H_ave;
                  }
                  ?>
                </td>
                <td style="width: 97px; height: 15px;">
                  <?php 
                  if(empty($Health1) || empty($Health2) || empty($Health3) || empty($Health4))
                    echo '';
                  else
                  {
                    if($H_ave == 75)
                      echo "Passed";
                    else if($H_ave > 75)
                      echo "Passed";
                    else
                      echo "Failed";
                  }
                  ?>
                </td>
              </tr>

              <tr style="height: 20px;">
                <td style="width: 141px; height: 20px;">&nbsp;Quarter Average</td>
                <!-- 1st quarter -->
                <td style="width: 141px; height: 20px;">
                  <?php
                  if(empty($Filipino1) || empty($English1) || empty($Math1) || empty($Science1) || empty($AralingPanlipunan1) || empty($EP1) || empty($TLE1) || empty($MAPEHF_1))
                    echo '';
                  else
                  {
                    $Ave_q1 = ($Filipino1 + $English1 + $Math1 + $Science1 + $AralingPanlipunan1 + $EP1 + $TLE1 + $MAPEHF_1)/8;
                    echo $Ave_q1;
                  }
                  ?>
                </td>
                <!-- 2nd quarter -->
                <td style="width: 141px; height: 20px;">
                   <?php
                  if(empty($Filipino2) || empty($English2) || empty($Math2) || empty($Science2) || empty($AralingPanlipunan2) || empty($EP2) || empty($TLE2) || empty($MAPEHF_2))
                    echo '';
                  else
                  {
                    $Ave_q2 = ($Filipino2 + $English2 + $Math2 + $Science2 + $AralingPanlipunan2 + $EP2 + $TLE2 + $MAPEHF_2)/8;
                    echo $Ave_q2;
                  }
                  ?>
                </td>
                <!-- 3rd quarter -->
                <td style="width: 141px; height: 20px;">
                   <?php
                  if(empty($Filipino3) || empty($English3) || empty($Math3) || empty($Science3) || empty($AralingPanlipunan3) || empty($EP3) || empty($TLE3) || empty($MAPEHF_3))
                    echo '';
                  else
                  {
                    $Ave_q3 = ($Filipino3 + $English3 + $Math3 + $Science3 + $AralingPanlipunan3 + $EP3 + $TLE3 + $MAPEHF_3)/8;
                    echo $Ave_q3;
                  }
                  ?>
                </td>
                <!-- 4th quarter -->
                <td style="width: 141px; height: 20px;">
                   <?php
                  if(empty($Filipino4) || empty($English4) || empty($Math4) || empty($Science4) || empty($AralingPanlipunan4) || empty($EP4) || empty($TLE4) || empty($MAPEHF_4))
                    echo '';
                  else
                  {
                    $Ave_q4 = ($Filipino4 + $English4 + $Math4 + $Science4 + $AralingPanlipunan4 + $EP4 + $TLE4 + $MAPEHF_4)/8;
                    echo $Ave_q4;
                  }
                  ?>
                </td>

                <!-- Final Grade -->
                <td style="width: 141px; height: 20px;">
                  <?php                  
                  if(empty($Ave_q1) || empty($Ave_q2) | empty($Ave_q3) | empty($Ave_q4)){
                    $Final_ave='';
                  }
                  else
                  {
                    $Final_ave = ($Ave_q1 + $Ave_q2 + $Ave_q3 + $Ave_q4)/4;
                    echo $Final_ave;
                    $val = '';
                    if($Final_ave >= 75)
                      $val = "Passed";
                    /*else if($Final_ave > 75)
                      $val = "Passed";*/
                    else
                      $val = "Failed";

                    //check if student for that year is already in the database
                    $empty = 0;
                    $sql_y = "SELECT LRN, Year_lvl FROM grade_per_year WHERE grade_per_year.LRN = '$StudentNo' AND grade_per_year.Year_lvl = '$year'";
                    $result_y = $conn->query($sql_y);

                    if($result_y->num_rows > 0)
                    {
                      //already in database
                      //do nothing
                    }
                    else
                    {
                       //not in database
                      $empty = 1;
                    }

                    if($empty == 1)
                    {
                       //$fremark_sql = "INSERT INTO grade_per_year(Remarks) VALUES ('$val')";
                      $fgrade_sql = "INSERT INTO grade_per_year(LRN, Year_lvl, Section, Period_1, Period_2, Period_3, Period_4, Grade_ave, Remarks) VALUES ('$StudentNo', '$year', '$Section', '$Ave_q1', '$Ave_q2', '$Ave_q3', '$Ave_q4', '$Final_ave', '$val')";

                      if ($conn->query($fgrade_sql) === TRUE) {
                        /*echo "New record created successfully";*/
                        $flag_for_empty = 0;
                      } else {
                        /*echo "Error: " . $fgrade_sql . "<br>" . $conn->error;*/
                      }
                    }
                    else
                    {
                      //do nothing

                    }

                  }
                  ?>
                </td>
                <td style="width: 141px; height: 20px;">
                  <?php
                  if(empty($Ave_q1) || empty($Ave_q2) | empty($Ave_q3) | empty($Ave_q4))
                    echo '';
                  else
                  {
                    if($Final_ave == 75){
                      echo "Passed";
                    }
                    else if($Final_ave > 75){
                      echo "Passed";
                    }
                    else{
                      echo "Failed";
 
                    }
                   } 
                  ?>
                </td>
              </tr>
            </table>
            </div>
          </div>
          <div class="recent-sales box" style="width:20%; margin-left: 10px;" >
            <!-- Insert fields here -->
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div style="text-align: left;">

        <h4>UPDATE GRADES</h4>
        Subject: 
        <input list="change_subj" placeholder="Subject" name="change_subj" size="10">
        <datalist id="change_subj">
        <option value="Filipino"> 
        <option value="English">
        <option value="Math">
        <option value="Science">
        <option value="Technology and Livelihood Education">
        <option value="Edukasyon Sa Pagpapakatao">
        <option value="Araling Panlipunan">
        <option value="Music">
        <option value="Arts">
        <option value="Physical Education">
        <option value="Health">
        </option>
        </datalist>
        Quarter: 
        <input list="change_q" placeholder="Quarter" name="change_q" size="10">
        <datalist id="change_q">
        <option value="1">  
        <option value="2">
        <option value="3">
        <option value="4">
        </option>
        </datalist>


        Grade Value:
        <input type="text" name = "change_grade" placeholder="Grade" size="10">

        
        <input hidden="" type="text" name="lrn" value=<?php echo $StudentNo; ?>>
        <input hidden="" type="text" name="section" value=<?php echo $Section; ?>>
        <div class="row">
          <div class="column">
          
          <input type="Submit" name="Update" value="Submit"class="subjectbutton btn1"  style="height: 40px; margin-left:10px; margin-top: 10px; font-size: 20px;">
          <!-- <input type="Submit" name="Confirm" value="Reload Changes"style="height: 20px; margin-left:20px; margin-top: 2px; font-size: 12px;"> -->
          <br><br>
          <!-- <p style="font-size: 12px;">Note: Double click update to automatically view changes</p> -->
        </div>
        </div>
        <br/><br/> 

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){

          if( isset($_POST['change_subj']) && isset($_POST['change_q']) && isset($_POST['change_grade'])){
            $change_subj = $_POST['change_subj'];
            $change_q = $_POST['change_q'];
            $change_grade = $_POST['change_grade'];
            
            //send this variable to query
            $with_q = "";
            $temp = "";
            //check if editable
            if($change_q == "1")
            {
                $with_q = "Status_Q1";
                $check = "SELECT Status_Q1 FROM quarter_status WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'";
                $check_result = $conn->query($check);
                
                if($check_result->num_rows > 0)
                {
                    while($row = $check_result->fetch_assoc()) {
                        $temp = $row['Status_Q1'];
                    }
                }
            }
            else if($change_q == "2"){
                $with_q = "Status_Q2";
                $check = "SELECT Status_Q2 FROM quarter_status WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'";
                $check_result = $conn->query($check);
                
                if($check_result->num_rows > 0)
                {
                    while($row = $check_result->fetch_assoc()) {
                        $temp = $row['Status_Q2'];
                    }
                }
            }
            else if($change_q == "3")
            {
                $with_q = "Status_Q3";
                $check = "SELECT Status_Q3 FROM quarter_status WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'";
                $check_result = $conn->query($check);
                
                if($check_result->num_rows > 0)
                {
                    while($row = $check_result->fetch_assoc()) {
                        $temp = $row['Status_Q3'];
                    }
                }
            }
            else if($change_q == "4"){
                $with_q = "Status_Q4";
                $check = "SELECT Status_Q4 FROM quarter_status WHERE quarter_status.LRN = '$StudentNo' AND quarter_status.Year_lvl = '$year'";
                $check_result = $conn->query($check);
                
                if($check_result->num_rows > 0)
                {
                    while($row = $check_result->fetch_assoc()) {
                        $temp = $row['Status_Q4'];
                    }
                }
            }
            
            $flag_for_editable = 0;
            
            if($temp == "Not Final")
            {
                //GRADE IS NOT SET TO FINAL CAN EDIT
                
                //check if empty
                $flag_for_empty = 0;
                $sql1 = "SELECT grade FROM grades_per_subject WHERE grades_per_subject.LRN= '$StudentNo' AND grades_per_subject.subject = '$change_subj' AND grades_per_subject.periodic_grading = '$change_q'";
                $result1 = $conn->query($sql1);
    
                $var = 0;
                if($result1->num_rows > 0)
                {
                  while($row = $result1->fetch_assoc()) {
                    $var = $row['grade'];
                  }
                }
                if(empty($var))
                    {
                      $flag_for_empty = 1;
                    }
                    
                //if no data yet (means empty)
                if($flag_for_empty == 1)
                {
                  //$flag_for_empty = 0;
                  //insert data
                  $sql2 = "INSERT INTO grades_per_subject (LRN, Year_lvl, subject, periodic_grading, grade) VALUES ('$StudentNo', '$year', '$change_subj', '$change_q', $change_grade)";
    
                  if ($conn->query($sql2) === TRUE) {
                    /*echo "New record created successfully";*/
                          echo '<script type="text/javascript">';
                          echo 'alert("Successfully updated");';
                          echo '</script>';
                          
                    $flag_for_empty = 0;
                  } else {
                    /*echo "Error: " . $sql2 . "<br>" . $conn->error;*/
                  }
                }
    
                if($flag_for_empty == 0)
                {
                  //update code
                  $sql = "UPDATE grades_per_subject SET grades_per_subject.Grade = '$change_grade' WHERE grades_per_subject.LRN= $StudentNo AND grades_per_subject.subject = '$change_subj' AND grades_per_subject.periodic_grading = $change_q;";
                  if ($conn->query($sql) === TRUE) { 
                    
                    //echo "<meta http-equiv='refresh' content='0'>";
                   echo '<script type="text/javascript">';
                          echo 'alert("Successfully updated");';
                          echo '</script>';
                  }
                  else { 
                    // echo "Error updating record: " . $conn->error;
                    echo '<script type="text/javascript">alert("Error updating record)';
                    echo $conn->error;
                    echo ') </script>';
                  }
                }
            }
            else if($temp == "Final")
            {
                //GRADE IS FINAL CAN'T EDIT
                echo '<script type="text/javascript">';
                          echo 'alert("Edit disabled, grade is set as final for this quarter");';
                          echo '</script>';
            }
         
          }
        }
        ?> 
           </div>
          </div><!-- end for recent sale box for update part -->
 
        </div>
        
      </div>

              </div>
            
      </div>
      
    </div>

      <div class="sales-boxes"></div>
       
      </div>
  </section>

<script>
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".sidebarBtn");
  sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
    }else
    sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }

 </script>

</body>
</html>

