<?php
include("connection.php");
session_start();
$loggedin = isset($_SESSION["user_id"]);
if (isset($_SESSION["type"])) {
$type = $_SESSION["type"];
if ($type == 1) $target = "admin_page.php";
elseif ($type == 2) $target = "profile_tutor.php";
elseif ($type == 3) $target = "profile.php";
else $target = "admin_page.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Teachers</title>
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
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="./img/logo.png" alt="">
        <span>Teachers</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="tutors_page.php">Our tutors</a></li>
          <?php if (!$loggedin) { echo "<li><a class=\"getstarted scrollto\" href=\"login.php\">Log in</a></li>";}
          else { echo "<li><a class=\"getstarted scrollto\" href=\"" . $target . "\">My page</a></li>"; 
            echo "<li><a class=\"getstarted scrollto\" href=\"logout.php\">Log out</a></li>"; 
          }
          
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">With Teachers, learning is for Everyone.</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">We offer top quality tutors, in every field, for every student, at
            the best prices.</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <?php if(!$loggedin) { ?>

              <div class="text-center text-lg-start">
                <a href="student_signup.php" style="width: 300px"
                  class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Become a student</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            
              <div class="text-center text-lg-start">
                <a href="tutor_application.php" style="width: 300px"
                  class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Become a tutor</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>

            <?php } ?>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="./img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h1 style="color: #013289;font-weight: bolder;">Who We Are</h1>
              <h2 style="color:#04c2f9">Teachers is a startup aiming to link tutors and students everywhere. </h2>
              <p>
                Our aim is to provide education and academical assistancein any subject, for any price range,
                everywhere.
                Our tutors are carefully picked to ensure the academic success of our students. They are highly
                experienced and specialized in their fields!
                To make sure every student gets the best tutor for their needs, we offer <span
                  style="color: #013289;font-weight: bold;">free</span> consultation sessions to cater for any specific
                requests or needs.
              </p>
              <div class="text-center text-lg-start">
                <a class="btn btn-primary p-0 btn-read-more d-inline-flex align-items-center justify-content-center align-self-center consultation-btn"
                  data-bs-toggle="modal" data-bs-target="#add-modal">
                  <span>Request Free consultation</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="./img/about.jpg" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- Free consultation-->
    <div class="modal modal-large fade" id="add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body p-5">
            <h2 class="text-center">Consultation Request</h1>
              <form action="consultation.php" method="post">
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
                    Additional information
                  </div>
                  <div class="col-8">
                    <input class="form-control" type="text" name="information" required>
                  </div>
                </div>
                <br><br>
                <div class="modal-footer">
                  <br>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary p-0 ok-btn"  >Confirm</button>
                </div>
              </form>

          </div>
        </div>
      </div>


    </div>


    <div class="modal modal-large fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-body p-5">
           <h2 class="text-center">Your request has been submitted! You will be contacted soon to set the consultation
             details.</h1>
         </div>
         <div class="modal-footer">
           <form action="">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-primary p-0 ok-btn" data-bs-toggle="modal"
               data-bs-target="#msg-modal" data-bs-dismiss="modal" onclick="$('#editform').submit()">OK</button>
           </form>
         </div>
       </div>
     </div>
   </div>



    <!-- ======= Values Section ======= -->
    <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2 style="display: none;">Our Values</h2>
          <p>Why Choose Us</p>
        </header>

        <div class="row">

          <div class="col-lg-4">
            <div class="box" data-aos="fade-up" data-aos-delay="200">
              <img src="./img/values-1.png" class="img-fluid" alt="">
              <h3>Premium Education</h3>
              <p>"Teachers" guarantees <span style="color: #013289;font-weight: bold;">excellence</span> in education.
                subject-matter experts pre-screened, background-checked and interviewed by professional education
                consultants. They will assist you in every step of your education towards success.
              </p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="400">
              <img src="./img/values-2.png" class="img-fluid" alt="">
              <h3>Personalized Education.</h3>
              <p>With "Teachers", you can learn <span style="color: #013289;font-weight: bold;">anything.</span>You can
                either choose a course and a tutor form our website,or you contact our educational consultant who can
                provide you with the best tutor based on your subject, learning style, needs and budget.
              </p>
            </div>
          </div>





          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="600">
              <img src="./img/values-3.png" class="img-fluid" alt="">
              <h3>We are here for you.</h3>
              <p>Our students are our <span style="color: #013289;font-weight: bold;">top priority.</span> We are always
                available to listen to your feedback and cater for your needs.
                If a tutor does not show up for their session, you will be immediatly linked with a different tutor.
              </p>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Values Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4 gx-5">

          <div class="col-lg-4 col-md-12">
            <div class="count-box d-flex justify-content-center">
              <i class="bi bi-people-fill"></i>
              <div>
                <p>Over</p>
                <span data-purecounter-start="0" data-purecounter-end="200" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Learning students</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-12">
            <div class="count-box d-flex justify-content-center">
              <i class="bi bi-person-video3" style="color: #ee6c20;"></i>
              <div>
                <p>Over</p>
                <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Proficient tutors</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-12">
            <div class="count-box d-flex justify-content-center">
              <i class="bi bi-journal-bookmark-fill" style="color: #15be56;"></i>
              <div>
                <p>Over</p>
                <span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Sessions a week</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->



    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq" style="display:none;">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </header>

        <div class="row">
          <div class="col-lg-6">
            <!-- F.A.Q List 1-->
            <div class="accordion accordion-flush" id="faqlist1">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-1">
                    Non consectetur a erat nam at lectus urna duis?
                  </button>
                </h2>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur
                    gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-2">
                    Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?
                  </button>
                </h2>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id
                    donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque
                    elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-3">
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?
                  </button>
                </h2>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar
                    elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque
                    eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis
                    sed odio morbi quis
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-6">

            <!-- F.A.Q List 2-->
            <div class="accordion accordion-flush" id="faqlist2">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2-content-1">
                    Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?
                  </button>
                </h2>
                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id
                    donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque
                    elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2-content-2">
                    Tempus quam pellentesque nec nam aliquam sem et tortor consequat?
                  </button>
                </h2>
                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in.
                    Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est.
                    Purus gravida quis blandit turpis cursus in
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2-content-3">
                    Varius vel pharetra vel turpis nunc eget lorem dolor?
                  </button>
                </h2>
                <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada
                    nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut
                    venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas
                    egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>

    </section><!-- End F.A.Q Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Testimonials</h2>
          <p>What they are saying about us</p>
        </header>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>

                </p>
                <div class="profile mt-auto">
                  <img src="./img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                  <p> Math was never my favored subject at school, and in college, it only got harder. It made me doubt
                    my
                    intelligence,
                    but with "Teachers", I discovered that it only took a good tutor to become better at math. Everyone
                    has their own learning style, it is just a matter of finding a tutor that accomodates it</p>
                  <h3>Mhamad Ayoub</h3>
                  <h4>zcomputer Science student</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  I have always had a passion for music, but I was never able to play the piano on my own. I was so
                  surprised to learn that "Teachers" also offered tutors for non academic courses as well! My tutor,
                  Nancy, got me from level zero to level hero in a matter of months only!
                </p>
                <div class="profile mt-auto">
                  <img src="./img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                  <h3>Lynn L.</h3>
                  <h4>College student</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  My son, Ali, was failing his software engineering course, but "Teachers" came to the rescue! After
                  only a few sessions, his grades improved drastically, and he became much more confident in his
                  academic performance!
                  !
                </p>
                <div class="profile mt-auto">
                  <img src="./img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                  <h3>Nariman Knayber</h3>
                  <h4>Ali's mother</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  The best thing about "Teachers", is how I am able to choose everything; my preferred tutor, my set
                  budget, the number of sessions and their times etc... This has made my learning process much more
                  comfortable for me!
                </p>
                <div class="profile mt-auto">
                  <img src="./img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                  <h3>Matt Brandon</h3>
                  <h4>Highschool student</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa
                  labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                </p>
                <div class="profile mt-auto">
                  <img src="./img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                  <h3>John Larson</h3>
                  <h4>Entrepreneur</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>

        </div>

      </div>

    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">

      <div class="container" data-aos="fade-up">

        <header class="section-header row">
          <h2>Tutors</h2>
          <p>Our hard working tutors</p>
        </header>

        <div class="d-flex flex-column">
          <p class="w-75 mx-auto my-0 text-center">Here at Teachers, we pick the best of the best for our students.
            Our team of proficient and hard working tutors are always happy to assist and deliver high quality
            educational sessions. Take a look at our tutors to see who suits you best according to all your learning
            needs.</p>
          <div class="btn text-center text-lg-start row my-5">
            <a href="tutors_page.php"
              class="btn-browse d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Browse Our Tutors</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

      </div>

    </section><!-- End Team Section -->

  </main><!-- End #main -->

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
  <script src="./vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="./vendor/aos/aos.js"></script>
  <script src="./vendor/php-email-form/validate.js"></script>
  <script src="./vendor/swiper/swiper-bundle.min.js"></script>
  <script src="./vendor/purecounter/purecounter.js"></script>
  <script src="./vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./vendor/glightbox/js/glightbox.min.js"></script>
  

  <!-- Template Main JS File -->
  <script src="./js/main.js"></script>

</body>

</html>