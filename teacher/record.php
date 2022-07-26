<?php
session_start();
// If the user is not logged in redirect to the login page...
if(!isset($_SESSION['loggedin'])){
    header('Location: index.html');
    exit;
}//end of if

/*$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_Passed = '';
$DATABASE_NAME = 'schoolBoard_database';*/

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'schoolBoard';
$DATABASE_Passed = '54HPneK7CC9NLhj';
$DATABASE_NAME = 'schoolBoard_database';

$year = $_SESSION['year'];
$section = $_SESSION['advisorysec']; 

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_Passed, $DATABASE_NAME);

//Query to display Male students
$query1 = "SELECT student_info.*, student_year.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Sex ='Male' AND Section = '$section'";

$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));

//Query to display female students
$query2 = "SELECT student_info.*, student_year.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Sex ='Female' AND Section = '$section'";

$result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

function getGrade($SubjectName,$QuarterPeriod,$StudentLRN)
  {
     if($SubjectName == "MAPEH")
    {
      $m_grade =0;
      $sql_m = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentLRN AND grades_per_subject.subject = 'Music' AND grades_per_subject.periodic_grading = $QuarterPeriod";

      $sql_a = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentLRN AND grades_per_subject.subject ='Arts' AND grades_per_subject.periodic_grading = $QuarterPeriod";

      $sql_p = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentLRN AND grades_per_subject.subject ='Physical Education' AND grades_per_subject.periodic_grading = $QuarterPeriod";

      $sql_h = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentLRN AND grades_per_subject.subject ='Health' AND grades_per_subject.periodic_grading = $QuarterPeriod";
    
      
      //Music
      $res_m = mysqli_query($GLOBALS['conn'], $sql_m);
      if(mysqli_num_rows($res_m)==0){
        ///$m1 = 0;
      }
      else{
        if($res_m->num_rows > 0){
          while($row = $res_m->fetch_assoc()) 
               {
                 $m1 = $row["grade"];
                }
        }
      }
      //Arts
      $res_a = mysqli_query($GLOBALS['conn'], $sql_a);
      if(mysqli_num_rows($res_a)==0){
        //$m2 = 0;
      }
      else{
        if($res_a->num_rows > 0){
          while($row = $res_a->fetch_assoc()) 
               {
                 $m2 = $row["grade"];
                }
        }
      }
      //PE
      $res_p = mysqli_query($GLOBALS['conn'], $sql_p);
      if(mysqli_num_rows($res_p)==0){
        //$m3 = 0;
      }
      else{
        if($res_p->num_rows > 0){
          while($row = $res_p->fetch_assoc()) 
               {
                 $m3 = $row["grade"];
                }
        }
      }
      //Health
      $res_h = mysqli_query($GLOBALS['conn'], $sql_h);
      if(mysqli_num_rows($res_h)==0){
        //$m4 = 0;
      }
      else{
        if($res_h->num_rows > 0){
          while($row = $res_h->fetch_assoc()) 
               {
                 $m4 = $row["grade"];
                }
        }
      }

      if(empty($m1) || empty($m2) || empty($m3) || empty($m4))
      {
        //
      }
      else
      {
              $m_grade = ($m1 + $m2 + $m3 + $m4)/4;
              return $m_grade;
      }


    }//end of if statement


    else
    {
      $sql1 = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN = $StudentLRN
          AND grades_per_subject.subject=  '". $SubjectName. "' AND grades_per_subject.periodic_grading = $QuarterPeriod";

    $result = mysqli_query($GLOBALS['conn'], $sql1);
                      
       if (mysqli_num_rows($result)==0) { 
              $subjectgrade ='';
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
    }

  }//end of getGrade() function

function compGrade($G_quarter1,$G_quarter2,$G_quarter3,$G_quarter4){
  $answer = '';
  $answer = ($G_quarter1 + $G_quarter2 + $G_quarter3 + $G_quarter4)/4;
  return $answer;
}//end of compGrade() function

?>

<!DOCTYPE html>
<html>
<head>
  <title>Class Record</title>
  <title>School Board</title>
		<link href="style.css" rel="stylesheet" type= "text/css">
		<link rel="icon" href="images/SB-logo.png">
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
              font-size: 15px;
              padding: 3px;
              align-content: center;
            }
            th{
              font-size: 20px;
              font-weight: 600;
            }
  </style>
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
          <a href="students.php">
            <i class='bx bx-chalkboard' ></i>
            <span class="links_name">Manage Students</span>
          </a>
        </li>
        <li>
          <a href="record.php"  class="active">
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
        <span class="dashboard">Class Record</span>
      </div>
  
      <div class="profile-details">
        <img src="images/wonwoo.png" alt="">
        

        <a href="logout.php">
            <i class='bx bx-log-out' ></i>
        </a>
        
      </div>
    </nav>

    <div class="home-content">
      

      <div class="sales-boxes" style="width: 100%">
            <div class="recent-sales box" style="width:70%">
                            
                  <!-- Insert code here -->
                  <!-- Table for the content part of the class record -->
                  <?php $in_view = 'Filipino'; ?>
                              <?php if(isset($_POST['subj'])): ?>
                  <?php $in_view = $_POST['subj']; ?>             
            <?php endif;  ?>
            <table style="width: 700px; margin-left: 5px; font-size: 12px; font-family: 'Poppins', sans-serif; color: #194e63;">

              <tr style="height:10px;">
                <td style="width: 20px; height: 40px;text-align: center;" rowspan="2">LRN</td>
                <td style="width: 500px; height: 40px;text-align: center;" rowspan="2">LEARNERS' NAMES</td>
                <td style="width: 257px;height: 20px;text-align: center;" colspan="6"><?php echo $in_view; ?></td>
               
              </tr>
              <tr style="height:10px;">
                <td style="width: 62px; height: 20px;"text-align: center;>&nbsp;1</td>
                <td style="width: 66px; height: 20px;"text-align: center;>&nbsp;2</td>
                <td style="width: 63px; height: 20px;"text-align: center;>&nbsp;3</td>
                <td style="width: 66px; height: 20px;"text-align: center;>&nbsp;4</td>
                 <td style="width: 90px; height: 40px;text-align: center;" >FINAL GRADE</td>
                <td style="width: 97px; height: 40px;text-align: center;" >REMARKS</td>
              </tr>

              <!-- Display Male students -->
              <tr>
            <td class="tg-0pky">MALE</td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
          </tr>


  <?php while($row = mysqli_fetch_array($result1)):;?>
              <!-- Filipino -->
             <tr style="height:10px;">
                <!-- LRN -->
                <td style="width: 141px; height: 20px;"><?php echo $row[0]; ?></td>
                <!-- Learner's Name -->
                <td style="width: 62px; height: 20px;"><?php echo $row[1],", ",$row[2],", ",$row[3];?></td>
                <!-- quarter1 -->
                <td style="width: 63px; height: 20px;"text-align: center;>
                  <?php
                  $q1 = '';
                  $q1 = getGrade($in_view,1, $row[0]);
                  echo $q1;
                  ?>
                </td>
                <!-- quarter2 -->
                <td style="width: 66px; height: 20px;"text-align: center;>
                  <?php
                  $q2 = '';
                  $q2 = getGrade($in_view,2, $row[0]);
                  echo $q2;
                  ?>
                </td>
                <!-- quarter3 -->
                <td style="width: 66px; height: 20px;"text-align: center;>
                  <?php
                  $q3 = '';
                  $q3 = getGrade($in_view,3, $row[0]);
                  echo $q3;
                  ?>
                </td>
                <!-- quarter4 -->
                <td style="width: 66px; height: 20px;"text-align: center;>           
                  <?php
                  $q4 = '';
                  $q4 = getGrade($in_view,4, $row[0]);
                  echo $q4;
                  ?>
                </td>
                <!-- Final Grade -->
                <td style="width: 66px; height: 20px;"text-align: center;>
                  <?php
                  if(empty($q1) || empty($q2) || empty($q3) || empty($q4))
                  {
                    $y = '';
                  }
                  else
                  {
                    $y = compGrade($q1, $q2, $q3, $q4);
                    echo $y;
                  }
                  ?>
                </td>
                <!-- Remark -->
                <td style="width: 66px; height: 20px;"text-align: center;>
                  <?php
                  if($y == '')
                  {
                    echo '';
                  }
                  else
                  {
                    if($y == 75)
                      echo "PASSED";
                    else if($y > 75)
                      echo "PASSED";
                    else
                      echo "FAILED";
                  }
                  ?>
                </td>
    <?php endwhile;?> 
            </tr>

            <tr>
          <td class="tg-0pky">FEMALE</td>
          <td class="tg-0pky"></td>
          <td class="tg-0pky"></td>
          <td class="tg-0pky"></td>
          <td class="tg-0pky"></td>
          <td class="tg-0pky"></td>
          <td class="tg-0pky"></td>
          <td class="tg-0pky"></td>
        </tr>

    <?php while($row = mysqli_fetch_array($result2)):;?>
        <tr style="height:10px;">
                <!-- LRN -->
                <td style="width: 141px; height: 20px;"><?php echo $row[0]; ?></td>
                <!-- Learner's Name -->
                <td style="width: 62px; height: 20px;"><?php echo $row[1],", ",$row[2],", ",$row[3];?></td>
                <!-- quarter1 -->
                <td style="width: 63px; height: 20px;"text-align: center;>
                  <?php
                  $q1 = '';
                  $q1 = getGrade($in_view,1, $row[0]);
                  echo $q1;
                  ?>
                </td>
                <!-- quarter2 -->
                <td style="width: 66px; height: 20px;"text-align: center;>
                  <?php
                  $q2 = '';
                  $q2 = getGrade($in_view,2, $row[0]);
                  echo $q2;
                  ?>
                </td>
                <!-- quarter3 -->
                <td style="width: 66px; height: 20px;"text-align: center;>
                  <?php
                  $q3 = '';
                  $q3 = getGrade($in_view,3, $row[0]);
                  echo $q3;
                  ?>
                </td>
                <!-- quarter4 -->
                <td style="width: 66px; height: 20px;"text-align: center;>           
                  <?php
                  $q4 = '';
                  $q4 = getGrade($in_view,4, $row[0]);
                  echo $q4;
                  ?>
                </td>
                <!-- Final Grade -->
                <td style="width: 66px; height: 20px;"text-align: center;>
                  <?php
                  if(empty($q1) || empty($q2) || empty($q3) || empty($q4))
                  {
                    $y = '';
                  }
                  else
                  {
                    $y = compGrade($q1, $q2, $q3, $q4);
                    echo $y;
                  }
                  ?>
                </td>
                <!-- Remark -->
                <td style="width: 66px; height: 20px;"text-align: center;>
                  <?php
                  if($y == '')
                  {
                    echo '';
                  }
                  else
                  {
                    if($y == 75)
                      echo "PASSED";
                    else if($y > 75)
                      echo "PASSED";
                    else
                      echo "FAILED";
                  }
                  ?>
                </td>
    <?php endwhile;?>        
            </tr>
          </table>      

            </div>

            <div class="recent-sales box" style="width:25%; text-align: left;">
                            
                   <!-- Insert code here -->
              <form method="POST" action="record.php">
              <input style="width: 230px; font-size: 11px;" type="submit" name="subj" value="Filipino" /><br><br>
              <input style="width: 230px; font-size: 11px;" type="submit" name="subj" value="English" /><br><br>
              <input style="width: 230px; font-size: 11px;" type="submit" name="subj" value="Araling Panlipunan" /><br><br>
              <input style="width: 230px; font-size: 11px;" type="submit" name="subj" value="Math" /><br><br>
              <input style="width: 230px; font-size: 11px;" type="submit" name="subj" value="Science" /><br><br>
              <input style="width: 230px; font-size: 11px;" type="submit" name="subj" value="Technology and Livelihood Education" /><br><br>
              <input style="width: 230px; font-size: 11px;" type="submit" name="subj" value="Edukasyon sa Pagpapakatao" /><br><br>
              <input style="width: 230px; font-size: 11px;" type="submit" name="subj" value="MAPEH" /><br><br>
            </form>

            <?php if(isset($_POST['subj'])): ?>
                  <?php $in_view = $_POST['subj']; ?>             
            <?php endif;  ?>     

            </div>
            
      </div>      
    </div>

       
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