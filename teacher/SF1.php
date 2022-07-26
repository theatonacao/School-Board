<?php
// Start the session
session_start();
?>

<!DOCTYPE html>  
<html>
<head>
	<title>SF1</title>
	<style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg .tg-t6bd{border-color:#343434;font-size:11px;text-align:right;vertical-align:top}
        .tg .tg-p1nr{border-color:inherit;font-size:11px;text-align:left;vertical-align:top}
        .tg .tg-91w8{border-color:inherit;font-size:10px;text-align:center;vertical-align:top}
        .tg .tg-lm6i{border-color:inherit;font-size:11px;font-weight:bold;text-align:center;vertical-align:top}
        .tg .tg-jfoo{border-color:inherit;font-size:20px;font-weight:bold;text-align:center;vertical-align:top}
        .tg .tg-u2um{border-color:#343434;font-size:11px;text-align:center;vertical-align:top}
        .tg .tg-gzo9{border-color:inherit;font-size:11px;text-align:center;vertical-align:top}
        .tg .tg-7x02{border-color:inherit;font-size:11px;text-align:right;vertical-align:top}
        .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
        .tg .tg-dvpl{border-color:inherit;text-align:right;vertical-align:top}
        .tg .tg-0p48{border-color:inherit;font-size:11px;font-weight:bold;text-align:left;vertical-align:top}
        .tg .tg-0lax{text-align:left;vertical-align:top}

            <!--
      @media print {
      body { font-size: 10pt }
      }

     @media screen {
      body { font-size: 12pt }
     }
     @media screen, print {
      body { line-height: 1.2 }
     }
 
    </style>

    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          overflow:hidden;padding:0px 5px;word-break:normal;}
        .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          font-weight:normal;overflow:hidden;padding:0px 5px;word-break:normal;}
        .tg .tg-g5xs{font-size:11px;text-align:center;vertical-align:top}
        .tg .tg-ps66{font-size:11px;text-align:left;vertical-align:top}
        .tg .tg-obd9{font-size:11px;font-weight:bold;text-align:left;vertical-align:top}
        .tg .tg-xsvg{font-size:12px;font-weight:bold;text-align:left;vertical-align:top}
        .tg .tg-0lax{text-align:left;vertical-align:top}
        .tg .tg-b56p{font-size:11px;font-weight:bold;text-align:center;vertical-align:top}
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
$index = 1;
$x = 0;

//connect to mysql
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

//mysql select query
$query = "SELECT student_info.*, student_contact.*, student_guardian_info.*, student_guardian_contact.*, student_year.*  FROM student_info INNER JOIN student_contact ON student_info.LRN = student_contact.LRN INNER JOIN student_guardian_info ON student_info.LRN = student_guardian_info.LRN INNER JOIN student_guardian_contact ON student_info.LRN = student_guardian_contact.LRN INNER JOIN student_year ON student_info.LRN = student_year.LRN WHERE Section = '$section'";

