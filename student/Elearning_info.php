<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

  require ('../config.php');
    $StudentNo = $_SESSION['LRN'];
    $index = 1;
    $x = 0;

    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

   $sql = "SELECT * FROM student_info WHERE student_info.LRN = '$StudentNo'";

    $result = mysqli_query($conn, $sql);
    
     if($result->num_rows > 0){
    // output data of each row
    while($row = $result->fetch_assoc() ) {
        $LRN = $row["LRN"];
        $Lastname = $row["Lastname"];
        $Firstname = $row["Firstname"];
        $Middlename = $row["Middlename"];
        $Ext = $row["Extension"];
       
        }
        
    }else{
        echo '<br>';    
        echo "<h4>Student information for ".$StudentNo." is empty. </h4>";
    }
    $folder = "profileimg/";//profile images foldername

     $sql = "SELECT * FROM `profile_img` WHERE LRN =  '$StudentNo'";
     
     $result = mysqli_query($conn, $sql);

      //has profile pic
      if($result->num_rows > 0){

         while($row = $result->fetch_assoc() ) {
          $filename = $row["file_name"];
         }
         
         $imgfilename = $folder.$filename;
          $imagestatus=1;
        //echo   $imgfilename;

      }else{//no prof pic display default
        $imagestatus=0;
        //display defaul pic
         $imgfilename = $folder."profileimg.png";
         
      }

?>
 
 <!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>E-Learning Resources</title>
    <link rel="stylesheet" href="../admin/welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="SB-logo.png">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i><img src="../admin/images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" ></i>
      <span class="logo_name">SchoolBoard</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="profile.php"  >
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
          <a href="Elearning_info.php" class="active">
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
        <span class="dashboard">E-Learning </span>
      </div>
      
      <div class="profile-details">
        <img src="<?php echo $imgfilename?>" alt="">
        <span class="admin_name"><?php echo htmlspecialchars ($Firstname); ?></span>
      </div>
    </nav>

    <div class="home-content">
        
      
<div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title">All E-Learning Resources
            
              <!-- <a href="e_learningperglvl.php" onMouseOver="this.style.color='#F34213'" onMouseOut="this.style.color='#D88510'" ><button style="background-color: #FFB140; margin: 5px; float: right; padding: 10px; border: none; border-radius: 15px;cursor: pointer;font-weight: 900;" >See By Grade Level</button></a>
             -->
          </div>
          <br>
          <div class="search-box">
                   <i class='bx bx-search' style="font-size:2rem;" ></i>
            <input class="searchbar" type="text" id="myInput" style="width:96%; height: 40px; padding: 10px; justify-content: center;float:right; font-size: 1rem; border-radius: 15px 30px 30px 15px; background: #F5F6FA;border: 2px solid #EFEEF1;" onkeyup="performSearch()" placeholder="Search by Grade Level, Subject, Title..."  title="Type in keyword">

          </div><br>
          <table id="myTable" style="width:100%;border-collapse: collapse;">
            <thead>
                <th>ID</th>
                <th>Grade Level</th>
                <th>Subject</th>
                <th>Quarter Number</th>
                <th>Module Number</th>
                <th>Title</th>
                <th>Size</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php
                             
              $result = mysqli_query($conn,"SELECT * From files");
              $i=0;
              while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td> $i </td>";
              echo "<td>" . $row['gradelvl'] ."</td>";
              echo "<td>" . $row['subjec_t'] . "</td>";
              echo "<td>" . $row['quarter_no'] . "</td>";
              echo "<td style='text-align: center'>" . $row['module_no'] . "</td>";
              echo "<td>" . $row['title'] . "</td>";
              echo "<td>" . ($row['size'])*0.001 . "</td>";
              echo "<td style='text-align:center'><a href='uploads/". $row['e_filename'] ."' download><button style='background-color: #95B46A; border: none; border-radius: 20px; color: #333; /* Dark grey */ padding: 5px 22px;cursor: pointer; '>Download</button></a></td>";
              echo "</tr>";
              $i++;
              }
              
              echo "</table>";

              mysqli_close($conn);
              ?>

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

