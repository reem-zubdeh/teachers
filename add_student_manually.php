<?php 


include("connection.php");
session_start();

if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"1")==0)
{


$firstname = $_POST["first"];
$lastname = $_POST["last"];
$email = $_POST["email"];
$password = hash("sha256",$_POST["password"]);
$phone= $_POST["phone"];
$price= $_POST["price"];

$query= "SELECT * from students INNER JOIN users on students.user_id=users.user_id where email=?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$results = $stmt->get_result(); 
$student= $results->fetch_assoc();
if(empty($student)){
    $mysql = $connection->prepare("INSERT INTO users (type, first_name, last_name,email, phone_number, password) VALUES (3, ?,?,?,?,?);");
    $mysql->bind_param("sssss", $firstname, $lastname, $email, $phone, $password);
    $mysql->execute();

    //before adding to students table we must get the user_id


    $query= "SELECT user_id FROM users where email= ?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $results = $stmt->get_result(); 
    $student_id= $results->fetch_assoc();

    //now we can add to students table
    $mysql = $connection->prepare("INSERT INTO students (user_id, price_range)
     VALUES (?, ?);");
    $mysql->bind_param("dd", $student_id["user_id"], $price);
    ($mysql->execute());
    header('Location: admin_students_page.php');

}
else{
    die("Student account already exists");
}
}
else {header("Location: index.php");}

?>