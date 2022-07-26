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
    <title>Alumni Information</title>
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
          <a href="teacher_info.php" >
            <i class='bx bx-chalkboard' ></i>
            <span class="links_name">Teacher Information</span>
          </a>
        </li>
        <li>
          <a href="class_info.php" >
          <i class='bx bxs-school'></i>
            <span class="links_name">Class Information</span>
          </a>
        </li>
        
        <li>
          <a href="#" class="active">
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
        <span class="dashboard">Alumni</span>
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
     

      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title">All Alumni Information</div>
          <div class="search-box">
          <i class='bx bx-search' style="font-size:2rem;" ></i>
          <input class="searchbar" type="text" id="myInput" style="width:96%; height: 40px; padding: 10px; justify-content: center;float:right; font-size: 1rem; border-radius: 15px 30px 30px 15px; background: #F5F6FA;border: 2px solid #EFEEF1;" onkeyup="performSearch()" placeholder="Search by LRN, Name, Year Graduated..."  title="Type in keyword">

          </div><br><br>
          <div class="sales-details">
          <table  style="border: 1px solid black; border-collapse: collapse;width: 100%">
            <thead style="border: 1px solid black; border-collapse: collapse;">
            <tr class="header">	
              <th  class="text2">LRN</th>
              <th class="text2">Name</th>
              <th class="text2">Year Graduated</th>
              <th class="text2">Action</th>
            </tr>
            </thead>
            <tbody style="border: 1px solid black; border-collapse: collapse;">
            
            
              <?php
              $con=mysqli_connect("localhost","schoolBoard","54HPneK7CC9NLhj","schoolBoard_database");
                // Check connection
              if (mysqli_connect_errno())
              {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
              $result = mysqli_query($con,"SELECT alumni_info.LRN, alumni_info.LastN, alumni_info.FirstN, alumni_info.MiddleN, alumni_info.YearGrad FROM alumni_info ORDER BY LastN");
              
              while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['LRN'] . "</td>";
              echo "<td>" . $row['LastN'] . " , " . $row['FirstN'] . " " . $row['MiddleN'] ."</td>";
              echo "<td>" . $row['YearGrad'] . "</td>";
              echo "<td><button type='submit' name='view_data' ><a href='student_display.php?id=". $row['LRN'] . "'>Preview</a></button></td>";
              echo "</tr>";
              }
              echo "</table>";

              mysqli_close($con);
              ?>
            </tbody>
          </table>
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
      function myFunction() {
				var input, filter, table, tr, td, i, txtValue;
				input = document.getElementById("myInput");
				filter = input.value.toUpperCase();
				table = document.getElementById("myTable");
				tr = table.getElementsByTagName("tr");
				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[0];
					if (td) {
						txtValue = td.textContent || td.innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						} else {
							tr[i].style.display = "none";
						}
					}
					
					
				}
			}
			function performSearch() {

        // Declare search string 
        var filter = myInput.value.toUpperCase();

        // Loop through first tbody's rows
        for (var rowI = 0; rowI < trs.length; rowI++) {

          // define the row's cells
          var tds = trs[rowI].getElementsByTagName("td");

          // hide the row
          trs[rowI].style.display = "none";

          // loop through row cells
          for (var cellI = 0; cellI < tds.length; cellI++) {

            // if there's a match
            if (tds[cellI].innerHTML.toUpperCase().indexOf(filter) > -1) {

              // show the row
              trs[rowI].style.display = "";

              // skip to the next row
              continue;

            }
          }
        }

      }

      // declare elements
      const searchBox = document.getElementById('searchBox');
      const table = document.getElementById("myTable");
      const trs = table.tBodies[0].getElementsByTagName("tr");

      // add event listener to search box
      searchBox.addEventListener('keyup', performSearch);

 </script>

</body>
</html>

