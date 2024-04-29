<?php 


include("connection.php");
session_start();

if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "" && strcmp($_SESSION["type"],"3")==0)
{
    
$id= $_SESSION["user_id"];
$email = $_POST["email"];
$phone_number = $_POST["phone"];
$price = $_POST["price"];



$query = "SELECT * FROM users where email = ?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $id);
$stmt->execute();
$results = $stmt->get_result(); 
$row = $results->fetch_assoc();
if (empty($row)){

    $query = "UPDATE users 
    set email=?,
 phone_number=?
    where user_id=?;
    ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ssd", $email,$phone_number,$id);
    $stmt->execute();

    $query = "UPDATE students 
    set price_range=?
    where user_id=?;
    ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $price,$id);
    $stmt->execute();




}

else
{

    $query = "UPDATE users 
    set phone_number=?
    where user_id=?;
    ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("si",$phone_number,$id);
    $stmt->execute();

    $query = "UPDATE students 
    set price_range=?
    where user_id=?;
    ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $price,$id);
    $stmt->execute();

}
header("Location: profile_edit.php");

 } else {header("Location: index.php");} ?>