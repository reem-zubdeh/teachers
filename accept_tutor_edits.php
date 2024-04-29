<?php

include("connection.php");
session_start();
if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"1")==0)
{
  if (isset($_GET["id"])) {
  $id = $_GET["id"];
    
    echo($id);
  $query= "SELECT * from tutor_edit_requests where user_id=?;";
  $stmt= $connection->prepare($query);
  $stmt->bind_param("i",$id);
  $stmt->execute();
  $results = $stmt->get_result();
$row = $results->fetch_assoc();


$query2= "UPDATE  users 
SET 
    email = ?,
    phone_number = ?
WHERE
    user_id=? ;";
$stmt2= $connection->prepare($query2);
$stmt2->bind_param("ssi",$row["email"],$row["phone_number"],$id);
$stmt2->execute();


$query3= "UPDATE  tutors 
SET 
    city = ?,
    description = ?,
    profile_image = ?
WHERE
    user_id=?;";
$stmt3= $connection->prepare($query3);
$stmt3->bind_param("sssi",$row["city"],$row["description"],$row["profile_image"],$id);
$stmt3->execute();

$folder_old =__DIR__."\\pending\\".$row['profile_image'];
$folder_new =__DIR__."\\tutor_image\\".$row['profile_image'];
rename($folder_old,$folder_new);

$query4= "DELETE FROM tutor_edit_requests WHERE
    user_id=?;";
$stmt4= $connection->prepare($query4);
$stmt4->bind_param("i",$id);
$stmt4->execute();





  } else die ("no tutor application selected");
} else {header("Location: index.php");}
?>
