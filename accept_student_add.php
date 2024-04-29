<?php

include("connection.php");
$id = $_GET["id"];

$query = "SELECT * FROM new_tutor_requests 
JOIN students ON `new_tutor_requests`.`student_id` = `students`.`student_id` 
JOIN users ON `users`.`user_id` = `students`.`user_id`
WHERE `id` = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $id);
$stmt-> execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();


$query= "SELECT * FROM courses where course_name=? and course_level=?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("ss", $row["course"], $row["education_level_student"]);
$stmt->execute();
$results = $stmt->get_result(); 
$courses_row = $results->fetch_assoc();

if(empty($courses_row)){
    
    $query= "INSERT into courses(course_name,course_level) values(?,?);";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $row["course"], $row["education_level_student"]);
    $stmt->execute();

    $query2= "SELECT course_id FROM courses WHERE course_name=? AND course_level=?; ";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param("ss", $row["course"], $row["education_level_student"]);
    $stmt2->execute();
    $results = $stmt2->get_result(); 
    $courses_row = $results->fetch_assoc();
    $course_id = $courses_row["course_id"];

    
    $query3= "INSERT into bookings(student_id,tutor_id,course_id,starting_date,days_of_sessions) values(?,?,?,?,?);";
    $stmt2 = $connection->prepare($query3);
    $stmt2->bind_param("iiiss",$row["student_id"],$row["preferred_tutor"], $course_id, $row["starting_date"], $row["days_of_sessions"]);
    $stmt2->execute();

    
}
else
{
    $course_id = $courses_row["course_id"];

    $query3= "INSERT into bookings(student_id,tutor_id,course_id,starting_date,days_of_sessions) values(?,?,?,?,?);";
    $stmt2 = $connection->prepare($query3);
    $stmt2->bind_param("iiiss",$row["student_id"],$row["preferred_tutor"], $course_id, $row["starting_date"], $row["days_of_sessions"]);
    $stmt2->execute();
}


$query = "DELETE FROM new_tutor_requests where id = ?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $row["id"]);
$stmt->execute();

header('Location: admin_updates.php');
  

?>