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

        $sqlSS= "SELECT * FROM quarter_status WHERE quarter_status.LRN = '$StudentNo'";
        $resultSS = mysqli_query($conn, $sqlSS);

            if($resultSS->num_rows > 0){
            // output data of each row
            while($row = $resultSS->fetch_assoc() ) {
                $Q1_STATUS = $row["Status_Q1"];
                $Q2_STATUS = $row["Status_Q2"];
                $Q3_STATUS = $row["Status_Q3"];
                $Q4_STATUS = $row["Status_Q4"];
                
                }
              
            }else{
                echo '<br>';    
                echo "<h4>NOT CONNECTED</h4>";
            }
      
    }else{
        echo '<br>';    
        echo "<h4>Student information for ".$StudentNo." is empty. </h4>";
    }


    //php function to retrieve grade from a specific subject + period
    function getGrade($subjectname,$gradeperiod){

         switch ($gradeperiod) {
            case 1:
                $Q_STATUS = $GLOBALS['Q1_STATUS'];

                break;
            case 2:
                $Q_STATUS = $GLOBALS['Q2_STATUS'];
                break;
            case 3:
                $Q_STATUS = $GLOBALS['Q3_STATUS'];
                break;
            case 4:
                $Q_STATUS = $GLOBALS['Q4_STATUS'];
                break;
        }

        if( $Q_STATUS=='Final'){

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
        }else echo ''; 
      } //end of getGrade() function

      function getQuarterAve($quarter){

        switch ($quarter) {
            case 1:
                $Q_STATUS = $GLOBALS['Q1_STATUS'];

                break;
            case 2:
                $Q_STATUS = $GLOBALS['Q2_STATUS'];
                break;
            case 3:
                $Q_STATUS = $GLOBALS['Q3_STATUS'];
                break;
            case 4:
                $Q_STATUS = $GLOBALS['Q4_STATUS'];
                break;
        }

        if ($Q_STATUS=='Final') {
            // code...
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
        }else echo ''; 
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
      }//end of getGrade function

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
      }//end of getGrade function

    $folder = "profileimg/";//profile images foldername

     $sql = "SELECT * FROM `profile_img` WHERE LRN =  '$StudentNo'";
     
     $result = mysqli_query($conn, $sql);

      //has profile pic
      if($result->num_rows > 0){

         while($row = $result->fetch_assoc() ) {
          $filename = $row["file_name"];
         }
         
         $imgfilename = $folder.$filename;
          $imagestatus=1;
        //echo   $imgfilename;

      }else{//no prof pic display default
        $imagestatus=0;
        //display defaul pic
         $imgfilename = $folder."profileimg.png";
       
      }

    ?> 

 <!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="welcome_styles.css">
    <!-- Boxicons CDN Link -->

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://cdn.anychart.com/releases/8.0.0/js/anychart-base.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="icon" href="SB-logo.png">

   </head>
