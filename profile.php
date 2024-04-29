<?php
include("connection.php");
session_start();
if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"2")==0 || strcmp($_SESSION["type"],"3")==0)
{
$id = $_SESSION["user_id"];

$query= "SELECT * FROM  users where user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);

$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Your student profile</title>
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
                    <li><a class="nav-link scrollto active" href="profile.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="todolist2.php">To-do List</a></li>
                    <li><a class="nav-link scrollto" href="calendar.php">Calendar</a></li>
                    <li><a class="nav-link scrollto" href="timer.php">Timer</a></li>
                    <li><a class="nav-link scrollto" href="pomodoro.php">Pomodoro Clock</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Log out</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <br><br><br><br><br><br>
    <div class="greeting">
        <h1>Hello, <span id="user-name"> 
          <?php 
            echo($row["first_name"]);
          ?>
        </span>
      </h1>
        <p>What would you like to do today?</p>
    </div>

    <br><br>
    <div class="grid-container">
        <a href="calendar.php">
            <div class="grid-item item1">
                <img src="img/calendarIllustration.jpg">
                <p>Calendar</p>
            </div>
        </a>
        <a href="todolist2.php">
            <div class="grid-item item2">
                <img src="img/tasktodo.png">
                <p>To-do List</p>
            </div>
        </a>
        <a href="pomodoro.php">
            <div class="grid-item item3">
                <img src="img/pomodoro2.jpg">
                <p>Pomodoro Clock</p>
            </div>
        </a>
        <a href="timer.php">
            <div class="grid-item item4">
                <img src="img/timer3.png">
                <br><br>
                <p>Timer</p>
            </div>
        </a>

        <a href="profile_edit.php">
            <div class="grid-item item5">
                <img src="img/edit.jpg">
                <br><br><br>
                <p>Edit Profile Info</p>
            </div>
        </a>
        <a href="request_new_tutor.php">
            <div class="grid-item item6">
                <img src="img/request.png">
                <p>Request a new tutor/Add Course</p>
            </div>
        </a>
    </div>

    <form style="display: block; height: 70px; padding: 10px; width: fit-content; margin: auto" action="login.php" method="post">
        <input type="hidden" name="email" value="<?php echo $row["email"] ?>">
        <input type="submit" name="forgot" value="Change my password" class="btn position-static h-75">
    </form>

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
    <script src="./js/main.js"></script>

</body>


</html>


<?php } else {header("Location: index.php");} ?>