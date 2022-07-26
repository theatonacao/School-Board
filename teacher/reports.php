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
//$Sec = $_SESSION['advisorysec']; 
$index = 1;
$x = 0;

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
//echo 
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT * FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Section = '$section'");

$result2 = mysqli_query($conn, "SELECT * FROM grade_per_year WHERE grade_per_year.Year_lvl = '$year'");

$result3 = mysqli_query($conn, "SELECT student_info.*, student_year.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Section = '$section' AND student_info.Sex = 'Male'");

$result4 = mysqli_query($conn, "SELECT student_info.*, student_year.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Section = '$section' AND student_info.Sex = 'Female'");

$result5 = mysqli_query($conn, "SELECT `Period_1` FROM grade_per_year WHERE Section = '$section'");

$result6 = mysqli_query($conn, "SELECT `Period_2` FROM grade_per_year WHERE Section = '$section'");

$result7 = mysqli_query($conn, "SELECT `Period_3` FROM grade_per_year WHERE Section = '$section'");

$result8 = mysqli_query($conn, "SELECT `Period_4` FROM grade_per_year WHERE Section = '$section'");

$q_res = mysqli_query($conn, "SELECT student_year.*, `Status_Q1` FROM student_year INNER JOIN quarter_status WHERE ");

?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->

    <link rel="stylesheet" href="welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <style type="text/css">
     	table, tr, th, td{
 				border-collapse:collapse;
 				border: hidden;
				}

		th, td {
				  padding: 15px;
				  text-align: left;
				}

		td{
			font-size: 20px;
			font-weight: 100px;
		}
     </style>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
   <title>School Board</title>
		<link href="style.css" rel="stylesheet" type= "text/css">
		<link rel="icon" href="images/SB-logo.png">
   </head>
