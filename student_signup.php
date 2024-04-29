

<?php

include("connection.php");
$msg="";
$invalid = false;
$exists=false;

if(isset($_POST["submit"])){

  if(isset($_POST["first_name"]) && $_POST["first_name"]!="" && preg_match ("/^[a-zA-z]*$/",$_POST["first_name"])){
    $first_name = $_POST["first_name"];
}else if(isset($_POST["first_name"]) && $_POST["first_name"]==""  || !preg_match ("/^[a-zA-z]*$/",$_POST["first_name"])){
    $invalid=true;
    $msg="First name should only contain alphabet";
}else{
    die("Error 1");
}
if(isset($_POST["last_name"]) && $_POST["last_name"]!="" && preg_match ("/^[a-zA-z]*$/",$_POST["last_name"])){
  $last_name = $_POST["last_name"];
}else {
$invalid=true;
$msg="Last name should only contain alphabet & no empty entries are allowed";
}

if(isset($_POST["phone_number"]) && $_POST["phone_number"]!="" && preg_match("/^[0-9]*$/", $_POST["phone_number"])){
  $phone_number = $_POST["phone_number"];
}else if(isset($_POST["phone_number"]) && $_POST["phone_number"]!="" && !preg_match("/^[0-9]*$/", $_POST["phone_number"])){
$invalid=true;
$msg="Phone number should contain numbers only. ";
}else{
  die("Error 7");
}

if(isset($_POST["email_address"]) && $_POST["email_address"]!="" && filter_var($_POST["email_address"], FILTER_VALIDATE_EMAIL)){
  $email_address = $_POST["email_address"];
}else if(isset($_POST["email_address"]) && $_POST["email_address"]!="" && !filter_var($_POST["email_address"], FILTER_VALIDATE_EMAIL)){
$invalid=true;
$msg="Incorrect email format";
}

if(isset($_POST["password"]) && $_POST["password"]!="" && preg_match('@[A-Z]@', $_POST["password"]) && preg_match('@[a-z]@',  $_POST["password"]) && preg_match('@[0-9]@',  $_POST["password"]) && preg_match('@[^\w]@',  $_POST["password"]) && strlen($_POST["password"]) > 7 && strlen($_POST["password"]) < 21){
  $password = hash("sha256",$_POST["password"]);
}else if(isset($_POST["password"]) && $_POST["password"]!="" && !preg_match('@[A-Z]@', $_POST["password"]) || !preg_match('@[a-z]@',  $_POST["password"]) || !preg_match('@[0-9]@',  $_POST["password"]) || !preg_match('@[^\w]@',  $_POST["password"]) || strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20){
$invalid=true;
$msg="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";  

}else{
  die("Error 4");
}

//Course Details

if(isset($_POST["education"]) && $_POST["education"] != "" ){
    $education_level_student = $_POST["education"];
}else{
    die("Error6");
}
   

if ($education_level_student == "college") {
    if(isset($_POST["course-name"]) && $_POST["course-name"]!=""){ //for education level = college
        $course_choice = $_POST["course-name"];
    }else{
      $invalid=true;
      $msg="Please enter the course name.";
    }
}
elseif($education_level_student != "college") {
    if(isset($_POST["course"]) && $_POST["course"]!=""){ //for education levels != college
        $course_choice = $_POST["course"];
    }else{
        die("Error8");
    }
}
else{
    die("Error9");
}


//Tutor Details

if(isset($_POST["tutor"]) && $_POST["tutor"] != "" && preg_match("/^[0-9]*$/", $_POST["tutor"]) && $_POST["tutor"] >= 0){
    $tutor = $_POST["tutor"];
}else{
    die("Error10");
}

//Session Details


if(isset($_POST["date"]) && $_POST["date"] != "" && preg_match("/$/", $_POST["date"])){
    $date = $_POST["date"];
}else if(isset($_POST["date"]) && $_POST["date"] != "" && !preg_match("/$/", $_POST["date"])){
    die("Enter correct date format");
}else{
  $invalid=true;
  $msg="Enter correct date format";
}


$days_of_session = "";

if(isset($_POST["monday"]) && $_POST["monday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}


if(isset($_POST["tuesday"]) && $_POST["tuesday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}

if(isset($_POST["wednesday"]) && $_POST["wednesday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}


if(isset($_POST["thursday"]) && $_POST["thursday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}

if(isset($_POST["friday"]) && $_POST["friday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}


if(isset($_POST["saturday"]) && $_POST["saturday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}

if(isset($_POST["sunday"]) && $_POST["sunday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}


if (!isset($_POST["sunday"]) && !isset($_POST["saturday"]) && !isset($_POST["friday"]) && !isset($_POST["thursday"]) && !isset($_POST["wednesday"]) && !isset($_POST["tuesday"]) && !isset($_POST["monday"])){
    $invalid=true;
    $msg="Please select the days of your sessions.";
}       

if(isset($_POST["price"]) && $_POST["price"] !="" && preg_match("/^[0-9]*$/", $_POST["price"])){
    $price = $_POST["price"]; //check variable is set and not null && make sure input is composed of only numbers
}else if(isset($_POST["price"]) && $_POST["price"] !="" && !preg_match("/^[0-9]*$/", $_POST["price"])){
    die("Price option should be composed of numbers."); //if input is not composed of only numbers it wont be accepted
}else{
  $invalid=true;
  $msg="Price option should be composed of numbers. No empty values allowed.";

}



if ( $invalid==false){

    $mysql1 = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $mysql1->bind_param("s", $email_address);
    $mysql1->execute();
    $results1 = $mysql1->get_result();
    $row1 = $results1->fetch_assoc();
    if(empty($row1)) {
        $mysql2 = $connection->prepare("SELECT * FROM pending_students WHERE email = ?");
        $mysql2->bind_param("s", $email_address);
        $mysql2->execute();
        $results2 = $mysql2->get_result();
        $row2 = $results2->fetch_assoc();
      }else {  
        $exists=true;
        $msg="Email already exists.";
      }
       if(empty($row2)) {
        $mysql3 = $connection->prepare("SELECT * FROM pending_tutors WHERE email = ?");
        $mysql3->bind_param("s", $email_address);
        $mysql3->execute();
        $results3 = $mysql3->get_result();
        $row3 = $results3->fetch_assoc();
    }else {  
      $exists=true;
      $msg="Email already exists.";
       }
       if ($exists==false){
       if(empty($row3)) {
        $mysql = $connection->prepare("INSERT INTO pending_students(first_name,last_name,phone_number,email,password,education_level_student,course,preferred_tutor,starting_date,days_of_sessions,price) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $mysql->bind_param("sssssssdssd",$first_name,$last_name,$phone_number,$email_address,$password,$education_level_student,$course_choice,$tutor,$date,$days_of_session,$price);
      
                
        $to_email = "yara.chahine@lau.edu";
        $subject = "Teachers Student Sign Up";
        $body = "Hello Admin!\n\n You have a new Student Sign up request from $first_name  $last_name.";
        $headers = "From: yarachahine77@gmail.com";
        
        mail($to_email, $subject, $body, $headers);
    
    }else {  
      $exists=true;
      $msg="Email already exists.";
           }
        if (!$mysql->execute()){
            echo ("\n");
            echo($mysql->error);
        }
        echo $connection->error;
        $mysql->close();
        $connection->close();
        
        
     header("Location: index.php");
      }
    }

    }
?>























<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Become a student at Teachers</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="./img/favicon.png" rel="icon">
  <link href="./img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./vendor/aos/aos.css" rel="stylesheet">
  <link href="./vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="./vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="./vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="./css/style.css" rel="stylesheet">
  <link href="./css/style4.css" rel="stylesheet">
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top header-form">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="./img/logo.png" alt="">
        <span>Teachers</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>  
          <li><a class="nav-link scrollto" href="tutors_page.php">Our tutors</a></li>
          <li class="dropdown"><a href="#" style="display: none;"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="getstarted scrollto" href="login.php">Log in</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <br><br><br><br><br><br>

  <div class="form_intro">
    <h5>To become a student at "Teachers", please fill the form below.</h5>
    <p>Once the form has been approved, an email will be sent to you with your account password.</p>
    <br>
      <fieldset>
        <form action="student_signup.php" method="POST" enctype="multipart/form-data">

          <h4>Your Personal Information</h4>
          <br>
          <?php if($invalid) { ?> <p class="text-danger"><?php echo("Warning: ".$msg)?></p><?php } ?>
  <?php if($exists && !$invalid) { ?> <p class="text-danger"><?php echo("Warning: ".$msg)?></p><?php } ?>

          <br>
          <label for="first_name">First Name</label>
          <input type="text" name="first_name" placeholder="Please enter your first name">
          <label for="last_name">Last Name</label>
          <input type="text" name="last_name" placeholder="Please enter your last name">
          <br><br>
          <label for="phone_number">Phone Number</label>
          <input type="text" name="phone_number" placeholder="Please enter your phone number">
          <label for="email_address">Email Address</label>
          <input type="text" name="email_address" placeholder="Please enter your email address"> <br>
          <label for="email_address">Create Password</label>
          <div class="col-auto text-muted"><small>
              Your password must be 8-20 characters long and must contain at least one lowercase letter, uppercase
              letter,
              number, and special symbol.
            </small></div>
          <input type="password" name="password" placeholder="">



          <br>

          <h4>Course Details</h4>
          <br>
          <label for="education">Select Education Level: </label>

          <select name="education" id="education" oninput="change_student_education()" style="min-width: 200px;">

            <option value="primary" selected>Primary School</option>
            <option value="middle">Middle School</option>
            <option value="highschool">Highschool</option>
            <option value="college">College</option>
          </select>

          <label for="course" style="min-width: 200px;" id="menu-label">Choose Course Topic: </label>

          <select name="course" id="menu-course" style="margin-left: 20px; min-width: 200px;">
            <option value="Math">Math</option>
            <option value="Physics">Physics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Biology">Biology</option>
            <option value="Arabic">Arabic</option>
            <option value="French">French</option>
            <option value="English">English</option>

          </select>
          <br><br>
          <label for="course-name" id="course-name-id" style="display: none; margin-right: 30px;">Please enter your
            course name: </label>
          <input type="text" id="course-name" name="course-name" style="display: none;" placeholder="i.e Calculus 3">

          <br><br>


          <h4>Tutor Details</h4>
          <br>
          <label for="tutor" style="vertical-align: top">Select your preferred tutor:</label>
          <select name="tutor" id="tutor" size = 4 style="margin-left: 20px; min-width: 200px;">
            <!-- "value" here is the tutor id -->

            <?php
            
            include("connection.php");

            $query = "SELECT * FROM `users` JOIN `tutors` ON `users`.`user_id` = `tutors`.`user_id`";
            $stmt = $connection->prepare($query);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($r = $res->fetch_assoc()) {
              echo ("<option value=\"" . $r["tutor_ID"] . "\">".$r["first_name"] . " " . $r["last_name"] ."</option>");
            }

            ?>
          </select>
          <br><br>
          <p>You can check our list of tutors <a href=index.php>here</a></p>
          <br><br>
          <h4>Session Details</h4>
          <br>
          <label for="date">When would you like to start your sessions? </label>
          <input type="date" id="date" name="date" style="margin-left: 20px;">
          <br><br>
          <p> Please check the day/days on which you would like to have your sessions.</p>
          <label for="monday">Monday</label>
          <input type="checkbox" id="monday" name="monday">
          <br>
          <label for="tuesday">Tuesday</label>
          <input type="checkbox" id="tuesday" name="tuesday">
          <br>
          <label for="wednesday">Wednesday</label>
          <input type="checkbox" id="wednesday" name="wednesday">
          <br>
          <label for="thursday">Thursday</label>
          <input type="checkbox" id="thursday" name="thursday">
          <br>
          <label for="friday">Friday</label>
          <input type="checkbox" id="friday" name="friday">
          <br>
          <label for="saturday">Saturday</label>
          <input type="checkbox" id="saturday" name="saturday">
          <br>
          <label for="sunday">Sunday</label>
          <input type="checkbox" id="sunday" name="sunday">
          <br><br>

          <label for="price">Please select your preferred price range: </label>
          <input type="text" id="price" name="price" placeholder="i.e 50000" style="margin-left: 20px;">
          <br><br>

          <br>
          <br>
          <button type="submit" value="Submit" name="submit" class="submit-button">Submit</button>
          <br><br><br><br>
        </form>

      </fieldset>



  </div>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 col-md-12 footer-info">
            <a href="index.php" class="logo d-flex align-items-center">
              <img src="./img/logo.png" alt="">
              <span>Teachers</span>
            </a>
            <p>We offer top quality tutors, in every field, for every student, at the best prices, <br>
              because your education is our priority.</p>
            <div class="social-links mt-3">
              <a href="https://www.facebook.com/Teachers.leb/" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="https://www.instagram.com/teachers.lb/" class="instagram"><i class="bi bi-instagram"></i></a>
            </div>
          </div>

          <div class="d-block col-1 d-lg-none"></div>
          <div class="col-lg-3 col-5 footer-links">
            <br> <br class="d-block d-md-none">
            <h4><i class="bi bi-envelope"></i>&ThickSpace; Email us</h4> <br>
            elie.daccache7777@gmail.com
          </div>

          <div class="col-lg-3 col-5 footer-contact text-center text-md-start">
            <h4>
              <i class="bi bi-telephone"></i>&ThickSpace; Give us a call <br>
              <i class="bi bi-whatsapp"></i>&ThickSpace; Contact us on WhatsApp
            </h4> <br>
            +961 71 777 498
          </div>
          <div class="d-block col-1 d-lg-none"></div>

        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="./vendor/jquery/jquery-3.6.0.min.js"></script>
  <script src="./vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="./vendor/aos/aos.js"></script>
  <script src="./vendor/swiper/swiper-bundle.min.js"></script>
  <script src="./vendor/purecounter/purecounter.js"></script>
  <script src="./vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="./js/main.js"></script>
  <script src="./js/main2.js"></script>

</body>

</html>


