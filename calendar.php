<?php

include("connection.php");
session_start();


if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "" && strcmp($_SESSION["type"],"2")==0 || strcmp($_SESSION["type"],"3")==0)
{
$id = $_SESSION["user_id"];

if (!empty($_POST)) {

    if (isset($_POST["delete"]) && isset($_POST["id"]) && $_POST["id"] != "") {
        $event_id = $_POST["id"];
        $query= "DELETE FROM calendar WHERE user_id= ? AND item_id_calendar = ?;";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("dd", $id, $event_id);
        $stmt->execute();
    }

    else  {
        if (isset($_POST["item_name_calendar"]))$name = trim($_POST["item_name_calendar"]);
        if (isset($_POST["importance"]))$imp = +$_POST["importance"];
        if (isset($_POST["date"]))$date = trim($_POST["date"]);

        $date_arr  = explode('-', $date);

        $valid = $name != "" &&
        $imp != "" && is_int($imp) && $imp >= 0 && $imp <= 4 &&
        $date != "" && checkdate($date_arr[1], $date_arr[2], $date_arr[0]);

        if ($valid) {
            $query = "INSERT INTO calendar (user_id, item_name_calendar, importance, date) VALUES (?,?,?,?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("dsss", $id, $name, $imp, $date);
            $stmt->execute();
        }
        else {
            die ("invalid input");
        }
    }

}

$query = "SELECT * FROM calendar WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $id);
$stmt->execute();
$res = $stmt->get_result();
$json = [];
while ($row = $res->fetch_assoc()) {
    $event["id"] = $row["item_id_calendar"];
    $event["occasion"] = $row["item_name_calendar"];
    $event["flag"] = $row["importance"];
    $date = explode("-", $row["date"]);
    $event["year"] = $date[0];
    $event["month"] = $date[1];
    $event["day"] = $date[2];
    $json[] = $event;
}

$results = htmlentities("{\"events\" : " . json_encode($json, JSON_NUMERIC_CHECK) ."}");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Calendar</title>
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
    <link rel="stylesheet" href="./vendor/calendar/font-awesome.min.css">
    <link rel="stylesheet" href="./vendor/calendar/fonts.css">
    <link rel="stylesheet" href="./vendor/calendar/styles.css">
    
</head>

<body>

    <input type="hidden" id="fetched_events" value="<?php echo $results ?>" ></input>

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
                    <li><a class="nav-link scrollto active" href="calendar.php">Calendar</a></li>
                    <li><a class="nav-link scrollto " href="timer.php">Timer</a></li>
                    <li><a class="nav-link scrollto" href="pomodoro.php">Pomodoro Clock</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Log out</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <br>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="content w-100">
                        <div class="calendar-container">
                            <div class="calendar">
                                <div class="year-header">
                                    <span class="left-button" id="prev"><i class="bi bi-chevron-double-left"></i></span>
                                    <span class="year" id="label">2021</span>
                                    <span class="right-button" id="next"><i class="bi bi-chevron-double-right"></i></span>
                                </div>
                                <table class="months-table w-100">
                                    <tbody>
                                        <tr class="months-row">
                                            <td class="month">Jan</td>
                                            <td class="month">Feb</td>
                                            <td class="month">Mar</td>
                                            <td class="month">Apr</td>
                                            <td class="month">May</td>
                                            <td class="month">Jun</td>
                                            <td class="month">Jul</td>
                                            <td class="month">Aug</td>
                                            <td class="month">Sep</td>
                                            <td class="month">Oct</td>
                                            <td class="month">Nov</td>
                                            <td class="month">Dec</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="days-table w-100">
                                    <tbody>
                                        <tr>
                                            <td class="day">Sun</td>
                                            <td class="day">Mon</td>
                                            <td class="day">Tue</td>
                                            <td class="day">Wed</td>
                                            <td class="day">Thu</td>
                                            <td class="day">Fri</td>
                                            <td class="day">Sat</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="frame">
                                    <table class="dates-table w-100">
                                    <tbody class="tbody">
                                        <tr class="table-row"></tr>
                                        <tr class="table-row">
                                            <td class="table-date nil"></td>
                                            <td class="table-date">1</td>
                                            <td class="table-date">2</td>
                                            <td class="table-date">3</td>
                                            <td class="table-date">4</td>
                                            <td class="table-date">5</td>
                                            <td class="table-date">6</td>
                                        </tr>
                                        <tr class="table-row">
                                            <td class="table-date">7</td>
                                            <td class="table-date">8</td>
                                            <td class="table-date">9</td>
                                            <td class="table-date">10</td>
                                            <td class="table-date">11</td>
                                            <td class="table-date">12</td>
                                            <td class="table-date">13</td>
                                        </tr>
                                        <tr class="table-row">
                                            <td class="table-date">14</td>
                                            <td class="table-date">15</td>
                                            <td class="table-date">16</td>
                                            <td class="table-date">17</td>
                                            <td class="table-date">18</td>
                                            <td class="table-date">19</td>
                                            <td class="table-date">20</td>
                                        </tr>
                                        <tr class="table-row">
                                            <td class="table-date">21</td>
                                            <td class="table-date">22</td>
                                            <td class="table-date event-date active-date">23</td>
                                            <td class="table-date">24</td>
                                            <td class="table-date event-date">25</td>
                                            <td class="table-date">26</td>
                                            <td class="table-date">27</td>
                                        </tr>
                                        <tr class="table-row">
                                            <td class="table-date">28</td>
                                            <td class="table-date">29</td>
                                            <td class="table-date">30</td>
                                            <td class="table-date nil"></td>
                                            <td class="table-date nil"></td>
                                            <td class="table-date nil"></td>
                                            <td class="table-date nil"></td>
                                        </tr>
                                        <tr class="table-row">
                                            <td class="table-date nil"></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <button class="button" id="add-button">Add Event</button>
                            </div>
                        </div>
                        <div class="events-container">
                            <div class="event-card">
                                <div class="event-name"></div>
                                <div class="event-count"></div>
                            </div>
                        </div>
                        <div class="dialog" id="dialog" style="display: none;">
                            <h2 class="dialog-header"> Add New Event </h2>
                            <form class="form" id="form" data-user=" <?php echo $id ?>">
                                <div class="form-container">
                                    <label class="form-label" id="valueFromMyButton" for="name">Event name</label>
                                    <input name="name" class="input" type="text" id="name" maxlength="36">
                                    <label class="form-label" id="valueFromMyButton" for="flag">Flag</label>
                                    <select name="" class="input" id="flag">
                                        <option value="0" selected>Casual</option>
                                        <option value="1">Normal</option>
                                        <option value="2">Important</option>
                                        <option value="3">Urgent</option>
                                        <option value="4">Top priority</option>
                                    </select>
                                    <div class="d-flex justify-content-evenly w-100 my-4">
                                        <button type="button" class="button" id="cancel-button">Cancel</button>
                                        <button type="button" class="button button-white" id="ok-button">OK</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <br>
    
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
    <script src="./js/calendar.js"></script>
</body>


</html>


<?php } else {header("Location: index.php");} ?>