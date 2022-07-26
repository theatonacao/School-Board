<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php

    require ('../config.php');
   
    $StudentNo = $_SESSION['LRN'];
    $index = 1;
    $x = 0;

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
        
        }
        $year = $row['Year_lvl'];
    }else{
        echo '<br>';    
        echo "<h4>Student information for ".$StudentNo." is empty. </h4>";
    }


    //php function to retrieve grade from a specific subject + period
    function getGrade($subjectname,$gradeperiod){

        //sql query to get grades
        $sql1 = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN =  {$GLOBALS['StudentNo']}
                AND grades_per_subject.subject= '". $subjectname. "' AND grades_per_subject.periodic_grading = $gradeperiod ";
                          
                $result = mysqli_query($GLOBALS['conn'], $sql1);
                
                if (mysqli_num_rows($result)==0) { 
                        $subjectgrade = '';
                        // echo $subjectgrade;
                        return $subjectgrade;
                }
                else{
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc() ) 
                        {
                            $subjectgrade = $row["grade"];
                            // echo $subjectgrade;
                            return $subjectgrade;
                        }
                    }else{
                        echo ''; 
                    }
                }  
      } //end of getGrade() function

      function getQuarterAve($quarter){

        //sql query to get grades
        $sql2 = "SELECT * FROM grade_per_year WHERE grade_per_year.LRN =  {$GLOBALS['StudentNo']}";
                          
                $result = mysqli_query($GLOBALS['conn'], $sql2);
                
                if (mysqli_num_rows($result) == 0) { 
                        $qgrade = '';
                        // echo $subjectgrade;
                        return $qgrade;
                
                }
                else{
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc() ) 
                        {
                            $qgrade1 = $row["Period_1"];
                            $qgrade2 = $row["Period_2"];
                            $qgrade3 = $row["Period_3"];
                            $qgrade4 = $row["Period_4"];
                            $finalgrade = $row["Grade_ave"];
                        }

                        if ($quarter==1){
                            return $qgrade1;
                        }else if ($quarter==2) {
                            return $qgrade2;
                        }else if ($quarter==3) {
                            return $qgrade3;
                        }else if ($quarter==4) {
                            return $qgrade4;
                        }else if ($quarter==5) {
                            return $finalgrade;
                        }


                    }else{
                        echo ''; 
                    }

                }  
      } //end of getQuarterAve() function

      //php function to get average for 4 parameters (for MAPEH and Final Grade)
      function getAverage($s1,$s2,$s3,$s4){
        //leave blank if some grades are not yet in
        if($s1==''||$s2==''||$s3==''||$s4=='')
        $ave = '';
        else{
        $ave = ($s1+$s2+$s3+$s4)/4;
        }
        // echo $ave;
        return $ave;
      }//end of getAverage function

      //php function to get average for 7 parameters (for Subject Final Grade)
      function getAverage8($s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8){
        //leave blank if some grades are not yet in
        if($s1==''||$s2==''||$s3==''||$s4==''||$s5==''||$s6==''||$s7==''||$s8=='')
            $ave = '';
        else{
            $ave = ($s1+$s2+$s3+$s4+$s5+$s6+$s7+$s8)/8;
        }
        // echo $ave;
        return $ave;
      }//end of getAverage8 function

    //php function to get remarks per quarter
      function getRemarks($num){
        if ($num ==''){
            $remarks = '';
        }else if ($num >= 75){
            $remarks =  'Passed';
        }else if ($num < 75){
            $remarks =  'Failed';
        }
        return $remarks;
      }//end of getRemarks function

      //php function to get remarks 
      function getFinalRemarks($num){

         //sql query to get grades
        $sql2 = "SELECT * FROM grade_per_year WHERE grade_per_year.LRN =  {$GLOBALS['StudentNo']}";
                $result = mysqli_query($GLOBALS['conn'], $sql2);
                if (mysqli_num_rows($result) == 0) { 
                        $remarks = '';
                        return $remarks;
                }
                else{
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc() ){
                            $remarks = $row["Remarks"];
                            return $remarks;
                        }
                    }else{
                        echo ''; 
                    }
                }  

      }//end of getRemarks function

?> 

 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../admin/welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel = "icon" href =  "images/SB-logo.png"  type = "image/x-icon">
    <title> Student Grades</title>
   </head>
