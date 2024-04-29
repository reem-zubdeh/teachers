<?php 


include("connection.php");
session_start();

if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"1")==0)
{
$booking_id=$_POST["id"];
$student_id = $_POST["student"];
$tutor_id = $_POST["tutor"];
$course_id = $_POST["course"];
$date = $_POST["date"];
$days_of_sessions="";

//first step to see if student is already taking the course
$query = "SELECT * FROM bookings where booking_number!=? and student_id = ? and course_id = ? ;";
$stmt = $connection->prepare($query);
$stmt->bind_param("ddd", $booking_id,$student_id, $course_id);
$stmt->execute();
$results = $stmt->get_result(); 
$bookings_row = $results->fetch_assoc();
if (empty($bookings_row)){

    //check to see if there is such a course
    $query = "SELECT * FROM courses where  course_id = ?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("d",  $course_id);
    $stmt->execute();
    $results = $stmt->get_result(); 
    $courses_row = $results->fetch_assoc();

    //check to see if there is such a tutor
    $query = "SELECT * FROM tutors where  tutor_id = ?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("d",  $tutor_id);
    $stmt->execute();
    $results = $stmt->get_result(); 
    $tutors_row = $results->fetch_assoc();

    //check to see if there is such a student
    $query = "SELECT * FROM students where  student_id = ?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("d",  $student_id);
    $stmt->execute();
    $results = $stmt->get_result(); 
    $students_row = $results->fetch_assoc();
    if (!empty($courses_row) && !empty($tutors_row) && !empty($students_row)){
        
        if(isset($_POST["Mon"]) && $_POST["Mon"]!=""){
            $days_of_sessions .= 1;
            }
            else{
            $days_of_sessions .= 0;
    
            }
    
    
            if(isset($_POST["Tue"]) && $_POST["Tue"]!=""){
            $days_of_sessions .= 1;
            }
            else{
            $days_of_sessions .= 0;
    
            }
    
            if(isset($_POST["Wed"]) && $_POST["Wed"]!=""){
            $days_of_sessions .= 1;
            }
            else{
            $days_of_sessions .= 0;
    
            }
    
    
            if(isset($_POST["Thu"]) && $_POST["Thu"]!=""){
            $days_of_sessions .= 1;
            }
            else{
            $days_of_sessions .= 0;
    
            }
    
            if(isset($_POST["Fri"]) && $_POST["Fri"]!=""){
            $days_of_sessions .= 1;
            }
            else{
            $days_of_sessions .= 0;
    
            }
    
    
            if(isset($_POST["Sat"]) && $_POST["Sat"]!=""){
            $days_of_sessions .= 1;
            }
            else{
            $days_of_sessions .= 0;
    
            }
    
            if(isset($_POST["Sun"]) && $_POST["Sun"]!=""){
            $days_of_sessions .= 1;
            }
            else{
            $days_of_sessions .= 0;
            }
            $mysql = $connection->prepare("UPDATE bookings SET student_id=?,tutor_id=?,course_id=?,starting_date=?,days_of_sessions=? where booking_number=?;");
            $mysql->bind_param("dddssd", $student_id, $tutor_id, $course_id, $date, $days_of_sessions,$booking_id);
            ($mysql->execute());
            header('Location: admin_bookings_page.php');
    }
    else{
        die("Student,tutor or course is not in the database");

    }
}
    else{
        die("student is already taking the course");
}
}else {header("Location: index.php");}
?>