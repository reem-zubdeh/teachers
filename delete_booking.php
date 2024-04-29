<?php 


include("connection.php");
session_start();

if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"1")==0)
{
$booking_id = $_POST["booking_id"];

$query = "SELECT * FROM bookings where booking_number=?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $booking_id);
$stmt->execute();
$results = $stmt->get_result(); 
$bookings_row = $results->fetch_assoc();
if (!empty($bookings_row)){
    $query = "DELETE FROM bookings where booking_number=?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("d", $booking_id);
    $stmt->execute();
    header('Location: admin_bookings_page.php');

}
else{
    die("Booking number not available");
}}else {header("Location: index.php");}
?>