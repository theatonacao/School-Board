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
$index = 0;
$x = 0;

//connect to mysql
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

//mysql select query
$query1 = "SELECT student_info.*, student_year.*, student_health.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN INNER JOIN
student_health ON student_info.LRN = student_health.LRN WHERE Sex ='Male' AND Section = '$section'";

//result for method one
$result1 = mysqli_query($connect, $query1) or die(mysqli_error($connect));
//mysql select query
$query2 = "SELECT student_info.*, student_year.*, student_health.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN INNER JOIN
student_health ON student_info.LRN = student_health.LRN WHERE Sex ='Female' AND Section = '$section'";
//result for method one
$result2 = mysqli_query($connect, $query2) or die(mysqli_error($connect));

$query3 = "SELECT School_ID, School_name, Division, District, Region FROM school_info";
$result3 = mysqli_query($connect, $query3) or die(mysqli_error($connect));

while($data = mysqli_fetch_array($result3)){
    $schoolID = $data[0];
    $schoolname = $data[1];
    $division = $data[2];
    $district = $data[3];
    $region = $data[4];
}
?>


<body id="printarea">
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:5px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:5px 5px;word-break:normal;}
.tg .tg-l93j{border-color:inherit;font-size:16px;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-llyw{background-color:#c0c0c0;border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-lqy6{text-align:right;vertical-align:top}
.tg .tg-lvro{border-color:inherit;font-size:13px;font-weight:bold;text-align:center;vertical-align:middle}
.tg .tg-5iaf{border-color:inherit;font-size:10px;font-style:italic;text-align:center;vertical-align:top}
.tg .tg-znh0{border-color:inherit;font-size:13px;text-align:right;vertical-align:top}
.tg .tg-387r{border-color:inherit;font-size:13px;text-align:left;vertical-align:top}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-hysb{border-color:inherit;font-size:13px;text-align:center;vertical-align:middle}
.tg .tg-dvpl{border-color:inherit;text-align:right;vertical-align:top}
.tg .tg-y6fn{background-color:#c0c0c0;text-align:left;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}
.tg-sort-header::-moz-selection{background:0 0}
.tg-sort-header::selection{background:0 0}.tg-sort-header{cursor:pointer}
.tg-sort-header:after{content:'';float:right;margin-top:7px;border-width:0 5px 5px;border-style:solid;
  border-color:#404040 transparent;visibility:hidden}
.tg-sort-header:hover:after{visibility:visible}
.tg-sort-asc:after,.tg-sort-asc:hover:after,.tg-sort-desc:after{visibility:visible;opacity:.4}
.tg-sort-desc:after{border-bottom:none;border-width:5px 5px 0}</style>
<table id="tg-ctuvl" class="tg" style="undefined;table-layout: fixed; width: 1180px">
<colgroup>
<col style="width: 76px">
<col style="width: 124px">
<col style="width: 203px">
<col style="width: 106px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 86px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 101px">
<col style="width: 159px">
</colgroup>
<thead>
  <tr>
    <th class="tg-l93j" colspan="12">School Form 8 Learner's Basic Health and Nutrition Report (SF8) </th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-5iaf" colspan="12">(For All Grade Levels)</td>
  </tr>
  <tr>
    <td class="tg-znh0" colspan="2">School Name</td>
    <td class="tg-387r"><?php echo $schoolname;?></td>
    <td class="tg-znh0">District</td>
    <td class="tg-387r" colspan="2"><?php echo $district;?></td>
    <td class="tg-znh0" colspan="2">Division</td>
    <td class="tg-387r" colspan="2"><?php echo $division;?></td>
    <td class="tg-znh0">Region</td>
    <td class="tg-0pky"><?php echo $region;?></td>
  </tr>
  <tr>
    <td class="tg-znh0">School ID</td>
    <td class="tg-387r"><?php echo $schoolID;?></td>
    <td class="tg-znh0">Grade</td>
    <td class="tg-387r"><?php echo $year; ?></td>
    <td class="tg-znh0">Section</td>
    <td class="tg-387r" colspan="2"><?php echo $section; ?></td>
    <td class="tg-387r">Track/Strand</td>
    <td class="tg-387r" colspan="2"></td>
    <td class="tg-znh0">School Year</td>
    <td class="tg-0pky"></td>
  </tr>
  <tr>
    <td class="tg-hysb" rowspan="2">No.</td>
    <td class="tg-lvro" rowspan="2">LRN</td>
    <td class="tg-hysb" rowspan="2"><span style="font-weight:bold">Learner's Name</span><br>(Last Name, First Name, Name<br> Extension, Middle Name)</td>
    <td class="tg-hysb" rowspan="2"><span style="font-weight:bold">Birthdate</span><br>(MM/DD/YY)</td>
    <td class="tg-hysb" rowspan="2"><span style="font-weight:bold">Age</span></td>
    <td class="tg-hysb" rowspan="2"><span style="font-weight:bold">Weight</span><br>(kg)</td>
    <td class="tg-hysb" rowspan="2"><span style="font-weight:bold">Height</span><br>(m)</td>
    <td class="tg-hysb" rowspan="2"><span style="font-weight:bold">Height²</span> <br>(m²)</td>
    <td class="tg-lvro" colspan="2">Nutritional Status</td>
    <td class="tg-lvro" rowspan="2">Height for <br>Age (HFA)</td>
    <td class="tg-lvro" rowspan="2">Remarks</td>
  </tr>
  <tr>
    <td class="tg-hysb"><span style="font-weight:bold">BMI</span><br>(kg/m²)</td>
    <td class="tg-hysb"><span style="font-weight:bold">BMI</span><br>Category</td>
  </tr>
  <tr>
    <td class="tg-llyw" colspan="12">               &nbsp;&nbsp;&nbsp;&nbsp;MALE </td>
  </tr>

  <?php while($row1 = mysqli_fetch_array($result1)):;?>
            <tr>
                <td></td>
                <td><?php echo $row1[0];?></td>
                <td><?php echo $row1[1],", ",$row1[2],", ",$row1[3];?></td>
                <?php $dateOfBirth = $row1[6];
                $today = date("d-m-Y");
                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                ?>
                <td><?php echo $row1[6];?></td>
                <td><?php echo $diff->format('%y');?></td>
                <!-- Weight -->
                <td class="tg-0pky"><?php echo $row1[19];?></td>
                <!-- Height -->
                <td class="tg-0pky"><?php echo $row1[20];?></td>
                <!-- Height^2 -->
                <td class="tg-0pky">
                    <?php
                    $var1 = $row1[20];
                    $ans = $var1 * $var1;
                    echo $ans;
                    ?>
                </td>
                <!-- BMI -->
                <td class="tg-0pky"><?php echo $row1[21];?></td>
                <!-- BMI category -->
                <td class="tg-0pky"><?php echo $row1[22];?></td>
                <!-- HFA -->
                <td class="tg-0pky"></td>
                <!-- remarks -->
                <td class="tg-0pky"><?php echo $row1[23];?></td>
                <!-- <td class="tg-0pky"></td> -->
    <?php endwhile;?>   
  </tr>
  <tr>
    <td class="tg-y6fn" colspan="12">               &nbsp;&nbsp;&nbsp;&nbsp;FEMALE</td>
  </tr>
   <?php while($row2 = mysqli_fetch_array($result2)):;?>
            <tr>
                <td></td>
                <td><?php echo $row2[0];?></td>
                <td><?php echo $row2[1],", ",$row2[2],", ",$row2[3];?></td>
                <?php $dateOfBirth = $row2[6];
                $today = date("d-m-Y");
                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                ?>
                <td><?php echo $row2[6];?></td>
                <td><?php echo $diff->format('%y');?></td>
                <!-- Weight -->
                <td class="tg-0pky"><?php echo $row2[19];?></td>
                <!-- Height -->
                <td class="tg-0pky"><?php echo $row2[20];?></td>
                <!-- Height^2 -->
                <td class="tg-0pky">
                    <?php
                    $var2 = $row2[20];
                    $ans = $var2 * $var2;
                    echo $ans;
                    ?>
                </td>
                <!-- BMI -->
                <td class="tg-0pky"><?php echo $row2[21];?></td>
                <!-- BMI category -->
                <td class="tg-0pky"><?php echo $row2[22];?></td>
                <!-- HFA -->
                <td class="tg-0pky"></td>
                <!-- remarks -->
                <td class="tg-0pky"><?php echo $row2[23];?></td>
                <!-- <td class="tg-0pky"></td> -->
            <?php endwhile;?>   
  </tr>
</tbody>
</table>

<br>
<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:5px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:5px 5px;word-break:normal;}
.tg .tg-zv4m{border-color:#ffffff;text-align:left;vertical-align:top}
.tg .tg-5unb{border-color:#000000;font-size:16px;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-lvro{border-color:inherit;font-size:13px;font-weight:bold;text-align:center;vertical-align:middle}
.tg .tg-2k8k{border-color:inherit;font-size:13px;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-wrlh{font-size:13px;font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-vask{font-size:13px;text-align:left;vertical-align:top}
.tg-sort-header::-moz-selection{background:0 0}
.tg-sort-header::selection{background:0 0}.tg-sort-header{cursor:pointer}
.tg-sort-header:after{content:'';float:right;margin-top:7px;border-width:0 5px 5px;border-style:solid;
  border-color:#404040 transparent;visibility:hidden}
.tg-sort-header:hover:after{visibility:visible}
.tg-sort-asc:after,.tg-sort-asc:hover:after,.tg-sort-desc:after{visibility:visible;opacity:.4}
.tg-sort-desc:after{border-bottom:none;border-width:5px 5px 0}</style>
<table id="tg-Dyphw" class="tg" style="undefined;table-layout: fixed; width: 905px">
<colgroup>
<col style="width: 130px">
<col style="width: 78px">
<col style="width: 75px">
<col style="width: 65px">
<col style="width: 92px">
<col style="width: 65px">
<col style="width: 63px">
<col style="width: 77px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
<col style="width: 65px">
</colgroup>
<thead>
  <tr>
    <th class="tg-5unb" colspan="12">SUMMARY TABLE</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-lvro" rowspan="2">SEX</td>
    <td class="tg-2k8k" colspan="6">Nutritional Status</td>
    <td class="tg-2k8k" colspan="5">Height for Age (HFA)</td>
  </tr>
  <tr>
    <td class="tg-lvro">Severely<br>Wasted<br></td>
    <td class="tg-lvro">Wasted</td>
    <td class="tg-lvro">Normal</td>
    <td class="tg-lvro">Overweight</td>
    <td class="tg-lvro">Obese</td>
    <td class="tg-lvro">TOTAL</td>
    <td class="tg-lvro">Severely<br>Stunted<br></td>
    <td class="tg-lvro">Stunted</td>
    <td class="tg-lvro">Normal</td>
    <td class="tg-lvro">Tall</td>
    <td class="tg-lvro">Total</td>
  </tr>
  <tr>
    <td class="tg-wrlh">MALE</td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
  </tr>
  <tr>
    <td class="tg-wrlh">FEMALE</td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
  </tr>
  <tr>
    <td class="tg-wrlh">TOTAL</td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="12" rowspan="2">Date of Assessment:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Conducted/Assessed By:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Certified Correct By:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:<br><br>____________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></td>
  </tr>
  <tr>
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

<!--
<script type="text/javascript">
/*--This JavaScript method for Print command--*/
    function PrintDoc() {
        var toPrint = document.getElementById('printarea');
        var popupWin = window.open('', '_blank', 'width=350,height=150,location=no,left=200px');
        popupWin.document.open();
        popupWin.document.write('<html><title>::Preview::</title><link rel="stylesheet" type="text/css" href="print.css" /></head><body onload="window.print()">')
        popupWin.document.write(toPrint.innerHTML);
        popupWin.document.write('</html>');
        popupWin.document.close();
    }
/*--This JavaScript method for Print Preview command--*/
    function PrintPreview() {
        var toPrint = document.getElementById('printarea');
        var popupWin = window.open('', '_blank', 'width=350,height=150,location=no,left=200px');
        popupWin.document.open();
        popupWin.document.write('<html><title>::Print Preview::</title><link rel="stylesheet" type="text/css" href="Print.css" media="screen"/></head><body">')
        popupWin.document.write(toPrint.innerHTML);
        popupWin.document.write('</html>');
        popupWin.document.close();
    }
</script>-->
</html>