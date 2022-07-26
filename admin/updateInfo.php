<?php

            require ('../config.php');
               $index = 1;
               $x = 0;

            $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            //echo 
            if (mysqli_connect_errno()) {
              exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }

            //IF CHANGE REQUEST CONFIRMED
            if(isset($_POST['submit'])){ 
               
                $LRN = $_POST["lrn"];
                
                $Height = $_POST["height"];
                $Weight = $_POST["weight"]; 

                $Street = $_POST["street"];
                $Barangay = $_POST["brgy"];
                $City = $_POST["city"];
                $Province = $_POST["province"];

                $Mobile = $_POST["mobileno"];
                $Email = $_POST["email"];
                $GAddress = $_POST["gaddress"];
                $GContact = $_POST["gcontact"];
                $ID = $_POST["requestNo"];

                $sql ="UPDATE student_health
                SET student_health.Weight = '$Weight', student_health.Height= '$Height'
                WHERE LRN = $LRN" ;

                if( $conn->query($sql)===TRUE){

                }


                $sql ="UPDATE student_contact
                SET student_contact.Street  = '$Street',student_contact.Barangay  = '$Barangay',student_contact.City  = '$City',student_contact.Province  = '$Province',student_contact.Email= '$Email', student_contact.Mobile_num = '$Mobile' WHERE student_contact.LRN = $LRN" ;

              if( $conn->query($sql)===TRUE){
                  
                }

                $sql ="UPDATE student_guardian_contact
                SET student_guardian_contact.Guardian_contact = '$GContact', student_guardian_contact.Guardian_address= '$GAddress'
                WHERE LRN = $LRN" ;

                if( $conn->query($sql)===TRUE){
                  
                }

                $sql ="UPDATE student_update
                SET student_update.reqStatus = 1 
                WHERE student_update.requestID = $ID" ;

                if( $conn->query($sql)===TRUE){

                }

            }
            else{
              //echo 'wala nasulod ';
             
            }
 mysqli_close($conn);
 header('Location: admin-requestLogs.php');
?>
 
