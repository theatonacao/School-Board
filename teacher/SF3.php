<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<?php

/*$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'schoolBoard_database';*/

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
$query1 = "SELECT student_info.*, student_year.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Sex ='Male' AND Section = '$section'";

//result for method one
$result1 = mysqli_query($connect, $query1) or die(mysqli_error($connect));
//mysql select query
$query2 = "SELECT student_info.*, student_year.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Sex ='Female' AND Section = '$section'";
//result for method one
$result2 = mysqli_query($connect, $query2) or die(mysqli_error($connect));

$query3 = "SELECT School_ID, School_name, Division, District, Region FROM school_info";
$result3 = mysqli_query($connect, $query3) or die(mysqli_error($connect));

while($data = mysqli_fetch_array($result3)){
    $schoolID = $data[0];
    $schoolname = $data[1];
    $division = $data[2];
    $region = $data[4];
}
?>

<body id="printarea">
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Trebuchet MS, sans-serif;font-size:13px;
  overflow:hidden;padding:4px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Trebuchet MS, sans-serif;font-size:13px;
  font-weight:normal;overflow:hidden;padding:4px 5px;word-break:normal;}
.tg .tg-9wq8{border-color:inherit;text-align:center;vertical-align:middle}
.tg .tg-dj8h{font-size:11px;font-style:italic;text-align:center;vertical-align:middle}
.tg .tg-p1nr{border-color:inherit;font-size:11px;text-align:left;vertical-align:top}
.tg .tg-qkex{font-size:13px;text-align:right;vertical-align:top}
.tg .tg-qv16{font-size:16px;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-u6id{border-color:inherit;font-size:12px;font-weight:bold;text-align:center;vertical-align:middle}
.tg .tg-lqy6{text-align:right;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}
.tg .tg-znh0{border-color:inherit;font-size:13px;text-align:right;vertical-align:top}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-73a0{border-color:inherit;font-size:12px;text-align:left;vertical-align:top}
.tg .tg-f4iu{border-color:inherit;font-size:12px;text-align:center;vertical-align:top}
.tg .tg-9o1m{border-color:inherit;font-size:12px;text-align:center;vertical-align:middle}
.tg-sort-header::-moz-selection{background:0 0}
.tg-sort-header::selection{background:0 0}.tg-sort-header{cursor:pointer}
.tg-sort-header:after{content:'';float:right;margin-top:7px;border-width:0 5px 5px;border-style:solid;
  border-color:#404040 transparent;visibility:hidden}
.tg-sort-header:hover:after{visibility:visible}
.tg-sort-asc:after,.tg-sort-asc:hover:after,.tg-sort-desc:after{visibility:visible;opacity:.4}
.tg-sort-desc:after{border-bottom:none;border-width:5px 5px 0}</style>
<table id="tg-us4Lm" class="tg" style="undefined; width: 1250px; height: 400px;">
<colgroup>
<col style="width: 1px">
<col style="width: 35px">
<col style="width: 263px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 163px">
</colgroup>
<thead>
  <tr>
    <th class="tg-0lax"></th>
    <th class="tg-qv16" colspan="19">School Form 3 (SF3) Books Issued and Returned</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-0lax"></td>
    <td class="tg-dj8h" colspan="19">(This replaces Form 1 &amp; Inventory of Textbooks)</td>
  </tr>
  <tr>
    <td class="tg-znh0">School ID</td>
    <td class="tg-lqy6" colspan="2">School ID</td>
    <td class="tg-0pky" colspan="5"><?php echo $schoolID; ?></td>
    <td class="tg-znh0" colspan="2">School Year</td>
    <td class="tg-0pky" colspan="10"></td>
  </tr>
  <tr>
    <td class="tg-znh0">School Name</td>
    <td class="tg-qkex" colspan="2">School Name</td>
    <td class="tg-0pky" colspan="5"><?php echo $schoolname; ?></td>
    <td class="tg-znh0" colspan="3">Grade Level</td>
    <td class="tg-0pky" colspan="3"><?php echo $year; ?></td>
    <td class="tg-znh0" colspan="2">Section</td>
    <td class="tg-0pky" colspan="4"><?php echo $section; ?></td>
  </tr>
  <tr>
    <td class="tg-73a0">NO.</td>
    <td class="tg-0lax">No</td>
    <td class="tg-u6id">LEARNER'S NAME<br>(Last Name, First Name, Middle Name)</td>
    <td class="tg-f4iu" colspan="2">Subject Area &amp; Title</td>
    <td class="tg-73a0" colspan="2">Subject Area &amp; Title<br></td>
    <td class="tg-73a0" colspan="2">Subject Area &amp; Title<br></td>
    <td class="tg-73a0" colspan="2">Subject Area &amp; Title<br></td>
    <td class="tg-73a0" colspan="2">Subject Area &amp; Title<br></td>
    <td class="tg-73a0" colspan="2">Subject Area &amp; Title<br></td>
    <td class="tg-73a0" colspan="2">Subject Area &amp; Title<br></td>
    <td class="tg-73a0" colspan="2">Subject Area &amp; Title<br></td>
    <td class="tg-9o1m" rowspan="3">REMARKS/ACTION TAKEN<br>(Please Refer to the legend <br>below)</td>
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0pky"></td>
    <td class="tg-f4iu" colspan="2">Date</td>
    <td class="tg-f4iu" colspan="2">Date</td>
    <td class="tg-f4iu" colspan="2">Date</td>
    <td class="tg-f4iu" colspan="2">Date</td>
    <td class="tg-f4iu" colspan="2">Date</td>
    <td class="tg-f4iu" colspan="2">Date</td>
    <td class="tg-f4iu" colspan="2">Date</td>
    <td class="tg-f4iu" colspan="2">Date</td>
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0pky"></td>
    <td class="tg-f4iu">Issued</td>
    <td class="tg-f4iu">Returned</td>
    <td class="tg-f4iu">Issued</td>
    <td class="tg-f4iu">Returned</td>
    <td class="tg-f4iu">Issued</td>
    <td class="tg-f4iu">Returned<br></td>
    <td class="tg-f4iu">Issued</td>
    <td class="tg-f4iu">Returned</td>
    <td class="tg-f4iu">Issued</td>
    <td class="tg-f4iu">Returned</td>
    <td class="tg-f4iu">Issued</td>
    <td class="tg-f4iu">Returned</td>
    <td class="tg-f4iu">Issued</td>
    <td class="tg-f4iu">Returned</td>
    <td class="tg-f4iu">Issued</td>
    <td class="tg-f4iu">Returned</td>
  </tr>
  <?php while($row1 = mysqli_fetch_array($result1)):;?>
            <tr>
                <td></td>
                <td></td>
                <td><?php echo $row1[1],", ",$row1[2],", ",$row1[3];?></td>
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
                <td class="tg-9wq8"></td>
                
            <?php endwhile;?>
   
    
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0lax"></td>
    <td class="tg-73a0">&lt;- TOTAL FOR MALE | TOTAL COPIES -&gt;</td>
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
    <td class="tg-9wq8"></td>
  </tr>
  <?php while($row2 = mysqli_fetch_array($result2)):;?>
            <tr>
                <td></td>
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
                <td class="tg-9wq8"></td>
             <?php endwhile;?>      
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0lax"></td>
    <td class="tg-73a0">&lt;- TOTAL FOR FEMALE | TOTAL COPIES -&gt;</td>
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
    <td class="tg-9wq8"></td>
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0lax"></td>
    <td class="tg-73a0">&lt;- TOTAL LEARNERS | TOTAL COPIES -&gt;</td>
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
    <td class="tg-9wq8"></td>
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0lax"></td>
    <td class="tg-p1nr" colspan="5"><span style="font-weight:bold">GUIDELINES:</span><br><br>1. Title of books issued to each learner must be recorded by the class adviser.<br>2. The date of issuance and the date of return shall be reflected in the form.<br>3. The total number of copies issued at BoSY shall be reflected in the form.<br>4. The total number of books returned at EoSy shall be reflected in the form.<br>5. All textbooks being used must be included. Additional copies of this form may be used if needed.<br><br></td>
    <td class="tg-p1nr" colspan="9"><span style="font-weight:bold">In cased of lost/unreturned books, please provide information with the following code: </span><br><br><br><span style="font-weight:bold">A</span>. In column<span style="text-decoration:underline"> Date Returned</span>, codes are: <span style="font-weight:bold">FM</span>=Force Majeure, <span style="font-weight:bold">TDO</span>=Transferred/Dropout, <span style="font-weight:bold">NEG</span>=Negligence <br><span style="font-weight:bold">B</span>. In column <span style="text-decoration:underline">Remark/Action Taken</span>, codes are: <span style="font-weight:bold">LLTR</span>= Secured letter from Learner duly signed by parent/guardian<br>(for code FM), <span style="font-weight:bold">TLTR</span>= Teacherprepared letter/report duly noted by School head for submission to School property <br>custodian(for code TDO), <span style="font-weight:bold">PTL</span>= Paid by the Learner(for code NEG),</td>
    <td class="tg-p1nr" colspan="4"><span style="font-weight:bold">Prepared By:</span><br><br>___________________________________<br>          (Signature over Printed Name)<br><br>Date BoSY:_____________ Date EoSY:___________<br></td>
  </tr>
</tbody>
</table>


<!--<input type="button" value="Print" class="btn" onclick="PrintDoc()"/>
<input type="button" value="Print Preview" class="btn" onclick="PrintPreview()"/>-->

<!-- <form method="post" action="Class_form_options">
   <input hidden="" name="section" value=<?php  $section; ?>> -->
   <button class="btn" name="year" onclick="history.go(-1);" value=<?php echo $year; ?>> Back </button>
<!-- </form> -->






</body>
</html>