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
    $StudentNo = $_SESSION['LRN'];
    $index = 1;
    $x = 0;

    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

   $sql = "SELECT student_info.*, student_contact.*, student_year.*, student_guardian_info.*, student_guardian_contact.*, student_health.* 
        FROM student_info
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
      
    }else{
        echo '<br>';    
        echo "<h4>Student information for ".$StudentNo." is empty. </h4>";
    }
    

    //check user profile img in data base

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


mysqli_close($conn)
    ?> 

 <!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->

    <link rel="stylesheet" href="../admin/welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="SB-logo.png">
      <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
      <style type="text/css">
        .avatar-upload {
  position: relative;
  max-width: 205px;
  margin: 50px auto;
}
.avatar-upload .avatar-edit {
  position: absolute;
  right: 25px;
  z-index: 1;
  top: 17px;
}
.avatar-upload .avatar-edit input {
  display: none;
}
.avatar-upload .avatar-edit input + label {
  display: inline-block;
  width: 34px;
  height: 34px;
  margin-bottom: 0;
  border-radius: 100%;
  background: #FFFFFF;
  border: 1px solid  #f1f1f1;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  font-weight: normal;
  transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
  font-family: 'FontAwesome 5 Free';
  color: #757575;
  position: absolute;
  top: 10px;
  left: 0;
  right: 0;
  text-align: center;
  margin: auto;
}

.avatar-upload .avatar-preview {
  width: 192px;
  height: 192px;
  position: relative;
  border-radius: 100%;
  border: 6px solid #F8F8F8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

      </style> 

   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i><img src="../admin/images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" ></i>
      <span class="logo_name">SchoolBoard</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="profile.php" class="active" >
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
          <a href="Elearning_info.php">
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
                <span class="dashboard">My Profile</span>
              </div>
          
              <div class="profile-details">
                <img src='<?php echo $imgfilename?>' alt="">
                <span class="admin_name"><?php echo htmlspecialchars($Firstname); ?></span>
              </div>
            </nav>

    <div class="home-content">
      
   
      <div class="container py-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-lg-12 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .7rem;">
              <div class="row g-0">
                <div class="col-md-4 gradient-custom text-center text-black"
                  style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; ">

                    <!-- profile img div -->
                   <div class="avatar-upload">
                      <div class="avatar-edit">
                        <form action="uploadimg.php" method="POST" enctype="multipart/form-data" >
                            <input type="hidden" name="imgstatus" value="<?php echo $imagestatus;?>">
                            <input type='file' id="imageUpload" name=file accept=".png, .jpg, .jpeg"onchange="form.submit()" />
                             <label for="imageUpload"><i class='bx bxs-pencil '></i></label>
                             <!-- <button type=submit name=upload > UPLOAD</button> -->
                        </form>
                          
                      </div>
                      <div class="avatar-preview">
                          <div id="imagePreview" style="background-image: url(<?php echo $imgfilename?>);">
                          </div>
                      </div>
                  </div>
                  <!-- end of profile img div -->


                  <!-- <img src="profileimg/profileimg.png"
                    alt="Avatar" class="img-fluid my-5" style="width: 200px;" /> -->


                  <h5> <?php echo  $Firstname;?> <?php echo $Lastname ; ?><?php echo $Ext; ?> </h5>
                  <h4><span style="color: orangered;"><b><?php echo $LRN; ?></b></h4></span><p><?php echo "<b>ENROLLED</b>"; ?><br><?php echo "Grade " ;echo $Grade; echo " - "; echo  $Section; ?></p>

                    <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"  style="z-index: 1;"onclick="window.location='requestEdit.php';"> <i class="far fa-edit mb-1"></i>Edit profile</button>

             

                </div>
                <div class="col-md-8">
                  <div class="card-body p-4">
                    <h6>PERSONAL INFORMATION</h6>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                      <div class="col-6 mb-3">
                        <h6>Birthdate:</h6>
                        <p class="text-muted"><?php echo $Birthdate;?></p>
                         <h6>Gender:</h6>
                        <p class="text-muted"><?php echo $Gender;?></p>
                         <h6>Height(m):</h6>
                        <p class="text-muted"><?php echo $Height;?></p>
                         <h6> Weight(kg):</h6>
                        <p class="text-muted"><?php echo $Weight;?></p>
                         <h6>Mothertongue:</h6>
                        <p class="text-muted"><?php echo $Mothertongue;?></p>
                      </div>
                      <div class="col-6 mb-3">
                        <h6>Ethnicity:</h6>
                        <p class="text-muted"><?php echo $Ethnicity;?></p>
                         <h6>Religion:</h6>
                        <p class="text-muted"><?php echo $Religion;?></p>
                         <h6>Citizenship:</h6>
                        <p class="text-muted"><?php echo $Citizenship;?></p>
                         <h6>Civil Status:</h6>
                        <p class="text-muted"><?php echo $Status;?></p>
                         <h6>Address:</h6>
                        <p class="text-muted"><?php echo $Street;?>,
                                     <?php echo $Barangay;?>, <?php echo $City;?> , <?php echo $Province;?></p>
                      </div>
                    </div>
                    <h6>CONTACT INFORMATION</h6>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                      <div class="col-6 mb-3">
                       <h6>Mobile:</h6>
                        <p class="text-muted"><?php echo $Mobile;?></p>
                      </div>
                      <div class="col-6 mb-3">
                        <h6>Email:</h6>
                        <p class="text-muted"><?php echo $Email;?></p>
                      </div>
                    </div>

                     <h6>PARENT/GUARDIAN INFORMATION</h6>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                      <div class="col-6 mb-3">
                       <h6> Mother's Name:</h6>
                        <p class="text-muted"><?php echo $Mother;?></p>
                       <h6> Father's Name:</h6>
                        <p class="text-muted"><?php echo $Father;?></p>
                      </div>

                      <div class="col-6 mb-3">
                        <h6>Guardian's Address:</h6>
                        <p class="text-muted"><?php echo $GAddress;?></p>
                         <h6>Guardian's Contact:</h6>
                        <p class="text-muted"><?php echo $GContact;?></p>
                      </div>
                    </div>
                     
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>               
      </div  class="home-content">
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

   

  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
// $("#imageUpload").change(function() {
//     readURL(this);
// });

 </script>

</body>
</html>

