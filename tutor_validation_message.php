
<?php

include("connection.php");
session_start();
$msg = $_GET["x"];

?>

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
  <style>
    body {
        position: relative;
        z-index: 0;
    }
    .error {
        width:30%;
        height:400px;
        box-shadow: 4px 4px 50px rgb(141, 134, 134);
        text-align: center;
        padding: 10px;
        padding-top: 80px;
        padding-right: 20px;
        padding-left: 20px;
        margin-left: 35%;
        background-color: white;
        opacity: 1;
        position: fixed;
        z-index: 1;
    }

    .ok {
        margin-top: 25px;
        
    }
</style>
    <br><br><br><br><br><br>
    <div class="error">
        <h5><?php echo($msg);?></h5>
            <hr>
            <a href="tutor_application.html"><button class="btn btn-primary p-0 ok-btn ok" >OK</button></a>
    </div>





  <div class="form_intro">
    <h5 >To apply to <em>Teachers</em>, please fill the form below.</h5>
    <p>Once the form has been approved, an email will be sent to you confirming your account.</p>
    <br>
  <fieldset class="form">
    <form action="tutor_application.php" method="POST" enctype="multipart/form-data">

    <h4>Your Personal Information</h4>
    <br>

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
          <option value="0" selected>Highschool degree</option>
          <option value="1">College Undergraduate</option>
          <option value="2">College Graduate</option>
          <option value="3">Other..</option>
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
          <button type="submit" class="submit-button">Submit</button>
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