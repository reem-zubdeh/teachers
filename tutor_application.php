



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
    $msg="First name should only contain alphabet & no empty entries are allowed";
}else{
    die("Error 1");
}
if(isset($_POST["last_name"]) && $_POST["last_name"]!="" && preg_match ("/^[a-zA-z]*$/",$_POST["last_name"])){
    $last_name = $_POST["last_name"];
}else {
  $invalid=true;
  $msg="Last name should only contain alphabet & no empty entries are allowed";
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
if(isset($_POST["age"]) && $_POST["age"]!="" && preg_match("/^[0-9]*$/", $_POST["age"]) && $_POST["age"]>17 &&  $_POST["age"]<81){
    $currentYear = intval(date("Y"));
    $year_born = $currentYear - $_POST["age"];
    
}else if(isset($_POST["age"]) && $_POST["age"]!="" && (!preg_match("/^[0-9]*$/", $_POST["age"]) || $_POST["age"]>80 || $_POST["age"]<18)){
  $invalid=true;
  $msg="Age should be between 18 and 80.";
}else{
    die("Error 5");
}
if(isset($_POST["gender"]) && $_POST["gender"]!="" && (strcmp(($_POST["gender"]),"Male")==0 || strcmp(($_POST["gender"]),"Female")==0 || strcmp(($_POST["gender"]),"Other")==0)){
    $gender = $_POST["gender"];
}else if (isset($_POST["gender"]) && $_POST["gender"]!="" && strcmp(($_POST["gender"]),"Male")!=0 && strcmp(($_POST["gender"]),"Female")!=0 && strcmp(($_POST["gender"]),"Other")!=0){
  $invalid=true;
  $msg="No other choices.";
}else{
    die("Error 6");
}
if(isset($_POST["phone_number"]) && $_POST["phone_number"]!="" && preg_match("/^[0-9]*$/", $_POST["phone_number"])){
    $phone_number = $_POST["phone_number"];
}else if(isset($_POST["phone_number"]) && $_POST["phone_number"]!="" && !preg_match("/^[0-9]*$/", $_POST["phone_number"])){
  $invalid=true;
  $msg="Phone number should contain numbers only. ";
}else{
    die("Error 7");
}
if(isset($_POST["city"]) && $_POST["city"]!="" && preg_match ("/^[a-zA-z]*$/",$_POST["city"])){
    $city = $_POST["city"];
}else if(isset($_POST["city"]) && $_POST["city"]!="" && !preg_match ("/^[a-zA-z]*$/",$_POST["city"])){
  $invalid=true;
  $msg="City name should not contain numbers.";
}else{
    die("Error 8");
}
if(isset($_POST["education_level"]) && $_POST["education_level"]!="" && preg_match("/^[a-zA-z]*$/", $_POST["education_level"])){
    $education_level_tutor = $_POST["education_level"];
}else{
    die("Error 9");
}
if(isset($_POST["school"]) && $_POST["school"]!=""){
    $educational_institution_name = $_POST["school"];
}else{
  $invalid=true;
  $msg="Please enter school name.";
}
if(isset($_POST["field"]) && $_POST["field"]!=""){
    $field = $_POST["field"];
}else{
  $invalid=true;
  $msg="Please enter field.";
}
if(isset($_POST["years"]) && $_POST["years"]!="" && preg_match("/^[0-9]*$/", $_POST["years"]) && $_POST["years"]>=0){
    $years_of_experience = $_POST["years"];
}else if(isset($_POST["years"]) && $_POST["years"]!="" && (!preg_match("/^[0-9]*$/", $_POST["years"]) || $_POST["years"]<0)){
  $invalid=true;
  $msg="years of experience should contain numbers only.";
}else{
    die("Error 12");
}


if(isset($_POST["course1-level"]) && $_POST["course1-level"]!=""){
    $course_level_1 = $_POST["course1-level"];
}else{
    die("Error 13");
}
if ($course_level_1 == "college") {
    if(isset($_POST["course1-input"]) && $_POST["course1-input"]!=""){
        $course_1 = $_POST["course1-input"];
    }else{
        die("Error 14");
    }
}
else {
    if(isset($_POST["course1-select"]) && $_POST["course1-select"]!=""){
        $course_1 = $_POST["course1-select"];
    }else{
        die("Error 15");
    }
}


if(isset($_POST["course2-level"]) && $_POST["course2-level"]!=""){
    $course_level_2 = $_POST["course2-level"];
}else{
    die("Error 16");
}
if ($course_level_2 == "none") {
    $course_2 = "none";
}
else if ($course_level_2 == "college") {
    if(isset($_POST["course2-input"]) && $_POST["course2-input"]!=""){
        $course_2 = $_POST["course2-input"];
    }else{
        die("Error 17");
    }
}
else {
    if(isset($_POST["course2-select"]) && $_POST["course2-select"]!=""){
        $course_2 = $_POST["course2-select"];
    }else{
        die("Error 18");
    }
}


if(isset($_POST["course3-level"]) && $_POST["course3-level"]!=""){
    $course_level_3 = $_POST["course3-level"];
}else{
    die("Error 19");
}
if ($course_level_3 == "none") {
    $course_3 = "none";
}
else if ($course_level_3 == "college") {
    if(isset($_POST["course3-input"]) && $_POST["course3-input"]!=""){
        $course_3 = $_POST["course3-input"];
    }else{
        die("Error 20");
    }
}
else {
    if(isset($_POST["course3-select"]) && $_POST["course3-select"]!=""){
        $course_3 = $_POST["course3-select"];
    }else{
        die("Error 21");
    }
}


if(isset($_POST["course4-level"]) && $_POST["course4-level"]!=""){
    $course_level_4 = $_POST["course4-level"];
}else{
    die("Error 22");
}
if ($course_level_4 == "none") {
    $course_4 = "none";
}
else if ($course_level_4 == "college") {
    if(isset($_POST["course4-input"]) && $_POST["course4-input"]!=""){
        $course_4 = $_POST["course4-input"];
    }else{
        die("Error 23");
    }
}
else {
    if(isset($_POST["course4-select"]) && $_POST["course4-select"]!=""){
        $course_4 = $_POST["course4-select"];
    }else{
        die("Error 24");
    }
}

  

 if (isset($_FILES["cv_file"]) && $_FILES["cv_file"]["error"] != UPLOAD_ERR_NO_FILE) {
    
    $cv_file = (str_replace(".", "", microtime(true)));
    $ext = pathinfo($_FILES["cv_file"]["name"], PATHINFO_EXTENSION);
    $cv_file = $cv_file . "." . $ext;

    $tempname = $_FILES["cv_file"]["tmp_name"];
    
    $folder = __DIR__ ."\\pending\\".$cv_file;
    
    $mime = mime_content_type($tempname); //make sure file uploaded is pdf
    
    if ((strcasecmp($mime, "application/pdf") == 0)) {
        if (!move_uploaded_file($tempname, $folder))  {
          $invalid=true;
          $msg="Error in saving pdf file to server, try again";
            
        }
    }
    else {
      $invalid=true;
      $msg="Invalid pdf file";
            
    }

} else {
  $invalid=true;
  $msg="Please upload your CV.";
}


if (isset($_FILES["img_file"]) && $_FILES["img_file"]["error"] != UPLOAD_ERR_NO_FILE) {
    $img_file = (str_replace(".", "", microtime(true)));
    $ext = pathinfo($_FILES["img_file"]["name"], PATHINFO_EXTENSION);
    $img_file = $img_file . "." . $ext;

    $tempname = $_FILES["img_file"]["tmp_name"];
    
    $folder = __DIR__ ."\\pending\\".$img_file;
    
    $mime = mime_content_type($tempname);
	$type = substr($mime, 0, strpos($mime, "/")); //make sure file uploaded is image
    
    if ((strcasecmp($type, "image") == 0)) {
        if (!move_uploaded_file($tempname, $folder))  {
          $invalid=true;
          $msg="Error in saving image file to server, try again";
          
        }
    }
    else {
      $invalid=true;
      $msg="Invalid image file.";

    }
} else {
  $invalid=true;
  $msg="Please upload a photo";
}





if(isset($_POST["bio"]) && $_POST["bio"]!=""){
    $bio = $_POST["bio"];
}else{
  $invalid=true;
  $msg="Please fill in the bio section.";
  
}


if ( $invalid==false){
$mysql1 = $connection->prepare("SELECT * FROM users WHERE email = ?");
$mysql1->bind_param("s", $email_address);
$mysql1->execute();
$results1 = $mysql1->get_result();
$row1 = $results1->fetch_assoc();
if(empty($row1)) {
    $mysql2 = $connection->prepare("SELECT * FROM pending_tutors WHERE email = ?");
    $mysql2->bind_param("s", $email_address);
    $mysql2->execute();
    $results2 = $mysql2->get_result();
    $row2 = $results2->fetch_assoc();
  }else {  
   $exists=true;
   $msg="Email already exists.";
  }
   if(empty($row2)) {
    $mysql3 = $connection->prepare("SELECT * FROM pending_students WHERE email = ?");
    $mysql3->bind_param("s", $email_address);
    $mysql3->execute();
    $results3 = $mysql3->get_result();
    $row3 = $results3->fetch_assoc();
}else {  
  $exists=true;
  $msg="Email already exists.";
   }
  
   if ($exists==false){
   if(empty($row3) ) {

    $mysql = $connection->prepare("INSERT INTO pending_tutors(first_name,last_name,email,password,year_born,gender,phone_number,city,education_level_tutor,educational_institution_name,field,years_of_experience,course_1,course_level_1,course_2,course_level_2,course_3,course_level_3,course_4,course_level_4,cv,image,description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $mysql->bind_param("ssssdssssssdsssssssssss",$first_name,$last_name,$email_address,$password,$year_born,$gender,$phone_number,$city,$education_level_tutor,$educational_institution_name,$field,$years_of_experience,$course_1,$course_level_1,$course_2,$course_level_2,$course_3,$course_level_3,$course_4,$course_level_4,$cv_file,$img_file,$bio);
    $mysql->execute();
    $to_email = "yara.chahine@lau.edu";
    $subject = "Teachers Tutor Application";
    $body = "Hello Admin! You have a new Tutor Application sent by $first_name  $last_name.";
    $headers = "From: yarachahine77@gmail.com";
    
    mail($to_email, $subject, $body, $headers);
    header("Location: index.php");


    }
  }
  
  }


  
  
}?>




  


















<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Become a tutor at Teachers</title>
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
    <h5 >To apply to <em>Teachers</em>, please fill the form below.</h5>
    <p>Once the form has been approved, an email will be sent to you confirming your account.</p>
    <br>
  <fieldset class="form">
    <form action="tutor_application.php" method="POST" enctype="multipart/form-data">

    <h4>Your Personal Information</h4>
    <br>
  <?php if($invalid) { ?> <p class="text-danger"><?php echo("Warning: ".$msg)?></p><?php } ?>
  <?php if($exists && !$invalid) { ?> <p class="text-danger"><?php echo("Warning: ".$msg)?></p><?php } ?>

    <div class="row align-items-center">
      <div class="col-auto">

      <label for="first_name" class="col-form-label">First name</label>
      </div>
      <div class="col-auto">
        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="e.g. John" >
      </div>
      <div class="col-auto">
        <label for="last_name" class="col-form-label">Last name</label>
      </div>
      <div class="col-auto">
        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="e.g. Smith" >
      </div>
    </div>

    <div class="row align-items-center">
      <div class="col-auto">
        <label for="email_address" class="col-form-label">Email</label>
      </div>
      <div class="col-auto">
        <input type="email" id="email_address" name="email_address" class="form-control" placeholder="e.g. john.smith@example.com" >
      </div>
      <div class="col-auto">
        <label for="password" class="col-form-label">Create password</label>
      </div>
      <div class="col-auto">
        <input type="password" id="password" name="password" class="form-control" placeholder="Create a secure password" >
      </div>
      <div class="col-auto text-muted"><small>
        Your password must be 8-20 characters long and must contain at least one lowercase letter, uppercase letter,
        number, and special symbol.
      </small></div>
    </div>

    <div class="row align-items-center">
      <div class="col-auto">
        <label for="age" class="col-form-label">Age</label>
      </div>
      <div class="col-auto">
        <input type="number" id="age" name="age" class="form-control" placeholder="e.g. 30" >
      </div>
      <div class="col-auto">
        <label for="gender" class="col-form-label">Gender</label>
      </div>
      <div class="col-auto">
        <select id="gender" name="gender" class="form-select" >
          <option value="Male" >Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
      </select>
      </div>
    </div>

    <div class="row align-items-center">
      <div class="col-auto">
        <label for="phone_number" class="col-form-label">Phone</label>
      </div>
      <div class="col-auto">
        <input type="tel" id="phone_number" name="phone_number" class="form-control" placeholder="e.g. 01234567" >
      </div>
      <div class="col-auto">
        <label for="city" class="col-form-label">City</label>
      </div>
      <div class="col-auto">
        <input type="text" id="city" name="city" class="form-control" placeholder="e.g. Beirut" >
      </div>
    </div>
  
        <br>
        <h4>Background Information</h4>
        <br>
        <label for="education-level">Select Education Level </label>

        <select name="education_level" id="education-level" class="form-select" oninput="change_tutor_education()"
        style="display: inline-block; width: 200px;">
          <option value="highschool" selected>Highschool degree</option>
          <option value="undergrad">College Undergraduate</option>
          <option value="grad">College Graduate</option>
          <option value="other">Other..</option>
        </select>
        <br><br>
        <label for="school" id="school-label">High School Name </label>
        <input type="text" name="school" id="school" placeholder="i.e. High school">
        <label for="field" id="field-label">Field/degree </label>
        <input type="text" name="field" id="field" placeholder="i.e General Sciences Baccalaureate">
        <br> <br>
        <div id="common">
          <label for="years" style="min-width: 200px;" id="years-label">Years of Experience </label>
          <input type="number" name="years" id="years">
          <br><br>
        </div>
          <p style="font-weight: bold;">Please add below the courses you can teach (at least one is required): </p>
          <br>
          <label>Course 1</label>
          <input type="text" name="course1-input" id="course1-input" style="display: none;">
          <select name="course1-select" id="course1-select" class="form-select" style="display: inline-block; width: 200px;">
            <option value="Math">Math</option>
            <option value="Physics">Physics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Biology">Biology</option>
            <option value="Arabic">Arabic</option>
            <option value="French">French</option>
            <option value="English">English</option>
          </select>
          <label for="course1-level">Level</label>
          <select name="course1-level" id="course1-level" class="form-select" oninput="change_level()" 
          style="display: inline-block; width: 200px;">
            <option value="primary" selected>Primary school</option>
            <option value="middle">Middle school</option>
            <option value="high">High school</option>
            <option value="college">College</option>
          </select>
          <br>
          <label>Course 2</label>
          <input type="text" name="course2-input" id="course2-input" style="display: none;">
          <select name="course2-select" id="course2-select" class="form-select" style="display: none; width: 200px;">
            <option value="Math">Math</option>
            <option value="Physics">Physics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Biology">Biology</option>
            <option value="Arabic">Arabic</option>
            <option value="French">French</option>
            <option value="English">English</option>
          </select>
          <label for="course2-level">Level</label>
          <select name="course2-level" id="course2-level" class="form-select" oninput="change_level()" 
          style="display: inline-block; width: 200px;">
            <option value="none" selected>--None--</option>
            <option value="primary">Primary school</option>
            <option value="middle">Middle school</option>
            <option value="high">High school</option>
            <option value="college">College</option>
          </select>
          <br>
          <label>Course 3</label>
          <input type="text" name="course3-input" id="course3-input" style="display: none;">
          <select name="course3-select" id="course3-select" class="form-select" style="display: none; width: 200px;">
            <option value="Math">Math</option>
            <option value="Physics">Physics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Biology">Biology</option>
            <option value="Arabic">Arabic</option>
            <option value="French">French</option>
            <option value="English">English</option>
          </select>
          <label for="course3-level">Level</label>
          <select name="course3-level" id="course3-level" class="form-select" oninput="change_level()" 
          style="display: inline-block; width: 200px;">
            <option value="none" selected>--None--</option>
            <option value="primary">Primary school</option>
            <option value="middle">Middle school</option>
            <option value="high">High school</option>
            <option value="college">College</option>
          </select>
          <br>
          <label>Course 4</label>
          <input type="text" name="course4-input" id="course4-input" style="display: none;">
          <select name="course4-select" id="course4-select" class="form-select" style="display: none; width: 200px;">
            <option value="Math">Math</option>
            <option value="Physics">Physics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Biology">Biology</option>
            <option value="Arabic">Arabic</option>
            <option value="French">French</option>
            <option value="English">English</option>
          </select>
          <label for="course4-level">Level</label>
          <select name="course4-level" id="course4-level" class="form-select" oninput="change_level()" 
          style="display: inline-block; width: 200px;">
            <option value="none" selected>--None--</option>
            <option value="primary">Primary school</option>
            <option value="middle">Middle school</option>
            <option value="high">High school</option>
            <option value="college">College</option>
          </select>
          <br>
        
          <br><br>
          <label for="cv_file">Upload CV: </label>
          <input type="file" name="cv_file" id="cv_file" >
          <br>
          <label for="img_file">Upload a profile image: </label>
          <input type="file" name="img_file" id="img_file" >
          <br><br>
          <label for="bio">Tell us a bit about yourself: <br><small>Note: this information must be accurate and will be publicly visible</small></label>
          <br>
          <textarea name="bio" id="bio" rows="6" placeholder="Enter text here..."></textarea>
          <button type="submit" class="submit-button" name="submit">Submit</button>
        </form>

        </fieldset>

        <br>

    <br><br>

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
