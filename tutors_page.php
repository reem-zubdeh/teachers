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

$currentYear = date("Y");
$age = "";
$ageQ = "";
if (isset($_GET["age"])) $age = $_GET["age"]; 
switch ($age) {
  case "18-25":
      $ageQ = $currentYear-25 . " AND " . $currentYear-18;
      break;
  case "26-35":
      $ageQ = $currentYear-35 . " AND " . $currentYear-26;
      break;
  case "36-49":
      $ageQ = $currentYear-49 . " AND " . $currentYear-36;
      break;
  case "50":
      $ageQ = $currentYear-60 . " AND " . $currentYear-50;
      break;
  default:
      $ageQ = $currentYear-60 . " AND " . $currentYear-18;
}

$gender = "";
$genderQ = "";
if (isset($_GET["gender"])) $gender = $_GET["gender"];
switch ($gender) {
  case "m":
      $genderQ = "Male";
      break;
  case "f":
      $genderQ = "Female";
      break;
  case "o":
      $genderQ = "Other";
      break;
  default:
      $genderQ = "%";
}

$city = "";
$cityQ = "%";
if (isset($_GET["city"])) $city = trim($_GET["city"]);
if ($city != "") $cityQ = $city;

$education = "";
$educationQ = "";
if (isset($_GET["education"])) $education = $_GET["education"];
switch ($education) {
  case "0":
      $educationQ = "0";
      break;
  case "1":
      $educationQ = "1";
      break;
  case "2":
      $educationQ = "2";
      break;
  case "3":
      $educationQ = "3";
      break;
  default:
      $educationQ = "%";
}

$field = "";
$fieldQ = "%";
if (isset($_GET["field"])) $field = trim($_GET["field"]);
if ($field != "") $fieldQ = $field;

$years = "";
$yearsQ = "";
if (isset($_GET["years"])) $years = $_GET["years"]; 
switch ($years) {
  case "0-3":
      $yearsQ = "0 AND 3";
      break;
  case "4-6":
      $yearsQ = "4 AND 6";
      break;
  case "7-9":
      $yearsQ = "7 AND 9";
      break;
  case "10":
      $yearsQ = "10 AND 9999";
      break;
  default:
      $yearsQ = "0 AND 9999";
}

$query = "
SELECT 
tutor_id, first_name, last_name, email, phone_number, gender, years_of_experience,
education_level, major, year_born, city, college_name, profile_image, description
FROM users JOIN tutors ON `users`.`user_id` = `tutors`.`user_id` WHERE
year_born BETWEEN ". $ageQ . " 
AND
gender LIKE '". $genderQ . "' 
AND
city LIKE '". $cityQ . "' 
AND
education_level LIKE '". $educationQ . "' 
AND
major LIKE '". $fieldQ . "' 
AND
years_of_experience BETWEEN ". $yearsQ . ";";

