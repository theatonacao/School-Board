<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="JScalendar/css/styles.css" />
    <link rel="stylesheet" href="JScalendar/src/calendarjs.css" />
    <script src="JScalendar/src/calendarjs.js"></script>
    <link rel="stylesheet" href="welcome_styles.css">
    <link rel = "icon" href =  "images/SB-logo.png"  type = "image/x-icon">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- include jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- include jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- for calendar-->
        
        
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i><img src="images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" ></i>
      <span class="logo_name">SchoolBoard</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="student_info.php">
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
    <?php
        
        $con=mysqli_connect("localhost","schoolBoard","54HPneK7CC9NLhj","schoolBoard_database");
          // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $query = "SELECT COUNT(Year_lvl) c  FROM student_year ;";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);
        $query2 = "SELECT COUNT(id) c  FROM teachers ;";
        $result2 = mysqli_query($con,$query2);
        $row2 = mysqli_fetch_assoc($result2);
        $query3 = "SELECT COUNT(LRN) c  FROM alumni_info ;";
        $result3 = mysqli_query($con,$query3);
        $row3 = mysqli_fetch_assoc($result3);
      echo '<div class="overview-boxes">
        <div class="box" style="width:32%">
          <div class="right-side">
            <div class="box-topic">Total Students</div>
            <div class="number">'. $row['c'] .'</div>';
            echo '
          </div>
          
          <i class="bx bxs-group cart"></i>
        </div>
        <div class="box" style="width:32%">
          <div class="right-side">
            <div class="box-topic">Total Teachers</div>
            <div class="number">'. $row2['c'] .'</div>
            
          </div>
          <i class="bx bx-chalkboard cart two" ></i>
        </div>';
        echo '<div class="box" style="width:32%">
          <div class="right-side">
            <div class="box-topic">Total Alumni</div>
            <div class="number">'. $row3['c'] .'</div>
            
          </div>
          <i class="bx bxs-graduation cart three" ></i>
        </div>
        
      </div>';?>
      
      <div class="sales-boxes">
        <div class="recent-sales box" style="width:71%; margin-top: 1px;margin-right: 10px" >
          <div id="myCalendar" >
          </div>
        </div>
        <div class="recent-sales box" style="width:34%">
            <div class="title"> <i class='bx bx-bell' ></i> &nbsp;Request Logs</div>
            <?php
             require ('../config.php');
               $index = 1;
               $x = 0;

            $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            //echo 
            if (mysqli_connect_errno()) {
              exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }

             $result = mysqli_query($conn, "SELECT student_update.requestID, student_update.LRN, student_info.Lastname, student_info.Firstname FROM student_update INNER JOIN student_info ON student_update.LRN = student_info.LRN WHERE student_update.reqStatus=0");



              $all_property= array();
                  if($result->num_rows > 0){
                      echo '<table class= "data-table" style="border-collapse: collapse; border-color:gray;">
                      <tr class = "data-heading">';
                  
                      while($x < 4){
                          $property= mysqli_fetch_field($result);
                          echo '<td><b>'.$property->name. '</b></td>';
                          array_push($all_property, $property->name );
                          $x = $x + 1;
                      }
                       //echo '<td>'.'Delete'. '</td>';
                      echo '<td><b>'.'View Request'. '</b></td>';
                      echo '</tr>';
                      while($row= mysqli_fetch_array($result)){
                          echo '<tr>';
                          foreach ($all_property as $item){
                              echo '<td>'.$row[$item].'</td>';
                          }
                      echo "<td><form id= \"$index\" method=\"post\" action=\"admin-viewRequests.php\">
                          <input name=\"requestID\" type=\"hidden\" value=\"$row[0]\">  
                          <input name=\"lrn\" type=\"hidden\" value=\"$row[1]\">  
                          <input name=\"submit\" type=\"submit\" value=\"View\"></form></td>";
                          echo '</tr>';
                      }   
                      echo '</tr>';
                      echo '</table>';
                  }
                  else{
                      echo '<br>'; 
                      echo "<h4>No pending requests as of this moment.</h4>";
                  }
                 
                 $conn->close();

          ?>
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


        var calendarInstance = new calendarJs( "myCalendar", { 
            exportEventsEnabled: true, 
            manualEditingEnabled: true, 
            showTimesInMainCalendarEvents: false,
            minimumDayHeight: 0,
            manualEditingEnabled: true,
            organizerName: "Your Name",
            organizerEmailAddress: "your@email.address",
            visibleDays: [ 0, 1, 2, 3, 4, 5, 6 ]
        } );

        document.title += " v" + calendarInstance.getVersion();
        document.getElementById( "header" ).innerText += " v" + calendarInstance.getVersion();

        calendarInstance.addEvents( getEvents() );

        function turnOnEventNotifications() {
            calendarInstance.setOptions( {
                eventNotificationsEnabled: true
            } );
        }

        function setEvents() {
            calendarInstance.setEvents( getEvents() );
        }

        function removeEvent() {
            calendarInstance.removeEvent( new Date(), "Test Title 2" );
        }

        function daysInMonth( year, month ) {
            return new Date( year, month + 1, 0 ).getDate();
        }

        function setOptions() {
            calendarInstance.setOptions( {
                minimumDayHeight: 70,
                manualEditingEnabled: false,
                exportEventsEnabled: false,
                showDayNumberOrdinals: false,
                fullScreenModeEnabled: false,
                maximumEventsPerDayDisplay: 0,
                showTimelineArrowOnFullDayView: false,
                maximumEventTitleLength: 10,
                maximumEventDescriptionLength: 10,
                maximumEventLocationLength: 10,
                maximumEventGroupLength: 10,
                showDayNamesInMainDisplay: false,
                tooltipsEnabled: true,
                visibleDays: [ 0, 1, 2, 3, 4 ],
                allowEventScrollingOnMainDisplay: true,
                showExtraMainDisplayToolbarButtons: false,
                hideEventsWithoutGroupAssigned: true,
                showHolidays: false,
                allowHtmlInDisplay: true
            } );
        }

        function setSearchOptions() {
            calendarInstance.setSearchOptions( {
                left: 10,
                top: 10
            } );
        }

        function onlyDotsDisplay() {
            calendarInstance.setOptions( {
                useOnlyDotEventsForMainDisplay: true
            } );
        }

        function setCurrentDisplayDate() {
            var newDate = new Date();
            newDate.setMonth( newDate.getMonth() + 3 );

            calendarInstance.setCurrentDisplayDate( newDate );
        }

        function getEvents() {
            var previousDay = new Date(),
                today9 = new Date(),
                today11 = new Date(),
                tomorrow = new Date(),
                firstDayInNextMonth = new Date(),
                lastDayInNextMonth = new Date(),
                today = new Date(),
                today3HoursAhead = new Date(),
                previousYear = new Date(),
                nextYear = new Date(),
                overlappingEvent1 = new Date(),
                overlappingEventTo1 = new Date(),
                overlappingEvent2 = new Date(),
                overlappingEventTo2 = new Date(),
                overlappingEvent3 = new Date(),
                overlappingEventTo3 = new Date(),
                overlappingEvent4 = new Date(),
                overlappingEventTo4 = new Date(),
                overlappingEvent5 = new Date(),
                overlappingEventTo5 = new Date();

            previousDay.setDate( previousDay.getDate() - 1 );
            today11.setHours( 11 );
            tomorrow.setDate( today11.getDate() + 1 );
            today9.setHours( 9 );

            firstDayInNextMonth.setDate( 1 );
            firstDayInNextMonth.setDate( firstDayInNextMonth.getDate() + daysInMonth( firstDayInNextMonth.getFullYear(), firstDayInNextMonth.getMonth() ) );

            lastDayInNextMonth.setDate( 1 );
            lastDayInNextMonth.setMonth( lastDayInNextMonth.getMonth() + 1 );
            lastDayInNextMonth.setDate( lastDayInNextMonth.getDate() + daysInMonth( lastDayInNextMonth.getFullYear(), lastDayInNextMonth.getMonth() ) - 1 );

            today.setHours( 21, 59, 0, 0 );
            today.setDate( today.getDate() + 3 );
            today3HoursAhead.setHours( 23, 59, 0, 0 );
            today3HoursAhead.setDate( today3HoursAhead.getDate() + 3 );

            previousYear.setFullYear( previousYear.getFullYear() - 1 );
            nextYear.setFullYear( nextYear.getFullYear() + 1 );

            overlappingEvent1.setDate( overlappingEvent1.getDate() - 3 );
            overlappingEventTo1.setDate( overlappingEventTo1.getDate() - 3 );
            overlappingEvent2.setDate( overlappingEvent2.getDate() - 3 );
            overlappingEventTo2.setDate( overlappingEventTo2.getDate() - 3 );
            overlappingEvent3.setDate( overlappingEvent3.getDate() - 3 );
            overlappingEventTo3.setDate( overlappingEventTo3.getDate() - 3 );
            overlappingEvent4.setDate( overlappingEvent4.getDate() - 3 );
            overlappingEventTo4.setDate( overlappingEventTo4.getDate() - 3 );
            overlappingEvent5.setDate( overlappingEvent5.getDate() - 3 );
            overlappingEventTo5.setDate( overlappingEventTo5.getDate() - 3 );
            overlappingEvent1.setHours( 0, 10, 0, 0 );
            overlappingEventTo1.setHours( 1, 10, 0, 0 );
            overlappingEvent2.setHours( 0, 35, 0, 0 );
            overlappingEventTo2.setHours( 1, 35, 0, 0 );
            overlappingEvent3.setHours( 1, 20, 0, 0 );
            overlappingEventTo3.setHours( 2, 20, 0, 0 );
            overlappingEvent4.setHours( 2, 0, 0, 0 );
            overlappingEventTo4.setHours( 3, 0, 0, 0 );
            overlappingEvent5.setHours( 3, 30, 0, 0 );
            overlappingEventTo5.setHours( 4, 40, 0, 0 );

            return [
                {
                    from: overlappingEvent1,
                    to: overlappingEventTo1,
                    title: "Overlapping Event 1",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    group: "Group 1"
                },
                {
                    from: overlappingEvent2,
                    to: overlappingEventTo2,
                    title: "Overlapping Event 2",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    group: "Group 1"
                },
                {
                    from: overlappingEvent3,
                    to: overlappingEventTo3,
                    title: "Overlapping Event 3",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    group: "Group 1"
                },
                {
                    from: overlappingEvent4,
                    to: overlappingEventTo4,
                    title: "Overlapping Event 4",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    group: "Group 1"
                },
                {
                    from: overlappingEvent5,
                    to: overlappingEventTo5,
                    title: "Overlapping Event 5",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    group: "Group 1"
                },
                {
                    from: previousYear,
                    to: previousYear,
                    title: "Previous Year",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    isAllDay: true,
                    group: "Group 2"
                },
                {
                    from: nextYear,
                    to: nextYear,
                    title: "Next Year",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    isAllDay: true,
                    group: "Group 2"
                },
                {
                    from: previousDay,
                    to: previousDay,
                    title: "Previous Day",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    isAllDay: true,
                    color: "#FF0000",
                    colorText: "#FFFF00",
                    colorBorder: "#00FF00",
                    repeatEvery: 5,
                    id: "1234-5678-9",
                    group: "Group 1"
                },
                {
                    from: today11,
                    to: tomorrow,
                    title: "Title 1",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    isAllDay: false,
                    group: "group 1"
                },
                {
                    from: tomorrow,
                    to: today11,
                    title: "Title Bad (should not show)",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    isAllDay: false,
                    group: "group 1"
                },
                {
                    from: today9,
                    to: today9,
                    title: "Title 2",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    isAllDay: true,
                    group: "Group 1",
                    url: "https://www.google.com/"
                },
                {
                    from: firstDayInNextMonth,
                    to: firstDayInNextMonth,
                    title: "First Day 1",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    isAllDay: true,
                    color: "#00FF00",
                    colorText: "#FF0000",
                    repeatEvery: 4
                },
                {
                    from: firstDayInNextMonth,
                    to: firstDayInNextMonth,
                    title: "First Day 2",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    isAllDay: true,
                    color: "#00FF00",
                    colorText: "#FF0000",
                    repeatEvery: 4
                },
                {
                    from: lastDayInNextMonth,
                    to: lastDayInNextMonth,
                    title: "Last Day 1",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    location: "Teams Meeting",
                    isAllDay: true,
                    color: "#0000FF",
                    repeatEvery: 2
                },
                {
                    from: today,
                    to: today3HoursAhead,
                    title: "Regular Event",
                    description: "This is a another <b>description</b> of the event that has been added, so it can be shown in the pop-up dialog.",
                    repeatEvery: 1,
                    repeatEveryExcludeDays: [ 6, 0 ],
                    repeatEnds: new Date( today.getFullYear() + 1, 0, 1 ),
                    group: "Group 1"
                }
            ];
        }

        function getCopiedEvent() {
            var today = new Date(),
                todayPlus1Hour = new Date();

            todayPlus1Hour.setHours( today.getHours() + 1 );

            return {
                from: today,
                to: todayPlus1Hour,
                title: "Copied Event",
                description: "This is a another description of the event that has been added, so it can be shown in the pop-up dialog.",
                group: "Group 1"
            }
        }

        function addNewHolidays() {
            var today = new Date();

            var holiday1 = {
                day: today.getDate(),
                month: today.getMonth() + 1,
                title: "Google Day",
                onClick: function() {
                    window.open( "https://www.google.com/", "_blank" );
                }
            };

            var holiday2 = {
                day: today.getDate(),
                month: today.getMonth() + 1,
                title: "Calendar.js Day",
                onClick: function() {
                    window.open( "https://github.com/williamtroup/Calendar.js", "_blank" );
                }
            };
            
            calendarInstance.addHolidays( [ holiday1, holiday2 ] );
        }

        function removeNewHolidays() {
            calendarInstance.removeHolidays( [ "Google Day", "Calendar.js Day" ] );
        }


 </script>

</body>
</html>

