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
  if(!empty($_POST)){
      

        $LRN = $_POST["lrn"];
        $Lastname = $_POST["last"];
        $Firstname = $_POST["first"];
        $Middlename = $_POST["middle"];
        $Ext = $_POST["ext"];
        $Grade = $_POST["Grade"];
        $Section = $_POST["Section"];
        
        $Gender = $_POST["Sex"];
        $Birthdate = $_POST["Birthdate"];

        $Height = $_POST["height"];
        $Weight = $_POST["weight"];

        $Mothertongue = $_POST["Mothertongue"];
        $Ethnicity = $_POST["Ethnicity"];
        $Religion = $_POST["religion"];
        $Citizenship = $_POST["Citizenship"];
        $Status = $_POST["Status"];

        $Street = $_POST["street"];
        $Barangay = $_POST["brgy"];
        $City = $_POST["city"];
        $Province = $_POST["province"];

        $Mobile = $_POST["mobileno"];
        $Email = $_POST["email"];
        $Mother = $_POST["Mother_name"];
        $Father = $_POST["Father_name"];
        $GAddress = $_POST["gaddress"];
        $GContact = $_POST["gcontact"];
        
    }else{
        echo "NO DATA LOADED";
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
    <title>Student Information</title>
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="../admin/welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="SB-logo.png">

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
      <i><img src="../admin/images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" ></i>
      <span class="logo_name">SchoolBoard</span>
    </div>
      <ul class="nav-links">
        <!-- <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li> -->
        <li>
          <a href="#" class="active" >
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
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <img src="<?php echo $imgfilename?>" alt="">
        <span class="admin_name"><?php echo htmlspecialchars($Firstname); ?></span>
        
        
      </div>
    </nav>

    <div class="home-content">

      <div class="sales-boxes">
        <div class="recent-sales box" style="width:100%">
          <div class="title">Confirm Profile Information</div>
          

          <div style="font-family: Trebuchet MS; text-align: left; color: black; letter-spacing: 2px;font-size: 14pt; padding-left: 60px;">

                <p class="elearning" style="text-align: left; margin-bottom: 0px;">
                <!--  LRN  -->           
                <span style="color: red"><?php echo $LRN; ?></span></B><br> 
                <!--  //NAME -->
                <span style="color: navy;"><?php echo $Lastname ; ?>, <?php echo  $Firstname;?>  <?php echo $Middlename; ?> <?php echo $Ext; ?></span><br> 

<!-- NEED UPDATE FROM ADMIN MODULE -->
                <!-- STATUS -->
                <span style="color: black;"><?php echo "ENROLLED"; ?></span></B><br> 
                <!--  Grade level -->
                <span style="color: black;"><?php echo "Grade " ;echo $Grade; echo " - "; echo  $Section; ?></span></B><br> 
                </p>

                       <div class="rowX" style="display: table; width: 100%;">
                            <div class="columnX" style="float: left;width: 50%; border: none;">
                                <h3>PERSONAL INFORMATION</h3>
                                Birthdate: <?php echo $Birthdate;?> <br>
                                Gender: <?php echo $Gender;?> <br>
                                Height(m): <?php echo $Height;?><br>
                                Weight(kg): <?php echo $Weight;?><br>
                                Mothertongue: <?php echo $Mothertongue;?> <br>
                                Ethnicity: <?php echo $Ethnicity;?> <br>
                                Religion: <?php echo $Religion;?> <br>
                                Citizenship: <?php echo $Citizenship;?> <br>
                                Status: <?php echo $Status;?> <br>
                                Address: <?php echo $Street;?>,
                               <?php echo $Barangay;?>, <?php echo $City;?> , <?php echo $Province;?> <br>
                            </div>

                            <div class="columnX" style="float: left;width: 50%;">
                            <h3>CONTACT INFORMATION</h3>
                                Mobile: <?php echo $Mobile;?> <br>
                                Email: <?php echo $Email;?> <br>
                                 <h3>PARENT/GUARDIAN INFORMATION</h3>
                                Mother's Name: <?php echo $Mother;?> <br>
                                Father's Name: <?php echo $Father;?> <br>
                                Guardian's Address: <?php echo $GAddress;?> <br>
                                Guardian's Contact: <?php echo $GContact;?> <br> <br><br>

                               
                            </div><!-- end of columnx -->
                        </div><!-- end of rowX/ end of table -->
                    
            </div>
<form action="forwardRequest.php" method=POST>
                    <input type="hidden" name="lrn" value="<?php echo $LRN;?>" /> 
                
                    <input type="hidden" name="height" style="width: 30.5%" value="<?php echo $Height;?>" >
                    <input type="hidden"  name="weight" style="width: 30.5%; float: right" value="<?php echo $Weight;?>"  required="" >
                         
                    <input type="hidden"name="street" id="address" value="<?php echo $Street;?>" style="width:49%" required="">&nbsp;&nbsp;
                    <input type="hidden"name="brgy"value="<?php echo $Barangay;?>" style="width:49%" required=""> <br>
                    <input type="hidden" name="city" value="<?php echo $City;?>" style="width:49%;margin-top:5px" required="">&nbsp;&nbsp;
                    <input type="hidden" name="province" value="<?php echo $Province;?>" style="width:49%" required=""> 
               
                    <input type="hidden" name="mobileno" id="mobile" value="<?php echo $Mobile;?>" required="">

                    <input type="hidden" name="email" id="email"  value="<?php echo $Email;?>" >
    
                    <input type="hidden" name="gaddress" value="<?php echo $GAddress;?>" required="">

                    <input type="hidden" name="gcontact" value="<?php echo $GContact;?>" required="">



                <div class="overview-boxes">
                    <div class="box bttns" style="width:50%">
                        <button  type=submit class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" onclick="success();">
                            <div class="box-topic">CONFIRM</div>
                        </button>
                    </div>

                    <div class="box bttns" style="width:50%">
                        <div class="right-side" style="cursor: pointer;" onclick="javascript:window.history.go(-1);" >
                            <div class="box-topic">CANCEL</div>
                        </div>
                    </div>
                </div>
              
            </form>
          
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

  function success() {
    alert('Request to update information was successfully sent!\nKindly wait for your request to be approved.');
    
  }


  </script>


</body>
</html>

