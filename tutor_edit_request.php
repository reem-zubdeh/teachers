<?php

include("connection.php");
session_start();

$id=$_SESSION["user_id"];


$email = $_POST["email"];
$phone= $_POST["phone_number"];
$description= $_POST["description"];
$city = $_POST["city"];
$id2= $_POST["id"];

$query= "SELECT * from  tutor_edit_requests where user_id=?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();
if(empty($row)){


if (isset($_FILES["img_file"]) && $_FILES["img_file"]["error"] != UPLOAD_ERR_NO_FILE) {
    $img_file = (str_replace(".", "", microtime(true)));
    $ext = pathinfo($_FILES["img_file"]["name"], PATHINFO_EXTENSION);
    $img_file = $img_file . "." . $ext;

    $tempname = $_FILES["img_file"]["tmp_name"];
    
    $folder = __DIR__ ."\\pending\\".$img_file;
    
    $mime = mime_content_type($tempname);
    $type = substr($mime, 0, strpos($mime, "/")); //make sure file uploaded is image
    
    if ((strcasecmp($type, "image") == 0)) {
        if (!move_uploaded_file($tempname, $folder))  {
            die("Error in saving image file to server, try again");
        }
    }
    else {
        die("Invalid image file.");
    }
} else {
    die("Error 26");
}


$query= "INSERT into tutor_edit_requests(user_id,email,phone_number,city,profile_image,description) values (?,?,?,?,?,?);";
$stmt = $connection->prepare($query);
$stmt->bind_param("isssss", $id, $email,$phone,$city,$img_file,$description);
$stmt->execute();


$query2= "SELECT * from users where user_id=?;";
$stmt2 = $connection->prepare($query2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$results2 = $stmt2->get_result();
$row2 = $results2->fetch_assoc();


$to_email = "yara.chahine@lau.edu";
$subject = "Teachers Tutor Edit Request";
$body = "Hello Admin! A new profile edit request from". $row2['first_name'].  $row2['last_name'] . "is waiting for you.";
$headers = "From: yarachahine77@gmail.com";
 
mail($to_email, $subject, $body, $headers);

header("Location: tutor_edit_succes.php");

}
else
{
    header("Location: tutor_edit_fail.php");

}

?>