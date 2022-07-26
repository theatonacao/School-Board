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
    <title>Generate Form</title>
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
          <a href="student_info.php">
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
          <a href="school_forms.php" class="active">
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
        <span class="dashboard">School Forms</span>
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
        <div class="box bttns " style="width:33%">
          <div class="right-side" style="cursor: pointer;" onclick="window.location='SF_dlTemplates.php';">
          
            <div class="box-topic"><i class='bx bxs-download' ></i>  Download templates  </div>
            
          </div>
          
        </div>
        <div class="box bttns active" style="width:33%">
          <div class="right-side" style="cursor: pointer;" onclick="window.location='generate_form.php';">
            <div class="box-topic"><i class='bx bxs-file-import'></i>  Generate Form</div>
            
          </div>
          
        </div>
        <div class="box bttns" style="width:33%">
          <div class="right-side" style="cursor: pointer;" onclick="window.location='add_SF.php';">
            <div class="box-topic"><i class='bx bx-import' ></i>  Add New File</div>
            
          </div>
          
        </div>
        
      </div>
     

      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title">All School Forms</div><br>
          
          <div class="search-box">
            <i class='bx bx-search' style="font-size:2rem;" ></i>
            <input class="searchbar" type="text" id="myInput" style="width:96%; height: 40px; padding: 10px; justify-content: center;float:right; font-size: 1rem; border-radius: 15px 30px 30px 15px; background: #F5F6FA;border: 2px solid #EFEEF1;" onkeyup="performSearch()" placeholder="Search for School Forms.." title="Type in keyword">
          </div>
          <br>
          <table id="myTable" style="border: 1px solid black; border-collapse: collapse;">
            <thead style="border: 1px solid black; border-collapse: collapse;">
            <tr class="header">	
              <th style="width:5%;" class="text2">Code</th>
              <th style="width:50%;" class="text2">Title</th>
              <th style="width:10%;" class="text2">Type</th>
              <th style="width:20%;" class="text2">Download File</th>
            </tr>
            </thead>
            <tbody style="border: 1px solid black; border-collapse: collapse;">
            <tr>
              <td>SF1</td>
              <td>School Registry</td>
              <td><i class='bx bxs-file-pdf'></i>PDF </td>
              <td><a href="SchoolForm_templates/SF1_Registration.pdf" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF2</td>
              <td>Learner's Daily Class Attendance</td>
              <td><i class='bx bxs-file-pdf'></i>PDF </td>
              <td><a href="SchoolForm_templates/SF 2 Daily Attendance.pdf" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF2</td>
              <td>Learner's Daily Class Attendance (Automated)</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/SF 2 Daily Attendance (Automated).xlsx" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF3</td>
              <td>Books Issued and Returned</td>
              <td><i class='bx bxs-file-pdf'></i>PDF</td>
              <td><a href="SchoolForm_templates/SF 3 Books Issued and Returned.pdf" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF4</td>
              <td>Summary Enrollment and Movement of Learners</td>
              <td><i class='bx bxs-file-pdf'></i>PDF</td>
              <td><a href="SchoolForm_templates/SF 4 Monthly Learner Movement and Attendance.pdf" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF5</td>
              <td>Report on Promotion, Learning Progress, and Achievement</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/SF 5 Report on Promotion and Learning Progress _ Achievement_0 (1).xlsx" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF6</td>
              <td>Summary Report on Promotion, Learning Progress, and Achievement</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/SF 6 Summarized Report on Promotion and Learning Progress _ Achievement (1).xlsx" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF7</td>
              <td>Inventory of School Personnel Assignment List and Basic Profile</td>
              <td><i class='bx bxs-file-pdf'></i>PDF</td>
              <td><a href="SchoolForm_templates/SF 7 School Personnel Assignment List and Basic Profile.pdf" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF8</td>
              <td>Learner Basic Health and Nutrition Profile</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/SF 8 Learner Basic Health and Nutrition Report.xlsx" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF9</td>
              <td>Learner Progress Report Card (Junior High)</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/SF 9 - JHS (Learner's Progress Report Card B).xlsx" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF9</td>
              <td>Learner Progress Report Card (Senior High)</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/SF 9 - SHS (Learner's Progress Report Card ).pub" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF10</td>
              <td>Learner's Permanent Academic Record (Junior High)</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/SF 10 Learner_s Permanent Academic Record for Junior High School_3.xlsx" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>SF10</td>
              <td>Learner's Permanent Academic Record (Senior High)</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/SF 10 SHS Senior High School Student Permanent Record.xlsx" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>--</td>
              <td>School Forms 1-7</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/School Forms (1-7).xls" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>--</td>
              <td>Senior High Forms</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/Senior High School Forms.xlsx" download><button style="width:80%">Download</button></a></td>
            </tr>
            <tr>
              <td>ALS</td>
              <td>Alternative Learning System (ALS) Forms</td>
              <td><i class='bx bx-file'></i>XLSX</td>
              <td><a href="SchoolForm_templates/Alternative Learning System Forms.xlsx" download><button style="width:80%">Download</button></a></td>
            </tr>
            </tbody>
          </table>

         
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