//result for method one
$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

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

    	<table class="tg">

            <thead>
              <tr>
                <th class="tg-jfoo" colspan="18">School Form 1 (SF 1) School Register</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="tg-91w8" colspan="18">(This replaces Form 1, Master List &amp; STS Form2-Family Background and Profile</td>
              </tr>
              <tr>
                <td class="tg-p1nr"></td>
                <td class="tg-7x02">School ID</td>
                <td class="tg-gzo9" colspan="2"><?php echo $schoolID;?></td>
                <td class="tg-p1nr">Region</td>
                <td class="tg-gzo9" colspan="3"><?php echo $region;?></td>
                <td class="tg-t6bd">Division</td>
                <td class="tg-u2um" colspan="3"><?php echo $division;?></td>
                <td class="tg-0pky" colspan="6"></td>
              </tr>
              <tr>
                <td class="tg-p1nr"></td>
                <td class="tg-7x02">School Name</td>
                <td class="tg-gzo9" colspan="6"><?php echo $schoolname;?></td>
                <td class="tg-7x02">School Year</td>
                <td class="tg-p1nr"></td>
                <td class="tg-7x02">Grade Level</td>
                <td class="tg-0pky"><?php echo $year; ?></td>
                <td class="tg-0pky"></td>
                <td class="tg-dvpl">Section</td>
                <td class="tg-0pky" colspan="4"><?php echo $section; ?></td>
              </tr>
              <tr>
                <td class="tg-lm6i" rowspan="2"><br><br><br><br>LRN</td>
                <td class="tg-lm6i" rowspan="2"><br><br><br>NAME<br>(Last Name, First Name,<br>Middle Name)<br></td>
                <td class="tg-lm6i" rowspan="2"><br><br><br><br>Sex</td>
                <td class="tg-lm6i" rowspan="2"><br><br>BIRTH<br>DATE<br>(yyyy-mm-dd)<br></td>
                <td class="tg-lm6i" rowspan="2"><br><br>AGE<br>as of<br>1st<br>Friday<br>June<br></td>
                <td class="tg-0p48" rowspan="2">MOTHER<br>TONGUE<br>(Grade 1 <br>to 3<br>Only)<br></td>
                <td class="tg-lm6i" rowspan="2"><br><br><br>IP<br>(Ethnic<br>Group)<br></td>
                <td class="tg-lm6i" rowspan="2"><br><br><br><br>RELIGION</td>
                <td class="tg-lm6i" colspan="4"><br>ADDRESS</td>
                <td class="tg-lm6i" colspan="2"><br>PARENTS</td>
                <td class="tg-gzo9" colspan="2">GUARDIAN<br>(if Not Parent)<br></td>
                <td class="tg-0p48" rowspan="2">Contact<br>Number<br>of<br>Parent<br>or <br>Guardian<br></td>
                <td class="tg-0p48">REMARKS</td>
              </tr>
              <tr>
                <td class="tg-0p48">House/<br>Street/<br>Sitio/<br>Purok<br></td>
                <td class="tg-0p48"><br><br>Barangay</td>
                <td class="tg-0p48"><br><br>Municipality/<br>City<br></td>
                <td class="tg-0p48"><br><br>Province</td>
                <td class="tg-0p48"><br>Father's Name(Last Name,<br>First Name, Middle Name<br></td>
                <td class="tg-0p48"><br>Mother's Maiden Name(Last<br>Name, First Name, Middle Name)<br></td>
                <td class="tg-0p48"><br><br>Name</td>
                <td class="tg-0p48"><br><br>Relationship</td>
                <td class="tg-0p48">(Please<br>refer to<br>the legend<br>on last<br>page)<br></td>
              </tr>

            </tbody>

            <?php while($row1 = mysqli_fetch_array($result)):;?>
                <tr>
                    <td><?php echo $row1[0];?></td>
                    <td><?php echo $row1[1],", ",$row1[2],", ",$row1[3];?></td>
                    <td><?php echo $row1[5];?></td>
                    <?php $dateOfBirth = $row1[6];
                    $today = date("d-m-Y");
                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                    ?>
                    <td><?php echo $row1[6];?></td>
                    <td><?php echo $diff->format('%y');?></td>
                    <td><?php echo $row1[8];?></td>
                    <td><?php echo $row1[9];?></td>
                    <td><?php echo $row1[10];?></td>
                    <td><?php echo $row1[15];?></td>
                    <td><?php echo $row1[16];?></td>
                    <td><?php echo $row1[17];?></td>
                    <td><?php echo $row1[18];?></td>
                    <td><?php echo $row1[24];?></td>
                    <td><?php echo $row1[23];?></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td><?php echo $row1[28];?></td>
                    <td class="tg-0pky"></td>
                </tr>
                <?php endwhile;?>
        </table>



        <table class="tg">
        <thead>
          <tr>
            <th class="tg-xsvg" colspan="6">List and Code of Indicators under REMARKS column</th>
            <th class="tg-ps66"></th>
            <th class="tg-ps66"></th>
            <th class="tg-ps66"></th>
            <th class="tg-ps66"></th>
            <th class="tg-ps66"></th>
            <th class="tg-0lax"></th>
            <th class="tg-0lax"></th>
            <th class="tg-0lax"></th>
            <th class="tg-0lax"></th>
            <th class="tg-0lax"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="tg-obd9">Indicator</td>
            <td class="tg-obd9">Code</td>
            <td class="tg-obd9">Required Information</td>
            <td class="tg-obd9">Indicator<br></td>
            <td class="tg-obd9">Code</td>
            <td class="tg-obd9">Required Information</td>
            <td class="tg-ps66"></td>
            <td class="tg-b56p">REGISTERED</td>
            <td class="tg-obd9">BoSY</td>
            <td class="tg-obd9">EoSY</td>
            <td class="tg-ps66"></td>
            <td class="tg-obd9">Prepared by:</td>
            <td class="tg-obd9"></td>
            <td class="tg-obd9"></td>
            <td class="tg-obd9">Certified Correct:</td>
            <td class="tg-ps66"></td>
          </tr>
          <tr>
            <td class="tg-obd9" rowspan="3">Transfered Out<br><br><br>Transfered In<br><br><br>Dropped<br></td>
            <td class="tg-obd9" rowspan="3">T/O<br><br><br>T/I<br><br><br>DR<br></td>
            <td class="tg-obd9" rowspan="3">Name of Public (P) Private (PR)<br>School &amp; Effectivity Date<br><br>Name of Public (P) Private (PR)<br>School &amp; Effectivity Date<br><br>Reason and Effectivity Date<br>Reason (Enrollment beyond 1st Friday <br>of June<br></td>
            <td class="tg-obd9" rowspan="3">CCT Recepient<br><br>Balik Aral<br><br>Learner With<br>Disability<br><br>Accelerated<br></td>
            <td class="tg-obd9" rowspan="3">CCT<br><br>B/A<br><br>LWD<br><br><br>ACL<br></td>
            <td class="tg-obd9" rowspan="3">CCT Control/reference number &amp;<br>Effectivity Date<br><br>Name of School last attended &amp; year<br><br>Specify<br><br>Specify Level &amp; Effectivity Date<br></td>
            <td class="tg-ps66"></td>
            <td class="tg-b56p">MALE</td>
            <td class="tg-obd9"></td>
            <td class="tg-obd9"></td>
            <td class="tg-ps66"></td>
            <td class="tg-ps66" colspan="2"></td>
            <td class="tg-ps66"></td>
            <td class="tg-ps66" colspan="2"></td>
          </tr>
          <tr>
            <td class="tg-ps66"></td>
            <td class="tg-b56p">FEMALE</td>
            <td class="tg-obd9"></td>
            <td class="tg-obd9"></td>
            <td class="tg-ps66"></td>
            <td class="tg-g5xs" colspan="2">(Signature of Adviser over Printed Name)<br></td>
            <td class="tg-obd9"></td>
            <td class="tg-obd9" colspan="2">(Signature of School Head over<br>Printed Name)<br></td>
          </tr>
          <tr>
            <td class="tg-0lax"></td>
            <td class="tg-b56p">TOTAL</td>
            <td class="tg-obd9"></td>
            <td class="tg-obd9"></td>
            <td class="tg-ps66"></td>
            <td class="tg-obd9">BoSY Date:</td>
            <td class="tg-obd9">EoSY Date:</td>
            <td class="tg-ps66"></td>
            <td class="tg-obd9">BoSY Date:</td>
            <td class="tg-obd9">EoSY Date:</td>
          </tr>
          <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-ps66"></td>
            <td class="tg-ps66"></td>
            <td class="tg-ps66"></td>
            <td class="tg-ps66"></td>
            <td class="tg-ps66"></td>
          </tr>
          <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
          </tr>

          <tr>
                <!--<td>
                    <input type="button" value="Print" class="btn" onclick="PrintDoc()"/>
                </td>
                <td>
                    <input type="button" value="Print Preview" class="btn" onclick="PrintPreview()"/>
                </td>-->
                <td>
                        
                            <button class="btn" name="year" onclick="history.go(-1);" value=<?php echo $year; ?> > Back </button>
                        <!-- </form> -->
                </td>
          </tr>

        </tbody>
        </table>
        
    </body>
</html>
