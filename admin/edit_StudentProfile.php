
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
    require ('../config.php');
    $id = isset($_GET["id"]) ? $_GET["id"] : false;
    if ($id === false) {
        exit("missing input");
    }
    $_SESSION['LRN']= $id;
    $StudentNo = $_SESSION['LRN'];
    $index = 1;
    $x = 0;

   $sql = "SELECT student_info.*, student_contact.*, student_year.*, student_guardian_info.*, student_guardian_contact.*, student_health.* FROM student_info
        INNER JOIN student_contact ON  student_contact.LRN = student_info.LRN
        INNER JOIN student_year ON student_year.LRN = student_contact.LRN
        INNER JOIN student_guardian_info ON student_guardian_info.LRN = student_contact.LRN
        INNER JOIN student_guardian_contact ON student_guardian_contact.LRN = student_contact.LRN
        INNER JOIN student_health ON student_health.LRN = student_contact.LRN
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
        
        $Height = $row["Height"];
        $Weight = $row["Weight"];


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
        $year = $row['Year_lvl'];
        
        
    }else{
        echo '<br>';    
        echo "<h4>Student information for ".$StudentNo." is empty. </h4>";
    }
    
mysqli_close($conn)
    ?> 
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="welcome_styles.css">
    <!-- Boxicons CDN Link -->

     <script src="https://cdn.anychart.com/releases/8.0.0/js/anychart-base.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title> Edit Student Info</title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel = "icon" href =  "images/SB-logo.png"  type = "image/x-icon">

    <style type="text/css">
        .bttns{
        background:rgb(252,138,101);
        z-index: 2;
        color: teal;
        }

        .bttns: hover{
        transition: all 0.4s ease;
        transform: scale(1);
        background:teal;
        z-index: 2;
        color: white;
        }

    </style>
     
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
        <span class="dashboard">Student Profile</span>
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

      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title" onclick="history.back()"><i class='bx bxs-left-arrow-circle'></i></i>Edit Profile Information</div>
          
          <div class="div form-content" >
    <form  action="edit_StudentProfile.php" method="POST" >
              <div class="personalinfo" > 

                <input type="hidden" name="lrn" value="<?php echo $LRN;?>" /> 
                <input type="hidden" name="Grade" value="<?php echo $Grade;?>" />  
                <input type="hidden" name="Section" value="<?php echo $Section;?>" />  

                <br>
                <h3> I. PERSONAL INFORMATION </h3> 
                <div class="formrow">


                  <div class="formcol1" >
                    <label for="profpic" >Upload Profile Image</label>
                  </div>
                  <div class="formcol2">
