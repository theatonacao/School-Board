<!-- Authenticate users, connect to the database, validate form data, retrieve database results, and create new sessions. -->
<?php 
session_start();
//connection info
    require ('../config.php');

?>
<html>
	<head>
		<title>School Board</title>
		<link href="style.css" rel="stylesheet" type= "text/css">
		<link rel="icon" href="SB-logo.png">
	</head>
	
	<body>
	</body>


<?php

// Check submitted data
if ( !isset($_POST['studentno'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	//exit('Please fill both the student number and password fields!');
	exit ('<script> alert("Please fill both the student number and password fields.");</script>');
}


// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT Password FROM student_info WHERE LRN = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['studentno']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
	$stmt->bind_result($Password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	// if ($_POST['password'] === $password) {
	if ($_POST['password'] === $Password) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['LRN'] = $_POST['studentno'];
		// echo 'Welcome ' . $_SESSION['name'] . '!';
		header('Location: profile.php');
	} else {
		// Incorrect password
		echo'<script> alert("Incorrect username and/or password!\n Try again."); history.go(-1);</script>';
	}
	} else {
		// Incorrect username
		echo'<script> alert("Incorrect username and/or password!\n Try again."); history.go(-1);</script>';

	}


	$stmt->close();
}

?>
</html>
