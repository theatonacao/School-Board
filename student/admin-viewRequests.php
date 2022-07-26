

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
        <img src="" alt="">
        <span class="admin_name">Admin</span>
        
        
      </div>
    </nav>

    <div class="home-content">

        <div class="sales-boxes">
          <div class="recent-sales box" style="width:100%">
            <div class="title" style="padding-left: 55px;font-size: 40px;"> Request #
              <?php
                $ID =  $_POST['requestID'];
                $StudentNo =  $_POST['lrn'];
                echo  $ID;
              ?>                
            </div>

            <?php

             require ('../config.php');
               $index = 1;
               $x = 0;

            $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            //echo 
            if (mysqli_connect_errno()) {
              exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }


              $sql = "SELECT  student_info.Lastname, student_info.Firstname, student_info.Middlename, student_info.Extension, student_year.Year_lvl, student_year.Section, student_info.Sex, student_info.Birthdate, student_info.Mothertongue,student_info.Ethnic, student_info.Religion, student_info.Citizenship, student_info.Status, student_guardian_info.Mother_name, student_guardian_info.Father_name, student_update.* 
                FROM student_info
                INNER JOIN student_contact ON  student_contact.LRN = student_info.LRN
                INNER JOIN student_year ON student_year.LRN = student_contact.LRN
                INNER JOIN student_guardian_info ON student_guardian_info.LRN = student_contact.LRN
                INNER JOIN student_guardian_contact ON student_guardian_contact.LRN = student_contact.LRN
                CROSS JOIN student_update ON student_update.LRN = student_guardian_contact.LRN
                WHERE student_update.requestID = '$ID' AND  student_update.LRN = '$StudentNo'";       

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

        function declineStatus(){
          echo 'hi';
              // $sql ="UPDATE student_update
              //   SET student_update.reqStatus = 2 
              //   WHERE student_update.requestID = $ID" ;

              //   if( $GLOBALS['conn']->query($sql)===TRUE){
              //   }

        }
            
    


            ?>

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
              <form action="updateInfo.php" method='POST'>




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

                    <input type="hidden" name="requestNo" value="<?php echo $ID;?>" required="">



                <div class="overview-boxes">
                    <div class="box bttns" style="width:50%">
                        <button  type=submit class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" onclick="success();" name=submit>
                            <div class="box-topic">APPROVE</div>
                        </button>
                    </div>
             </form>

                    <div class="box bttns" style="width:50%">
                      <button  type=submit class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" onclick="<?php declineStatus();?>" name=submit>
                            <div class="box-topic">DECLINE REQUEST</div>
                      </button>
                      
                       
                    </div>
                </div>
              
          

            
            <!-- end -->          
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

  function success() {
    alert('Request to update information was successfully sent!\nKindly wait for your request to be approved.');
    
  }

  // function declined() {

  //   <?php declineStatus();?>

  //  window.history.go(-1);
  // }


  </script>


</body>
</html>

