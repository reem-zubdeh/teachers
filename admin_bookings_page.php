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

    <title>Admin - Bookings</title>
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
                    <li><a class="nav-link scrollto active" href="admin_page.php">Main Page</a></li>
                    <li><a class="nav-link scrollto" href="admin_updates.php">My updates</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Log out</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->


    <!-- CHANGE PAGE NUMBER HERE -->
    <div class="container" data-page="1">

        <br><br><br><br><br> 

        <div class="m-5 d-flex justify-content-between">
            <div></div>
            <ul class="pagination">
            <?php 
                if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                  $page_no = $_GET['page_no'];
                  } else {
                      $page_no = 1;
                      }
                

                      $query = "SELECT COUNT(*) As total_records FROM bookings";
                      $stmt1 = $connection->prepare($query);
                      $stmt1->execute();
                      $results_tutors = $stmt1->get_result();
                      $total_records = $results_tutors->fetch_assoc();



                $next_to = "2";
                $records_per_page =10;
                $offset = ($page_no-1) * $records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $stmt1 = $connection->prepare($query);
                $stmt1->execute();
                $results_tutors = $stmt1->get_result();
                $total_records = $results_tutors->fetch_assoc();
                $no_of_pages = ceil($total_records["total_records"] / $records_per_page);
                $before_last = $no_of_pages - 1;

                $query_bookings = "SELECT bookings.booking_number,students.student_id,bookings.tutor_id,bookings.course_id,users.first_name,users.last_name,bookings.starting_date,bookings.days_of_sessions from bookings INNER JOIN students on bookings.student_id=students.student_id INNER JOIN users on users.user_id=students.user_id LIMIT $records_per_page OFFSET $offset";
                $stmt = $connection->prepare($query_bookings);
                $stmt->execute();
                $results_students = $stmt->get_result();



                ?>
              <div class="pagContainer">
                <ul class="pagination">
                  <li class="page-item" <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                    <a class="page-link"aria-label="Previous" <?php if($page_no > 1){
                          echo "href='?page_no=$previous_page'";
                      } ?>><span aria-hidden="true">&laquo;</span></a>
                  </li>
                      <?php  	if ($no_of_pages <= 10){
                        for ($counter = 1; $counter <= $no_of_pages; $counter++){
                        if ($counter == $page_no) {
                          echo "<li class='page-item'><a class='page-link' >$counter</a></li>";	
                        }else{
                          echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        }
                        else if ($no_of_pages > 10){
                          if($page_no <= 4) {			
                            for ($counter = 1; $counter < 8; $counter++){		 
                             if ($counter == $page_no) {
                                echo "<li class='page-item'><a class='page-link'>$counter</a></li>";	
                               }else{
                                      echo "<li class='page-item' ><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                           }
                           }
                           echo "<li class='page-item'><a class='page-link'>...</a></li>";
                           echo "<li class='page-item'><a class='page-link' href='?page_no=$before_last'>$before_last</a></li>";
                           echo "<li class='page-item'><a class='page-link' href='?page_no=$no_of_pages'>$no_of_pages</a></li>";
                           }
                           elseif($page_no > 4 && $page_no < $no_of_pages - 4) {		 
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item'><a class='page-link' >...</a></li>";
                            for (
                                 $counter = $page_no - $next_to;
                                 $counter <= $page_no + $next_to;
                                 $counter++
                                 ) {		
                                 if ($counter == $page_no) {
                              echo "<li class='page-item'><a class='page-link'>$counter</a></li>";	
                              }else{
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                      }                  
                                   }
                            echo "<li class='page-item'><a class='page-link'>...</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$before_last'>$before_last</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$no_of_pages'>$no_of_pages</a></li>";
                            }
                            else {
                              echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                              echo "<li class='page-item'><a class='page-link' >...</a></li>";
                              for (
                                   $counter = $no_of_pages - 6;
                                   $counter <= $no_of_pages;
                                   $counter++
                                   ) {
                                   if ($counter == $page_no) {
                                echo "<li class='page-item'><a class='page-link'>$counter</a></li>";	
                                }else{
                                      echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                }                   
                                   }
                              }
                          }?>
                  <li class="page-item"<?php if($page_no >= $no_of_pages){
                      echo "class='disabled'";
                  } ?>>
                    <a class="page-link"<?php if($page_no < $no_of_pages) {
                    echo "href='?page_no=$next_page'";
                    } ?>><span aria-hidden="true">&raquo;</span></a>
                      </li>
                </ul>

                </div>


            </ul>
            <a class="btn btn-primary p-0" data-bs-toggle="modal" data-bs-target="#add-modal"><i class="bi bi-plus fs-1 lh-1"></i></a>

        </div>

        <div class="table-responsive m-5">
        
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col" onclick="sortBookingsBy(this)" name="booking">Booking ID</th>
                    <th scope="col" onclick="sortBookingsBy(this)" name="student_id">Student ID</th>
                    <th scope="col" onclick="sortBookingsBy(this)" name="student_name">Student Name</th>
                    <th scope="col" onclick="sortBookingsBy(this)" name="tutor_id">Tutor ID</th>
                    <th scope="col" onclick="sortBookingsBy(this)" name="tutor_name">Tutor Name</th>
                    <th scope="col" onclick="sortBookingsBy(this)" name="course_id">Course ID</th>
                    <th scope="col" onclick="sortBookingsBy(this)" name="course_name">Course Name</th>
                    <th scope="col" onclick="sortBookingsBy(this)" name="date">Sessions start date</th>
                    <th scope="col" onclick="sortBookingsBy(this)" name="days">Session days</th>
                    <th scope="col">Edit</th>
                </tr>
                </thead>
                <tbody>
                
                <?php

                  while($row = $results_students->fetch_assoc()){
                    $tutors_info = "";
                    $correct_dates = "";
                    $query_tutors = "SELECT users.first_name,users.last_name from tutors INNER JOIN users on tutors.user_id=users.user_id where tutors.tutor_ID = ?";
                    $stmt2 = $connection->prepare($query_tutors);
                    $stmt2->bind_param("d", $row['tutor_id']);
                    $stmt2->execute();
                    $results_tutors = $stmt2->get_result();
                    while($row2 = $results_tutors->fetch_assoc()){
                        $tutors_info .= $row2["first_name"] ." " .$row2["last_name"];
                        $courses_info = "";
                        $query_courses = "SELECT courses.course_name from courses where courses.course_ID = ?";
                        $stmt3 = $connection->prepare($query_courses);
                        $stmt3->bind_param("d", $row['course_id']);
                        $stmt3->execute();
                        $results_tutors = $stmt3->get_result();
                        while($row3 = $results_tutors->fetch_assoc()){
                            $courses_info .= $row3["course_name"];
                        }
                    }
                        if (substr($row['days_of_sessions'], 0,1)==1){
                            $correct_dates .= "Mon ";
                         }
                         if (substr($row['days_of_sessions'],1,-5)==1){
                            $correct_dates .= "Tue ";
                        }
                        if (substr($row['days_of_sessions'],2,-4)==1){
                            $correct_dates .= "Wed ";
                         }
                         if (substr($row['days_of_sessions'],3,-3)==1){
                            $correct_dates .= "Thu ";
                         }
                         if (substr($row['days_of_sessions'],4,-2)==1){
                            $correct_dates .= "Fri ";
                         }
                         if (substr($row['days_of_sessions'],5,-1)==1){
                            $correct_dates .= "Sat ";
                         }
                         if (substr($row['days_of_sessions'],6)==1){
                            $correct_dates .= "Sun ";
                         }

                        echo "<tr>
                        <td name=\"id\">".$row['booking_number']."</td>
                        <td name=\"student\">".$row['student_id']."</td>
                        <td>".$row['first_name']. " ".$row['last_name']."</td>
                        <td name=\"tutor\">".$row['tutor_id']."</td>
                        <td>".$tutors_info."</td>
                        <td name=\"course\">".$row['course_id']."</td>
                        <td>".$courses_info."</td>
                        <td name=\"date\">".$row['starting_date']."</td>
                        <td name=\"days\">".$correct_dates."</td>
                        <td> <a class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#edit-modal\" onclick=\"loadBookingData(this)\">Edit</a></td>
                        </tr>";
       
              
                }
                ?>
                
                </tbody>
            </table>
        </div>

    </div>

    <!-- Edit Modal -->

    <div class="modal modal-large fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body p-5">
                <h2 class="text-center">Edit booking</h1>
                <form  id="editform" action="edit_bookings.php" method="post" >
                    <div class="row">
                        <div class="col-4">
                            Booking ID
                        </div>
                        <div class="col-8">
                            <input readonly class="form-control" type="number" name="id">
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-4">
                            Student ID
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="number" name="student">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Tutor ID
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="number" name="tutor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Course ID
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="number" name="course">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Session start date
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="date" name="date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Session days
                        </div>
                        <div class="col-8 d-flex flex-column align-items-start m-0">
                            <div>
                                <input class="" type="checkbox" name="Mon">&ThickSpace; Monday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Tue">&ThickSpace; Tuesday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Wed">&ThickSpace; Wednesday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Thu">&ThickSpace; Thursday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Fri">&ThickSpace; Friday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Sat">&ThickSpace; Saturday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Sun">&ThickSpace; Sunday
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="$('#editform').submit()">Confirm</button>
                </form>
            </div>
          </div>
        </div>
      </div>

    <!-- End Edit Modal -->

    <div class="d-flex justify-content-center pb-0">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><a  data-bs-toggle="modal" data-bs-target="#delete-modal">Delete Booking</a></button>
    </div>
    <div class="modal modal-large fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body p-5">
                <h2 class="text-center">Delete booking</h1>
                <form action="delete_booking.php" method="post">
                    <div class="row">
                        <div class="col-4">
                            Booking Number
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="number" name="booking_id">
                        </div>
                   
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="$('#editform').submit()">Confirm</button>
            </div>
            </form>

          </div>
        </div>
      </div>

    <!-- Add Modal -->

    <div class="modal modal-large fade" id="add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body p-5">
                <h2 class="text-center">Add booking</h1>
                <form action="add_bookings_manually.php" method="post">
                    <div class="row">
                        <div class="col-4">
                            Student ID
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="number" name="student">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Tutor ID
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="number" name="tutor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Course ID
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="number" name="course">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Session start date
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="date" name="date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Session days
                        </div>
                        <div class="col-8 d-flex flex-column align-items-start m-0">
                            <div>
                                <input class="" type="checkbox" name="Mon">&ThickSpace; Monday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Tue">&ThickSpace; Tuesday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Wed">&ThickSpace; Wednesday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Thu">&ThickSpace; Thursday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Fri">&ThickSpace; Friday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Sat">&ThickSpace; Saturday
                            </div>
                            <div>
                                <input class="" type="checkbox" name="Sun">&ThickSpace; Sunday
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="$('#editform').submit()">Confirm</button>
            </div>
            </form>

          </div>
        </div>
      </div>

    <!-- End Add Modal -->

    <br><br><br><br>
    
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


<?php } else {header("Location: index.php");} ?>