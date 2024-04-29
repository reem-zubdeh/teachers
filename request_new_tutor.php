<?php

include("connection.php");
session_start();
if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"3"==0)) 
{  

$user_id = $_SESSION["user_id"];
$msg="";
$invalid = false;
$exists=false;



if(isset($_POST["submit"])){
  
//Course Details

if(isset($_POST["education"]) && $_POST["education"] != "" ){
    $education_level_student = $_POST["education"];
}else{
    die("Error");
}

if ($education_level_student == "college") {
    if(isset($_POST["course-name"]) && $_POST["course-name"]!=""){ //for education level = college
        $course_choice = $_POST["course-name"];
    }else{
      $invalid=true;
      $msg="Please enter the course name.";
    }
}
else {
    if(isset($_POST["course"]) && $_POST["course"]!=""){ //for education levels != college
        $course_choice = $_POST["course"];
    }else{
        die("Error8");
    }
}


//Tutor Details

if(isset($_POST["tutor"]) && $_POST["tutor"] != "" && preg_match("/^[0-9]*$/", $_POST["tutor"]) && $_POST["tutor"] >= 0){
    $tutor = $_POST["tutor"];
}else{
  $invalid=true;
  $msg="Please select a tutor.";
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


if (!isset($_POST["sunday"]) && !isset($_POST["saturday"]) && !isset($_POST["friday"]) 
&& !isset($_POST["thursday"]) && !isset($_POST["wednesday"]) && !isset($_POST["tuesday"]) && !isset($_POST["monday"])){
    $invalid=true;
    $msg="Please enter a date.";
}


if ( $invalid==false){

    $mysql = $connection->prepare("SELECT * FROM students JOIN users ON `users`.`user_id` = `students`.`user_id` WHERE `users`.`user_id` = ?");
    $mysql->bind_param("d", $user_id);
    $mysql->execute();
    $results = $mysql->get_result();
    $row = $results->fetch_assoc();
    $student_id = $row["student_id"];

    $mysql = $connection->prepare("INSERT INTO new_tutor_requests(student_id,education_level_student, course,preferred_tutor,starting_date,days_of_sessions) VALUES (?,?,?,?,?,?)");
    $mysql->bind_param("dssdss",$student_id, $education_level_student,$course_choice,$tutor,$date,$days_of_session);
    $mysql->execute();
    $mysql->close();
    $connection->close();
            
    $to_email = "yara.chahine@lau.edu";
    $subject = "Teachers Student Sign Up";
    $body = "Hello Admin!\n\n Your student, " . $row["first_name"] . " " .  $row["last_name"] . ", has requested a new tutor.";
    $headers = "From: yarachahine77@gmail.com";
    
    mail($to_email, $subject, $body, $headers);

    header("Location: profile.php");

}

}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Request a new tutor</title>
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
  <link href="./css/style2.css" rel="stylesheet">
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top header-form" >
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="./img/logo.png" alt="">
        <span>Teachers</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
        <li><a class="nav-link scrollto " href="profile.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="todolist2.php">To-do List</a></li>
                    <li><a class="nav-link scrollto active" href="timer.php">Timer</a></li>
                    <li><a class="nav-link scrollto" href="pomodoro.php">Pomodoro Clock</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Log out</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <br><br><br><br><br><br>

  <div class="form_intro">
    <h5 >To request a new tutor or a new course please fill the form below.</h5>
    <p>Once you submit, you will be contacted by our consultant.</p>
    <br>
  <form action="request_new_tutor.php" method="POST" class="form">

  <?php if($invalid) { ?> <p class="text-danger"><?php echo("Warning: ".$msg)?></p><?php } ?>

  <fieldset class="course-details">
      <h4>Course Details</h4>
      <br>
      <label for="education">Select Education Level: </label>
      
      <select name="education" id="education" oninput="change_student_education()" style="min-width: 200px;">

        <option value="primary" selected>Primary School</option>
        <option value="middle">Middle School</option>
        <option value="highschool">Highschool</option>
        <option value="college">College</option>
        </select>
      
      <label for="course" style="min-width: 200px;" id="menu-label" >Choose Course Topic: </label>

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
      <label for="course-name" id="course-name-id" style="display: none; margin-right: 30px;">Please enter your course name:  </label>
      <input type="text" id= "course-name" name="course-name" style="display: none;" placeholder="i.e Calculus 3">

</fieldset>
<br><br>

<fieldset>
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
          <label for="date">When would you like to start your sessions?  </label>
          <input type="date" id="date" name="date" style="margin-left: 20px;">
          <br><br>
          <p> Please check the day/days on which you would like to have your sessions.</p>
          <label for="monday">Monday</label>
          <input type="checkbox" id="monday" name="monday" >
          <br>
          <label for="tuesday">Tuesday</label>
          <input type="checkbox" id="tuesday" name="tuesday" >
          <br>
          <label for="wednesday">Wednesday</label>
          <input type="checkbox" id="wednesday" name="wednesday" >
          <br>
          <label for="thursday">Thursday</label>
          <input type="checkbox" id="thursday" name="thursday" >
          <br>
          <label for="friday">Friday</label>
          <input type="checkbox" id="friday" name="friday" >
          <br>
          <label for="saturday">Saturday</label>
          <input type="checkbox" id="saturday" name="saturday" >
          <br>
          <label for="sunday">Sunday</label>
          <input type="checkbox" id="sunday" name="sunday" >
            <br><br>

            <button type="submit" name="submit" class="submit-button" >Submit</button>
            <br><br><br><br>
          
      
</fieldset>

</form>

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
            <i class="bi bi-whatsapp"></i>&ThickSpace; Contact us on WhatsApp</h4> <br>
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

<?php } else {header("Location: index.php");} ?>