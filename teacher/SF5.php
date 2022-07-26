<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
* {
  box-sizing: border-box;
}

.row {
  display: flex;
  margin-left:-5px;
  margin-right:-5px;
}

.column1 {
  flex: 50%;
  padding: 5px;
}

.column2{
    flex: 25%;
    padding: 5px;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:7px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:7px 5px;word-break:normal;}
.tg .tg-gzo9{border-color:inherit;font-size:11px;text-align:center;vertical-align:top}
.tg .tg-gmla{border-color:inherit;font-size:16px;text-align:center;vertical-align:top}
.tg .tg-lvro{border-color:inherit;font-size:13px;font-weight:bold;text-align:center;vertical-align:middle}
.tg .tg-387r{border-color:inherit;font-size:13px;text-align:left;vertical-align:top}
.tg .tg-znh0{border-color:inherit;font-size:13px;text-align:right;vertical-align:top}
.tg .tg-76qt{border-color:inherit;font-size:13px;text-align:center;vertical-align:top}
.tg .tg-hysb{border-color:inherit;font-size:13px;text-align:center;vertical-align:middle}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
</style>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Trebuchet MS, sans-serif;font-size:12px;
  overflow:hidden;padding:7px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Trebuchet MS, sans-serif;font-size:12px;
  font-weight:normal;overflow:hidden;padding:7px 5px;word-break:normal;}
