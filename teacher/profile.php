<!-- Select the user's account from our MySQL database and populate the account details. -->
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
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- include jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- include jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <title>School Board</title>
		<link href="style.css" rel="stylesheet" type= "text/css">
		<link rel="icon" href="images/SB-logo.png">
   </head>
<body>

  <div class="sidebar">
    <div class="logo-details">
      <i><img src="images/schoolboard_logo.png" width="30px" height="45px" alt="" style="margin-top:5px;" href="profile.php"></i>
      <span class="logo_name" href="profile.php" >SchoolBoard</span>
    </div>
      <ul class="nav-links">
        
        <li>
          <a href="profile.php" class="active">
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
        <span class="dashboard">Profile</span>
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
        <div class="recent-sales box" style="width:65%">
          <div class="title" style="text-align: center; font-weight: 800;">Basic Information</div><br>
          <div class="sales-details">
            <div class="details">
              <div class="formrow">
                    <div class="formcol1" style=" text-align: center" >
                       <img src="images/wonwoo.png" class="profilepic" style="width: 200px;height: 200px;" alt=""> <br>   
<!--                        <div class="overview-boxes">
                          <div class="box bttns" style="width:80%;">
                          <div class="right-side" style="cursor: pointer;background: none;color: inherit;border: none;padding: 0;font: inherit;outline: inherit;" onclick="window.location='';" >
                              <div class="box-topic" style="font-size: 13px;">Update Picture</div>
                          </div>
                          </div>
                      </div> -->
          
                    </div>
                    <div class="formcol2" style=" text-align: center;">
                      <table>
                <tr>
                  <td style="color: #ff8040; font-size: 20px; font-weight: 700;">&nbsp;&nbsp;Employee Number:</td>
                  <td style="font-weight: 600;"><?=$_SESSION['name']?></td>
                </tr>
                <tr>
                  <td style="color: #ff8040; font-size: 20px; font-weight: 700;">&nbsp;&nbsp;Password:</td>
                  <td style="font-weight: 600;"><?=$password?></td>
                </tr>
                <tr>
                  <td style="color: #ff8040; font-size: 20px; font-weight: 700;">&nbsp;&nbsp;Name:</td>
                  <td style="font-weight: 600;"><?=$firstname?> <?=$lastname?></td>
                </tr>
                <tr>
                  <td style="color: #ff8040; font-size: 20px; font-weight: 700;">&nbsp;&nbsp;Position:</td>
                  <td style="font-weight: 600;"><?=$position?></td>
                </tr>
                <tr>
                  <td style="color: #ff8040; font-size: 20px; font-weight: 700;">&nbsp;&nbsp;Advisory Section:</td>
                  <td style="font-weight: 600;"><?=$year?> - <?=$advisorysec?></td>
                </tr>
              </table>
                    </div>
              </div>
          
            	
            </div>
          </div>
 
        </div><!-- end sa basic info -->
        <div class="recent-sales box" style="width:35%">
          <div class="box" style="width:35%">
            <div class="right-side">
              <div id="Datepicker1"></div>
            </div>
          </div>
        </div>
            
      </div>
      
    </div>

      <div class="sales-boxes"></div>
       
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

$(function() {
        $("#Datepicker1").datepicker({
         numberOfMonths: 1
        }); 
      });

