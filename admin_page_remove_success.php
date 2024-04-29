<?php

include("connection.php");
session_start();

if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"1")==0)
{ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin - Remove: Success</title>
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

<body >

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top header-form">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center">
                <img src="./img/logo.png" alt="">
                <span>Teachers</span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="admin_page.php">Main Page</a></li>
                    <li><a class="nav-link scrollto" href="admin_updates.php">My updates</a></li>
                    <li> <a style="cursor: pointer ;" class="nav-link scrollto rmov" data-bs-toggle="modal"
                            data-bs-target="#remove-modal">
                            <span>Remove Member</span>
                        </a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Log out</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->


    <!-- Free consultation-->
    <div class="modal modal-large fade" id="remove-modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <h2 class="text-center">Remove Member form</h1>
                        <p style="color:red;margin-left:30px;">Caution: Removing a member will delete them permanently
                            from the database.</p>
                        <form action="delete_member.php" method="post" id="remove-form">
                            <div class="row">
                                <div class="col-4">
                                    First name
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="first" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    Last name
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="last" required>
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
                                    Phone number
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="phone" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    User type
                                </div>
                                <div class="col-8">
                                    <select class="form-control" autocomplete="off" name="select">
                                        <option value="none" disabled hidden selected>Select an Option</option>
                                        <option value="tutor" name="type">Tutor</option>
                                        <option value="student" name="type">Student</option>


                                    </select>
                                </div>
                            </div>
                            <br><br>

                            <div class="modal-footer">

                                <br>
                                <a href="admin_page.php">
                                    <button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </a>
                                <button type="submit" class="btn btn-primary p-0 ok-btn"
                                    style="border-color:red; background-color:red;">Delete</button>
                            </div>
                        </form>

                </div>
            </div>
        </div>


    </div>

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
        <h5>The user has been successfully deleted from the database!</h5>
            <hr>
            <a href="admin_page.php"><button class="btn btn-primary p-0 ok-btn ok" >OK</button></a>
    </div>
    <div class="greeting">
        <h1>Hello, Admin!</h1>
        <p>What would you like to do today?</p>
    </div>

    <br><br>
    <div class="grid-container">
        <a href="admin_students_page.php">
            <div class="grid-item item1">
                <img src="img/students.png">
                <p>Manage Students</p>
            </div>
        </a>
        <a href="admin_tutors_page.php">
            <div class="grid-item item2">
                <img src="img/tutors.jpg">
                <p>Manage Tutors</p>
            </div>
        </a>
        <a href="admin_bookings_page.php">
            <div class="grid-item item3">
                <img src="img/bookings.jpg">
                <p>Manage Bookings</p>
            </div>
        </a>
        <div class="grid-item item4">
        </div>
        <a href="admin_updates.php">
            <div class="grid-item item5">
                <img src="img/updates.png">
                <p>View Updates</p>
            </div>
        </a>
        <div class="grid-item item6">
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
                            <a href="https://www.facebook.com/Teachers.leb/" class="facebook"><i
                                    class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/teachers.lb/" class="instagram"><i
                                    class="bi bi-instagram"></i></a>
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
</body>


</html>


<?php } else {header("Location: index.php");} ?>