$stmt = $connection->prepare($query);
$stmt->execute();
$res = $stmt->get_result();

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Our Tutors</title>
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
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto active" href="tutors_page.php">Our tutors</a></li>
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

    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">

      <div class="container">

        <div class="row gy-4 my-5">

          <header class="section-header p-0">
            <h2>Tutors</h2>
            <p>Our hard working tutors</p>
          </header>
  
          <div class="row my-1 p-0">
            <div class="col-11"></div>
            <div class="col-1 d-flex justify-content-around p-0">
              <button class="filter-button" onclick="clear_filters()"><i class="bi bi-x" ></i> <small style="vertical-align:top; font-variant: small-caps">clear</small></button>
            </div>
          </div>

          <div class="container my-1" id="filter-panel">
            <form action="tutors_page.php" id="filter">
              <div class="thin-container row card card-body d-flex flex-row justify-content-around p-5">
                <div class="col-12 col-md-6 p-3">
                  <span>Age</span>
                  <select name="age" id="age" onchange="this.form.submit()" class="form-select w-auto d-inline-block m-2">
                    <option value="all" <?php if ($age == "all" || $age == "") { ?> selected <?php }?> >All</option>
                    <option value="18-25" <?php if ($age == "18-25") { ?> selected <?php }?> >18-25</option>
                    <option value="26-35" <?php if ($age == "26-35") { ?> selected <?php }?> >26-35</option>
                    <option value="36-49" <?php if ($age == "36-49") { ?> selected <?php }?> >36-49</option>
                    <option value="50" <?php if ($age == "50") { ?> selected <?php }?> >50+</option>
                  </select>
                  <br>
                  <span>Gender</span>
                  <select name="gender" id="gender" onchange="this.form.submit()" class="form-select w-auto d-inline-block m-2">
                    <option value="all" <?php if ($gender == "all" || $gender == "") { ?> selected <?php }?> >All</option>
                    <option value="m" <?php if ($gender == "m") { ?> selected <?php }?> >Male</option>
                    <option value="f" <?php if ($gender == "f") { ?> selected <?php }?> >Female</option>
                    <option value="o" <?php if ($gender == "o") { ?> selected <?php }?> >Other</option>
                  </select>
                  <br>
                  <span>City</span>
                  <input type="text" name="city" id="city" placeholder="Beirut" onchange="this.form.submit()"
                  value="<?php echo $city ?>" class="form-control w-auto d-inline-block m-2">
                </div>
                <div class="col-12 col-md-6 p-3">
                  <span>Education level</span>
                  <select name="education" id="education" onchange="this.form.submit()" class="form-select w-auto d-inline-block m-2">
                    <option value="all" <?php if ($education == "all" || $education == "") { ?> selected <?php }?> >All</option>
                    <option value="0" <?php if ($education == "0") { ?> selected <?php }?> >High school</option>
                    <option value="1" <?php if ($education == "1") { ?> selected <?php }?> >College - undergraduate</option>
                    <option value="2" <?php if ($education == "2") { ?> selected <?php }?> >College - graduate</option>
                    <option value="3" <?php if ($education == "3") { ?> selected <?php }?> >Other</option>
                  </select>
                  <br>
                  <span>Field/degree</span>
                  <input type="text" name="field" id="field" placeholder="Computer Engineering" onchange="this.form.submit()"
                  value="<?php echo $field ?>" class="form-control w-auto d-inline-block m-2">
                  <br>
                  <span>Years of experience</span>
                  <select name="years" id="years" onchange="this.form.submit()" class="form-select w-auto d-inline-block m-2">
                    <option value="all" <?php if ($years == "all" || $years == "") { ?> selected <?php }?> >All</option>
                    <option value="0-3" <?php if ($years == "0-3") { ?> selected <?php }?> >0-3</option>
                    <option value="4-6" <?php if ($years == "4-6") { ?> selected <?php }?> >4-6</option>
                    <option value="7-9" <?php if ($years == "7-9") { ?> selected <?php }?> >7-9</option>
                    <option value="10" <?php if ($years == "10") { ?> selected <?php }?> >10+</option>
                  </select>
                </div>
              </div>
            </form>
          </div>

          

          <?php
          while($r = $res->fetch_assoc()) { 
            
            $id = $r["tutor_id"];
            $name = $r["first_name"] ." ". $r["last_name"];
            $email = $r["email"];
            $phone = "+" . $r["phone_number"];
            $gender = $r["gender"];
            $years = $r["years_of_experience"];
            $education = "";
                switch ($r["education_level"]) {
                  case "0":
                      $education = "High school degree";
                      break;
                  case "1":
                      $education = "Undergraduate degree";
                      break;
                  case "2":
                      $education = "Graduate degree";
                      break;
                  case "3":
                      $education = "Degree";
                      break;
                }
            $field = $r["major"];
            $age = date("Y") - $r["year_born"];
            $city = $r["city"];
            $school = $r["college_name"];
            $image = "tutor_image/".$r["profile_image"];
            $description = $r["description"];
            $courses = "";

                $query = "SELECT * FROM `tutor_courses` JOIN `courses` ON `tutor_courses`.`course_id` = `courses`.`course_id`
                WHERE `tutor_id` = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("d", $id);
                $stmt->execute();
                $res2 = $stmt->get_result();
                while ($r2 = $res2->fetch_assoc()) {
                  $courses .= $r2["course_name"] ." - " .$r2["course_level"] . "<br>";
                }
            
            ?>

              <div class="col-lg-3 col-md-6 d-flex align-items-stretch my-5">
                <div class="member">
                  <div class="member-img">
                    <img src="<?php echo ($image); ?>" class="img-fluid" alt="">
                  </div>
                  <div class="member-info">
                    <h4><?php echo $name ?></h4>
                    <span><?php echo $email ?></span>
                    <span><?php echo $phone ?></span>
                    <span><?php echo $city ?></span>
                    <p>
                    <?php echo $age ?> years old - <?php echo $gender ?> <br>
                    <?php echo $years ?> years of experience <br>
                    <?php echo $education ?> at <?php echo $school ?> <br>
                    Main field of study: <?php echo $field ?> <br>
                    Teaches the following courses: <br>
                    <?php echo $courses ?> <br>
                    <?php echo $description ?>
                    </p>
                  </div>
                </div>
              </div>



          <?php }?>

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