.tg .tg-dovx{font-size:13px;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}
.tg .tg-vask{font-size:13px;text-align:left;vertical-align:top}
.tg .tg-wrlh{font-size:13px;font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-z1yq{font-size:13px;text-align:center;vertical-align:top}
</style>
</head>
<?php
//populate table from database
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


$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

//mysql select query
$query1 = "SELECT student_info.*, student_year.* FROM student_info INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Sex ='Male' AND Section = '$section'";

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

<h2 align="center">School Form 5 (SF 5) Report on Promotion and Level of Proficiency & Achievement</h2>
<p align="center">(This replaces Forms 18-E1, 18-E2, 18A and List of Graduates)</p>

<div class="row">
  <div class="column1">
    <table class="tg">
  <tr>
    <td class="tg-387r"></td>
    <td class="tg-znh0">Region</td>
    <td class="tg-387r"><?php echo $region;?></td>
    <td class="tg-387r">Division</td>
    <td class="tg-387r"><?php echo $division;?></td>
  </tr>
  <tr>
    <td class="tg-387r"></td>
    <td class="tg-znh0">School ID</td>
    <td class="tg-387r"><?php echo $schoolID;?></td>
    <td class="tg-387r">School Year</td>
    <td class="tg-387r"></td>
  </tr>
  <tr>
    <td class="tg-387r"></td>
    <td class="tg-znh0">School Name</td>
    <td class="tg-76qt" colspan="3"><?php echo $schoolname;?></td>
  </tr>
  <tr>
    <td class="tg-lvro" rowspan="3">LRN</td>
    <td class="tg-lvro" rowspan="3">LEARNER'S NAME<br>(Last Name, First Name, Middle Name)<br></td>
    <td class="tg-lvro" rowspan="3">GENERAL<br>AVERAGE<br></td>
    <td class="tg-lvro" rowspan="3">ACTION TAKEN:<br>PROMOTED,<br>CONDITIONAL or<br>RETAINED<br></td>
    <td class="tg-hysb" rowspan="3">Did not Meet<br>Expectations of the ff.<br>Learning Area/s as of<br>end of current<br>School Year<br></td>
  </tr>
  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
    <td class="tg-0pky">MALE</td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
  </tr>

  <?php while($row1 = mysqli_fetch_array($result1)):;?>
            <tr>
                <td><?php echo $row1[0];?></td>
                <td><?php echo $row1[1],", ",$row1[2],", ",$row1[3];?></td>

                <td>
                  <!-- Average grade -->
                  <?php
                  $sql9 = "SELECT * FROM grade_per_year WHERE grade_per_year.LRN = $row1[0] AND grade_per_year.Year_lvl = $year";
                  $ave1 = '';
                  $result9 = mysqli_query($connect, $sql9);
                  if (mysqli_num_rows($result9)==0) { 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result9->num_rows > 0){
                            while($row = $result9->fetch_assoc() ) 
                            {
                              $ave1= $row["Grade_ave"];
                              echo $ave1;
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                <td class="tg-0pky">
                  <?php
                  if(empty($ave1))
                  {

                  }
                  else
                  {
                    if($ave1 == 75)
                  echo "PROMOTED";
                else if($ave1 > 75)
                  echo "PROMOTED";
                else
                  echo "RETAINED";
                  }
                ?>
                </td>
                <td></td>
                
                  <!-- Promoted or not -->
                <!-- Promoted or not -->
                
                <td class="tg-0pky"></td>
<?php endwhile;?> 
                
                
            
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky">&lt;=== TOTAL MALE<br></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
  </tr>
  <tr>
    <td class="tg-0pky">FEMALE</td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
  </tr>
  <?php while($row2 = mysqli_fetch_array($result2)):;?>
            <tr>
                <td><?php echo $row2[0];?></td>
                <td><?php echo $row2[1],", ",$row2[2],", ",$row2[3];?></td>
               
                <td>
                  <!-- Average grade for women -->
                  <?php
                  $sql8 = "SELECT * FROM grade_per_year WHERE grade_per_year.LRN = $row2[0] AND grade_per_year.Year_lvl = $year";
                  $ave2 = '';
                  $result8 = mysqli_query($connect, $sql8);
                  if (mysqli_num_rows($result8)==0) { 
                        /*echo  $Music1;*/
                      }
                      else{
                          if($result8->num_rows > 0){
                            while($row2 = $result8->fetch_assoc() ) 
                            {
                              $ave2= $row2["Grade_ave"];
                              echo $ave2;
                             /*echo  $Music1;*/
                            }
                      }else{
                        echo ''; }
                    }
                  ?>
                </td>
                <!-- Promoted or not -->
                <td class="tg-0pky">
                  <?php
                  if(empty($ave2))
                  {

                  }
                  else
                  {
                    if($ave2 == 75)
                  echo "PROMOTED";
                else if($ave2 > 75)
                  echo "PROMOTED";
                else
                  echo "RETAINED";
                  }
                ?>
                </td>
                <td class="tg-0pky"></td>
                
 <?php endwhile;?>
                
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky">&lt;=== TOTAL FEMALE</td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
  </tr>
  <tr>
    <td class="tg-0pky"></td>
    <td class="tg-0pky">&lt;=== COMBINED</td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
    <td class="tg-0pky"></td>
  </tr>
</tbody>
</table>
  </div>
  <div class="column2">
    <table class="tg">
<tbody>
  <tr>
    <td class="tg-vask">Curriculum</td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
  </tr>
  <tr>
    <td class="tg-vask">Grade Level</td>
    <td class="tg-0pky"><?php echo $year; ?></td>
    <td class="tg-vask">Section</td>
    <td class="tg-0pky"><?php echo $section; ?></td>
  </tr>
  <tr>
    <td class="tg-dovx" colspan="4">SUMMARY TABLE<br></td>
  </tr>
  <tr>
    <td class="tg-wrlh">STATUS</td>
    <td class="tg-wrlh">MALE</td>
    <td class="tg-wrlh">FEMALE</td>
    <td class="tg-wrlh">TOTAL</td>
  </tr>
  <tr>
    <td class="tg-wrlh">PROMOTED</td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
  </tr>
  <tr>
    <td class="tg-wrlh">CONDITIONALLY<br>PROMOTED<br></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
  </tr>
  <tr>
    <td class="tg-wrlh">RETAINED</td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
    <td class="tg-vask"></td>
  </tr>
  <tr>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-dovx" colspan="4">LEVEL OF PROGRESS AND ACHIEVEMENT</td>
  </tr>
  <tr>
    <td class="tg-wrlh">Descriptor &amp;<br>Grading</td>
    <td class="tg-wrlh">MALE</td>
    <td class="tg-wrlh">FEMALE</td>
    <td class="tg-wrlh">TOTAL</td>
  </tr>
  <tr>
    <td class="tg-vask">Did Not Meet<br>Expectations (74<br>and below)<br></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-wrlh">Fairly<br>Satisfactory<br>(75-79)<br></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-wrlh">Satisfactory<br>(80-84)<br></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-wrlh">Very <br>Satisfactory<br>(85-89)<br></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-wrlh">Outstanding</td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-vask"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
    <td class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-vask" colspan="4">PREPARED BY:<br></td>
  </tr>
  <tr>
    <td class="tg-vask" colspan="4"></td>
  </tr>
  <tr>
    <td class="tg-z1yq" colspan="4">Class Adviser<br>(Name and Signature)<br></td>
  </tr>
  <tr>
    <td class="tg-vask" colspan="4">CERTIFIED CORRECT &amp; SUBMITTED BY:</td>
  </tr>
  <tr>
    <td class="tg-vask" colspan="4"></td>
  </tr>
  <tr>
    <td class="tg-z1yq" colspan="4">School Head<br>(Name and Signature)<br></td>
  </tr>
  <tr>
    <td class="tg-vask" colspan="4">REVIEWED BY:<br></td>
  </tr>
  <tr>
    <td class="tg-vask" colspan="4"></td>
  </tr>
  <tr>
    <td class="tg-z1yq" colspan="4">(Name &amp; Signature)</td>
  </tr>
</tbody>
</table>
  </div>
</div>
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
</body>
</html>
