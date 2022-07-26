<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


    require ('../config.php');
    $id = isset($_GET["id"]) ? $_GET["id"] : false;
    if ($id === false) {
        exit("missing input");
    }
    $_SESSION['LRN']= $id;
    $StudentNo = $_SESSION['LRN'];
    $index = 1;
    $x = 0;

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
        
        }
        $year = $row['Year_lvl'];
    }else{
        echo '<br>';    
        echo "<h4>Student information for ".$StudentNo." is empty. </h4>";
    }


    //php function to retrieve grade from a specific subject + period
    function getGrade($subjectname,$gradeperiod){

        //sql query to get grades
        $sql1 = "SELECT * FROM grades_per_subject WHERE grades_per_subject.LRN =  {$GLOBALS['StudentNo']}
                AND grades_per_subject.subject= '". $subjectname. "' AND grades_per_subject.periodic_grading = $gradeperiod";
                          
                $result = mysqli_query($GLOBALS['conn'], $sql1);
                
                if (mysqli_num_rows($result)==0) { 
                        $subjectgrade = '';
                        // echo $subjectgrade;
                        return $subjectgrade;
                }
                else{
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc() ) 
                        {
                            $subjectgrade = $row["grade"];
                            // echo $subjectgrade;
                            return $subjectgrade;
                        }
                    }else{
                        echo ''; 
                    }
                }  
      } //end of getGrade() function

      function getQuarterAve($quarter){

        //sql query to get grades
        $sql2 = "SELECT * FROM grade_per_year WHERE grade_per_year.LRN =  {$GLOBALS['StudentNo']}";
                          
                $result = mysqli_query($GLOBALS['conn'], $sql2);
                
                if (mysqli_num_rows($result) == 0) { 
                        $qgrade = '';
                        // echo $subjectgrade;
                        return $qgrade;
                
                }
                else{
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc() ) 
                        {
                            $qgrade1 = $row["Period_1"];
                            $qgrade2 = $row["Period_2"];
                            $qgrade3 = $row["Period_3"];
                            $qgrade4 = $row["Period_4"];
                            $finalgrade = $row["Grade_ave"];
                        }

                        if ($quarter==1){
                            return $qgrade1;
                        }else if ($quarter==2) {
                            return $qgrade2;
                        }else if ($quarter==3) {
                            return $qgrade3;
                        }else if ($quarter==4) {
                            return $qgrade4;
                        }else if ($quarter==5) {
                            return $finalgrade;
                        }


                    }else{
                        echo ''; 
                    }
                }  
      } //end of getQuarterAve() function

      //php function to get average for 4 parameters (for MAPEH and Final Grade)
      function getAverage($s1,$s2,$s3,$s4){
        //leave blank if some grades are not yet in
        if($s1==''||$s2==''||$s3==''||$s4=='')
        $ave = '';
        else{
        $ave = ($s1+$s2+$s3+$s4)/4;
        }
        // echo $ave;
        return $ave;
      }//end of getGrade function

      //php function to get average for 7 parameters (for Subject Final Grade)
      function getAverage8($s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8){
        //leave blank if some grades are not yet in
        if($s1==''||$s2==''||$s3==''||$s4==''||$s5==''||$s6==''||$s7==''||$s8=='')
            $ave = '';
        else{
            $ave = ($s1+$s2+$s3+$s4+$s5+$s6+$s7+$s8)/8;
        }
        // echo $ave;
        return $ave;
      }//end of getGrade function

    ?> 

 <!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="welcome_styles.css">
    <!-- Boxicons CDN Link -->

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://cdn.anychart.com/releases/8.0.0/js/anychart-base.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta charset="UTF-8">
    <title> Student Grades</title>
    <link rel="stylesheet" href="welcome_styles.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel = "icon" href =  "images/SB-logo.png"  type = "image/x-icon">

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
        <span class="dashboard"> Performance Tracker</span>
      </div>
  
      <div class="profile-details">
      <img src="images/default_pfp.jpg" alt="">
        <span class="admin_name"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
        <a href="logout.php">
            <i class='bx bx-log-out' ></i>
        </a>
        
      </div>
    </nav>

    <div class="home-content" style="padding-top: 80px;">


      <div class="sales-boxes">

        <div class="recent-sales box" style="float: left; display: block;margin-top: 20px; ">
           <div class="title" onclick="history.back()"><i class='bx bxs-left-arrow-circle'></i></i></div>

            <div class="overview-boxes"> <br><br><br><br>

                <div class="box bttns active" style="width:100%;">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" onclick="getChartOverAll();" >
                        <div class="box-topic">Overall Performance</div>
                    </div>
                </div>
                 <div class="box bttns" style="width:100%;margin: 5px">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" onclick="getChartQuarter(1);" >
                        <div class="box-topic">1st Quarter</div>
                    </div>
                </div>
                 <div class="box bttns" style="width:100%;margin: 5px">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" onclick="getChartQuarter(2);" >
                        <div class="box-topic">2nd Quarter</div>
                    </div>
                </div>
                 <div class="box bttns" style="width:100%;margin: 5px">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" onclick="getChartQuarter(3);" >
                        <div class="box-topic">3rd Quarter</div>
                    </div>
                </div>
                 <div class="box bttns" style="width:100%;margin: 5px">
                    <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" onclick="getChartQuarter(4);" >
                        <div class="box-topic">4th Quarter</div>
                    </div>
                </div>


         <!-- Dropdown per Subject -->
        <div class="select-menu"  style=" width:32%%;">
        <div class="select-btn" style=" position: absolute; width:32%;">
            <span class="sBtn-text">Per Subject</span>
            <i class="bx bx-chevron-down"></i>
        </div>

        <ul class="options" style=" position: absolute; text-align:center;" >
            <li class="option"  onclick="getChartSubject('Filipino')">
                <i class="bx" style="color: #171515;"></i>
                <span class="option-text">Filipino</span>
            </li>
            <li class="option"  onclick="getChartSubject('English')">
                <i class="bx" style="color: #E1306C;"></i>
                <span class="option-text">English</span>
            </li>
            <li class="option"  onclick="getChartSubject('Math')">
                <i class="bx" style="color: #0E76A8;"></i>
                <span class="option-text">Math</span>
            </li>
            <li class="option"  onclick="getChartSubject('Science')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">Science</span>
            </li>
            <li class="option" onclick="getChartSubject('Araling Panlipunan')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">Araling Panlipunan</span>
            </li>
            <li class="option" onclick="getChartSubject('Edukasyon sa Pagpapakatao')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">Edukasyon sa Pagpapakatao</span>
            </li>
            <li class="option" onclick="getChartSubject('Technology and Livelihood Education')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">TLE</span>
            </li>
            <li class="option"  onclick="getChartSubject('MAPEH')">
                <i class="bx" style="color: #4267B2;"></i>
                <span class="option-text">MAPEH</span>
            </li>
        </ul>
        </div>
          <!-- end of char -->

      </div><br><br>
            
        </div>
            <div class="recent-sales box" style="width:100%; height: 550px; margin-top: 20px;float: left;">
                 
