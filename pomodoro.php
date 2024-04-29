<?php

include("connection.php");
session_start();
if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"2")==0|| strcmp($_SESSION["type"],"3")==0)
{
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pomodoro Clock</title>
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
    <link href="./css/pomodoro.css" rel="stylesheet">

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
                    <li><a class="nav-link scrollto " href="timer.php">Timer</a></li>
                    <li><a class="nav-link scrollto active" href="pomodoro.php">Pomodoro Clock</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Log out</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <br><br><br><br><br><br>




        <div id="pomodoro-app">
          <h1>Pomodoro Clock</h1>

          <div id="container">
            
            <div id="timer">
              <div id="time">
                <span id="minutes">25</span>
                <span id="colon">:</span>
                <span id="seconds">00</span>
              </div>
              <div id="filler"></div>
            </div>
        
            <div id="buttons">
              <button id="work">Work</button>
              <button id="shortBreak">Short Break</button>
              <button id="longBreak">Long Break</button>
              <button id="stop">Stop</button>
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
<script src="./vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="./vendor/aos/aos.js"></script>
<script src="./vendor/php-email-form/validate.js"></script>
<script src="./vendor/swiper/swiper-bundle.min.js"></script>
<script src="./vendor/purecounter/purecounter.js"></script>
<script src="./vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="./vendor/glightbox/js/glightbox.min.js"></script>

<!-- Template Main JS File -->
<script src="./js/main.js"></script>

<script>var pomodoro = {
  started : false,
  minutes : 0,
  seconds : 0,
  fillerHeight : 0,
  fillerIncrement : 0,
  interval : null,
  minutesDom : null,
  secondsDom : null,
  fillerDom : null,

  init : function(){
    var self = this;
    this.minutesDom = document.querySelector('#minutes');
    this.secondsDom = document.querySelector('#seconds');
    this.fillerDom = document.querySelector('#filler');
    this.interval = setInterval(function(){
      self.intervalCallback.apply(self);
    }, 1000);
    document.querySelector('#work').onclick = function(){
      self.startWork.apply(self);
    };
    document.querySelector('#shortBreak').onclick = function(){
      self.startShortBreak.apply(self);
    };
    document.querySelector('#longBreak').onclick = function(){
      self.startLongBreak.apply(self);
    };
    document.querySelector('#stop').onclick = function(){
      self.stopTimer.apply(self);
    };
  },
  resetVariables : function(mins, secs, started){
    this.minutes = mins;
    this.seconds = secs;
    this.started = started;
    this.fillerIncrement = 200/(this.minutes*60);
    this.fillerHeight = 0;  
  },
  startWork: function() {
    this.resetVariables(25, 0, true);
  },
  startShortBreak : function(){
    this.resetVariables(5, 0, true);
   
  },
  startLongBreak : function(){
    this.resetVariables(15, 0, true);
  },
  stopTimer : function(){
    this.resetVariables(25, 0, false);
    this.updateDom();

  },
  toDoubleDigit : function(num){
    if(num < 10) {
      return "0" + parseInt(num, 10);
    }
    return num;
  },
  updateDom : function(){
    this.minutesDom.innerHTML = this.toDoubleDigit(this.minutes);
    this.secondsDom.innerHTML = this.toDoubleDigit(this.seconds);
    this.fillerHeight = this.fillerHeight + this.fillerIncrement;
    this.fillerDom.style.height = this.fillerHeight + 'px';
  },
  intervalCallback : function(){
    if(!this.started) return false;
    if(this.seconds == 0) {
      if(this.minutes == 0) {
        this.timerComplete();
        return;
      }
      this.seconds = 59;
      this.minutes--;
    } else {
      this.seconds--;
    }
    this.updateDom();
  },
  timerComplete : function(){
    this.started = false;
    this.fillerHeight = 0;
    var audio = new Audio('alarm.mp3');
    audio.play();
  }
};
window.onload = function(){
pomodoro.init();
};</script>
</body>

</html>

<?php } else {header("Location: index.php");} ?>