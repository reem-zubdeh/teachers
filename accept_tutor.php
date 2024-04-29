<?php

include("connection.php");
session_start();

if (isset($_SESSION["user_id"])&& strcmp($_SESSION["type"],"1")==0)
{

    
$id = $_GET["id"];


$query = "SELECT * FROM  pending_tutors where temp_user_id=$id";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result(); 
$row = $results->fetch_assoc();


//We should check if tutor already in database;
$query= "SELECT * FROM users where email= ?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $row["email"]);
$stmt->execute();
$results = $stmt->get_result(); 
$tutor_row = $results->fetch_assoc();

//if not then we add tutor
if (empty($tutor_row)) {

$mysql = $connection->prepare("INSERT INTO users (type, first_name, last_name,email, phone_number, password) VALUES (2, ?, ?, ?,?,?);");
$mysql->bind_param("sssss", $row["first_name"], $row["last_name"], $row["email"], $row["phone_number"], $row["password"]);
$mysql->execute();

$to_email = $row["email"];
$subject = "Welcome to Teachers!";
$body = "
Dear ".$row["first_name"]." ".$row["last_name"]. ",

Congratulations and welcome to Teachers!

We are happy to inform you that you have been accepted as a tutor at Teachers. The selection process at Teachers is highly selective, so you should be proud! Please stay tuned this week as you will be receving an email with your orientation session details.

Please note that you can now login to your profile on our website with the credentials that you have applied with. Do not forget to use your productivity tools to boost your workflow!

Happy Teaching!
Best,
Teachers.";
    $headers = "From: yarachahine77@gmail.com";
    
    mail($to_email, $subject, $body, $headers);


//we need to get user id before we add to tutors table
$query= "SELECT user_id FROM users where email= ?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $row["email"]);
$stmt->execute();
$results = $stmt->get_result(); 
$tutor_id= $results->fetch_assoc();

//adding to tutors table
$mysql = $connection->prepare("INSERT INTO tutors ( user_id, gender,years_of_experience,education_level ,major,	year_born ,city,college_name ,cv ,profile_image ,description)
 VALUES (?, ?, ?, ?,?,?,?,?,?,?,?);");
$mysql->bind_param("issssisssss", $tutor_id["user_id"], $row["gender"], $row["years_of_experience"], $row["education_level_tutor"], $row["field"],$row["year_born"],$row["city"],$row["educational_institution_name"], $row["cv"],$row["image"],$row["description"]);
($mysql->execute());
$folder_old =__DIR__."\\pending\\".$row["image"];
$folder_new =__DIR__."\\tutor_image\\".$row["image"];
rename($folder_old,$folder_new);

$query_id="SELECT tutor_ID from tutors where user_id=?;";
$stmt = $connection->prepare($query_id);
$stmt->bind_param("i", $tutor_id["user_id"]);
$stmt->execute();
$results = $stmt->get_result(); 
$tutor_id = $results->fetch_assoc();



$query= "SELECT * FROM courses where course_name=? and course_level=?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("ss", $row["course_1"], $row["course_level_1"]);
$stmt->execute();
$results = $stmt->get_result(); 
$courses_row = $results->fetch_assoc();

if(empty($courses_row)){
    
    $query= "INSERT into courses(course_name,course_level) values(?,?);";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $row["course_1"], $row["course_level_1"]);
    $stmt->execute();

    $query2= "SELECT course_id from courses where course_name=?; ";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param("s", $row["course_1"]);
    $stmt2->execute();
    $results = $stmt2->get_result(); 
    $course_id = $results->fetch_assoc();


    $query3= "INSERT into tutor_courses(course_id, tutor_id) values(?,?);";
    $stmt2 = $connection->prepare($query3);
    $stmt2->bind_param("ii", $course_id["course_id"], $tutor_id["tutor_ID"]);
    $stmt2->execute();

}
else
{
    
    $query2= "SELECT course_id from courses where course_name=?; ";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param("s", $row["course_1"]); 
    $stmt2->execute();
    $results = $stmt2->get_result(); 
    $course_id = $results->fetch_assoc();


    $query3= "INSERT into tutor_courses(course_id, tutor_id) values(?,?);";
    $stmt2 = $connection->prepare($query3);
    $stmt2->bind_param("ii", $course_id["course_id"], $tutor_id["tutor_ID"]);
    $stmt2->execute();
}

if ((strcasecmp($row["course_2"], "none") != 0)){
    $query= "SELECT * FROM courses where course_name=? and course_level=?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $row["course_2"], $row["course_level_2"]);
    $stmt->execute();
    $results = $stmt->get_result(); 
    $courses_row = $results->fetch_assoc();
    if (empty($courses_row)){
        $query= "INSERT into courses(course_name,course_level) values(?,?);";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss", $row["course_2"], $row["course_level_2"]);
        $stmt->execute();
        
        $query2= "SELECT course_id from courses where course_name=?; ";
        $stmt2 = $connection->prepare($query2);
        $stmt2->bind_param("s", $row["course_2"]);
        $stmt2->execute();
        $results = $stmt2->get_result(); 
        $course_id = $results->fetch_assoc();


        $query3= "INSERT into tutor_courses(course_id, tutor_id) values(?,?);";
        $stmt2 = $connection->prepare($query3);
        $stmt2->bind_param("ii", $course_id["course_id"], $tutor_id["tutor_ID"]);
        $stmt2->execute();
    }
    else
    {
        
    $query2= "SELECT course_id from courses where course_name=?; ";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param("s", $row["course_2"]);
    $stmt2->execute();
    $results = $stmt2->get_result(); 
    $course_id = $results->fetch_assoc();


    $query3= "INSERT into tutor_courses(course_id, tutor_id) values(?,?);";
    $stmt2 = $connection->prepare($query3);
    $stmt2->bind_param("ii", $course_id["course_id"], $tutor_id["tutor_ID"]);
    $stmt2->execute();
    }

}
if ((strcasecmp($row["course_3"], "none") != 0)){
    $query= "SELECT * FROM courses where course_name=? and course_level=?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $row["course_3"], $row["course_level_3"]);
    $stmt->execute();
    $results = $stmt->get_result(); 
    $courses_row = $results->fetch_assoc();
    if (empty($courses_row)){
        $query= "INSERT into courses(course_name,course_level) values(?,?);";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss", $row["course_3"], $row["course_level_3"]);
        $stmt->execute();
        
        $query2= "SELECT course_id from courses where course_name=?; ";
        $stmt2 = $connection->prepare($query2);
        $stmt2->bind_param("s", $row["course_3"]);
        $stmt2->execute();
        $results = $stmt2->get_result(); 
        $course_id = $results->fetch_assoc();


        $query3= "INSERT into tutor_courses(course_id, tutor_id) values(?,?);";
        $stmt2 = $connection->prepare($query3);
        $stmt2->bind_param("ii", $course_id["course_id"], $tutor_id["tutor_ID"]);
        $stmt2->execute();
    }
    else
    {
        
        $query2= "SELECT course_id from courses where course_name=?; ";
        $stmt2 = $connection->prepare($query2);
        $stmt2->bind_param("s", $row["course_3"]);
        $stmt2->execute();
        $results = $stmt2->get_result(); 
        $course_id = $results->fetch_assoc();


        $query3= "INSERT into tutor_courses(course_id, tutor_id) values(?,?);";
        $stmt2 = $connection->prepare($query3);
        $stmt2->bind_param("ii", $course_id["course_id"], $tutor_id["tutor_ID"]);
        $stmt2->execute();
    }

}

if ((strcasecmp($row["course_4"], "none") != 0)){
    $query= "SELECT * FROM courses where course_name=? and course_level=?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $row["course_4"], $row["course_level_4"]);
    $stmt->execute();
    $results = $stmt->get_result(); 
    $courses_row = $results->fetch_assoc();
    if (empty($courses_row)){
        $query= "INSERT into courses(course_name,course_level) values(?,?);";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss", $row["course_4"], $row["course_level_4"]);
        $stmt->execute();

            
        $query2= "SELECT course_id from courses where course_name=?; ";
        $stmt2 = $connection->prepare($query2);
        $stmt2->bind_param("s", $row["course_4"]);
        $stmt2->execute();
        $results = $stmt2->get_result(); 
        $course_id = $results->fetch_assoc();


        $query3= "INSERT into tutor_courses(course_id, tutor_id) values(?,?);";
        $stmt2 = $connection->prepare($query3);
        $stmt2->bind_param("ii", $course_id["course_id"], $tutor_id["tutor_ID"]);
        $stmt2->execute();
    }
    else
    {
        
    $query2= "SELECT course_id from courses where course_name=?; ";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param("s", $row["course_4"]);
    $stmt2->execute();
    $results = $stmt2->get_result(); 
    $course_id = $results->fetch_assoc();


    $query3= "INSERT into tutor_courses(course_id, tutor_id) values(?,?);";
    $stmt2 = $connection->prepare($query3);
    $stmt2->bind_param("ii", $course_id["course_id"], $tutor_id["tutor_ID"]);
    $stmt2->execute();
    }

}
//removing from pending tutors 

$query= "DELETE FROM pending_tutors where temp_user_id= ?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $row["temp_user_id"]);
$stmt->execute();






header('Location: admin_updates.php');




}
else
{
    die("<br>Tutor already in database");
}
} else {header("Location: index.php");}
?>





