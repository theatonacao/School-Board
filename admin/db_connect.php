<?php
    
    $DB_SERVER = 'localhost';
    $DB_USERNAME = 'schoolBoard';
    $DB_PASSWORD = '54HPneK7CC9NLhj';
    $DB_NAME = 'schoolBoard_database';
/* Attempt to connect to MySQL database */
$link = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>