<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 <!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Student Information</title>
    <link rel = "icon" href =  "images/SB-logo.png"  type = "image/x-icon">
    <link rel="stylesheet" href="welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <span class="dashboard">Student Information</span>
      </div>
      
      <div class="profile-details">
      <img src="images/default_pfp.jpg" alt="">
        <span class="admin_name"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
        <a href="logout.php">
            <i class='bx bx-log-out' ></i>
        </a>
        
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box bttns active" style="width:49%;cursor: pointer;" onclick="window.location='student_info.php';">
          <div class="right-side" >
            <div class="box-topic">Student Details</div>
            
          </div>
          
        </div>
        <div class="box bttns" style="width:49%; cursor: pointer;" onclick="window.location='admission_form.php';">
          <div class="right-side" >
            <div class="box-topic">Admission Form</div>
          </div>
        </div>
      </div>
      
      <?php
        $id = isset($_GET["id"]) ? $_GET["id"] : false;
        if ($id === false) {
          exit("missing input");
        }
        
        $con=mysqli_connect("localhost","schoolBoard","54HPneK7CC9NLhj","schoolBoard_database");
              // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
           
        $query="SELECT `student_info`.`LRN`, `student_info`.`Lastname`, `student_info`.`Firstname`, `student_info`.`Middlename`, `student_year`.`Year_lvl`, `student_year`.`Section`, `student_contact`.`Email`, `student_contact`.`Mobile_num`, `student_info`.`Birthdate`, `student_info`.`Birthplace`, `student_info`.`Mothertongue`, `student_info`.`Ethnic`, `student_info`.`Religion`, `student_info`.`Citizenship`, `student_contact`.`Street`, `student_contact`.`Barangay`, `student_contact`.`Barangay`, `student_contact`.`City`, `student_contact`.`Province`, `student_guardian_info`.`Father_name`, `student_guardian_info`.`Mother_name`, `student_guardian_info`.`Guardian_name`, `student_guardian_contact`.`Guardian_contact`
        FROM `student_info`
          , `student_year`
          , `student_contact`
          , `student_guardian_info`
          , `student_guardian_contact`
          WHERE student_info.LRN = $id";
        $result = mysqli_query($con,$query);
              
        if($row = mysqli_fetch_array($result))
        {
      echo '<div class="sales-boxes">';
        echo '<div class="recent-sales box" style="width:100%;""><div class="title" style="cursor: pointer;"  onclick="history.back()"><i class="bx bxs-left-arrow-circle"></i></div>';
            echo '<div class="formrow">';
              
                echo '<div class="formcol1" style=" text-align: center" >';
                   echo' <img src="images/default_pfp.jpg" class="profilepic" style="width: 200px;height: 200px;" alt=""> <br>';
                    
                        echo  "<label> LRN:" . $row['LRN'] ."</label><br>" ;
                        echo "<a href='edit_StudentProfile.php?id=". $row['LRN'] . "'><button type='submit' name='view_data' style='background-color: #e07a5f; border: none; border-radius: 17px; color: #333; /* Dark grey */ padding: 10px 27px;cursor: pointer; margin: 5px; width: 90%;'>Edit Information</button></a><br>";
                        echo "<a href='studentGradedisplay.php?id=". $row['LRN'] . "'><button type='submit' name='view_data' style='background-color: #e07a5f; border: none; border-radius: 17px; color: #333; /* Dark grey */ padding: 10px 27px;cursor: pointer; margin: 5px; width: 90%;'>See Student Grades</button></a><br>";
                        echo "<a href='studentPerfdisplay.php?id=". $row['LRN'] . "'><button type='submit' name='view_data' style='background-color: #e07a5f; border: none; border-radius: 17px; color: #333; /* Dark grey */ padding: 10px 27px;cursor: pointer; margin: 5px; width: 90%;'>See Student Performance</button></a>";
                    
                echo "</div>";
                  echo '<div class="formcol2" style="color: black;">';
                    echo '<label >';
                    
                        echo '<span style="font-size: 25pt" > <b>' . $row['Firstname'] . " ". $row['Lastname'] .'</b> </span> <br><br>';
                        echo "Grade Level: ". $row['Year_lvl'] ."<br>";
                        echo "Section:". $row['Section'] ." <br>";
                        echo "E-mail:". $row['Email'] ."<br>";
                        echo "Mobile Number:". $row['Mobile_num'] ."<br><br>";
                        echo "<b> PERSONAL INFORMATION</b>
                        <br>";
                        echo "Date of Birth: ". $row['Birthdate'] ."<br>";
                        echo "Place of Birth:". $row['Birthplace'] ." <br>";
                        echo "Sex:<br>";
                        echo "Mother Tongue:". $row['Mothertongue'] ."<br>";
                        echo "Ethnic Group:". $row['Ethnic'] ."<br>";
                        echo "Religion: ". $row['Religion'] . "<br>";
                        echo "Citizenship:". $row['Citizenship'] ."<br>";
                        echo "Residential Address: ". $row['Street'] . ", ". $row['Barangay'] . ", " . $row['City'] .", " . $row['Province'] ."<br><br>";
                        echo "<b> PARENT/GUARDIAN INFORMATION</b><br>";
                        echo "Father's Name: ". $row['Father_name'] ."<br>";
                        echo "Father's Occupation:<br>";
                        echo "Mother's Name:". $row['Mother_name'] ."<br>";
                        echo "Mother's Occupation:<br>";
                        echo "Guardian's Name: ". $row['Guardian_name'] ."<br>";
                        echo "Contact Number:". $row['Guardian_contact'] ."<br>";
                    echo "</label>";
                  echo "</div>";
                }
                      
                mysqli_close($con);?>
            </div>

            <div style="background-color: teal; padding-left: 15px; color: white">
                <label>Student Forms</label>
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
</html>