<!-- INSERT HERE -->



           
                <p id=title style="text-align: center; font-size: 20px;"></p>
            <div id="container" style="width: 100%; height: 450px; margin-left: 10px; margin-top:5px;" >
                <!-- Graph will be displayed here -->


                
            </div>

        
       
        

<!-- div for hidden element placeholder to retrieve all phpdata grades and forward to javascript w/o using AJAX-->
       
            <!-- Filipino -->
            <input type="hidden" name="Filipino" id="Filipino1" value="<?php echo getGrade('Filipino', 1);?>">
            <input type="hidden" name="Filipino" id="Filipino2" value="<?php echo getGrade('Filipino', 2);?>">
            <input type="hidden" name="Filipino" id="Filipino3" value="<?php echo getGrade('Filipino', 3);?>">
            <input type="hidden" name="Filipino" id="Filipino4" value="<?php echo getGrade('Filipino', 4);?>">

            <input type="hidden" name="English" id="English1" value="<?php echo getGrade('English', 1);?>">
            <input type="hidden" name="English" id="English2" value="<?php echo getGrade('English', 2);?>">
            <input type="hidden" name="English" id="English3" value="<?php echo getGrade('English', 3);?>">
            <input type="hidden" name="English" id="English4" value="<?php echo getGrade('English', 4);?>">


            <input type="hidden" name="Araling Panlipunan" id="Araling Panlipunan1" value="<?php echo getGrade('Araling Panlipunan', 1);?>">
            <input type="hidden" name="Araling Panlipunan" id="Araling Panlipunan2" value="<?php echo getGrade('Araling Panlipunan', 2);?>">
            <input type="hidden" name="Araling Panlipunan" id="Araling Panlipunan3" value="<?php echo getGrade('Araling Panlipunan', 3);?>">
            <input type="hidden" name="Araling Panlipunan" id="Araling Panlipunan4" value="<?php echo getGrade('Araling Panlipunan', 4);?>">

            <input type="hidden" name="Math" id="Math1" value="<?php echo getGrade('Math', 1);?>">
            <input type="hidden" name="Math" id="Math2" value="<?php echo getGrade('Math', 2);?>">
            <input type="hidden" name="Math" id="Math3" value="<?php echo getGrade('Math', 3);?>">
            <input type="hidden" name="Math" id="Math4" value="<?php echo getGrade('Math', 4);?>">

            <input type="hidden" name="Science" id="Science1" value="<?php echo getGrade('Science', 1);?>">
            <input type="hidden" name="Science" id="Science2" value="<?php echo getGrade('Science', 2);?>">
            <input type="hidden" name="Science" id="Science3" value="<?php echo getGrade('Science', 3);?>">
            <input type="hidden" name="Science" id="Science4" value="<?php echo getGrade('Science', 4);?>">

             <!-- Filipino -->
            <input type="hidden" name="Technology and Livelihood Education" id="Technology and Livelihood Education1" value="<?php echo getGrade('Technology and Livelihood Education', 1);?>">
            <input type="hidden" name="Technology and Livelihood Education" id="Technology and Livelihood Education2" value="<?php echo getGrade('Technology and Livelihood Education', 2);?>">
            <input type="hidden" name="Technology and Livelihood Education" id="Technology and Livelihood Education3" value="<?php echo getGrade('Technology and Livelihood Education', 3);?>">
            <input type="hidden" name="Technology and Livelihood Education" id="Technology and Livelihood Education4" value="<?php echo getGrade('Technology and Livelihood Education', 4);?>">

            <input type="hidden" name="Edukasyon sa Pagpapakatao" id ="Edukasyon sa Pagpapakatao1" value="<?php echo getGrade('Edukasyon sa Pagpapakatao', 1);?>">
            <input type="hidden" name="Edukasyon sa Pagpapakatao" id ="Edukasyon sa Pagpapakatao2" value="<?php echo getGrade('Edukasyon sa Pagpapakatao', 2);?>">
            <input type="hidden" name="Edukasyon sa Pagpapakatao" id ="Edukasyon sa Pagpapakatao3" value="<?php echo getGrade('Edukasyon sa Pagpapakatao', 3);?>">
            <input type="hidden" name="Edukasyon sa Pagpapakatao" id ="Edukasyon sa Pagpapakatao4" value="<?php echo getGrade('Edukasyon sa Pagpapakatao', 4);?>">
