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
// connect to the database
$conn = mysqli_connect("localhost","schoolBoard","54HPneK7CC9NLhj","schoolBoard_database");

$sql = "SELECT * FROM files";
$result = mysqli_query($conn, $sql);

while($files = $result->fetch_array())
{
$rows[] = $files;
}  
// Uploads files
if (isset($_POST['upload'])) { // if save button on the form is clicked
    // name of the uploaded file
    $gradelvl =  $_REQUEST['year'];
    $subjec_t = $_REQUEST['subject'];
    $quarter_no =  $_REQUEST['quarterno'];
    $module_no = $_REQUEST['moduleno'];
    $title = $_REQUEST['title'];
    $e_filename = $_FILES['file']['name'];

    // destination of the file on the server
    $destination = 'uploads/' . $e_filename;

    // get the file extension
    $extension = pathinfo($e_filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['file']['size'] > 25000000) { // file shouldn't be larger than 25Megabyte
        echo "File too large!";
        echo '<script type="text/javascript">';
        echo ' alert("File too large!")';  //not showing an alert box.
        echo '</script>';
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO files  VALUES ('$gradelvl', '$subjec_t','$quarter_no','$module_no','$title','$e_filename', '$size' )";
            if (mysqli_query($conn, $sql)) {
               
                echo '<script type="text/javascript">';
                echo ' alert("File uploaded successfully")';  //not showing an alert box.
                echo '</script>';
            }
        } else {
            echo "Failed to upload file.";
            echo '<script type="text/javascript">';
            echo ' alert("Failed to upload file.")';  //not showing an alert box.
            echo '</script>';
        }
    }
}
 // Close connection
mysqli_close($conn);
?>

 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>E-Learning Resources</title>
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
          <a href="teacher_info.php">
            <i class='bx bx-chalkboard' ></i>
            <span class="links_name">Teacher Information</span>
          </a>
        </li>
        <li>
          <a href="teacher_info.php">
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
          <a href="#" class="active">
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
        <span class="dashboard">E-Learning </span>
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
        <div class="box bttns " style="width:49%;cursor: pointer;" onclick="window.location='Elearning_info.php';">
          <div class="right-side" > 
            <div class="box-topic"><i class='bx bx-file'></i>All Files </div>
            
          </div>
          
        </div>
        <div class="box bttns active" style="width:49%;cursor: pointer;" onclick="window.location='add_elearning_file.php';">
          <div class="right-side" > 
            <div class="box-topic"><i class='bx bxs-file-plus'></i>Add New File</div>
            
          </div>
          
        </div>
        
        
        
      </div>
      

      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title">File Information</div>
          
          <form action="add_elearning_file.php" method="POST" enctype="multipart/form-data" >
            <div class="formrow">
                <div class="formcol1" >
                    <label for="year" > Grade level </label>
                </div>
                <div class="formcol2" >
                    <select id="year" name="year" class="category_div" onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);" required="">
                        <option value="">Select Grade Level</option>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                    </select>
                </div>
            </div>
            <div class="formrow">
                <div class="formcol1" >
                    <label for="subject" > Subject </label>
                </div>
                <div class="formcol2" >
                  <!-- Boxicons CDN Link 
                <script type="text/javascript" language="JavaScript" >
                    document.write('<select name="status" id="status"><option value="">Select subject</option></select>')
                </script>-->
                  <select id="subject" name="subject" onchange="showfield(this.options[this.selectedIndex].value)">
                      <option value="">Select Subject</option>
                      <option value="Filipino">Filipino</option>
                      <option value="English">English</option>
                      <option value="Mathematics">Mathematics</option>
                      <option value="Science">Science</option>
                      <option value="Araling Panlipunan">Araling Panlipunan</option>
                      <option value="Technical and Livelihood Education(TLE)">Technical and Livelihood Education(TLE)</option>
                      <option value="Music">Music</option>
                      <option value="Arts">Arts</option>
                      <option value="Physical Education">Physical Education</option>
                      <option value="Health">Health</option>
                      <option value="Edukasyon sa Pagpapakatao (EsP)">Edukasyon sa Pagpapakatao (EsP)</option>
                      <option value="Other">Others... Please Specify</option>
                    </select>
                    <div id="div1"></div>
                </div>
            </div>
            <div class="formrow">
                <div class="formcol1" >
                    <label for="quarterno" >Quarter</label>
                </div>
                <div class="formcol2" >
                    <select id="quarterno" name="quarterno"  required="">
                        <option value="">Select Quarter</option>
                        <option value="Quarter 1">Quarter 1</option>
                        <option value="Quarter 2">Quarter 2</option>
                        <option value="Quarter 3">Quarter 3</option>
                        <option value="Quarter 4">Quarter 4</option>
                    </select>
                </div>
            </div>
            <div class="formrow">
                  <div class="formcol1" >
                    <label for="moduleno" >Module Number	</label>
                  </div>
                  <div class="formcol2">
                    <input type="number" min="0" step="1"  name="moduleno" id="moduleno" required="">
                  </div>
            </div>
            <div class="formrow">
                  <div class="formcol1" >
                    <label for="title" >Title	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text"  name="title" id="title" required="">
                  </div>
            </div>
            <div class="formrow">
                  <div class="formcol1" >
                    <label for="file" ></label>
                  </div>
                  <div class="formcol2">
                    <input type="file"  name="file" id="file" required="">
                  </div>
            </div>
            
            <input type="submit"  name="upload" value="Upload" class="submitbttn" style="float: right;">
             
          </form>
          
         
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
    function showfield(name){
      if(name == 'Other') {
        document.getElementById('div1').innerHTML = 'Other: <input type="text" name="other" />';
      }
      else {
        document.getElementById('div1').innerHTML='';
      }	
    }
    
    function ShowHideDiv() {
        var chkYes = document.getElementById("chkDual");
        var dvPassport = document.getElementById("dvCountry");
        dvPassport.style.display = chkDual.checked ? "block" : "none";
    }
    

 </script>

</body>
</html>

