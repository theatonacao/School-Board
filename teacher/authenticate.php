<!-- Authenticate users, connect to the database, validate form data, retrieve database results, and create new sessions. -->
<?php 
session_start();
//connection info
/*$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'schoolBoard_database';*/

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'schoolBoard';
$DATABASE_PASS = '54HPneK7CC9NLhj';
$DATABASE_NAME = 'schoolBoard_database';

//connect to the database
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check submitted data
if ( !isset($_POST['employeenum'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the employee number and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password, year, advisorysec FROM teachers WHERE employeenum = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['employeenum']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password, $year, $advisorysec);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	// if ($_POST['password'] === $password) {
	if ($_POST['password'] === $password) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['employeenum'];
		$_SESSION['id'] = $id;
		$_SESSION['year'] = $year;
		$_SESSION['advisorysec'] = $advisorysec;
		// echo 'Welcome ' . $_SESSION['name'] . '!';
		header('Location: profile.php');
	} else {
		// Incorrect password
		$login_err = "Invalid username or password.";
		//echo 'Incorrect username and/or password!';
		echo '<script>alert("Incorrect Login Credentials")</script>';
		header('Location: index.html');
	}
	} else {
		// Incorrect username
		//echo 'Incorrect username and/or password!';
		$login_err = "Oops! Something went wrong. Please try again later.";
		echo '<script>alert("Incorrect Login Credentials")</script>';
		header('Location: index.html');
		
	}


	$stmt->close();
}

?>