<body>
    <!-- div for hidden element placeholder to retrieve all phpdata grades and forward to javascript w/o using AJAX-->
            <input type="hidden" name="quart" id="quart1" value="<?php echo $Q1_STATUS; ?>">
            <input type="hidden" name="quart" id="quart2" value="<?php echo $Q2_STATUS;?>">
            <input type="hidden" name="quart" id="quart3" value="<?php echo $Q3_STATUS;?>">
            <input type="hidden" name="quart" id="quart4" value="<?php echo $Q4_STATUS;?>">
       
            <!-- Filipino -->
            <input type="hidden" name="Filipino" id="Filipino1" value="<?php echo getGrade('Filipino', 1);?>">
            <input type="hidden" name="Filipino" id="Filipino2" value="<?php echo getGrade('Filipino', 2);?>">
            <input type="hidden" name="Filipino" id="Filipino3" value="<?php echo getGrade('Filipino', 3);?>">
            <input type="hidden" name="Filipino" id="Filipino4" value="<?php echo getGrade('Filipino', 4);?>">

            <input type="hidden" name="English" id="English1" value="<?php echo getGrade('English', 1);?>">
            <input type="hidden" name="English" id="English2" value="<?php echo getGrade('English', 2);?>">
            <input type="hidden" name="English" id="English3" value="<?php echo getGrade('English', 3);?>">
            <input type="hidden" name="English" id="English4" value="<?php echo getGrade('English', 4);?>">


            <input type="hidden" name="Araling Panlipunan" id="Araling Panlipunan1" value="<?php echo getGrade('Araling Panlipunan', 1);?>">
            <input type="hidden" name="Araling Panlipunan" id="Araling Panlipunan2" value="<?php echo getGrade('Araling Panlipunan', 2);?>">
            <input type="hidden" name="Araling Panlipunan" id="Araling Panlipunan3" value="<?php echo getGrade('Araling Panlipunan', 3);?>">
            <input type="hidden" name="Araling Panlipunan" id="Araling Panlipunan4" value="<?php echo getGrade('Araling Panlipunan', 4);?>">

            <input type="hidden" name="Math" id="Math1" value="<?php echo getGrade('Math', 1);?>">
            <input type="hidden" name="Math" id="Math2" value="<?php echo getGrade('Math', 2);?>">
            <input type="hidden" name="Math" id="Math3" value="<?php echo getGrade('Math', 3);?>">
            <input type="hidden" name="Math" id="Math4" value="<?php echo getGrade('Math', 4);?>">

            <input type="hidden" name="Science" id="Science1" value="<?php echo getGrade('Science', 1);?>">
            <input type="hidden" name="Science" id="Science2" value="<?php echo getGrade('Science', 2);?>">
            <input type="hidden" name="Science" id="Science3" value="<?php echo getGrade('Science', 3);?>">
            <input type="hidden" name="Science" id="Science4" value="<?php echo getGrade('Science', 4);?>">

             <!-- Filipino -->
            <input type="hidden" name="Technology and Livelihood Education" id="Technology and Livelihood Education1" value="<?php echo getGrade('Technology and Livelihood Education', 1);?>">
            <input type="hidden" name="Technology and Livelihood Education" id="Technology and Livelihood Education2" value="<?php echo getGrade('Technology and Livelihood Education', 2);?>">
            <input type="hidden" name="Technology and Livelihood Education" id="Technology and Livelihood Education3" value="<?php echo getGrade('Technology and Livelihood Education', 3);?>">
            <input type="hidden" name="Technology and Livelihood Education" id="Technology and Livelihood Education4" value="<?php echo getGrade('Technology and Livelihood Education', 4);?>">

            <input type="hidden" name="Edukasyon sa Pagpapakatao" id ="Edukasyon sa Pagpapakatao1" value="<?php echo getGrade('Edukasyon sa Pagpapakatao', 1);?>">
            <input type="hidden" name="Edukasyon sa Pagpapakatao" id ="Edukasyon sa Pagpapakatao2" value="<?php echo getGrade('Edukasyon sa Pagpapakatao', 2);?>">
            <input type="hidden" name="Edukasyon sa Pagpapakatao" id ="Edukasyon sa Pagpapakatao3" value="<?php echo getGrade('Edukasyon sa Pagpapakatao', 3);?>">
            <input type="hidden" name="Edukasyon sa Pagpapakatao" id ="Edukasyon sa Pagpapakatao4" value="<?php echo getGrade('Edukasyon sa Pagpapakatao', 4);?>">