<body>
<div class="sidebar">
    <div class="logo-details">
      <i><img src="images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" ></i>
      <span class="logo_name">SchoolBoard</span>
    </div>
      <ul class="nav-links">
      <li>
          <a href="welcome.php" >
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#" class="active">
            <i class='bx bx-group' ></i>
            <span class="links_name">Student Information</span>
          </a>
        </li>
        <li>
          <a href="teacher_info.php">
            <i class='bx bx-chalkboard' ></i>
            <span class="links_name">Teacher Information</span>
          </a>
        </li>
        <li>
          <a href="class_info.php">
            <i class='bx bxs-school'></i>
            <span class="links_name">Class Information</span>
          </a>
        </li>
        <li>
          <a href="alumni_info.php">
            <i class='bx bxs-graduation' ></i>
            <span class="links_name">Manage Alumni</span>
          </a>
        </li>
        <li>
          <a href="Elearning_info.php">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">E-Learning</span>
          </a>
        </li>
        <li>
          <a href="school_forms.php">
            <i class='bx bx-paperclip' ></i>
            <span class="links_name">School Forms</span>
          </a>
        </li>
        
        <li>
          <a href="settings.php">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Settings</span>
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
        <span class="dashboard">Student Grades</span>
      </div>
  
     <div class="profile-details">
      <img src="images/default_pfp.jpg" alt="">
        <span class="admin_name"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
        <a href="logout.php">
            <i class='bx bx-log-out' ></i>
        </a>
        
      </div>
    </nav>

    <div class="home-content" style="padding-top: 80px;">


      <div class="sales-boxes">
            <div class="recent-sales box" style="width:100%; margin-top: 20px;">
                <div class="title" onclick="history.back()"><i class='bx bxs-left-arrow-circle'></i></i></div>
                        
                         
