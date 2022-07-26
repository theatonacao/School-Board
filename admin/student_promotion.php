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
               $index = 1;
               $x = 0;

            $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            //echo 
            if (mysqli_connect_errno()) {
              exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }

            //IF CHANGE REQUEST CONFIRMED
            if(isset($_POST['update'])){ 
               
                $LRN = $_POST["lrn"];
                
                $Year_lvl = $_POST["Year_lvl"];
                $Section = $_POST["prevSection"]; 
                $newSection = $_POST["toSection"]; 


                $sql ="UPDATE student_year
                SET student_year.Year_lvl = 'Grade 8', student_year.Section= '$newSection'
                WHERE newSection = $newSection" ;

                if( $conn->query($sql)===TRUE){

                }


                
            }
            else{
              //echo 'wala nasulod ';
             
            }
 mysqli_close($conn);
?>
 
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Class Promotion</title>
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
          <a href="student_info.php" >
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
          <a href="class_info.php" class="active">
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
        <span class="dashboard">Class Promotion</span>
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
        <div class="box bttns " style="width:49%; cursor: pointer;" onclick="window.location='admission_form.php';">
          <div class="right-side" >
            <div class="box-topic">Sections</div>
          </div>
        </div>
        <div class="box bttns active" style="width:49%; cursor: pointer;" onclick="window.location='student_promotion.php';">
          <div class="right-side" >
            <div class="box-topic">Class Promotion</div>
          </div>
        </div> 
        
      </div>
      
      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title">Promote Student</div>
          
          <br> <br> 
          <form action="student_promotion.php" method="POST">
              <div class="formrow">
                <div class="formcol1" >
                    <label for="year" > From Grade level </label>
                </div>
                <div class="formcol2" >
                    <select id="year" name="year" required="">
                      <option value="Grade 7">Grade 7</option>
                      <option value="Grade 8">Grade 8</option>
                      <option value="Grade 9">Grade 9</option>
                      <option value="Grade 10">Grade 10</option>
                      <option value="Grade 11">Grade 11</option>
                      <option value="Grade 12">Grade 12</option>
                    </select>
                  </div>
                </div>
            <div class="formrow">
                <div class="formcol1" >
                    <label for="year" > To Grade level </label>
                </div>
                <div class="formcol2" >
                    <select id="year" name="year" required="">
                      <option value="Grade 7">Grade 7</option>
                      <option value="Grade 8">Grade 8</option>
                      <option value="Grade 9">Grade 9</option>
                      <option value="Grade 10">Grade 10</option>
                      <option value="Grade 11">Grade 11</option>
                      <option value="Grade 12">Grade 12</option>
                    </select>
                  </div>
                </div>
                <div class="formrow">
                <div class="formcol1" >
                    <label for="prevSection" > From Class </label>
                </div>
                <div class="formcol2" >
                    <input type="text"id="prevSection" name="prevSection" placeholder="Section"  required="">
                  </div>
                </div>
                <div class="formrow">
                <div class="formcol1" >
                    <label for="toSection" > To Class </label>
                </div>
                <div class="formcol2" >
                    <input type="text"id="toSection" name="toSection" placeholder="Surname"  required="">
                  </div>
                </div>
                <input type="submit"  name="update" value="Promote" class="submitbttn" style="float: right;">
            </form>
         

          
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

