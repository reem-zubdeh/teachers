<?php

include("connection.php");

session_start();

$invalid = false;
if(isset($_POST["password"]) && $_POST["password"]!=""){

	if (preg_match('@[A-Z]@', $_POST["password"]) && preg_match('@[a-z]@',  $_POST["password"]) 
	&& preg_match('@[0-9]@',  $_POST["password"]) && preg_match('@[^\w]@',  $_POST["password"]) 
	&& strlen($_POST["password"]) > 7 && strlen($_POST["password"]) < 21) {

		$password = hash("sha256",$_POST["password"]);

		$user_id = $_SESSION["user_id"];

		$query = "UPDATE users SET password = ? WHERE user_id = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param("sd", $password, $user_id);
		if (!$stmt->execute()) {
			die("Failed");
		}
		$stmt->close();

		$query = "DELETE FROM temp_codes WHERE user_id = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param("d", $user_id);
		if (!$stmt->execute()) {
			die("Failed");
		}

		$query = "ALTER TABLE temp_codes AUTO_INCREMENT = 1";
		$stmt = $connection->prepare($query);
		if (!$stmt->execute()) {
			die("Failed");
		}
		$stmt->close();

		$connection->close();

		session_unset();
		session_destroy();

		header('Location: change_success.html');

	}
	else {
		$invalid = true;
	}
    
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/logo.png" alt="bootstrap 4 login page">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Forgot Password</h4>
							<form action="change_password.php" method="POST">
							<?php if ($invalid) { ?> <p class="text-danger">Please follow the password requirements below.</p> <?php } ?>	
							<div class="form-group">
									<label for="password">Create your new password</label>
									<input id="password" type="password" name="password" class="form-control" required autofocus>
									<div class="form-text text-muted">
										Your password must be 8-20 characters long and must contain at least one lowercase letter, uppercase letter,
        								number, and special symbol.
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Change password
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2021 &mdash; Teachers 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
	<script src="./js/main.js"></script>

</body>
</html>