<!-- UPDATE DATABASE MAPEH AVE -->
           <input type="hidden" name="MAPEH" id="MAPEH1" value=" <?php 
                                                                    $s1 = getGrade('Music', 1);
                                                                    $s2 = getGrade('Arts', 1);
                                                                    $s3 = getGrade('Physical Education', 1);
                                                                    $s4 = getGrade('Health', 1);
                                                                    $M1 = getAverage($s1,$s2,$s3,$s4);
                                                                    echo $M1;
                                                                ?>">
            <input type="hidden" name="MAPEH" id="MAPEH2" value="<?php 
                                                                    $s1 = getGrade('Music', 2);
                                                                    $s2 = getGrade('Arts', 2);
                                                                    $s3 = getGrade('Physical Education', 2);
                                                                    $s4 = getGrade('Health', 2);
                                                                    $M2 = getAverage($s1,$s2,$s3,$s4);
                                                                    echo $M2;
                                                                ?>">
            <input type="hidden" name="MAPEH" id="MAPEH3" value=" <?php 
                                                                    $s1 = getGrade('Music', 3);
                                                                    $s2 = getGrade('Arts', 3);
                                                                    $s3 = getGrade('Physical Education', 3);
                                                                    $s4 = getGrade('Health', 3);
                                                                    $M3 = getAverage($s1,$s2,$s3,$s4);
                                                                    echo $M3;
                                                                ?>">
            <input type="hidden" name="MAPEH" id="MAPEH4" value="<?php 
                                                                    $s1 = getGrade('Music', 4);
                                                                    $s2 = getGrade('Arts', 4);
                                                                    $s3 = getGrade('Physical Education', 4);
                                                                    $s4 = getGrade('Health', 4);
                                                                    $M4 = getAverage($s1,$s2,$s3,$s4);
                                                                    echo $M4;
                                                                ?>"> 

            <input type="hidden" name="Final" id="Final1" value=" <?php 
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
                                                                   //  echo getQuarterAve(1);?> ">
            <input type="hidden" name="Final" id="Final2" value="<?php 
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
                                                                   //  echo getQuarterAve(2);?> ">
            <input type="hidden" name="Final" id="Final3" value=" <?php 
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
                                                                   //  echo getQuarterAve(3);?> ">
            <input type="hidden" name="Final" id="Final4" value="<?php 
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
                                                                   //  echo getQuarterAve(4);?> ">
