<?php
session_start();
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: login.php");
//     exit;
// }
include("connection.php");

$email = "";
$password = "";

$incorrect = false;
$invalid = false;

if (isset($_POST["login"])){

    //LOGIN

    if(isset($_POST["email"]) && $_POST["email"]!=""){
        $email = $_POST["email"];

    }else{
         $incorrect=true;   
    }

    if(isset($_POST["password"]) && $_POST["password"]!=""){
        $password = hash("sha256",$_POST["password"]);

    }
    else{
        $incorrect = true;
    }

    $mysql = $connection->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $mysql->bind_param("ss", $email, $password);
    $mysql->execute();
    $results = $mysql->get_result();
    $row = $results->fetch_assoc();
    if(empty($row)) {
        $incorrect = true;
    }else {  
        $_SESSION["loggedin"] = true;
        $_SESSION["user_id"] = $row['user_id'];
        $_SESSION["type"] = $row['type'];
        if(strcmp($row['type'],"1")==0){
            header('Location: admin_page.php');
        }
        elseif (strcmp($row['type'],"2")==0) {
            header('Location: profile_tutor.php');
        }
        elseif (strcmp($row['type'],"3")==0) {
            header('Location: profile.php');
        }
        else {
            header('Location: index.php');
        }
    }
}




else if (isset($_POST["forgot"])) {

    //FORGOT PASSWORD

    if(isset($_POST["email"]) && $_POST["email"]!=""){
        $email = $_POST["email"];
    }
    else{
        die("Error 3");
    }

    $mysql = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $mysql->bind_param("s", $email);
    $mysql->execute();
    $results = $mysql->get_result();
    $row = $results->fetch_assoc();

    if(empty($row)) {
        $invalid = true;
    }else {
        $code = sprintf("%06d", mt_rand(1, 999999));

        $now = microtime(true);
        $now = substr($now, 0, strpos($now, "."));

        $query = "DELETE FROM temp_codes WHERE user_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("d", $row["user_id"]);
        if (!$stmt->execute()) {
            die ("Failed");
        }

        $query = "INSERT INTO temp_codes (user_id, code, created) VALUES (?,?,?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("dss", $row["user_id"], $code, $now);
        if (!$stmt->execute()) {
            die ("Failed");
        }

        $_SESSION["code"] = $code;
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["email"] = $email;

        $connection->close();

        $message = "
        Hello " . $row["first_name"] . "!\n\n
        Your Teachers password reset code is:\n\n" .
        $code .
        "\n\n
        Please use this code within 10 minutes of receiving this email.\n
        Please do not share this code with anyone.\n
        If you did not request to change your password, you can safely ignore this email.\n\n
        With love,\n
        Teachers
        ";

        $subject = "Teachers - Your password reset code";
          
    $to_email = $email;
    $subject = "Teachers Verification Code";
    $body = $message;
    $headers = "From: yarachahine77@gmail.com";
    
    mail($to_email, $subject, $body, $headers);
        header('Location: verification.php');

    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>My Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css">

</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
                        <a href="index.php">
						<img src="img/logo.png" alt="logo">
                        </a>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form action="login.php" method="POST">
								
							<?php if ($incorrect) { ?> <p class="text-danger">Your email or password is incorrect. Please try again.</p> <?php } ?>
							<?php if ($invalid) { ?> <p class="text-danger">Please enter the valid email of your account to change your password.</p> <?php } ?>

								<div class="form-group">
									<label for="email">Email Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Password
										<input type="submit" name="forgot" value="Forgot password?" class="btn-link float-right bg-transparent border-0">
									</label>
									<input id="password" type="password" class="form-control" name="password" required>
								</div>

								<div class="form-group m-0">
                                    <input id="loginSubmit" type="submit" name="login" value="Login" class="btn btn-primary btn-block " 
									style="background-color: #04c2f9; border-color: #04c2f9;">
								</div>
								<div class="mt-4 text-center">
									Not a member?<br><br> <a href="student_signup.php" >Register as a student</a>
                                    <br>
                                    <a href="tutor_application.php">Become a tutor</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script>
		$(window).keydown(function(event){
			if(event.keyCode == 13) {
			event.preventDefault();
			$("#loginSubmit").get(0).click();
			return false;
			}
		});
	</script>
</body>
</html>

