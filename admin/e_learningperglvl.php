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
    <title>E-Learning Resources</title>
    <link rel = "icon" href =  "images/schoolboard_logo.png"  type = "image/x-icon">
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
          <a href="#">
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
          <a href="#" class="active">
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
        <span class="dashboard">E-Learning </span>
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
        <div class="box bttns active" style="width:49%; cursor: pointer;" onclick="window.location='Elearning_info.php';">
          <div class="right-side" > 
            <div class="box-topic"><i class='bx bx-file'></i>All Files </div>
            
          </div>
          
        </div>
        <div class="box bttns" style="width:49%; cursor: pointer;" onclick="window.location='add_elearning_file.php';">
          <div class="right-side" > 
            <div class="box-topic"><i class='bx bxs-file-plus'></i>Add New File</div>
            
          </div>
          
        </div>
        
        
        
      </div>
      

      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title"><a href="Elearning_info.php"><i class='bx bxs-left-arrow-circle'></i></a></i>All E-Learning Resources
          </div>
          
          <br>
          
            <div class="overview-boxes">
                <div class="box bttns " style="width:33%;cursor: pointer;" onclick="window.location='grade7sub.php';">
                    <div class="right-side" > 
                        <div class="box-topic">Grade 7</div>  
                    </div>
                </div>
                <div class="box bttns" style="width:33%;cursor: pointer;" onclick="window.location='grade8sub.php';">
                    <div class="right-side" > 
                        <div class="box-topic">Grade 8</div>
                    </div>
                </div>
                <div class="box bttns" style="width:33%;cursor: pointer;" onclick="window.location='grade9sub.php';">
                    <div class="right-side" > 
                        <div class="box-topic">Grade 9</div>
                    </div>
                </div>
                
                
            </div>
            <div class="overview-boxes">
                <div class="box bttns " style="width:33%;cursor: pointer;" onclick="window.location='grade10sub.php';">
                    <div class="right-side" > 
                        <div class="box-topic">Grade 10 </div>  
                    </div>
                </div>
                <div class="box bttns" style="width:33%;cursor: pointer;" onclick="window.location='grade11sub.php';">
                    <div class="right-side" > 
                        <div class="box-topic">Grade 11</div>
                    </div>
                </div>
                <div class="box bttns" style="width:33%;cursor: pointer;" onclick="window.location='grade12sub.php';">
                    <div class="right-side"> 
                        <div class="box-topic">Grade 12</div>
                    </div>
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