<!-- end of hidden input -->
  <div class="sidebar">
    <div class="logo-details">
      <i><img src="../admin/images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" ></i>
      <span class="logo_name">SchoolBoard</span>
    </div>
      <ul class="nav-links">
        <!-- <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li> -->
        <li>
          <a href="profile.php" >
            <i class='bx bx-group' ></i>
            <span class="links_name">My Profile</span>
          </a>
        </li>
        <li>
          <a href="mygrades.php" >
            <i class='bx bx-chalkboard' ></i>
            <span class="links_name">My Grades</span>
          </a>
        </li>
        <li>
          <a href="performanceChart.php" class="active">
            <i class='bx bx-group' ></i>
            <span class="links_name">My Performance</span>
          </a>
        </li>
      
        <li>
          <a href="Elearning_info.php">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">E-Learning</span>
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
        <span class="dashboard"> Performance Tracker</span>
      </div>
  
      <div class="profile-details">
        <img src=" <?php echo $imgfilename?>" alt="">
        <span class="admin_name"><?php echo htmlspecialchars($Firstname); ?></span>

       
        
      </div>
    </nav>

    <div class="home-content" style="padding-top: 80px;">

        <!-- TOP DIV -->
         <div class="sales-boxes" style="margin-top: 20px; width: 95%;">



             <div class="recent-sales box" >
                <div class="overview-boxes"style = "display: flex;justify-content: center; padding-bottom: none;">
                    <div class="title" style="text-align:center; ">Quarter 1<br> 

                        <span style="color:navy; " id=dispQ1></span>

                    </div>
                </div>
             </div>

             <div class="recent-sales box"  >
                <div class="overview-boxes"style = "display: flex;justify-content: center;">
                    <div class="title" style="text-align:center;">Quarter 2<br> 
                         <span style="color:navy; " id=dispQ2></span>

                         <?php
                         if($q1!=0 && $q2!=0){
                                if($q2>$q1){
                                    echo '<i class="bx bx-up-arrow-alt" style="color:green" ></i>';
                                    $diff=$q2-$q1;
                                    echo '<span style="color:green; font-size: 12px;">'.$diff.'</span>';

                                }else if($q2<$q1){
                                    echo '<i class="bx bx-down-arrow-alt" style="color:red" ></i>';
                                    $diff=$q2-$q1;
                                    echo '<span style="color:red; font-size: 12px;">'.$diff.'</span>';
                                }
                         }

                        ?>
                    </div>
                </div>
             </div>

             <div class="recent-sales box"  >
                <div class="overview-boxes"style = "display: flex;justify-content: center;">
                   <div class="title" style="text-align:center;">Quarter 3<br> 
                         <span style="color:navy; " id=dispQ3></span>
                         <?php
                         if($q2!=0 && $q3!=0){
                            if($q3>$q2){
                                echo '<i class="bx bx-up-arrow-alt" style="color:green" ></i>';
                                $diff=$q3-$q2;
                                echo '<span style="color:green; font-size: 12px;">'.$diff.'</span>';

                            }else if($q3<$q2){
                                echo '<i class="bx bx-down-arrow-alt" style="color:red" ></i>';
                                $diff=$q3-$q2;
                                echo '<span style="color:red; font-size: 12px;">'.$diff.'</span>';
                            }
                        }

                        ?>
                    </div>
                </div>
             </div>

             <div class="recent-sales box"  >
                <div class="overview-boxes"style = "display: flex;justify-content: center;">
                   <div class="title" style="text-align:center;">Quarter 4<br> 
                         <span style="color:navy; " id=dispQ4></span>
                          <?php
                           if($q3!=0 && $q4!=0){
                                if($q4>$q3){
                                    echo '<i class="bx bx-up-arrow-alt" style="color:green" ></i>';
                                    $diff=$q4-$q3;
                                    echo '<span style="color:green; font-size: 12px;">'.$diff.'</span>';

                                }else if($q4<$q3){
                                    echo '<i class="bx bx-down-arrow-alt" style="color:red" ></i>';
                                    $diff=$q4-$q3;
                                    echo '<span style="color:red; font-size: 12px;">'.$diff.'</span>';
                                }
                            }

                        ?>
                    </div>
                </div>
             </div>


         </div>


      <div class="sales-boxes">


        <div class="recent-sales box" style="float: left; display: block;margin-top: 20px; ">

            <div class="overview-boxes"> <br><br><br><br><br><br>

                <div class="box bttns" style="width:100%;cursor: pointer;"onclick="getChartOverAll();">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;"  >
                        <div class="box-topic">Overall Performance</div>
                    </div>
                </div>
                 <div class="box bttns" style="width:100%;cursor: pointer;"onclick="getChartQuarter(1);">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;"  >
                        <div class="box-topic">1st Quarter</div>
                    </div>
                </div>
                 <div class="box bttns" style="width:100%;cursor: pointer;"onclick="getChartQuarter(2);">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;"  >
                        <div class="box-topic">2nd Quarter</div>
                    </div>
                </div>
                 <div class="box bttns" style="width:100%;cursor: pointer;" onclick="getChartQuarter(3);">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" >
                        <div class="box-topic">3rd Quarter</div>
                    </div>
                </div>
                 <div class="box bttns" style="width:100%;cursor: pointer;"onclick="getChartQuarter(4);">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;"  >
                        <div class="box-topic">4th Quarter</div>
                    </div>
                </div>


         <!-- Dropdown per Subject -->
        <div class="select-menu"  style=" width:32%%;">
        <div class="select-btn" style=" position: absolute; width:32%;">
            <span class="sBtn-text">Per Subject</span>
            <i class="bx bx-chevron-down"></i>
        </div>

        <ul class="options" style=" position: absolute; text-align:center;" >
            <li class="option"  onclick="getChartSubject('Filipino')">
                <i class="bx" style="color: #171515;"></i>
                <span class="option-text">Filipino</span>
            </li>
            <li class="option"  onclick="getChartSubject('English')">
                <i class="bx" style="color: #E1306C;"></i>
                <span class="option-text">English</span>
            </li>
            <li class="option"  onclick="getChartSubject('Math')">
                <i class="bx" style="color: #0E76A8;"></i>
                <span class="option-text">Math</span>
            </li>
            <li class="option"  onclick="getChartSubject('Science')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">Science</span>
            </li>
            <li class="option" onclick="getChartSubject('Araling Panlipunan')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">Araling Panlipunan</span>
            </li>
            <li class="option" onclick="getChartSubject('Edukasyon sa Pagpapakatao')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">Edukasyon sa Pagpapakatao</span>
            </li>
            <li class="option" onclick="getChartSubject('Technology and Livelihood Education')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">TLE</span>
            </li>
            <li class="option"  onclick="getChartSubject('MAPEH')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">MAPEH</span>
            </li>
        </ul>
        </div>
          <!-- end of char -->

      </div><br><br>
            
        </div>
            <div class="recent-sales box" style="width:100%; height: 500px; margin-top: 20px;float: left;">
                 
