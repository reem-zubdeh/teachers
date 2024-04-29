<?php

include("connection.php");
session_start();
if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"1")==0)
{
$id = $_GET["id"];

$query = "INSERT INTO bookings(starting_date, days_of_sessions) VALUES (?,?);";
$stmt = $connection->prepare($query);
$stmt->bind_param("ss",$starting_date,$days_of_sessions);
$stmt->execute();

$query2 = "INSERT INTO students(education_level_student, course, preferred_tutor) VALUES (?,?,?);";
$stmt = $connection->prepare($query2);
$stmt->bind_param("sss",$education_level_student,$course, $preferred_tutor);
$stmt->execute();


$query = "DELETE FROM new_tutor_requests where id=$id";
$stmt = $connection->prepare($query);
$stmt->execute();



header("Location: admin_updates.php");
} else {header("Location: index.php");}
?>