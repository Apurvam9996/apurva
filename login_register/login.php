<?php
	if(isset($_SESSION)){
		header("Location: login.html");		
	}
	else{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		  //for login using email and password
		  if (isset($_POST['login-submit'])) {
		    	$email = $_POST["email"];
		    	$password = $_POST["password"];
		    	if (empty($email)){
				    $message = "Email is required";
				}
			elseif (empty($password)){
				    $message = "Password is required";
				}
			else{
					include "database.php";
					$sql = "SELECT email,name FROM login WHERE email='$email' AND password='$password'";
					$result = $conn->query($sql);
					if ($result->num_rows == 1 ) {
						$row = $result->fetch_assoc();
						$_SESSION['email']=$row["email"];
						$_SESSION['username']=$row["name"];
						header("Location: login.html");
						exit();
						
					    }
					else{
						
						$message = "Invalid Email or Password";
					    }
			      }
		       }
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>login</title>
<link href="login.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<form id="login-form" action="" method="post" role="form" style="display: block;">
									<div id="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="" autocomplete="off">
									</div>
									<div id="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" autocomplete="off">
									</div>
									
									<div id="form-groupmsg">
										<label for="remember"><?php echo $message;?></label>
									
									</div>
									<div id="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
								</form>
</body>
</html>

