<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "db_connect.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    //echo "Invalid username or password.";
                    $login_err = "Invalid username or password.";
                }
            } else{
                $login_err = "Oops! Something went wrong. Please try again later.";
                //echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login Form</title>
	<link rel="stylesheet" type="text/css" href="style_login.css">
	<link rel = "icon" href =  "images/SB-logo.png"  type = "image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
	<style type="text/css">
		.loginform{
			width: 800px;
			height: 450px;
			background-color:GhostWhite;	
			border-radius:60px; 
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) ;
		}

	</style>

</head>
<body style="
	background:whitesmoke">
    <img class="wave" src="wave.png">
    
    <div class="container">

					
						<div class="img">
						<img src="bg.png">
						</div>
						<div class="login-content">
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="login">
								<img src="sblogo.png"  >
								<h2 class="title">WELCOME<br>
						<p style="font-size: 13px;color:Teal; text-align: center; margin-top:0px"><br> Please log in to your account</p></h2>
						        <?php
                        if(!empty($login_err)){
                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }
                        ?>
				           		<div class="input-div one">
				           		   <div class="i">
				           		   		<i class="fas fa-user"></i>
				           		   </div>
				           		   <div class="div">
				           		   		<h5>Username</h5>
				           		   		<input type="text" name="username" class=" form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                        
				           		   </div>
				           		   <span class="invalid-feedback"><?php echo $username_err; ?></span>
				           		</div>
				           		<div class="input-div pass">
				           		   <div class="i"> 
				           		    	<i class="fas fa-lock"></i>
				           		   </div>
				           		   <div class="div">
				           		    	<h5>Password</h5>
				           		    	<input type="password" name="password" class=" form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
        
				            	   </div>
				            	   <span class="invalid-feedback"><?php echo $password_err; ?></span>
				            	</div>
				            	
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
</script>
</body>


</html>
    
     