//calendar
!function() {

var today = moment();

function Calendar(selector, events) {
  this.el = document.querySelector(selector);
  this.events = events;
  this.current = moment().date(1);
  this.draw();
  var current = document.querySelector('.today');
  if(current) {
    var self = this;
    window.setTimeout(function() {
      self.openDay(current);
    }, 500);
  }
}

Calendar.prototype.draw = function() {
  //Create Header
  this.drawHeader();

  //Draw Month
  this.drawMonth();

  this.drawLegend();
}

Calendar.prototype.drawHeader = function() {
  var self = this;
  if(!this.header) {
    //Create the header elements
    this.header = createElement('div', 'header');
    this.header.className = 'header';

    this.title = createElement('h1');

    var right = createElement('div', 'right');
    right.addEventListener('click', function() { self.nextMonth(); });

    var left = createElement('div', 'left');
    left.addEventListener('click', function() { self.prevMonth(); });

    //Append the Elements
    this.header.appendChild(this.title); 
    this.header.appendChild(right);
    this.header.appendChild(left);
    this.el.appendChild(this.header);
  }

  this.title.innerHTML = this.current.format('MMMM YYYY');
}

Calendar.prototype.drawMonth = function() {
  var self = this;
  
  this.events.forEach(function(ev) {
   ev.date = self.current.clone().date(Math.random() * (29 - 1) + 1);
  });
  
  
  if(this.month) {
    this.oldMonth = this.month;
    this.oldMonth.className = 'month out ' + (self.next ? 'next' : 'prev');
    this.oldMonth.addEventListener('webkitAnimationEnd', function() {
      self.oldMonth.parentNode.removeChild(self.oldMonth);
      self.month = createElement('div', 'month');
      self.backFill();
      self.currentMonth();
      self.fowardFill();
      self.el.appendChild(self.month);
      window.setTimeout(function() {
        self.month.className = 'month in ' + (self.next ? 'next' : 'prev');
      }, 16);
    });
  } else {
      this.month = createElement('div', 'month');
      this.el.appendChild(this.month);
      this.backFill();
      this.currentMonth();
      this.fowardFill();
      this.month.className = 'month new';
  }
}

Calendar.prototype.backFill = function() {
  var clone = this.current.clone();
  var dayOfWeek = clone.day();

  if(!dayOfWeek) { return; }

  clone.subtract('days', dayOfWeek+1);

  for(var i = dayOfWeek; i > 0 ; i--) {
    this.drawDay(clone.add('days', 1));
  }
}

Calendar.prototype.fowardFill = function() {
  var clone = this.current.clone().add('months', 1).subtract('days', 1);
  var dayOfWeek = clone.day();

  if(dayOfWeek === 6) { return; }

  for(var i = dayOfWeek; i < 6 ; i++) {
    this.drawDay(clone.add('days', 1));
  }
}

Calendar.prototype.currentMonth = function() {
  var clone = this.current.clone();

  while(clone.month() === this.current.month()) {
    this.drawDay(clone);
    clone.add('days', 1);
  }
}

Calendar.prototype.getWeek = function(day) {
  if(!this.week || day.day() === 0) {
    this.week = createElement('div', 'week');
    this.month.appendChild(this.week);
  }
}

Calendar.prototype.drawDay = function(day) {
  var self = this;
  this.getWeek(day);

  //Outer Day
  var outer = createElement('div', this.getDayClass(day));
  outer.addEventListener('click', function() {
    self.openDay(this);
  });

  //Day Name
  var name = createElement('div', 'day-name', day.format('ddd'));

  //Day Number
  var number = createElement('div', 'day-number', day.format('DD'));


  //Events
  var events = createElement('div', 'day-events');
  this.drawEvents(day, events);

  outer.appendChild(name);
  outer.appendChild(number);
  outer.appendChild(events);
  this.week.appendChild(outer);
}

Calendar.prototype.drawEvents = function(day, element) {
  if(day.month() === this.current.month()) {
    var todaysEvents = this.events.reduce(function(memo, ev) {
      if(ev.date.isSame(day, 'day')) {
        memo.push(ev);
      }
      return memo;
    }, []);

    todaysEvents.forEach(function(ev) {
      var evSpan = createElement('span', ev.color);
      element.appendChild(evSpan);
    });
  }
}

Calendar.prototype.getDayClass = function(day) {
  classes = ['day'];
  if(day.month() !== this.current.month()) {
    classes.push('other');
  } else if (today.isSame(day, 'day')) {
    classes.push('today');
  }
  return classes.join(' ');
}

Calendar.prototype.openDay = function(el) {
  var details, arrow;
  var dayNumber = +el.querySelectorAll('.day-number')[0].innerText || +el.querySelectorAll('.day-number')[0].textContent;
  var day = this.current.clone().date(dayNumber);

  var currentOpened = document.querySelector('.details');

  //Check to see if there is an open detais box on the current row
  if(currentOpened && currentOpened.parentNode === el.parentNode) {
    details = currentOpened;
    arrow = document.querySelector('.arrow');
  } else {
    //Close the open events on differnt week row
    //currentOpened && currentOpened.parentNode.removeChild(currentOpened);
    if(currentOpened) {
      currentOpened.addEventListener('webkitAnimationEnd', function() {
        currentOpened.parentNode.removeChild(currentOpened);
      });
      currentOpened.addEventListener('oanimationend', function() {
        currentOpened.parentNode.removeChild(currentOpened);
      });
      currentOpened.addEventListener('msAnimationEnd', function() {
        currentOpened.parentNode.removeChild(currentOpened);
      });
      currentOpened.addEventListener('animationend', function() {
        currentOpened.parentNode.removeChild(currentOpened);
      });
      currentOpened.className = 'details out';
    }

    //Create the Details Container
    details = createElement('div', 'details in');

    //Create the arrow
    var arrow = createElement('div', 'arrow');

    //Create the event wrapper

    details.appendChild(arrow);
    el.parentNode.appendChild(details);
  }

  var todaysEvents = this.events.reduce(function(memo, ev) {
    if(ev.date.isSame(day, 'day')) {
      memo.push(ev);
    }
    return memo;
  }, []);

  this.renderEvents(todaysEvents, details);

  arrow.style.left = el.offsetLeft - el.parentNode.offsetLeft + 27 + 'px';
}

Calendar.prototype.renderEvents = function(events, ele) {
  //Remove any events in the current details element
  var currentWrapper = ele.querySelector('.events');
  var wrapper = createElement('div', 'events in' + (currentWrapper ? ' new' : ''));

  events.forEach(function(ev) {
    var div = createElement('div', 'event');
    var square = createElement('div', 'event-category ' + ev.color);
    var span = createElement('span', '', ev.eventName);

    div.appendChild(square);
    div.appendChild(span);
    wrapper.appendChild(div);
  });

  if(!events.length) {
    var div = createElement('div', 'event empty');
    var span = createElement('span', '', 'No Events');

    div.appendChild(span);
    wrapper.appendChild(div);
  }

  if(currentWrapper) {
    currentWrapper.className = 'events out';
    currentWrapper.addEventListener('webkitAnimationEnd', function() {
      currentWrapper.parentNode.removeChild(currentWrapper);
      ele.appendChild(wrapper);
    });
    currentWrapper.addEventListener('oanimationend', function() {
      currentWrapper.parentNode.removeChild(currentWrapper);
      ele.appendChild(wrapper);
    });
    currentWrapper.addEventListener('msAnimationEnd', function() {
      currentWrapper.parentNode.removeChild(currentWrapper);
      ele.appendChild(wrapper);
    });
    currentWrapper.addEventListener('animationend', function() {
      currentWrapper.parentNode.removeChild(currentWrapper);
      ele.appendChild(wrapper);
    });
  } else {
    ele.appendChild(wrapper);
  }
}

Calendar.prototype.drawLegend = function() {
  var legend = createElement('div', 'legend');
  var calendars = this.events.map(function(e) {
    return e.calendar + '|' + e.color;
  }).reduce(function(memo, e) {
    if(memo.indexOf(e) === -1) {
      memo.push(e);
    }
    return memo;
  }, []).forEach(function(e) {
    var parts = e.split('|');
    var entry = createElement('span', 'entry ' +  parts[1], parts[0]);
    legend.appendChild(entry);
  });
  this.el.appendChild(legend);
}

Calendar.prototype.nextMonth = function() {
  this.current.add('months', 1);
  this.next = true;
  this.draw();
}

Calendar.prototype.prevMonth = function() {
  this.current.subtract('months', 1);
  this.next = false;
  this.draw();
}

window.Calendar = Calendar;

function createElement(tagName, className, innerText) {
  var ele = document.createElement(tagName);
  if(className) {
    ele.className = className;
  }
  if(innerText) {
    ele.innderText = ele.textContent = innerText;
  }
  return ele;
}
}();