<!-- INSERT HERE -->
                           <div class="" style="font-size: 15px;">
    

                                                <table style="width: 100%;margin-left: auto; margin-right: auto; border-collapse: collapse;">
                                                    <tbody style="line-height: 1px;">
                                                        <tr s>
                                                            <td style="width: 200px;">Learner's Reference Number:</td>
                                                            <td style="width: 276px; color: red;"><?php echo $LRN; ?></td>
                                                        </tr>
                                                        <tr >
                                                            <td style="width: 200px;">Student Name:</td>
                                                            <td style="width: 276px;"><?php echo $Lastname ; ?>, <?php echo  $Firstname;?>  <?php echo $Middlename; ?> <?php echo $Ext; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 200px;">Grade Level:</td>
                                                            <td style="width: 276px;"><?php echo $Grade; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 200px;">Section:</td>
                                                            <td style="width: 276px;"><?php echo $Section; ?></td>
                                                        </tr>
                                                        <tr>                    
                                                            <td style="width: 200px;">Class Adviser:</td>
                                                            <td style="width: 276px;"><?php echo $Adviser; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <table style="width: 100%; font-size: 15px; margin-left: auto; margin-right: auto; text-align: center; line-height: 0.002px; border-collapse: collapse;">
                                                    <tbody>
                                                        <tr >
                                                            <td style="width: 141px; text-align: center;" rowspan="2">LEARNING AREAS</td>
                                                            <td style="width: 257px;text-align: center;" colspan="4">PERIODIC RATING</td>
                                                            <td style="width: 90px; text-align: center;" rowspan="2">FINAL GRADE</td>
                                                            <td style="width: 97px; text-align: center;" rowspan="2">REMARKS</td>
                                                        </tr>
                                                        <tr style="">
                                                            <td style="width: 62px; text-align: center;">&nbsp;1</td>
                                                            <td style="width: 66px; text-align: center;">&nbsp;2</td>
                                                            <td style="width: 63px; text-align: center;">&nbsp;3</td>
                                                            <td style="width: 66px; text-align: center;">&nbsp;4</td>
                                                        </tr>
                                        <!-- Filipino -->
                                                        <tr style="">
                                                            <td style="width: 141px; text-align: left;">&nbsp;Filipino</td>
                                                            <td style="width: 62px; "><?php echo getGrade('Filipino', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Filipino', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('Filipino', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Filipino', 4);?></td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                echo $gFilipino=getAverage (getGrade('Filipino', 1),
                                                                                 getGrade('Filipino', 2),
                                                                                 getGrade('Filipino', 3),
                                                                                 getGrade('Filipino', 4));?>
                                                            </td>
                                                            <td style="width: 97px; "><?php echo getRemarks($gFilipino);?></td>
                                                        </tr>
                                        <!-- English -->
                                                        <tr style="">
                                                            <td style="width: 141px;text-align: left; ">&nbsp;English</td>
                                                            <td style="width: 62px; "><?php echo getGrade('English', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('English', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('English', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('English', 4);?></td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                echo $gEnglish=getAverage (getGrade('English', 1),
                                                                                            getGrade('English', 2),
                                                                                            getGrade('English', 3),
                                                                                            getGrade('English', 4));?>
                                                            </td>
                                                            <td style="width: 97px; "><?php echo getRemarks($gEnglish);?></td>
                                                        </tr>
                                        <!-- Math -->
                                                        <tr style="">
                                                            <td style="width: 141px; text-align: left;">&nbsp;Mathematics</td>
                                                            <td style="width: 62px; "><?php echo getGrade('Math', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Math', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('Math', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Math', 4);?></td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                    echo $gMath=getAverage (getGrade('Math', 1),
                                                                                            getGrade('Math', 2),
                                                                                            getGrade('Math', 3),
                                                                                            getGrade('Math', 4));?>
                                                            </td>
                                                            <td style="width: 97px; "><?php echo getRemarks($gMath);?></td>
                                                        </tr>
                                        <!-- Science -->
                                                        <tr style="height: 20px;">
                                                            <td style="width: 141px; text-align: left;">&nbsp;Science</td>
                                                            <td style="width: 62px; "><?php echo getGrade('Science', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Science', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('Science', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Science', 4);?></td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                 echo $gScience=getAverage (getGrade('Science', 1),
                                                                                            getGrade('Science', 2),
                                                                                            getGrade('Science', 3),
                                                                                            getGrade('Science', 4));?></td>
                                                            <td style="width: 97px; "><?php echo getRemarks($gScience);?></td>
                                                        </tr>
                                        <!-- Araling Panlipunan -->
                                                        <tr style="">
                                                            <td style="width: 141px; text-align: left;">&nbsp;Araling Panlipunan</td>
                                                            <td style="width: 62px; "><?php echo getGrade('Araling Panlipunan', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Araling Panlipunan', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('Araling Panlipunan', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Araling Panlipunan', 4);?></td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                  echo $gAP=getAverage (getGrade('Araling Panlipunan', 1),
                                                                                        getGrade('Araling Panlipunan', 2),
                                                                                        getGrade('Araling Panlipunan', 3),
                                                                                        getGrade('Araling Panlipunan', 4));?>                                   
                                                            </td>
                                                            <td style="width: 97px; "><?php echo getRemarks($gAP);?></td>
                                                        </tr>
                                    <!-- Edukasyon sa Pagpapakatao -->
                                                        <tr style="">
                                                            <td style="width: 141px; text-align: left;line-height: 1em">&nbsp;Edukasyon sa Pagpapakatao</td>
                                                            <td style="width: 62px; "><?php echo getGrade('Edukasyon sa Pagpapakatao', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Edukasyon sa Pagpapakatao', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('Edukasyon sa Pagpapakatao', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Edukasyon sa Pagpapakatao', 4);?></td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                  echo $gESP=getAverage (getGrade('Edukasyon sa Pagpapakatao', 1),
                                                                                        getGrade('Edukasyon sa Pagpapakatao', 2),
                                                                                        getGrade('Edukasyon sa Pagpapakatao', 3),
                                                                                        getGrade('Edukasyon sa Pagpapakatao', 4));?>   
                                                            </td>
                                                            <td style="width: 97px; "><?php echo getRemarks($gESP);?></td>
                                                        </tr>
                                    <!-- TLE -->
                                                        <tr style="">
                                                            <td style="width: 141px; text-align: left;">&nbsp;TLE</td>
                                                            <td style="width: 62px; "><?php echo getGrade('Technology and Livelihood Education', 1);?> </td>
                                                            <td style="width: 66px; "><?php echo getGrade('Technology and Livelihood Education', 2);?> </td>
                                                            <td style="width: 63px; "><?php echo getGrade('Technology and Livelihood Education', 3);?> </td>
                                                            <td style="width: 66px; "><?php echo getGrade('Technology and Livelihood Education', 4);?> </td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                 echo $gTLE=getAverage (getGrade('Technology and Livelihood Education', 1),
                                                                                        getGrade('Technology and Livelihood Education', 2),
                                                                                        getGrade('Technology and Livelihood Education', 3),
                                                                                        getGrade('Technology and Livelihood Education', 4));?> 
                                                            </td>
                                                            <td style="width: 97px;"><?php echo getRemarks($gTLE);?></td>
                                                        </tr>
                                                        <tr style="">
                                                            <td style="width: 141px;line-height:27px;"  rowspan=5; text-align: left; >
                                                              <div style="text-align: left;">
                                                                <p>MAPEH</p>
                                                                <p> Music</p>
                                                                <p> Arts</p>
                                                                <p>Physical  Education</p>
                                                                <p>Health</p>
                                                              </div>
                                                               
                                                            </td>
                                    <!-- MAPEH (Average) -->
                                                            <td style="width: 62px; ">
                                                            <!-- MAPEH (1ST) -->
                                                                <?php 
                                                                    $s1 = getGrade('Music', 1);
                                                                    $s2 = getGrade('Arts', 1);
                                                                    $s3 = getGrade('Physical Education', 1);
                                                                    $s4 = getGrade('Health', 1);
                                                                    $M1 = getAverage($s1,$s2,$s3,$s4);
                                                                    echo $M1;
                                                                ?>
                                                            </td>
                                                            <td style="width: 66px; ">
                                                            <!-- MAPEH (2ND) -->
                                                                <?php 
                                                                    $s1 = getGrade('Music', 2);
                                                                    $s2 = getGrade('Arts', 2);
                                                                    $s3 = getGrade('Physical Education', 2);
                                                                    $s4 = getGrade('Health', 2);
                                                                    $M2 = getAverage($s1,$s2,$s3,$s4);
                                                                    echo $M2;
                                                                ?>
                                                            </td>
                                                            <td style="width: 63px; ">
                                                            <!-- MAPEH (3RD) -->
                                                                <?php 
                                                                    $s1 = getGrade('Music', 3);
                                                                    $s2 = getGrade('Arts', 3);
                                                                    $s3 = getGrade('Physical Education', 3);
                                                                    $s4 = getGrade('Health', 3);
                                                                    $M3 = getAverage($s1,$s2,$s3,$s4);
                                                                    echo $M3;
                                                                ?>
                                                            </td>
                                                            <td style="width: 66px; ">
                                                                <!-- MAPEH (3RD) -->
                                                                <?php 
                                                                    $s1 = getGrade('Music', 4);
                                                                    $s2 = getGrade('Arts', 4);
                                                                    $s3 = getGrade('Physical Education', 4);
                                                                    $s4 = getGrade('Health', 4);
                                                                    $M4 = getAverage($s1,$s2,$s3,$s4);
                                                                    echo $M4;
                                                                ?>
                                                            </td>
                                                            <td style="width: 90px; ">
                                                                <?php echo $gMAPEH=round(getAverage($M1,$M2,$M3,$M4),2);?>
                                                            </td>
                                                            <td style="width: 97px; "><?php echo getRemarks($gMAPEH);?></td>
                                                        </tr>
                                    <!-- Music -->
                                                            <tr style="">
                                                            <td style="width: 62px; "><?php echo getGrade('Music', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Music', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('Music', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Music', 4);?></td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                 echo $gMusic=getAverage (getGrade('Music', 1),
                                                                                          getGrade('Music', 2),
                                                                                          getGrade('Music', 3),
                                                                                          getGrade('Music', 4));?> 
                                                            </td>
                                                            <td style="width: 97px;"><?php echo getRemarks($gMusic);?></td>
                                                        </tr>
                                    <!-- Arts -->
                                                        <tr style="">
                                                            <td style="width: 62px; "><?php echo getGrade('Arts', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Arts', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('Arts', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Arts', 4);?></td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                 echo $gArts=getAverage (getGrade('Arts', 1),
                                                                                         getGrade('Arts', 2),
                                                                                         getGrade('Arts', 3),
                                                                                         getGrade('Arts', 4));?> 
                                                            </td>
                                                            <td style="width: 97px; "><?php echo getRemarks($gArts);?></td>
                                                        </tr>
                                    <!-- Physical Education -->
                                                        <tr style="">
                                                            <td style="width: 62px; "><?php echo getGrade('Physical Education', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Physical Education', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('Physical Education', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Physical Education', 4);?></td>
                                                            <td style="width: 90px; ">
                                                                <?php 
                                                                 echo $gPE = getAverage (getGrade('Physical Education', 1),
                                                                                         getGrade('Physical Education', 2),
                                                                                         getGrade('Physical Education', 3),
                                                                                         getGrade('Physical Education', 4));?> 
                                                            </td>
                                                            <td style="width: 97px; "><?php echo getRemarks($gPE);?></td>
                                                        </tr>
                                    <!-- Health -->
                                                        <tr style="">
                                                            <td style="width: 62px; "><?php echo getGrade('Health', 1);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Health', 2);?></td>
                                                            <td style="width: 63px; "><?php echo getGrade('Health', 3);?></td>
                                                            <td style="width: 66px; "><?php echo getGrade('Health', 4);?></td>
                                                            <td style="width: 90px; ">
                                                            <?php 
                                                                 echo $gHealth=getAverage(getGrade('Health', 1),
                                                                                          getGrade('Health', 2),
                                                                                          getGrade('Health', 3),
                                                                                          getGrade('Health', 4));?> 
                                                            </td>
                                                            <td style="width: 97px;"><?php echo getRemarks($gHealth);?></td>
                                                        </tr>
                                                        <tr style="">
                                    <!-- QUARTER AVERAGE -->
                                                            <td style="width: 141px; ">Quarter Average</td>
                                     <!-- FIRST QUARTER --> <td style="width: 62px;">
                                                                     <?php 
                                                                     $s1 = getGrade('Filipino', 1);
                                                                     $s2 = getGrade('Math', 1);
                                                                     $s3 = getGrade('Science', 1);
                                                                     $s4 = getGrade('English', 1);
                                                                     $s5 = getGrade('Technology and Livelihood Education', 1);
                                                                     $s6 = getGrade('Araling Panlipunan', 1);
                                                                     $s7 = getGrade('Edukasyon sa Pagpapakatao', 1);
                                                                     $s8 = $M1;
                                                                     
                                                                     $q1 = round(getAverage8($s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8),2);
                                                                        echo $q1;
                                                                   //  echo getQuarterAve(1);?> 
                                                                     
                                                            </td>
                                     <!-- SECOND QUARTER --><td style="width: 66px; "> 
                                                            <?php 
                                                                     $s1 = getGrade('Filipino', 2);
                                                                     $s2 = getGrade('Math', 2);
                                                                     $s3 = getGrade('Science', 2);
                                                                     $s4 = getGrade('English', 2);
                                                                     $s5 = getGrade('Technology and Livelihood Education', 2);
                                                                     $s6 = getGrade('Araling Panlipunan', 2);
                                                                     $s7 = getGrade('Edukasyon sa Pagpapakatao', 2);
                                                                     $s8 = $M2;
                                                                     
                                                                     $q2 = round(getAverage8($s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8),2);
                                                                        echo $q2;
                                                                   //  echo getQuarterAve(2);?> </td>
                                     <!-- THIRD QUARTER --> <td style="width: 63px; "> 
                                                            <?php 
                                                                     $s1 = getGrade('Filipino', 3);
                                                                     $s2 = getGrade('Math', 3);
                                                                     $s3 = getGrade('Science', 3);
                                                                     $s4 = getGrade('English', 3);
                                                                     $s5 = getGrade('Technology and Livelihood Education', 3);
                                                                     $s6 = getGrade('Araling Panlipunan', 3);
                                                                     $s7 = getGrade('Edukasyon sa Pagpapakatao', 3);
                                                                     $s8 = $M3;
                                                                     
                                                                     $q3 = round(getAverage8($s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8),2);
                                                                        echo $q3;
                                                                   //  echo getQuarterAve(3);?> 
                                                            </td>
                                     <!-- FOURTH QUARTER --><td style="width: 66px; ">
                                                            <?php 
                                                                     $s1 = getGrade('Filipino', 4);
                                                                     $s2 = getGrade('Math', 4);
                                                                     $s3 = getGrade('Science', 4);
                                                                     $s4 = getGrade('English', 4);
                                                                     $s5 = getGrade('Technology and Livelihood Education', 4);
                                                                     $s6 = getGrade('Araling Panlipunan', 4);
                                                                     $s7 = getGrade('Edukasyon sa Pagpapakatao', 4);
                                                                     $s8 = $M4;
                                                                     
                                                                     $q4 = round(getAverage8($s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8),2);
                                                                        echo $q4;
                                                                   //  echo getQuarterAve(4);?> 
                                                            </td>
                                    <!-- FINAL GRADE -->    <td style="width: 90px; " rowspan="2"> 
                                                                <?php $final =  round(getAverage($q1,$q2,$q3,$q4), 2);
                                                                        echo $final;?> </td>
                                    <!-- FINAL REMARKS --><td style="width: 97px; line-height: 1em" rowspan="2"> 
                                                                    <?php 
                                                                    
                                                                    $g = $Grade+1;
                                                                          if ($final =='')
                                                                                echo ""; 
                                                                          else if ($final>=75)
                                                                                echo "Promoted to Grade ". $g;
                                                                          else if($final<75)
                                                                                echo "Failed";?>
                                                           </td>
                                                        </tr>
                                                        <tr style="">
                                                            <td style="width: 398px;text-align: right;" colspan="5">General Average</td>
                                                        </tr>
                                                    </tbody>
                                                </table>   

                                              </div>
                     

                          </div><!-- end of recent-sales box-->
                      
                      </div > <!-- class="sales-boxes" -->
                </div> <!-- home-content -->

                     
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