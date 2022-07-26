<?php
    
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'schoolBoard';
    $DATABASE_PASS = '54HPneK7CC9NLhj';
    $DATABASE_NAME = 'schoolBoard_database';

    //connect to the database
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

?>