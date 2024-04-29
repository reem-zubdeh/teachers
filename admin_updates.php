<?php

include("connection.php");
session_start();

if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"1")==0)
{


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin Updates</title>
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
                <li><a class="nav-link scrollto " href="admin_page.php">Main Page</a></li>
                    <li><a class="nav-link scrollto active" href="admin_updates.php">My updates</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Log out</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <br><br><br><br><br><br>

    <a href="admin_page.php" class="btn btn-secondary" style="margin: 0 0 0 20vw">&lt Back</a>

    <div class="container">

        <h5 class="flex-msg text-center">Updates awaiting your response</h5>

        <div class="list-group thin-container" id="myList" role="tablist">
            
            <div class="list-group-item card update-item  tutors-parent">
                <h5 class="card-header">Tutor Application</h5>
               <?php $query_tutors_application = "SELECT temp_user_id ,first_name, last_name,email,phone_number FROM  pending_tutors";
                $stmt = $connection->prepare($query_tutors_application);
                $stmt->execute();
                $results_tutors = $stmt->get_result();
                ?>


                <div class="card-body">
                  
              <?php 
                      while($row = $results_tutors->fetch_assoc()){
                    ?>
                   
                  <h5 class="card-title"><?php echo($row["first_name"]." ".$row["last_name"]); ?></h5>
                  <p class="card-text"><?php echo($row["email"]." - ".$row["phone_number"]); ?></p>
                  <a href="admin_application.php?id=<?php echo($row["temp_user_id"]);?>" class="btn btn-primary" data-id=<?php echo($row["temp_user_id"]); ?> >View update</a>
                  <hr>                 
                  <?php } ?> 
                </div>
            </div>

            <div class="list-group-item card update-item">
                <h5 class="card-header">Consultation Requests</h5>
                <?php $query = "SELECT  id,first_name, last_name,email_address,phone_number, information FROM  consultations";
                $stmt = $connection->prepare($query);
                $stmt->execute();
                $results = $stmt->get_result();
                ?>


                <div class="card-body">
                  
              <?php 
                      while($row = $results->fetch_assoc()){
                    ?>
                <div class="card-body">
                  <h5 class="card-title"><?php echo($row["first_name"]." ".$row["last_name"]); ?></h5>
                  <p class="card-text"><?php echo($row["email_address"]." - ".$row["phone_number"]); ?></p>
                  <a href="admin_consultation.php?id=<?php echo($row["id"]);?>"class="btn btn-primary">View update</a>
                </div>
                <hr>
                <?php } ?>
            </div>

            <div class="list-group-item card update-item">
                <h5 class="card-header">Student Signup</h5>

                <?php $query_student_signup = "SELECT temp_student_id, first_name, last_name, email, phone_number FROM  pending_students";
                $stmt = $connection->prepare($query_student_signup);
                $stmt->execute();
                $results_students = $stmt->get_result();
                ?>


                <div class="card-body">    
                  <?php
                    while($row = $results_students->fetch_assoc()){
                  ?>
                   
                  <h5 class="card-title"><?php echo($row["first_name"]." ".$row["last_name"]); ?></h5>
                  <p class="card-text"><?php echo($row["email"]." - ".$row["phone_number"]); ?></p>
                  <a href="admin_signup.php?id=<?php echo($row["temp_student_id"]);?>" class="btn btn-primary" data-id=<?php echo($row["temp_student_id"]); ?> >View update</a>
                  <hr>                 
                  <?php } ?>
                </div>
            </div>

            <div class="list-group-item card update-item">
                <h5 class="card-header">New Tutor Request</h5>
                
                <?php

                  $mysql = $connection->prepare("SELECT * FROM new_tutor_requests 
                  JOIN students ON `new_tutor_requests`.`student_id` = `students`.`student_id` 
                  JOIN users ON `users`.`user_id` = `students`.`user_id`");
                  $mysql->execute();
                  $results = $mysql->get_result();

                  ?>

                <div class="card-body">    
                  <?php
                  while($row = $results->fetch_assoc()){
                  ?>
                  
                  <h5 class="card-title"><?php echo($row["first_name"]." ".$row["last_name"]); ?></h5>
                  <p class="card-text"><?php echo($row["email"]." - ".$row["phone_number"]); ?></p>
                  <a href="admin_student_add.php?id=<?php echo($row["id"]);?>" class="btn btn-primary" data-id=<?php echo($row["id"]); ?> >View update</a>
                  <hr>                 
                  <?php } ?>
                </div>

            
         
            <div class="list-group-item card update-item">
                <h5 class="card-header">Tutor Profile Edit</h5>
                <?php $query= "SELECT user_id FROM  tutor_edit_requests";
                $stmt = $connection->prepare($query);
                $stmt->execute();
                $results = $stmt->get_result();
                while($row = $results->fetch_assoc()){
                  $query2= "SELECT first_name,last_name, email,phone_number from users where user_id=?;";
                  $stmt2= $connection->prepare($query2);
                  $stmt2->bind_param("i",$row["user_id"]);
                  $stmt2->execute();
                  $results2 = $stmt2->get_result();
                  while($row2 = $results2->fetch_assoc()){

                ?>
                <div class="card-body">
                  <h5 class="card-title"><?php echo($row2["first_name"]." ".$row2["last_name"]); ?></h5>
                  <p class="card-text"><?php echo($row2["email"]." - ".$row2["phone_number"]); ?></p>
                  <a href="admin_edit.php?id=<?php echo($row["user_id"]);?>" class="btn btn-primary">View update</a>
                </div>
                <?php } } ?>
            </div>
            </div>
        </div>
        </div>

    </div>

    <br><br><br><br><br><br>
    
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
    <script src="./vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="./vendor/aos/aos.js"></script>
  <script src="./vendor/php-email-form/validate.js"></script>
  <script src="./vendor/swiper/swiper-bundle.min.js"></script>
  <script src="./vendor/purecounter/purecounter.js"></script>
  <script src="./vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./vendor/glightbox/js/glightbox.min.js"></script>

  <script src="./js/main.js"></script>

</body>


</html>

<?php }else {header("Location: index.php");}
?>