!function() {
var data = [
  { eventName: 'Lunch Meeting w/ Mark', calendar: 'Work', color: 'orange' },
  { eventName: 'Interview - Jr. Web Developer', calendar: 'Work', color: 'orange' },
  { eventName: 'Demo New App to the Board', calendar: 'Work', color: 'orange' },
  { eventName: 'Dinner w/ Marketing', calendar: 'Work', color: 'orange' },

  { eventName: 'Game vs Portalnd', calendar: 'Sports', color: 'blue' },
  { eventName: 'Game vs Houston', calendar: 'Sports', color: 'blue' },
  { eventName: 'Game vs Denver', calendar: 'Sports', color: 'blue' },
  { eventName: 'Game vs San Degio', calendar: 'Sports', color: 'blue' },

  { eventName: 'School Play', calendar: 'Kids', color: 'yellow' },
  { eventName: 'Parent/Teacher Conference', calendar: 'Kids', color: 'yellow' },
  { eventName: 'Pick up from Soccer Practice', calendar: 'Kids', color: 'yellow' },
  { eventName: 'Ice Cream Night', calendar: 'Kids', color: 'yellow' },

  { eventName: 'Free Tamale Night', calendar: 'Other', color: 'green' },
  { eventName: 'Bowling Team', calendar: 'Other', color: 'green' },
  { eventName: 'Teach Kids to Code', calendar: 'Other', color: 'green' },
  { eventName: 'Startup Weekend', calendar: 'Other', color: 'green' }
];



function addDate(ev) {
  
}

var calendar = new Calendar('#calendar', data);

}();

 </script>

</body>
</html>