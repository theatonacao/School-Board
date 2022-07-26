

 <!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Student Information</title>
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="../admin/welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="SB-logo.png">

    <style type="text/css">
        .bttns{
        background:rgb(252,138,101);
        z-index: 2;
        color: teal;
        }

        .bttns: hover{
        transition: all 0.4s ease;
        transform: scale(1);
        background:teal;
        z-index: 2;
        color: white;
        }

    </style>
     
   </head>
<body>
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
          <a href="#" class="active" >
            <i class='bx bx-group' ></i>
            <span class="links_name">My Profile</span>
          </a>
        </li>
        <li>
          <a href="mygrades.php">
            <i class='bx bx-chalkboard' ></i>
            <span class="links_name">My Grades</span>
          </a>
        </li>
        <li>
          <a href="performanceChart.php">
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
        <span class="dashboard">My Profile</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <img src="" alt="">
        <span class="admin_name">Admin</span>
        
        
      </div>
    </nav>

    <div class="home-content">

        <div class="sales-boxes">
          <div class="recent-sales box" style="width:100%">
            <div class="title"> Request Logs</div>
            <!-- insert here -->

            <?php
             require ('../config.php');
               $index = 1;
               $x = 0;

            $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            //echo 
            if (mysqli_connect_errno()) {
              exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }

             $result = mysqli_query($conn, "SELECT student_update.requestID, student_update.LRN, student_info.Lastname, student_info.Firstname FROM student_update INNER JOIN student_info ON student_update.LRN = student_info.LRN WHERE student_update.reqStatus=0");



              $all_property= array();
                  if($result->num_rows > 0){
                      echo '<table class= "data-table" style="border-collapse: collapse; border-color:gray;">
                      <tr class = "data-heading">';
                  
                      while($x < 4){
                          $property= mysqli_fetch_field($result);
                          echo '<td><b>'.$property->name. '</b></td>';
                          array_push($all_property, $property->name );
                          $x = $x + 1;
                      }
                       //echo '<td>'.'Delete'. '</td>';
                      echo '<td><b>'.'View Request'. '</b></td>';
                      echo '</tr>';
                      while($row= mysqli_fetch_array($result)){
                          echo '<tr>';
                          foreach ($all_property as $item){
                              echo '<td>'.$row[$item].'</td>';
                          }
                      echo "<td><form id= \"$index\" method=\"post\" action=\"admin-viewRequests.php\">
                          <input name=\"requestID\" type=\"hidden\" value=\"$row[0]\">  
                          <input name=\"lrn\" type=\"hidden\" value=\"$row[1]\">  
                          <input name=\"submit\" type=\"submit\" value=\"View\"></form></td>";
                          echo '</tr>';
                      }   
                      echo '</tr>';
                      echo '</table>';
                  }
                  else{
                      echo '<br>'; 
                      echo "<h4>No pending requests as of this moment.</h4>";
                  }
                 
                 $conn->close();

          ?>





            <!-- end -->          
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

  function success() {
    alert('Request to update information was successfully sent!\nKindly wait for your request to be approved.');
    
  }


  </script>


</body>
</html>