<!-- UPDATE DATABASE MAPEH AVE -->
           <!--  <input type="hidden" name="MAPEH" id="MAPEH1" value="<?php echo getGrade('MAPEH', 1);?>">
            <input type="hidden" name="MAPEH" id="MAPEH2" value="<?php echo getGrade('MAPEH', 2);?>">
            <input type="hidden" name="MAPEH" id="MAPEH3" value="<?php echo getGrade('MAPEH', 3);?>">
            <input type="hidden" name="MAPEH" id="MAPEH4" value="<?php echo getGrade('MAPEH', 4);?>"> -->

            <input type="hidden" name="Final" id="Final1" value="<?php echo getQuarterAve(1);?>">
            <input type="hidden" name="Final" id="Final2" value="<?php echo getQuarterAve(2);?>">
            <input type="hidden" name="Final" id="Final3" value="<?php echo getQuarterAve(3);?>">
            <input type="hidden" name="Final" id="Final4" value="<?php echo getQuarterAve(4);?>">

<!-- do not go beyond -->
                          
                          
                          </div><!-- end of recent-sales box-->
                      </div > <!-- class="sales-boxes" -->
                </div> <!-- home-content -->


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

    const optionMenu = document.querySelector(".select-menu"),
       selectBtn = optionMenu.querySelector(".select-btn"),
       options = optionMenu.querySelectorAll(".option"),
       sBtn_text = optionMenu.querySelector(".sBtn-text");

    selectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));       

    options.forEach(option =>{
        option.addEventListener("click", ()=>{
            let selectedOption = option.querySelector(".option-text").innerText;
            sBtn_text.innerText = selectedOption;

            optionMenu.classList.remove("active");
        });
    });





   //chart generation 

    var chart = anychart.line();


    function getChartSubject(subj){
        var grade= new Array(4);

        for(var i = 0; i<4; i++){
            var item = document.getElementsByName(subj)[i].value;
            grade[i]=item;
        }

           // set the data

            var data = {
                header: ["Subject", "Grade"],
                rows: [   ["1st Quarter", grade[0]],
                          ["2nd Quarter", grade[1]],
                          ["3rd Quarter", grade[2]],
                          ["4th Quarter", grade[3]]
                    ]};

                chart.background().fill("white");

                //set yaxis range in chart
                chart.yScale().minimum(75);
                chart.yScale().maximum(100);

                // enable major grids
                    chart.xGrid().enabled(true);
                    chart.yGrid().enabled(true);
                // enable minor grids
                    chart.xMinorGrid().enabled(true);
                    chart.yMinorGrid().enabled(true);

                //transparent background
                    var background = chart.background();
                        background.stroke("3");
                        background.cornerType("round");
                        background.corners(10);
             
               // add the data
                    chart.data(data);
             
                // set the chart title
                 document.getElementById("title").innerHTML = "Performance in " + subj;
                   // chart.title(" Performance in " + subj);
             
                // draw
                    chart.container("container");
                    chart.draw();
                //end of drawchart section

               
    }//end of get Chart Subject Function


       function getChartOverAll(){
        var grade= new Array(4);

        for(var i = 0; i<4; i++){
            var item = document.getElementsByName('Final')[i].value;
            grade[i]=item;
        }

           // set the data

            var data = {
                header: ["Quarter", "Grade"],
                rows: [   ["1st Quarter", grade[0]],
                          ["2nd Quarter", grade[1]],
                          ["3rd Quarter", grade[2]],
                          ["4th Quarter", grade[3]]
                    ]};

                chart.background().fill("white");

                //set yaxis range in chart
                chart.yScale().minimum(75);
                chart.yScale().maximum(100);

                // enable major grids
                    chart.xGrid().enabled(true);
                    chart.yGrid().enabled(true);
                // enable minor grids
                    chart.xMinorGrid().enabled(true);
                    chart.yMinorGrid().enabled(true);

                //transparent background
                    var background = chart.background();
                        background.stroke("3");
                        background.cornerType("round");
                        background.corners(10);
             
               // add the data
                    chart.data(data);
             
                // set the chart title
                    document.getElementById("title").innerHTML = "Overall Performance";
                    //chart.title("Overall Performance ");
             
                // draw
                    chart.container("container");
                    chart.draw();
                //end of drawchart section

    }//end of get Chart Overall Function

    function getChartQuarter(quarter){
        var grade= new Array(8);
        var subject = new Array(8);
        subject = ["Filipino", "English", "Math","Science", "Araling Panlipunan", "Edukasyon sa Pagpapakatao", "Technology and Livelihood Education", "MAPEH"];
       // var subj = subject[6];
        var subj;
         //var item = document.getElementsByName(subj)[num].value;
           //item = subj;


        for(var i = 0; i<7; i++){  //change to 8  when MAPEH is added to database
            var str = subject[i] + quarter;
            var item = document.getElementById(str).value;
            grade[i]=item;
        }

  grade[7]=92;// PREDEFINED GRADE FOR MAPEH

           // set the data

            var data = {
                header: ["Subject", "Grade"],
                rows: [   ["Filipino", grade[0]],
                          ["English", grade[1]],
                          ["Math", grade[2]],
                          ["Science",grade[3]],
                          ["Aral Pan",grade[4]],
                          ["ESP",grade[5]],
                          ["TLE", grade[6]]
                          ,["MAPEH", grade[7]]
                    ]};

                chart.background().fill("white");

                //set yaxis range in chart
                chart.yScale().minimum(75);
                chart.yScale().maximum(100);

                // enable major grids
                    chart.xGrid().enabled(true);
                    chart.yGrid().enabled(true);
                // enable minor grids
                    chart.xMinorGrid().enabled(true);
                    chart.yMinorGrid().enabled(true);

                //transparent background
                    var background = chart.background();
                        background.stroke("3");
                        background.cornerType("round");
                        background.corners(10);
             
               // add the data
                    chart.data(data);

                //helper for Quarter Name display
                 var quarterName;
                 switch(quarter){
                    case 1:
                        quarterName = '1st';
                        break;
                    case 2:
                        quarterName = '2nd';
                        break;
                    case 3:
                        quarterName = '3rd';
                        break;
                    case 4:
                        quarterName = '4th';
                        break;

                 }

                  document.getElementById("title").innerHTML = quarterName + " Quarter Performance";
                // set the chart title
                 //   chart.title( quarterName + " Quarter Performance");
             
                // draw
                    chart.container("container");
                    chart.draw();
                //end of drawchart section

    }//end of get Chart Quarter Function
        
                    window.onload=getChartOverAll();
               

 </script>

</body>

<?php

mysqli_close($conn)

?> 
</html>