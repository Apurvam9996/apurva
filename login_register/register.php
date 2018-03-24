<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') 
	   {
		if (isset($_POST['register-submit'])) {
		    		$name = $_POST["name"];
		    		$email = $_POST["email"];
		    		$password = $_POST["password"];
		    	//checking name
		    	if (empty($name)) {
				    $nameErr = "Name is required";
				    $fErr = "Yes"; 
				}
			else {
				    // check if name has only letters and whitespace
				    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				      $nameErr = "Name must have Only letters and white space ";
				      $fErr = "Yes"; 
				    }
				}
		//checking the email 
			if (empty($email)) {
				    $message = "Email is required";
				    $fErr = "Yes";
				}
			else {
				    // check if e-mail address is well-formed
				    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				      $message = "Invalid email format";
				      $fErr = "Yes"; 
					}
				}
		//checking password
			if (empty($password)) {
				    $message = "password is required";
				    $fErr = "Yes";
				} 
			else {
				    // check if password has 1-Lowercase, 1-Uppercase,1-Symbol and a length of 8 to 12
				    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#_$%]{8,12}$/',$password)){
				      $message = "Password of min. 8-20 characters and with at least one lowercase char, one uppercase 					                                        char,one digit, one special sign of @#_$% is accepted.";
				      $fErr = "Yes"; 
					}
				}
	            if($fErr!="Yes"){
			include "database.php";
			$check="SELECT * FROM login WHERE email = '$email'";
			$result = $conn->query($check);
				//checking if the email is already there in database.
                  		if ($result->num_rows > 0) {
                  			$message = "Email already exists";
                  			$conn->close();
				    	}
				//for inserting the new user's details into database.
				else{
				    	$sql = "INSERT INTO `teacher`(`email`,`password`,`name`) VALUES ('$email','$password','$name')";
				    		if ($conn->query($sql) === TRUE) {
						 	   $message="Account created successfully, Please Login";
						     } 
						else {
						   	   $message="Error: " . $sql . " " . $conn->error;
						     }
						$conn->close();
				     }
				 }
				
        		    
		    
		}
	}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<form id="register-form" action="register.php" method="post" role="form" style="display: block;">
  <div class="container">
 	<label><b>Name</b></label>
    	<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" autocomplete="off"><?php echo $nameErr;?>
  </div>
  <div class="container">
 	<label><b>Email</b></label>									
	<input type="email" name="email" id="email" tabindex="2" class="form-control" placeholder="Email Address" value="" autocomplete="off">
  </div>
  <div class="container">
	<label><b>Password</b></label>
	<input type="password" name="password" id="password" tabindex="3" class="form-control" placeholder="Password" autocomplete="off">
  </div>
  <div id="form-group text-center">
	<label for="remember"><?php echo $message;?></label>
  </div>
  <div id="form-group">
  	<div id="row">
  	   <div class="col-sm-6 col-sm-offset-3">
		<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
	   </div>
	</div>
   </div>
</form>
</body>
</html>






