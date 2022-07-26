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
 if (isset($_POST['submit'])) {       
        $LRN = $_POST["lrn"];
        $Lastname = $_POST["surname"];
        $Firstname = $_POST["firstname"];
        $Middlename = $_POST["middlename"];
        $Ext = $_POST["nameextension"];
        $Grade = $_POST["Year_lvl"];
        $Section = $_POST["Section"];
        $Adviser = $_POST["Adviser_name"];
        $Password = $_POST["lrnr_password"];
        $Height = $_POST["Height"];
        $Weight = $_POST["Weight"];


        $Gender = $_POST["sex"];
        $Birthdate = $_POST["bday"];
        $Birthplace = $_POST["placeofbirth"];
        $Mothertongue = $_POST["mothertongue"];
        $Ethnicity = $_POST["ethnic"];
        $Religion = $_POST["religion"];
        $Citizenship = $_POST["citizenship"];
        $Status = $_POST["civilstatus"];

        $Street = $_POST["street"];
        $Barangay = $_POST["barangay"];
        $City = $_POST["city"];
        $Province = $_POST["province"];

        $Mobile = $_POST["mobile"];
        $Email = $_POST["email"];
        $Tele_num = $_POST["email"];
        $Mother = $_POST["mname"];
        $Father = $_POST["fname"];
        $GAddress = $_POST["faddress"];
        $GContact = $_POST["Guardian_contact"];
        
        
        $sql = "INSERT INTO student_info(LRN, Lastname, Firstname, Middlename, Extension, Sex, Birthdate, Birthplace, Mothertongue, Ethnic, Religion, Citizenship, Status, Password)VALUES('$LRN', '$Lastname', '$Firstname','$Middlename','$Ext','$Gender','$Birthdate','$Birthplace','$Mothertongue','$Ethnicity', '$Religion','$Citizenship','$Status','$Password')";
         
        if(mysqli_query($conn, $sql)){
            
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
        $sql2 = "INSERT INTO student_contact(LRN, Street, Barangay, City, Province, Tele_num, Email, Mobile_num)VALUES('$LRN', '$Street', '$Barangay', '$City', '$Province', '$Tele_num', '$Email', '$Mobile')";
         
        if(mysqli_query($conn, $sql2)){
            
        } else{
            echo "ERROR: Hush! Sorry $sql2. "
                . mysqli_error($conn);
        }
         
      }     
        // Close connection
        mysqli_close($conn);
?>

 
 <!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Student Admission</title>
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
        <span class="dashboard">Dashboard</span>
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
        <div class="box bttns"  style="width:49%;cursor: pointer;" onclick="window.location='student_info.php';">
          <div class="right-side" >
            <div class="box-topic">Student Details</div>
            
          </div>
          
        </div>
        <div class="box bttns active" style="width:49%; cursor: pointer;" onclick="window.location='admission_form.php';">
          <div class="right-side" >
            <div class="box-topic">Admission Form</div>
          </div>
        </div>
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title">Add New Student Information</div>
          
          <div class="div form-content" >
            <form action="admission_form.php" method="post" enctype="multipart/form-data" >
              <div class="personalinfo" > 
                <br>
                <h3> I. PERSONAL INFORMATION </h3> 
                
                <div class="formrow">
                  <div class="formcol1">
                    <label for="surname">Surname<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2">
                    <input type="text"id="surname" name="surname" placeholder="Surname"  required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1">
                    <label for="firstname">First Name<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2">
                    <input type="text" id="firstname" name="firstname" placeholder="First Name" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1">
                    <label for="middlename">Middle Name</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" id="middlename" name="middlename" placeholder="Middle Name" >
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1">
                    <label for="nameextension">Name Extension</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" id="nameextension" name="nameextension" placeholder="Jr/ Sr">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1">
                    <label for="lrn"> Learner's Reference Number (LRN)<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2">
                    <input type="number" min="0" step="1" id="lrn" name="lrn" placeholder="LRN" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="lrnr_password" > Student system password<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="lrnr_password" id="lrnr_password" placeholder="Password"  required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="bday" >Date of birth<span  style="color:red"> *</span>	</label>
                  </div>
                  <div class="formcol2">
                    <input type="date" name="bday"  id="bday" placeholder="mm/dd/yyy"  required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="placeofbirth" >Place of birth<span  style="color:red"> *</span>		</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="placeofbirth" id="placeofbirth" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="sex" >Sex<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2" style="margin-top: 15px">
                    <input type="radio" name="sex"  id="sex"value="male" required=""> Male
                    <input type="radio" name="sex" id="sex" value="female" required=""> Female
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="civilstatus" >Civil Status</label>
                  </div>
                  <div class="formcol2" style="margin-top: 15px">
                    <input type="radio" name="civilstatus" id="civilstatus" value="Single" required=""> Single
                    <input type="radio" name="civilstatus" id="civilstatus" value="Widowed" required=""> Widowed
                    <input type="radio" name="civilstatus" id="civilstatus" value="Married" required=""> Married
                    <input type="radio" name="civilstatus" id="civilstatus" value="Separated" required=""> Separated
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="mothertongue" >Mother Tongue<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2" >
                    <select id="mothertongue" name="mothertongue" onchange="showfield(this.options[this.selectedIndex].value)">
                      <option value="tagalog">Tagalog</option>
                      <option value="kapampangan">Kapampangan</option>
                      <option value="pangasinense">Pangasinense</option>
                      <option value="iloko">Iloko</option>
                      <option value="bikol">Bikol</option>
                      <option value="cebuano">Cebuano</option>
                      <option value="hiligaynon">Hiligaynon</option>
                      <option value="waray">Waray</option>
                      <option value="tausug">Tausug</option>
                      <option value="maguindanaoan">Maguindanaoan</option>
                      <option value="maranao">Maranao</option>
                      <option value="chabacano">Chabacano</option>
                      <option value="ybanag">Ybanag</option>
                      <option value="ivatan">Ivatan</option>
                      <option value="sambal">Sambal</option>
                      <option value="aklanon">Aklanon</option>
                      <option value="kinaray-a">Kinaray-a</option>
                      <option value="yakan">Yakan</option>
                      <option value="surigaonon">Surigaonon</option>
                      <option value="Other">Others... Please Specify</option>
                    </select>
                    <div id="div1"></div>
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="ethnic" >Ethnic Group 	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="ethnic" id="ethnic" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="religion" >Religion </label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="religion" id="religion" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="citizenship" >Citizenship <br><span style="font-size: 6pt">(If holder of dual citizenship, please indicate the details)</span></label>
                  </div>
                  <div class="formcol2" style="margin-top:20px">
                    <input type="radio" name="citizenship" id="citizenship" value="Filipino" onclick="ShowHideDiv()" required=""> Filipino &nbsp;&nbsp;&nbsp;
                    <input type="radio"  class ="dual" name="citizenship"   id="chkDual" value="other" onclick="ShowHideDiv()"  required=""> Dual Citizenship 
                    <div id="dvCountry" style="display: none">
                      <span style="font-size: 10pt">(Please indicate the country)</span>
                        <input type="text" name="country" id="country" >
                    </div>
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="address" >Residential Address <span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="street" id="address" placeholder="Street" style="width:49%" required="">&nbsp;&nbsp;
                    <input type="text" name="barangay" placeholder="Barangay"  style="width:49%" required=""> <br>
                    <input type="text" name="city" placeholder="City/Municipality" style="width:49%;margin-top:5px" required="">&nbsp;&nbsp;
                    <input type="text" name="province" placeholder="Province" style="width:49%" required=""> 
                  </div>
                </div><br>
                <h3> II. CONTACT INFORMATION </h3> 
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="telephone" >Telephone No.	</label>
                  </div>
                  <div class="formcol2">
                    <input type="number" name="telephone" id="telephone" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="mobile" >Mobile No.	</label>
                  </div>
                  <div class="formcol2">
                    <input type="number" name="mobile" id="mobile" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="email" >E-mail Address 	</label>
                  </div>
                  <div class="formcol2">
                    <input type="email" name="email" id="email"  required="">
                  </div>
                </div>

              </div>
              <h3> III. Parent/Guardian Information</h3>

                <div class="formrow">
                  <div class="formcol1" >
                    <label for="fname" >Father's Name	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="fname" id="fname" placeholder="Father's Name" required="">
                  </div>
                </div>
                
                
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="faddress" >Father's Address	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="faddress" id="faddress" placeholder="Father's Address" required="">
                  </div>
                </div>
                
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="mname" >Mother's Name	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="mname" id="mname"  placeholder="Mother's Name" required="">
                  </div>
                </div>
                
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="maddress" >Mother's Address	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="maddress" id="maddress" placeholder="Mother's Address" required="">
                  </div>
                </div>
                
                
                <label>If not Living with Parents:</label>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="guardian" >Student Guardian	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="guardian" id="guardian" placeholder="Guardian's Name"  style="width: 70%;">  &nbsp;&nbsp;Age <input type="number" name="sage" id="sage" placeholder="Age" style="width: 20%;float:right">
                  </div>
                </div>
                
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="gaddress" >Guardian's Address	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="gaddress" id="gaddress" placeholder="Guardian's Address" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="gcontact" >Guardian Contact Information	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="gcontact" id="gcontact" placeholder="Guardian Contact" required="">
                  </div>
                </div>
                
              <h3> III. Health History </h3>
              <div class="formrow">
                  <div class="formcol1" >
                    <label for="height" >Height</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="height" id="height" placeholder="Height"  style="width: 40%; "> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Weight<input type="number" name="weight" id="weight" placeholder="Weight" style="width: 40%; float: right"> 
                  </div>
              </div>
               <h3> IV. Student academic Status </h3>
              <div class="formrow">
                  <div class="formcol1" >
                    <label for="year" > Grade level </label>
                  </div>
                  <div class="formcol2" >
                    <select id="year" name="year" required="">
                      <option value="grade7">Grade 7</option>
                      <option value="grade8">Grade 8</option>
                      <option value="grade9">Grade 9</option>
                      <option value="grade10">Grade 10</option>
                      <option value="grade11">Grade 11</option>
                      <option value="grade12">Grade 12</option>
                    </select>
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="section" >Section	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="section" id="section" placeholder="Section" required="">
                  </div>
                </div>
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="adviser" >Adviser	</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="adviser" id="adviser" placeholder="Adviser" required="">
                  </div>
                </div>

              <input type="submit"  name="submit" value="Submit" class="submitbttn" style="margin: 20px 15px; float: right "> <input type="submit"  value="Reset" class="submitbttn" style="margin: 20px 15px; background-color:#6c757d; float:right"> 
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