<!-- prof img   -->  <input type="file"  name="profpic" id="profpic" >
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1">
                    <label for="surname">Surname<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2">
                    <input type="text"id="surname" name="last" value=" <?php echo $Lastname;?>"  readonly required="">
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1">
                    <label for="firstname">First Name<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2">
                    <input type="text" id="firstname" name="first" value="<?php echo $Firstname;?>" readonly required="">
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1">
                    <label for="middlename">Middle Name</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" id="middlename" name="middle" value="<?php echo $Middlename;?>"  readonly >
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1">
                    <label for="nameextension">Name Extension</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" id="nameextension" name="ext" value="<?php echo $Ext;?>"  readonly>
                  </div>
                </div>

                <div class="formrow">
                  <div class="formcol1" >
                    <label for="bday" >Date of birth<span  style="color:red"> *</span>  </label>
                  </div>
                  <div class="formcol2">
                    <input type="date" name="Birthdate"  id="bday" value="<?php echo $Birthdate;?>"  readonly  style="padding: 7px;" required="">
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1" >
                    <label for="sex" >Sex<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2" style="margin-top: 15px">
                     <input type="text" name="Sex" value="<?php echo $Gender;?>"  readonly   required="">
                  </div>
                </div>

                <div class="formrow">
                  <div class="formcol1" >
                    <label for="father_occupation" >Height(m)</label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="height" style="width: 30.5%" value="<?php echo $Height;?>"    required="">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label> Weight(kg)</label> 
                    <input type="text" name="weight" style="width: 30.5%; float: right" value="<?php echo $Weight;?>"  required="" >
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1" >
                    <label for="civilstatus" >Civil Status</label>
                  </div>
                  <div class="formcol2" style="margin-top: 15px">
                    <input type="text" name="Status" value="<?php echo $Status;?>"  readonly   required="">
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1" >
                    <label for="mothertongue" >Mother Tongue<span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2" >
                    <input type="text" name=Mothertongue value="<?php echo $Mothertongue;?>"  readonly   required="">
                    <div id="div1"></div>
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1" >
                    <label for="ethnic" >Ethnicity </label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name=Ethnicity value="<?php echo $Ethnicity;?>"  readonly   required="">
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1" >
                    <label for="religion" >Religion </label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="religion" value="<?php echo $Religion;?>"  readonly   required="">
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1" >
                    <label for="citizenship" >Citizenship <br></label>
                  </div>
                  <div class="formcol2" style="margin-top:20px">
                     <input type="text" name="Citizenship" value="<?php echo $Citizenship;?>"  readonly   required="">
                    </div>
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1" >
                    <label for="address" >Residential Address <span  style="color:red"> *</span></label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="street" id="address" value="<?php echo $Street;?>" style="width:49%" required="">&nbsp;&nbsp;
                    <input type="text" name="brgy"value="<?php echo $Barangay;?>" style="width:49%" required=""> <br>
                    <input type="text" name="city" value="<?php echo $City;?>" style="width:49%;margin-top:5px" required="">&nbsp;&nbsp;
                    <input type="text" name="province" value="<?php echo $Province;?>" style="width:49%" required=""> 
                  </div>
                </div><br>

                <h3>Contact Information</h3>

                <div class="formrow">
                  <div class="formcol1" >
                    <label for="mobile" >Mobile No. </label>
                  </div>
                  <div class="formcol2">
                    <input type="number" name="mobileno" id="mobile" value="<?php echo $Mobile;?>" required="">
                  </div>
                </div>


                <div class="formrow">
                  <div class="formcol1" >
                    <label for="email" >E-mail Address  </label>
                  </div>
                  <div class="formcol2">
                    <input type="email" name="email" id="email"  style="padding: 7px; width: 100%"  pattern="[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*" value="<?php echo $Email;?>" required="">
                  </div>
                </div>

              </div>
              <h3>Parent/Guardian Information</h3>

                <div class="formrow">
                  <div class="formcol1" >
                    <label for="fname" >Father's Name </label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="Father_name" value="<?php echo $Father;?>" required="">
                  </div>
                </div>
                
            
                <div class="formrow">
                  <div class="formcol1" >
                    <label for="mname" >Mother's Name </label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="Mother_name" value="<?php echo $Mother;?>" required="">
                  </div>
                </div>

                <div class="formrow">
                  <div class="formcol1" >
                    <label for="mname" >Guardian's Address </label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="gaddress" value="<?php echo $GAddress;?>" required="">
                  </div>
                </div>

                <div class="formrow">
                  <div class="formcol1" >
                    <label for="mname" >Guardian's Contact Number </label>
                  </div>
                  <div class="formcol2">
                    <input type="text" name="gcontact" value="<?php echo $GContact;?>" required="">
                  </div>
                </div>
        </div>
    </div>
                <div class="overview-boxes">
                    <div class="box bttns" style="width:50%">
                        <button type=submit class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" >
                            <div class="box-topic">SUBMIT CHANGES</div>
                        </button>
                    </div>

                    <div class="box bttns" style="width:50%"  onclick="javascript:window.history.go(-1);">
                        <div class="right-side" style="cursor: pointer;" >
                            <div class="box-topic">CANCEL</div>
                        </div>
                    </div>
                </div>
              
            </form>
          
      </div>
    </div>
  </section>

  <script>

    function submitform(){
        document.getElementById("form_id").submit();// Form submission

    }

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
