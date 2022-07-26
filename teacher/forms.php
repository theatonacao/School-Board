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
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT employeenum, password, lastname, firstname, position, year, advisorysec FROM teachers WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($employeenum, $password, $lastname, $firstname, $position, $year, $advisorysec);
$stmt->fetch();
$stmt->close();
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

   </head>
<body>

  <div class="sidebar">
    <div class="logo-details">
      <i><img src="images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" href="profile.php"></i>
      <span class="logo_name" href="profile.php" >SchoolBoard</span>
    </div>
      <ul class="nav-links">
        
        <li>
          <a href="profile.php" >
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
          <a href="#" class="active">
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
        <span class="dashboard">Form Generator</span>
      </div>
  
      <div class="profile-details">
        <img src="images/wonwoo.png" alt="">
        

        <a href="logout.php">
            <i class='bx bx-log-out' ></i>
        </a>
        
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box bttns active" style="width:45%; cursor: pointer;" onclick="window.location='forms.php';">
          <div class="right-side" style="cursor: pointer;" >
          
            <div class="box-topic"><i class='bx bxs-file-import' ></i>  Auto Generate Forms  </div>
            
          </div>
          
        </div>
        <div class="box bttns" style="width:45%; cursor: pointer;"  onclick="window.location='forms_dl.php';">
          <div class="right-side" style="cursor: pointer;">
            <div class="box-topic"><i class='bx bxs-download'></i>  Download Templates  </div>
            
          </div>
          
        </div>        
      </div>

      <div class="sales-boxes" style="width:100%; text-align: left;">
      	<div class="recent-sales box" style="width:100%; text-align: left;">
      <div class="sales-boxes" style="width:100%; text-align: left;">
      	<form method="get" action="SF1.php">
				<button type="submit" style="width:250px; margin-left: 100px;  font-size: 20px; color: #008080; cursor: pointer;">School Register<br>(SF1)</button>
		</form>
		<form method="get" action="SF2.php">
				<button type="submit" style="width:250px; margin-left: 100px; margin-right: 250px; font-size: 20px; color: #008080;">Attendance Report <br>(SF2)</button>
		</form>
      </div>
      <br>
      <div class="sales-boxes" style="width:100%; text-align: left;">
      	<form method="get" action="SF3.php">
				<button type="submit" style="width:250px; margin-left: 100px;  font-size: 20px; color: #008080;">Books Inventory<br>(SF3)</button>
		</form>
		
		<form method="get" action="SF5.php">
				<button type="submit" style="width:250px; margin-left: 100px; margin-right: 250px; font-size: 20px; color: #008080;">Level on Proficiency<br>(SF5)</button>
		</form>
      </div>
       <br>

      <div class="sales-boxes" style="width:100%; text-align: left;">
      	<form method="get" action="SF8.php">
				<button type="submit"  style="width:250px; margin-left: 100px;  font-size: 20px; color: #008080;">Nutrition Report<br>(SF8)</button>
		</form>
		<form method="get" action="STS1.php">
				<button type="submit"  style="width:250px; margin-left: 100px; margin-right: 250px;  font-size: 20px; color: #008080;">Personal Inventory<br>(STS)</button>
		</form>
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