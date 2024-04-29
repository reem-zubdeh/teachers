<?php

include("connection.php");
session_start();
if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"3")==0)
{
 $id= $_SESSION["user_id"];
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit your profile</title>
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
                <li><a class="nav-link scrollto " href="profile.php">Home</a></li>
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
    <h5 class="flex-msg">Your profile information will only be available to "Teachers" consultants to be able to contact you. Please keep
        it up to date.</h5>

    <div class="flex-container">
        <div class="flex-item">
        </div>
    
        <div class="flex-item">
            <?php $query="SELECT * from users where user_id=?;"; 
             $stmt = $connection->prepare($query);
             $stmt->bind_param("i",$id);
             $stmt->execute();
             $results = $stmt->get_result();
             $row = $results->fetch_assoc();?> 
            <p>First name: <span><?php echo($row["first_name"]); ?></span> </p>
            <p>Last name: <span><?php echo($row["last_name"]); ?></span> </p>
            <p> Phone number: <span><?php echo($row["phone_number"]); ?></span></p>
            <p>Email: <span><?php echo($row["email"]); ?></span> </p>
            <?php $query="SELECT * from students where user_id=?;"; 
             $stmt = $connection->prepare($query);
             $stmt->bind_param("i",$id);
             $stmt->execute();
             $results = $stmt->get_result();
             $row = $results->fetch_assoc();?> 
            <p>Preferred Price Range: <span><?php echo($row["price_range"]); ?></span> </p>

        </div>
        <div class="flex-item">
            <button type="button" style="width:100px;"class="btn btn-primary p-0 ok-btn"  data-bs-toggle="modal" data-bs-target="#edit-modal" data-bs-dismiss="modal" onclick="$('#editform').submit()">Edit Info</button>
        </div>

    </div>




    <div class="modal modal-large fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body p-5">
              <h2 class="text-center">Edit Profile Info</h1>
              <form action="student_edit.php" method="post">
                <div class="row text-muted m-3">
                    Please fill in all the fields before you submit.
                </div>
                <div class="row">
                      <div class="col-4">
                        Phone number
                      </div>
                      <div class="col-8">
                          <input class="form-control" type="text" name="phone" required>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-4">
                        Email address
                      </div>
                      <div class="col-8">
                          <input class="form-control" type="email" name="email" required>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-4">
                          Preferred Price Range
                      </div>
                      <div class="col-8">
                          <input class="form-control" type="text" name="price" required>
                      </div>
                  </div>
                
                  <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary p-0 ok-btn"  data-bs-toggle="modal" data-bs-target="#msg-modal" data-bs-dismiss="modal" onclick="$('#editform').submit()">Save</button>
                  </div>
              
              </form>
          </div>
        </div>
      </div>
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
    <script src="./js/main.js"></script>

</body>


</html>


<?php } else {header("Location: index.php");} ?>