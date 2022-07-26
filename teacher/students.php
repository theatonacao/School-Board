<!-- Basic home page for logged-in users -->
<?php 
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'schoolBoard';
$DATABASE_PASS = '54HPneK7CC9NLhj';
$DATABASE_NAME = 'schoolBoard_database';
$year = $_SESSION['year'];
$section = $_SESSION['advisorysec']; 
$index = 1;
$x = 0;

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
//echo 
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT * FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Section = '$section' ORDER BY Lastname ");

?>

<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
      <title>School Board</title>
		<link href="style.css" rel="stylesheet" type= "text/css">
		<link rel="icon" href="images/SB-logo.png">
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->

    <link rel="stylesheet" href="welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
   </head>

   <body>
  <div class="sidebar">
    <div class="logo-details">
      <i><img src="images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" ></i>
      <span class="logo_name" href="#" >SchoolBoard</span>
    </div>
      <ul class="nav-links">
        
        <li>
          <a href="profile.php">
            <i class='bx bx-group' ></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
        <li>
          <a href="students.php"  class="active">
            <i class='bx bx-chalkboard' ></i>
            <span class="links_name">Manage Students</span>
          </a>
        </li>
        <li>
          <a href="record.php">
            <i class='bx bx-group' ></i>
            <span class="links_name">Class Record</span>
          </a>
        </li>

        <li>
          <a href="forms.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Form Generator</span>
          </a>
        </li>
      
        <li>
          <a href="reports.php">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Class Reports</span>
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
        <span class="dashboard">Class List</span>
      </div>
  
      <div class="profile-details">
        <img src="images/wonwoo.png" alt="">
        

        <a href="logout.php">
            <i class='bx bx-log-out' ></i>
        </a>
        
      </div>
    </nav>

    <div class="home-content">
      

      <div class="sales-boxes">
            <div class="recent-sales box" style="width:100%">
                            
            
				<div class="title" style="text-align: center; font-weight: 800; font-family: 'Poppins', sans-serif; color: #194e63;">&emsp; Grade <?=$year?> <?=$section?></div>
				<?php
				$all_property= array();
				    if($result->num_rows > 0){
				        echo '<table id="myTable" style="border: 1px solid black; border-collapse: collapse; border-color: #194e63; width: 100%; color: #194e63;">
                <thead style="border: 1px solid black; border-collapse: collapse; border-color: #194e63;">
				        <tbody style="border: 1px solid black; border-collapse: collapse; border-color: #194e63;">
                <tr class = "header">';
				        
				        while($x < 4){
				            $property= mysqli_fetch_field($result);
				            echo '<td><b>'.$property->name. '</b></td>';
				            array_push($all_property, $property->name );
				            $x = $x + 1;
				        }
				        // echo '<td>'.'Delete'. '</td>';
				        echo '<td><b>'.'More Info'. '</b></td>';
				        echo '</tr>';
				        while($row= mysqli_fetch_array($result)){
				            echo '<tr>';
				            foreach ($all_property as $item){
				                echo '<td>'.$row[$item].'</td>';
				            }
				        echo "<td><form id= \"$index\" method=\"post\" action=\"studentprofile.php\">
				            <input name=\"lrn\" type=\"hidden\" value=\"$row[0]\">
				            <input name=\"section\" type=\"hidden\" value=\"$row[15]\">
				            <input name=\"submit\" type=\"submit\" value=\"View\"></form></td>";
				            echo '</tr>';
				        }   
				        echo '</tr>';
                echo '</tbody>';
				        echo '</table>';
				    }
				    else{
				        echo '<br>'; 
				        echo "<h4>List is empty</h4>";
				    }
				   
				   $conn->close();

				?>
        	</div>
        
      </div>

              </div>
            
      </div>
      
    </div>

      <div class="sales-boxes"></div>
       
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
