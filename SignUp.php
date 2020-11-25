<?php
include_once('./connection.php');

if(array_key_exists('submit', $_POST)) {

    $fullName = $_POST['fullName'];
	$birthDate = $_POST['birthDate'];
	$email = $_POST['email'];
	$userPassword = $_POST['userPassword'];

	$hashed_password = password_hash($userPassword, PASSWORD_DEFAULT);

    try{  
        $sql = "INSERT INTO users(fullName, birthDate, email, userPassword)
		   Values('$fullName', '$birthDate','$email', '$userPassword')";
		 
		$statment = $conn->prepare($sql);
		$statment->execute(array(':fullName' => $fullName, ':birthDate' => $birthDate, ':email' => $email, ':userPassword' =>$hashed_password));

        if($statment->rowCount() == 1){
			$result = header('location: HomePage.html');
		}
	}
	catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="StyleBootstrap.css" rel="stylesheet">

<!DOCTYPE html>
<html>

<head>
	<title>sign Up Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
		integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>

<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card" id="sign_up">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<i class="brand_logo fa fa-user fa-6x" alt="Logo"></i>
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="#">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="fullName" class="form-control input_user" value=""
								placeholder="Full Name" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
							</div>
							<input type="date" name="birthDate" class="form-control input_user" value=""
								placeholder="Birth Date" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="far fa-envelope"></i></span>
							</div>
							<input type="email" name="email" class="form-control input_user" value=""
								placeholder="Email" required>
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="userPassword" class="form-control input_pass" value=""
								placeholder="Password" required>
						</div>

						<div class="d-flex justify-content-center mt-3 login_container">
							<button type="submit" name="submit" class="btn login_btn">Sign Up</button>
						</div>
					</form>
				</div>

				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						<a href="LogIn.html">Log In</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>