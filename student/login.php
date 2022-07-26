
<!DOCTYPE html>
<html>
<?php 
session_start();
//connection info
    require ('../config.php');

    $ans=2;

// Check submitted data
if (isset($_POST['studentno'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	//exit('Please fill both the student number and password fields!');
						// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
					if ($stmt = $conn->prepare('SELECT Password FROM student_info WHERE LRN = ?')) {
						// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
						$stmt->bind_param('s', $_POST['studentno']);
						$stmt->execute();
						// Store the result so we can check if the account exists in the database.
						$stmt->store_result();
						$num=$stmt->num_rows;

						if ($num > 0) {
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
													$ans=1;
													header('Location: profile.php');
												
												}else {
												// Incorrect password
													
													$ans=3;
													//echo'<script> alert("Incorrect username and/or password!\n Try again.");</script>';
													
												}
							}else {
								// Incorrect username
								$ans=0;
							}
						$stmt->close();
					}
}
	
			

?>
<head>
	<title>Login As Student</title>
	<link rel="stylesheet" type="text/css" href="style_login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	
</head>
<body style="
	background:whitesmoke">
    <img class="wave" src="wave.png">


				<div class="container">

					
						<div class="img">
						<img src="bg.png">
						</div>
						<div class="login-content">
							<form name="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
							
								<img src="sblogo.png"  >
								<h2 class="title">WELCOME<br>
						<p style="font-size: 13px;color:Teal; text-align: center; margin-top:0px"><br> Please log in to your account</p></h2>
				           		<div class="input-div one">
				           		   <div class="i">
				           		   		<i class="fas fa-user"></i>
				           		   </div>
				           		   <div class="div">
				           		   		<h5>Student No</h5>
				           		   		<input type="text" name="studentno" required = "" class="input" id=stud>
				           		   </div>
				           		</div>
				           		<div class="input-div pass">
				           		   <div class="i"> 
				           		    	<i class="fas fa-lock"></i>
				           		   </div>
				           		   <div class="div">
				           		    	<h5>Password</h5>
				           		    	<input type="password" name="password"class="input" autocomplete="current-password" required="" id="id_password">  
				           		    	<div class="i" style="position: absolute; right: 25px;z-index: 1; top: 17px;"> 
				           		      <i class="far fa-eye" id="togglePassword" style=" cursor: pointer;color: #38d39f;"></i>
				           		      </div>  
				            	   </div>    	  
				            	</div>
				            	 <p id="pwerror" style="color: red; ">
				            	 	<?php 
				            	 	if($ans==0)
				            	 		{ echo "Student No. does not exist";
				            	 		$ans == 2;}
				            	 	else if ($ans==3){
				            	 		echo'<script> document.getElementById("pwerror").innerHTML = "Invalid password";</script>';
				            	 		$ans == 2;
				            	 		}
				            	  else if ($ans==2){
				            	 		//echo'<script> document.getElementById("pwerror").innerHTML = "HAHABOANG";</script>';
				            	  }
				            	 		?>
				            	 </p>
				            	
				            	<input type="submit" class="btn" value="Login">
				            </form>
				        </div>
							
					
					
			    </div>
<script type="text/javascript">


		const inputs = document.querySelectorAll(".input");


		function addcl(){
			let parent = this.parentNode.parentNode;
			parent.classList.add("focus");
		}

		function remcl(){
			let parent = this.parentNode.parentNode;
			if(this.value == ""){
				parent.classList.remove("focus");
			}
		}


		inputs.forEach(input => {
			input.addEventListener("focus", addcl);
			input.addEventListener("blur", remcl);
		});

const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');
 
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
		
</script>
</body>




</html>