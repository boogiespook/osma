<?php
session_start();

if(!isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}

include 'dbconnect.php';
connectDB();

//set validation error flag as false
$error = false;

//check all details
if (isset($_POST['signup'])) {
	$email = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['email']);
	$password = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['password']);
	$npassword = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['npassword']);
	$cnpassword = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cnpassword']);
	//name can contain only alpha characters and space
#	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
#		$error = true;
#		$name_error = "Name must contain only alphabets and space";
#	}
#	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
#		$error = true;
#		$email_error = "Please Enter Valid Email ID";
#	}
	if(strlen($npassword) < 6) {
		$error = true;
		$npassword_error = "Password must be minimum of 6 characters";
	}
	
	if($npassword != $cnpassword) {
		$error = true;
		$errormsg = "New Passwords Don't match";
	}

	if (!$error) {
## Check the user exists and the current passwords match
$chk = "SELECT password FROM users WHERE email = '$email'";	
	if(mysqli_query($GLOBALS["___mysqli_ston"], $chk)) {
		## User exists
		## Check password
		$res = mysqli_query($GLOBALS["___mysqli_ston"], $chk);
		$row = mysqli_fetch_assoc($res);
		if ($row['password'] == md5($password)) {
			## Matches - update with new password
			$update = "UPDATE users set password=MD5('$npassword') WHERE email='$email'";
			if (mysqli_query($GLOBALS["___mysqli_ston"], $update)) {
				$successmsg = "Password Successfully Changed! <a href='login.php'>Click here to Login</a>";
				} else {
				$errormsg = "Something went wrong." . mysqli_error($GLOBALS["___mysqli_ston"]);		
				}
			} else {
			$errormsg = "Incorrect Username or Password";		
			}
		} else {
		## User doesn't exist
		$errormsg = "User $email doesn't exist.";
		}

}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>RTI User Admin</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- add header -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><img src="images/innovate.png">  Ready to Innovate?</a>
		</div>
		<!-- menu items -->
		<div class="collapse navbar-collapse" id="navbar1">
		</div>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>User Admin</legend>
					
					<div class="form-group">
						<label for="name">Username</label>
						<input type="text" name="email" placeholder="Username" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Current Password</label>
						<input type="password" name="password" placeholder="Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">New Password</label>
						<input type="password" name="npassword" placeholder="New Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($npassword_error)) echo $npassword_error; ?></span>
					</div>


					<div class="form-group">
						<label for="name">Confirm New Password</label>
						<input type="password" name="cnpassword" placeholder="Confirm New Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($cnpassword_error)) echo $cnpassword_error; ?></span>
					</div>

					<div class="form-group">
						<input type="submit" name="signup" value="Update Password" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		
		</div>
	</div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



