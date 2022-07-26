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
/*$StudentNo = $_POST['lrn'];*/
$_SESSION['temp_username'] = $_POST['lrn'];
$StudentNo = $_SESSION['temp_username'];
$index = 1;
$x = 0;

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$sql = "SELECT student_info.*, student_contact.*, student_year.*, student_guardian_info.*, student_guardian_contact.* FROM student_info
        INNER JOIN student_contact ON  student_contact.LRN = student_info.LRN
        INNER JOIN student_year ON student_year.LRN = student_contact.LRN
        INNER JOIN student_guardian_info ON student_guardian_info.LRN = student_contact.LRN
        INNER JOIN student_guardian_contact ON student_guardian_contact.LRN = student_contact.LRN
        WHERE student_info.LRN = '$StudentNo'";

    $result = mysqli_query($conn, $sql);
    
     if($result->num_rows > 0){
    // output data of each row
    while($row = $result->fetch_assoc() ) {
        $LRN = $row["LRN"];
        $Lastname = $row["Lastname"];
        $Firstname = $row["Firstname"];
        $Middlename = $row["Middlename"];
        $Ext = $row["Extension"];
        $Grade = $row["Year_lvl"];
        $Section = $row["Section"];
        $Adviser = $row["Adviser_name"];
        
        $Gender = $row["Sex"];
        $Birthdate = $row["Birthdate"];
        $Mothertongue = $row["Mothertongue"];
        $Ethnicity = $row["Ethnic"];
        $Religion = $row["Religion"];
        $Citizenship = $row["Citizenship"];
        $Status = $row["Status"];

        $Street = $row["Street"];
        $Barangay = $row["Barangay"];
        $City = $row["City"];
        $Province = $row["Province"];

        $Mobile = $row["Mobile_num"];
        $Email = $row["Email"];
        $Mother = $row["Mother_name"];
        $Father = $row["Father_name"];
        $GAddress = $row["Guardian_address"];
        $GContact = $row["Guardian_contact"];
        }
        // $year = $row['Year_lvl'];
    }else{
        echo '<br>';    
        echo "<h4>Student information for ".$StudentNo." is empty. </h4>";
    }
    
mysqli_close($conn)

?>

<!DOCTYPE html>
<html>
    <head>
        <title>School Board</title>
		<link href="style.css" rel="stylesheet" type= "text/css">
		<link rel="icon" href="images/SB-logo.png">
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
        <span class="dashboard">Student Info</span>
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
            <div class="recent-sales box" style="width:90%">
              <div class="title" style="cursor: pointer;"  onclick="history.back()"><i class="bx bxs-left-arrow-circle"></i></div>
                <div class="formcol1" style=" text-align: center" >
                  <img src="images/student.png" class="profilepic" style="width: 180px;height: 180px;" alt=""> <br>
                  <span style="color: red; position: center;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $LRN; ?></span></B> <span style="color: navy;"></span> <br><br>

                  <form method="post" action="grades.php" >
                        <input type="hidden" name="year" value = <?php echo $year; ?>>
                        <button class="subjectbutton btn1" style="background-color:teal; border: none; color: white;  padding: 10px 10px;  text-align: center; text-decoration: none; display: inline-block; font-size: 16px; cursor: pointer; border-radius: 8px;" type="submit"name="lrn" value= <?php echo $StudentNo; ?> >View Grades</button>
                  </form>

                </div>
                <div class="formcol2" style="color: black;">
                
                       <span style="color: teal; font-size: 25px; font-weight: 600;"><?php echo $Lastname; ?>, <?php echo $Firstname;?>  <?php echo $Middlename;?></span> <br>
                        Year level: <?php echo $Grade;?> <br>
                        Section: <?php echo $Section;?> <br>
                        Adviser: <?php echo $Adviser;?> <br><br>
                         <h4>PERSONAL INFORMATION</h4> 
                        Birthdate: <?php echo $Birthdate;?> <br>
                        Mothertongue: <?php echo $Mothertongue;?> <br>
                        Ethnicity: <?php echo $Ethnicity;?> <br>
                        Religion: <?php echo $Religion;?> <br>
                        Citizenship: <?php echo $Citizenship;?> <br>
                        Status: <?php echo $Status;?> <br>
                        
                        Address: <?php echo $Street;?>,
                       <?php echo $Barangay;?>, <?php echo $City;?> , <?php echo $Province;?> <br><br>
                         <h4>CONTACT INFORMATION</h4>
                        Mobile: <?php echo $Mobile;?> <br>
                        Email: <?php echo $Email;?> <br><br>

                    <h4>PARENT/GUARDIAN INFORMATION</h4>
                        Mother's Name: <?php echo $Mother;?> <br>
                        Father's Name: <?php echo $Father;?> <br>
                        Guardian's Address: <?php echo $GAddress;?> <br>
                        Guardian's Contact: <?php echo $GContact;?> <br>  
                        <br>
       
<!-- <input type="Submit" name="Update" value="Update"class="subjectbutton btn1"  style="height: 40px; margin-left:50px; margin-top: 10px; font-size: 20px;"> -->
                </div>

            </div>
            <!-- <div class="recent-sales box" style="width:30%; height:100px;">
                    <br>
                        <form method="post" action="grades.php" >
                        <input type="hidden" name="year" value = <?php echo $year; ?>>
                        <button class="subjectbutton btn1" style="margin: 1px 0px 50px 60px; background-color:teal; border: none; color: white;  padding: 10px 10px;  text-align: center; text-decoration: none; display: inline-block; font-size: 16px; cursor: pointer; border-radius: 8px;" type="submit"name="lrn" value= <?php echo $StudentNo; ?> >View Grades</button>
                        </form>
            </div> -->
        </div>
    </div>
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