<!-- INSERT HERE -->



           
                <p id=title style="text-align: center; font-size: 20px;"></p>
            <div id="container" style="width: 100%; height: 400px; margin-left: 10px; margin-top:5px;" >
                <!-- Graph will be displayed here -->


                
            </div>

        
       
        


<!-- do not go beyond -->
                          
                          
                          </div><!-- end of recent-sales box-->
                      </div > <!-- class="sales-boxes" -->
                </div> <!-- home-content -->


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

    const optionMenu = document.querySelector(".select-menu"),
       selectBtn = optionMenu.querySelector(".select-btn"),
       options = optionMenu.querySelectorAll(".option"),
       sBtn_text = optionMenu.querySelector(".sBtn-text");

    selectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));       

    options.forEach(option =>{
        option.addEventListener("click", ()=>{
            let selectedOption = option.querySelector(".option-text").innerText;
            sBtn_text.innerText = selectedOption;

            optionMenu.classList.remove("active");
        });
    });





   //chart generation 

    var chart = anychart.line();


    function getChartSubject(subj){
        var grade= new Array(4);
        var restricted_quarter= new Array(4);

        for(var i = 0; i<4; i++){
            var item = document.getElementsByName('quart')[i].value;
            if(item=='Not Final'){
                restricted_quarter[i] = 0;
            }else if(item=='Final'){
                restricted_quarter[i] = 1;
            }
        }


        for(var i = 0; i<4; i++){
            var item = document.getElementsByName(subj)[i].value;
            if(restricted_quarter[i] = 1){
                 grade[i]=item;
            }
        }

        


           // set the data

            var data = {
                header: ["Subject", "Grade"],
                rows: [   ["1st Quarter", grade[0]],
                          ["2nd Quarter", grade[1]],
                          ["3rd Quarter", grade[2]],
                          ["4th Quarter", grade[3]]
                    ]};

                chart.background().fill("white");

                //set yaxis range in chart
                chart.yScale().minimum(75);
                chart.yScale().maximum(100);

                // enable major grids
                    chart.xGrid().enabled(true);
                    chart.yGrid().enabled(true);
                // enable minor grids
                    chart.xMinorGrid().enabled(true);
                    chart.yMinorGrid().enabled(true);

                //transparent background
                    var background = chart.background();
                        background.stroke("3");
                        background.cornerType("round");
                        background.corners(10);
             
               // add the data
                    chart.data(data);
             
                // set the chart title
                 document.getElementById("title").innerHTML = "Performance in " + subj;
                   // chart.title(" Performance in " + subj);
             
                // draw
                    chart.container("container");
                    chart.draw();
                //end of drawchart section

               
    }//end of get Chart Subject Function


       function getChartOverAll(){
        var grade= new Array(4);
        var restricted_quarter= new Array(4);

        for(var i = 0; i<4; i++){
            var item = document.getElementsByName('quart')[i].value;
            if(item=='Not Final'){
                restricted_quarter[i] = 0;
            }else if(item=='Final'){
                restricted_quarter[i] = 1;
            }
        }


        for(var i = 0; i<4; i++){
            var item = document.getElementsByName('Final')[i].value;

            if(restricted_quarter[i] = 1){
                 grade[i]=item;
            }else if(restricted_quarter[i] = 0){
                 grade[i]=null;
            }
           
        }

         document.getElementById("dispQ1").innerHTML = grade[0];


         document.getElementById("dispQ2").innerHTML = grade[1];


         document.getElementById("dispQ3").innerHTML = grade[2];


         document.getElementById("dispQ4").innerHTML = grade[3];

           // set the data

            var data = {
                header: ["Quarter", "Grade"],
                rows: [   ["1st Quarter", grade[0]],
                          ["2nd Quarter", grade[1]],
                          ["3rd Quarter", grade[2]],
                          ["4th Quarter", grade[3]]
                    ]};

                chart.background().fill("white");

                //set yaxis range in chart
                chart.yScale().minimum(75);
                chart.yScale().maximum(100);

                // enable major grids
                    chart.xGrid().enabled(true);
                    chart.yGrid().enabled(true);
                // enable minor grids
                    chart.xMinorGrid().enabled(true);
                    chart.yMinorGrid().enabled(true);

                //transparent background
                    var background = chart.background();
                        background.stroke("3");
                        background.cornerType("round");
                        background.corners(10);
             
               // add the data
                    chart.data(data);
             
                // set the chart title
                    document.getElementById("title").innerHTML = "Overall Performance";
                    //chart.title("Overall Performance ");
             
                // draw
                    chart.container("container");
                    chart.draw();
                //end of drawchart section

    }//end of get Chart Overall Function

    function getChartQuarter(quarter){
        var grade= new Array(8);
        var subject = new Array(8);
        subject = ["Filipino", "English", "Math","Science", "Araling Panlipunan", "Edukasyon sa Pagpapakatao", "Technology and Livelihood Education", "MAPEH"];
       // var subj = subject[6];
        var subj;
         //var item = document.getElementsByName(subj)[num].value;
           //item = subj;


        for(var i = 0; i<8; i++){  //change to 8  when MAPEH is added to database
            var str = subject[i] + quarter;
            var item = document.getElementById(str).value;
            grade[i]=item;
        }

  //grade[7]=92;// PREDEFINED GRADE FOR MAPEH

           // set the data

            var data = {
                header: ["Subject", "Grade"],
                rows: [   ["Filipino", grade[0]],
                          ["English", grade[1]],
                          ["Math", grade[2]],
                          ["Science",grade[3]],
                          ["Aral Pan",grade[4]],
                          ["ESP",grade[5]],
                          ["TLE", grade[6]]
                          ,["MAPEH", grade[7]]
                    ]};

                chart.background().fill("white");

                //set yaxis range in chart
                chart.yScale().minimum(75);
                chart.yScale().maximum(100);

                // enable major grids
                    chart.xGrid().enabled(true);
                    chart.yGrid().enabled(true);
                // enable minor grids
                    chart.xMinorGrid().enabled(true);
                    chart.yMinorGrid().enabled(true);

                //transparent background
                    var background = chart.background();
                        background.stroke("3");
                        background.cornerType("round");
                        background.corners(10);
             
               // add the data
                    chart.data(data);

                //helper for Quarter Name display
                 var quarterName;
                 switch(quarter){
                    case 1:
                        quarterName = '1st';
                        break;
                    case 2:
                        quarterName = '2nd';
                        break;
                    case 3:
                        quarterName = '3rd';
                        break;
                    case 4:
                        quarterName = '4th';
                        break;

                 }

                  document.getElementById("title").innerHTML = quarterName + " Quarter Performance";
                // set the chart title
                 //   chart.title( quarterName + " Quarter Performance");
             
                // draw
                    chart.container("container");
                    chart.draw();
                //end of drawchart section

    }//end of get Chart Quarter Function
        
                    window.onload=getChartOverAll();
               

 </script>

</body>

<?php

mysqli_close($conn)

?> 
</html>

