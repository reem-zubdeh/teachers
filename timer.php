<?php
include("connection.php");
session_start();
if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"2")==0 || strcmp($_SESSION["type"],"3")==0)
{

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Timer</title>
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
                    <li><a class="nav-link scrollto active" href="timer.php">Timer</a></li>
                    <li><a class="nav-link scrollto" href="pomodoro.php">Pomodoro Clock</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Log out</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <br><br><br><br><br><br>



    <div class="timer">
        <h1>Timer</h1>
        <form class="  form-time">
            <label for="hours">Hours:</label>
            <input class="inpt" type="number" min="0" max="24" name="hours" size="3" id="hrs" value="0" >
            <label for="minutes">Minutes: </label>
            <input type="number" step="1" min="0" max="60" name="minutes" id="minutes" value="0" >
            <label for="seconds">Seconds:</label>
            <input type="number" step="5" min="0" max="60" name="seconds" id="seconds" value="0">
            <p id="demo">0h 0m 0s</p>
            <div class="buttons-flex">
            <button type="button" onclick="start()" class="start-btn">Start</button>
            <button type="button" onclick="pause()">||</button>
            <button type="button" onclick="resume()" >&#9655;</button>
            <button type="button" onclick="stop()" class="start-btn" >Stop</button>

        </div>
        </form>
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




    <script>
            var hours   ;
            var minutes ;
            var seconds ;
            var hrs     ;
            var mins    ;
            var time    ;
            var t;
            var audio = new Audio('alarm.mp3');

        function start() {
            audio.pause();
             hours = parseInt(document.getElementById("hrs").value);//.toString();
             minutes = parseInt(document.getElementById("minutes").value);//toString();
             seconds = parseInt(document.getElementById("seconds").value);//toString();
            if (hours>24 || hours<0){
                window.alert("Caution : Please enter an Hour value between 0 and 24. ");
                return;
            }
            else{
                if(minutes>60 || minutes<0){
                    window.alert("Caution : Please enter a Minutes value between 0 and 60. ");
                    return;
                }
                else{
                    if(seconds>60 || seconds<0){
                        window.alert("Caution : Please enter a Seconds value between 0 and 24. ");
                        return;
                    }
                }
            }

             var interval=1000;

       console.log(hours, minutes, seconds);
             hrs = hours * 60 *60;
             mins = minutes*60 ;
             time = hrs + mins + seconds;

            console.log(time);
            // Set the date we're counting down to
            clearInterval(t);
            t=setInterval(updateCountdown, interval);
            function updateCountdown() {
                if(time>=0){

                var hours = Math.floor(time / (60 * 60));
                var t=time-(hours*60*60);
                var minutes = Math.floor(t / 60);
                var seconds = time % 60;

                document.getElementById("demo").innerHTML = hours + "h "
                    + minutes + "m " + seconds + "s ";
                time--;
                if (time<0){
                    audio.play();

                    clearInterval(t);
                }
            }
              
                }
            
           

             
               

            }
           


        
        function stop() {
            clearInterval(t);
            audio.pause();
            document.getElementById("demo").innerHTML =  "0h 0m 0s";
            time=0;

        }

        function pause(){
            clearInterval(t);
        }
        function resume(){
            clearInterval(t);
            t=setInterval(updateCountdown, 1000);
            function updateCountdown() {
                if(time>=0){

                var hours = Math.floor(time / (60 * 60));
                var t=time-(hours*60*60);
                var minutes = Math.floor(t / 60);
                var seconds = time % 60;

                document.getElementById("demo").innerHTML = hours + "h "
                    + minutes + "m " + seconds + "s ";
                time--;
                if (time<0){
                    audio.play();

                    clearInterval(t);
                }}

        }
    }
    </script>
</body>

</html>
<?php } else {header("Location: index.php");} ?>