<body>


  <div class="sidebar">
    <div class="logo-details">
      <i><img src="images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" href="profile.php"></i>
      <span class="logo_name" href="profile.php" >SchoolBoard</span>
    </div>
      <ul class="nav-links">
        
        <li>
          <a href="profile.php">
            <i class='bx bx-group' ></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
        <li>
          <a href="students.php">
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
          <a href="reports.php"  class="active">
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
        <span class="dashboard">Class Report</span>
      </div>
  
      <div class="profile-details">
        <img src="images/wonwoo.png" alt="">
        

        <a href="logout.php">
            <i class='bx bx-log-out' ></i>
        </a>
        
      </div>
    </nav>

    <div class="home-content">  
    	<div class="sales-boxes" style="width:100%">
        	<div class="recent-sales box" style="width:100%; height">
        		<div class="title" style="text-align: center;">Grade <?=$year?> <?=$section?> Class Performance Report</div>   
        	</div>
        </div>    
        <br>               
        <div class="sales-boxes" style="width:100%">
        	<div class="recent-sales box" style="width:50%; height">
        		<div class="title" style="text-align: left;">Total number of Students</div>
        		<div class="title" style="text-align: left; font-size: 40px; font-family: 'Poppins', sans-serif; color: #194e63; ">
            		<?php
    					$num_row = 0;

    					if($result->num_rows > 0){
    						while($row= mysqli_fetch_array($result)){
    							$num_row++;
    						}//end of while loop
    					}//end of if  
    					echo $num_row, " Students"; 				 
    				?> 
        		</div>   
        	</div>

        	<div class="recent-sales box" style="width:50%; height">
        		<div class="title" style="text-align: left;">Total number of failing students</div>   
        		<div class="title" style="text-align: left; font-size: 40px; font-family: 'Poppins', sans-serif; color: #194e63; ">
        			<?php
						$fail_count = 0;
						if($result2->num_rows > 0){
							while($row= mysqli_fetch_array($result2)){
								if($row['Grade_ave'] < 75)
								    $fail_count++;
							}//end of while loop
								}//end of if

						if($fail_count == 0)
							echo "None";
						else
							echo $fail_count, " Students";
					?>
        		</div>
        	</div>

        </div>
        <br>
        <div class="sales-boxes" style="width:100%">
          <div class="recent-sales box" style="width:55%; height">
            <!-- get quarter 1 grade for all values na naa sa grade_per year
                 compute average
                 display it in chart

             -->
             <!-- Total number of male students -->
             <div class="title" style="text-align: left; font-size: 20px;">Total number of Male students</div> 
             <div class="title" style="text-align: left; font-size: 35px; font-family: 'Poppins', sans-serif; color: #194e63; ">
              <?php
                $num_row = 0;

                if($result3->num_rows > 0){
                  while($row= mysqli_fetch_array($result3)){
                    $num_row++;
                  }//end of while loop
                }//end of if  
                echo $num_row, " Students";          
              ?>
             </div> 

          </div>
          <div class="recent-sales box" style="width:25%; height">
            <div class="title" style="text-align: left; font-size: 20px;">Average grade for Quarter 1</div> 
             <div class="title" style="text-align: left; font-size: 35px; font-family: 'Poppins', sans-serif; color: #194e63; ">
              <?php
                $num_row = 0;
                $running_sum = 0;

                if($result5->num_rows > 0){
                  while($row= mysqli_fetch_array($result5)){
                    $num_row++;
                    $running_sum = $running_sum + $row[0];

                  }//end of while loop
                }//end of if  
                $ans = $running_sum/ $num_row;
                echo $ans;          
              ?>
             </div>
          </div>
                    <div class="recent-sales box" style="width:25%; height">
            <div class="title" style="text-align: left; font-size: 20px;">Average grade for Quarter 2</div> 
             <div class="title" style="text-align: left; font-size: 35px; font-family: 'Poppins', sans-serif; color: #194e63; ">
              <?php
                $num_row = 0;
                $running_sum = 0;

                if($result6->num_rows > 0){
                  while($row= mysqli_fetch_array($result6)){
                    $num_row++;
                    $running_sum = $running_sum + $row[0];

                  }//end of while loop
                }//end of if  
                $ans = $running_sum/ $num_row;
                echo $ans;          
              ?>
             </div>
          </div>

          

        </div>
        <br>   
        <div class="sales-boxes" style="width:100%">
          <div class="recent-sales box" style="width:55%; height">
            <!-- get quarter 1 grade for all values na naa sa grade_per year
                 compute average
                 display it in chart

             -->
             <!-- Total number of male students -->
             <div class="title" style="text-align: left; font-size: 20px;">Total number of Female students</div> 
             <div class="title" style="text-align: left; font-size: 35px; font-family: 'Poppins', sans-serif; color: #194e63; ">
              <?php
                $num_row = 0;

                if($result4->num_rows > 0){
                  while($row= mysqli_fetch_array($result4)){
                    $num_row++;
                  }//end of while loop
                }//end of if  
                echo $num_row, " Students";          
              ?>
             </div> 

          </div>
            <div class="recent-sales box" style="width:25%; height">
            <div class="title" style="text-align: left; font-size: 20px;">Average grade for Quarter 3</div> 
             <div class="title" style="text-align: left; font-size: 35px; font-family: 'Poppins', sans-serif; color: #194e63; ">
              <?php
                $num_row = 0;
                $running_sum = 0;

                if($result7->num_rows > 0){
                  while($row= mysqli_fetch_array($result7)){
                    $num_row++;
                    $running_sum = $running_sum + $row[0];

                  }//end of while loop
                }//end of if  
                $ans = $running_sum/ $num_row;
                echo $ans;          
              ?>
             </div>
          </div>
            <div class="recent-sales box" style="width:25%; height">
            <div class="title" style="text-align: left; font-size: 20px;">Average grade for Quarter 4</div> 
             <div class="title" style="text-align: left; font-size: 35px; font-family: 'Poppins', sans-serif; color: #194e63; ">
              <?php
                $num_row = 0;
                $running_sum = 0;

                if($result8->num_rows > 0){
                  while($row= mysqli_fetch_array($result8)){
                    $num_row++;
                    $running_sum = $running_sum + $row[0];

                  }//end of while loop
                }//end of if  
                $ans = $running_sum/ $num_row;
                echo $ans;          
              ?>
             </div>
          </div>          

        </div>   
      </div><!-- end of home content -->
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