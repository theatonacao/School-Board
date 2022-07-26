<?php
// Start the session
session_start();
?>

<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'schoolBoard';
$DATABASE_PASS = '54HPneK7CC9NLhj';
$DATABASE_NAME = 'schoolBoard_database';
$year = $_SESSION['year'];
$section = $_SESSION['advisorysec']; 
$index = 1;
$x = 0;

//connect to mysql
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

//mysql select query
$query1 = "SELECT student_info.*, student_year.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Sex ='Male' AND Section = '$section' ORDER BY Lastname";

//result for method one
$result1 = mysqli_query($connect, $query1) or die(mysqli_error($connect));
//mysql select query
$query2 = "SELECT student_info.*, student_year.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Sex ='Female' AND Section = '$section' ORDER BY Lastname";
//result for method one
$result2 = mysqli_query($connect, $query2) or die(mysqli_error($connect));

$query3 = "SELECT School_ID, School_name, Division, District, Region FROM school_info";
$result3 = mysqli_query($connect, $query3) or die(mysqli_error($connect));

while($data = mysqli_fetch_array($result3)){
    $schoolID = $data[0];
    $schoolname = $data[1];
    $division = $data[2];
    $region = $data[4];
}?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<body id="printarea">

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:8px 8px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:8px 8px;word-break:normal;}
.tg .tg-p1nr{border-color:inherit;font-size:11px;text-align:left;vertical-align:top}
.tg .tg-l93j{border-color:inherit;font-size:16px;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-u6id{border-color:inherit;font-size:12px;font-weight:bold;text-align:center;vertical-align:middle}
.tg .tg-gzo9{border-color:inherit;font-size:11px;text-align:center;vertical-align:top}
.tg .tg-znh0{border-color:inherit;font-size:13px;text-align:right;vertical-align:top}
.tg .tg-387r{border-color:inherit;font-size:13px;text-align:left;vertical-align:top}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-u9r8{border-color:inherit;font-size:12px;text-align:center;vertical-align:bottom}
.tg .tg-9o1m{border-color:inherit;font-size:12px;text-align:center;vertical-align:middle}
.tg .tg-1zvd{border-color:inherit;font-size:12px;font-weight:bold;text-align:left;vertical-align:middle}
.tg .tg-73a0{border-color:inherit;font-size:12px;text-align:left;vertical-align:top}
.tg .tg-ai0l{border-color:inherit;font-size:12px;font-weight:bold;text-align:center;vertical-align:top}
.tg-sort-header::-moz-selection{background:0 0}
.tg-sort-header::selection{background:0 0}.tg-sort-header{cursor:pointer}
.tg-sort-header:after{content:'';float:right;margin-top:7px;border-width:0 5px 5px;border-style:solid;
  border-color:#404040 transparent;visibility:hidden}
.tg-sort-header:hover:after{visibility:visible}
.tg-sort-asc:after,.tg-sort-asc:hover:after,.tg-sort-desc:after{visibility:visible;opacity:.4}
.tg-sort-desc:after{border-bottom:none;border-width:5px 5px 0}</style>
<table id="tg-d7Ifr" class="tg" style="undefined; width: 1250px;">
<colgroup>
<col style="width: 20px">
<col style="width: 313px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 35px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 61px">
<col style="width: 61px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
<col style="width: 33px">
</colgroup>
<thead>
  <tr>
    <th class="tg-l93j" colspan="39">School Form 2 (SF2) Daily Attendance Report of Learners</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-gzo9" colspan="39">(This replaces Form 1, Form 2 &amp; STS Form 4 - Absenteeism and Dropout Profile)</td>
  </tr>
  <tr>
    <td class="tg-znh0" colspan="2">School ID</td>
    <td class="tg-387r" colspan="3"><?php echo $schoolID; ?></td>
    <td class="tg-387r" colspan="3">School Year</td>
    <td class="tg-387r" colspan="4"></td>
    <td class="tg-znh0" colspan="14">Report for the Month of:</td>
    <td class="tg-0pky" colspan="3"></td>
    <td class="tg-0pky" colspan="10"></td>
  </tr>
  <tr>
    <td class="tg-znh0" colspan="2">Name of School</td>
    <td class="tg-387r" colspan="10"><?php echo $schoolname; ?></td>
    <td class="tg-znh0" colspan="14">Grade Level</td>
    <td class="tg-0pky" colspan="2"><?php echo $year; ?></td>
    <td class="tg-znh0" colspan="4">Section</td>
    <td class="tg-0pky" colspan="7"><?php echo $section; ?></td>
  </tr>
  <tr>
    <td class="tg-u6id" colspan="2" rowspan="3">LEARNER'S NAME<br>(Last Name, First Name, Middle Name)</td>
    <td class="tg-u9r8" colspan="25">(1st row for date)</td>
    <td class="tg-u6id" colspan="2" rowspan="2">Total for the <br>Month</td>
    <td class="tg-9o1m" colspan="10" rowspan="3"><span style="font-weight:bold">REMARKS</span> (If <span style="font-weight:bold">DROPPED OUT</span>, state reason, please refer to legend number 2<br>If <span style="font-weight:bold">TRANSFERRED IN/OUT</span>, write the name of school)</td>
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
  </tr>
  <tr>
    <td class="tg-1zvd">M</td>
    <td class="tg-1zvd">T</td>
    <td class="tg-1zvd">W</td>
    <td class="tg-1zvd">TH</td>
    <td class="tg-1zvd">F</td>
    <td class="tg-1zvd">M</td>
    <td class="tg-1zvd">T</td>
    <td class="tg-1zvd">W</td>
    <td class="tg-1zvd">TH</td>
    <td class="tg-1zvd">F</td>
    <td class="tg-1zvd">M</td>
    <td class="tg-1zvd">T</td>
    <td class="tg-1zvd">W</td>
    <td class="tg-1zvd">TH</td>
    <td class="tg-1zvd">F</td>
    <td class="tg-1zvd">M</td>
    <td class="tg-1zvd">T</td>
    <td class="tg-1zvd">W</td>
    <td class="tg-1zvd">TH</td>
    <td class="tg-1zvd">F</td>
    <td class="tg-1zvd">M</td>
    <td class="tg-1zvd">T</td>
    <td class="tg-1zvd">W</td>
    <td class="tg-1zvd">TH</td>
    <td class="tg-1zvd">F</td>
    <td class="tg-73a0">Absent</td>
    <td class="tg-73a0">Tardy</td>
  </tr>
  <?php while($row1 = mysqli_fetch_array($result1)):;?>
            <tr>
                <td></td>
                <td><?php echo $row1[1],", ",$row1[2],", ",$row1[3];?></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
   
    <td class="tg-0pky" colspan="10"></td>
            <?php endwhile;?>
    
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-u6id">MALE | TOTAL Per Day</td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky" colspan="10"></td>

  </tr>

    <?php while($row2 = mysqli_fetch_array($result2)):;?>
            <tr>
                <td></td>
                <td><?php echo $row2[1],", ",$row2[2],", ",$row2[3];?></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
   
    <td class="tg-0pky" colspan="10"></td>
            <?php endwhile;?>
    
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-ai0l">FEMALE | TOTAL Per Day</td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky" colspan="10"></td>
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-ai0l">Combined TOTAL PER DAY</td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky" colspan="10"></td>
  </tr>
  <tr>
    <td class="tg-p1nr" colspan="8"><span style="font-weight:bold">GUIDELINES:</span><br>1. The attendance shall be accomplished daily. Refer to the codes for checking learner's attendance.<br>2. Date shall be written in the column after Learner's Name.<br>3. To compute the following:<br><br>   a. Percentage of Enrollment=                                  <span style="text-decoration:underline">  Registered learners as end of the month </span> <br>                                                                                   Enrollment as of 1st friday of school year    X 100<br><br>   b. Average Daily Attendance=                               <span style="text-decoration:underline">                Total Daily Attendance                </span><br>                                                                                  Number of School days in reporting month      X 100<br><br>   c. Percentage of Attendance for the month=          <span style="text-decoration:underline">              Average Daily Attendance        </span><br>                                                                                    Registered learners as end of the month     X 100<br><br>4. Every end of the month, the class adviser will submit this form to the office of the principal for the recording of summary table for into School Form 4. Once signed by the principal, this form shall be return to the adviser.<br><br><br></td>
    <td class="tg-p1nr" colspan="8"><span style="font-weight:bold">1. CODES FOR CHECKING ATTENDANCE</span><br>(blank)-Present; (x)-Absent; Tardy (half shaded= upper left for late commer, lower for cutting classes<br><br><span style="font-weight:bold">2. REASONS/CAUSES FOR DROPPING OUT</span><br><span style="font-weight:bold">a. Domestic-Related Factors</span><br>a.1. Had to take care of siblings<br>a.2. Early marriage/pregnancy<br>a.3. Parents' attitude towards schooling<br>a.4. Family problems<br><span style="font-weight:bold">b. Individual-Related Factors</span><br>b.1 Illness<br>b.2 Overage<br>b.3. Death<br>b.4. Drug abuse<br>b.5. Poor academic performance<br>b.6. Lack of interest/distractions<br>b.7. Hunger/Malnutrition<br><span style="font-weight:bold">c. School-Related Factors</span><br>c.1. Teacher Factor<br>c.2. Physical condition of classroom<br>c.3. Peer influence<br><span style="font-weight:bold">d. Geographic/Environmental</span><br>d.1. Distance between home and school<br>d.2. Armed conflict (incl tribal wars and clanfeuds)<br>d.3. Calamities/DIsasters<br><span style="font-weight:bold">e. Financial Related</span><br>e.1. Child labo, work<br><span style="font-weight:bold">f.Others (Specify</span><br></td>
    <td class="tg-73a0" colspan="23"><br><br><br><br><br><br><br><br><br><br><br><br><br><br>           I certify that this is a true and correct report<br><br><br>                                                                                _____________________________________<br>                                                                                    (Signature of Teacher over Printed Name)<br><br>           Attested by:<br><br>                                                                                _____________________________________<br>                                                                                 (Signature of School Head over Printed Name)<br></td>
  </tr>
</tbody>
</table>
</body>
<!--<input type="button" value="Print" class="btn" onclick="PrintDoc()"/>
<input type="button" value="Print Preview" class="btn" onclick="PrintPreview()"/>-->

<!-- <form method="post" action="Class_form_options">
   <input hidden="" name="section" value=<?php  $section; ?>> -->
   <button class="btn" name="year" onclick="history.go(-1);" value=<?php echo $year; ?>> Back </button>
<!-- </form> -->


</html>