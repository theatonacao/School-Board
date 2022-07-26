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

  $conn = mysqli_connect("localhost","schoolBoard","54HPneK7CC9NLhj","schoolBoard_database");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
 if (isset($_POST['save'])) {       
        $employeenum =  $_REQUEST['employeeNum'];
        $password = $_REQUEST['passW'];
        $lastname =  $_REQUEST['lastName'];
        $firstname = $_REQUEST['firstName'];
        $position = $_REQUEST['position'];
        $year = $_REQUEST['yrlvl'];
        $advisorysec = $_REQUEST['advisory'];
         
        // Performing insert query execution
        $sql = "INSERT INTO teachers VALUES (NULL, '$employeenum', '$password','$lastname','$firstname','$position','$year','$advisorysec')";
         
        if(mysqli_query($conn, $sql)){
            
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
      }     
        // Close connection
        mysqli_close($conn);
?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    
    <meta charset="UTF-8">
    <title>Add Teacher Information</title>
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
        <div class="box bttns " style="width:49%;cursor: pointer;" onclick="window.location='teacher_info.php';">
          <div class="right-side" >
            <div class="box-topic">Teacher Details</div>
            
          </div>
          
        </div>
        <div class="box bttns active" style="width:49%;cursor: pointer;" onclick="window.location='add_teacher.php';">
          <div class="right-side" >
            <div class="box-topic">Add Teacher</div>
            
          </div>
          
        </div>
        
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title">Add Teacher Information</div>
          
          <div class="div form-content" >
            <form action="add_teacher.php" method="post" enctype="multipart/form-data">
              <div class="personalinfo" > 
                <br>
                
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="profpic" >Upload Profile Image</label>
                  </div>
                  <div class="formcol2">
                    <input type="file"  name="profpic" id="profpic">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="employeeNum" >Employee Number </label>
                  </div>
                  <div class="formcol2">
                    <input type="text"  name="employeeNum" id="employeeNum" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="passW" >Assign Password </label>
                  </div>
                  <div class="formcol2">
                    <input type="text"  name="passW" id="passW" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="lastName" >Last Name </label>
                  </div>
                  <div class="formcol2">
                    <input type="text"  name="lastName" id="lastName" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="firstName" >First Name </label>
                  </div>
                  <div class="formcol2">
                    <input type="text"  name="firstName" id="firstName" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="middleName" >Middle Name </label>
                  </div>
                  <div class="formcol2">
                    <input type="text"  name="middleName" id="middleName" >
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="position" >Position </label>
                  </div>
                  <div class="formcol2">
                    <select id="position" name="position" >
                        <option value="">Select teacher position...</option>
                        <option value="Teacher I">Teacher I</option>
                        <option value="Teacher II">Teacher II</option>
                        <option value="Teacher III">Teacher III</option>
                        <option value="Master Teacher I">Master Teacher I</option>
                        <option value="Master Teacher II">Master Teacher II</option>
                        <option value="Master Teacher III"> Master Teacher III</option>
                        <option value="Master Teacher IV"> Master Teacher IV</option>
                        <option value="Head Teacher I">Head Teacher I</option>
                        <option value="Head Teacher II">Head Teacher II</option>
                        <option value="Head Teacher III"> Head Teacher III</option>
                        <option value="Head Teacher IV"> Head Teacher IV</option>
                        <option value="Head Teacher V"> Head Teacher V</option>
                        <option value="Head Teacher VI"> Head Teacher VI</option>
                        <option value="Principal I">Principal I</option>
                        <option value="Principal II">Principal II</option>
                        <option value="Principal III">Principal III</option>
                        <option value="Principal IV">Principal IV</option>
                      </select>
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="yrlvl" >Grade Level </label>
                  </div>
                  <div class="formcol2">
                    <select id="yrlvl" name="yrlvl" >
                        <option value="">Select Grade Level...</option>
                        <option value="7"> 7</option>
                        <option value="8"> 8</option>
                        <option value="9"> 9</option>
                        <option value="10"> 10</option>
                        <option value="11"> 11</option>
                        <option value="12"> 12</option>
                       
                      </select>
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="advisory" >Advisory </label>
                  </div>
                  <div class="formcol2">
                    <input type="text"  name="advisory" id="advisory" required="">
                  </div>
                </div>
              </div>
              <input type="submit"  name="save" value="Save" class="submitbttn" style="float: right">
            </form>
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

