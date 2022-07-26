<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php include("db_helper.php");?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Student Information</title>
    <link rel = "icon" href =  "images/SB-logo.png"  type = "image/x-icon">
    <link rel="stylesheet" href="welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
        $con=mysqli_connect("localhost","schoolBoard","54HPneK7CC9NLhj","schoolBoard_database");
          // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $query = "SELECT COUNT(Year_lvl) c  FROM student_year WHERE Year_lvl = 7;";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);
        $query2 = "SELECT COUNT(Year_lvl) c  FROM student_year WHERE Year_lvl = 8;";
        $result2 = mysqli_query($con,$query2);
        $row2 = mysqli_fetch_assoc($result2);
        $query3 = "SELECT COUNT(Year_lvl) c  FROM student_year WHERE Year_lvl = 9;";
        $result3 = mysqli_query($con,$query3);
        $row3 = mysqli_fetch_assoc($result3);
        $query4 = "SELECT COUNT(Year_lvl) c  FROM student_year WHERE Year_lvl = 10;";
        $result4 = mysqli_query($con,$query4);
        $row4 = mysqli_fetch_assoc($result4);
        $query5 = "SELECT COUNT(Year_lvl) c  FROM student_year WHERE Year_lvl = 11;";
        $result5 = mysqli_query($con,$query5);
        $row5 = mysqli_fetch_assoc($result5);
        $query6 = "SELECT COUNT(Year_lvl) c  FROM student_year WHERE Year_lvl = 12;";
        $result6 = mysqli_query($con,$query6);
        $row6 = mysqli_fetch_assoc($result6);
      echo '<div class="overview-boxes">
        <div class="box" style="width:32%">
          <div class="right-side">
            <div class="box-topic">Grade 7 Students</div>
            <div class="number">'. $row['c'] .'</div>';
            echo '
          </div>
          <i class="bx bxs-group cart"></i>
        </div>
        <div class="box" style="width:32%">
          <div class="right-side">
            <div class="box-topic">Grade 8 Students</div>
            <div class="number">'. $row2['c'] .'</div>
           
          </div>';
          echo '<i class="bx bxs-group cart two" ></i>
        </div>
        <div class="box" style="width:32%">
          <div class="right-side">
            <div class="box-topic">Grade 9 Students</div>
            <div class="number">'. $row3['c'] .'</div>
          </div>
          <i class="bx bxs-group  cart three" ></i>
        </div>
        
      </div>
      <div class="overview-boxes">
        <div class="box" style="width:32%">
          <div class="right-side">
            <div class="box-topic">Grade 10 Students</div>
            <div class="number">'. $row4['c'] .'</div>
          </div>
          <i class="bx bxs-group cart" style="background-color: #F3E8EE;color: black;"></i>
        </div>
        <div class="box" style="width:32%">
          <div class="right-side">
            <div class="box-topic">Grade 11 Students</div>
            <div class="number">'. $row5['c'] .'</div>
          </div>
          <i class="bx bxs-group  cart two" style="background-color:#BACDB0;color: black;"></i>
        </div>
        <div class="box" style="width:32%">
          <div class="right-side">
            <div class="box-topic">Grade 12 Students</div>
            <div class="number">' . $row6['c'] .'</div>
          </div>
          <i class="bx bxs-group  cart three" style="background-color:#EDF060;color: black;" ></i>
        </div>';
        ?>
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title">All Student Information</div>
          <div class="search-box">
            
            <div class="search-box">
              <i class='bx bx-search' style="font-size:2rem;" ></i>
            <input class="searchbar" type="text" id="myInput" style="width:96%; height: 40px; padding: 10px; justify-content: center;float:right; font-size: 1rem; border-radius: 15px 30px 30px 15px; background: #F5F6FA;border: 2px solid #EFEEF1;" onkeyup="performSearch()" placeholder="Search for LRN, Name, Section, Grade Level.." title="Type in keyword">

            </div>
          </div><br>
          <div class="sales-details">
            
          <table id="myTable" style="border: 1px solid black; border-collapse: collapse;width: 100%">
            <thead style="border: 1px solid black; border-collapse: collapse;">
            <tr class="header">	
              <th  class="text2">LRN</th>
              <th class="text2">Name</th>
              <th class="text2">Grade Level</th>
              <th class="text2">Section</th>
              <th class="text2">Action</th>
            </tr>
            </thead>
            <tbody style="border: 1px solid black; border-collapse: collapse;">
            
            
              <?php
              $result = mysqli_query($con,"SELECT student_info.LRN, student_info.Lastname, student_info.Firstname, student_info.Middlename, student_year.Year_lvl, student_year.Section FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN ORDER BY Lastname;");
              
              while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['LRN'] . "</td>";
              echo "<td>" . $row['Lastname'] . " , " . $row['Firstname'] . " " . $row['Middlename'] ."</td>";
              echo "<td>" . $row['Year_lvl'] . "</td>";
              echo "<td>" . $row['Section'] . "</td>";
              echo "<td style='text-align:center'><a href='student_display.php?id=". $row['LRN'] . "'><button type='submit' name='view_data' style='background-color: #95B46A; border: none; border-radius: 20px; color: #333; /* Dark grey */ padding: 10px 27px;cursor: pointer; '>Preview</button></a></td>";
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

