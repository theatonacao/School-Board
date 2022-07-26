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
<html lang="en" dir="ltr">
  <head>
    
    <meta charset="UTF-8">
    <title>Teacher Information</title>
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
          <a href="#" class="active">
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
        <span class="dashboard">Teacher Information</span>
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
      <div class="box bttns active" style="width:49%">
          <div class="right-side" style="cursor: pointer;" onclick="window.location='teacher_info.php';">
            <div class="box-topic">Teacher Details</div>
            
          </div>
          
        </div>
        <div class="box bttns " style="width:49%">
          <div class="right-side" style="cursor: pointer;" onclick="window.location='add_teacher.php';">
            <div class="box-topic">Add Teacher</div>
            
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
                
          $result = mysqli_query($con,"SELECT * FROM teachers Where employeenum='$id';");
                
          while($row = mysqli_fetch_array($result))
          {
            echo'<div class="sales-boxes">';
              echo '<div class="recent-sales box" style="width:100%"> <div class="title" style="cursor: pointer;"  onclick="history.back()"><i class="bx bxs-left-arrow-circle"></i></div>
                  <div class="formrow">
                      <div class="formcol1" style=" text-align: center" >
                          <img src="images/default_pfp.jpg" class="profilepic" style="width: 200px;height: 200px;" alt=""> 
                      </div>
                        <div class="formcol2">
                          <label >';
                            echo'<span style="font-size: 25pt" > <b>' . $row['firstname'] . " ". $row['lastname'] .'</b> </span> <br><br>';
                            echo "<b>Employee Number: </b>" . $row['employeenum'] . "<br> ";
                            echo "<b>Password: </b>" . $row['password'] . " <br>";
                            echo "<b>Position: </b>" . $row['position'] . "<br> ";
                            echo "<b>Grade Level: </b>" . $row['year'] . " <br>";
                            echo "<b>Advisory Section: </b>" . $row['advisorysec'] . " ";
                          }?>
                        </label>
                      </div>
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