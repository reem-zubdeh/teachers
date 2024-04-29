<?php 


include("connection.php");

$error=false;


    if(isset($_POST["first"]) && $_POST["first"]!="" && preg_match ("/^[a-zA-z]*$/",$_POST["first"])){
      $firstname = $_POST["first"];
  }else if(isset($_POST["first"]) && $_POST["first"]==""  || !preg_match ("/^[a-zA-z]*$/",$_POST["first"])){
      header("Location: error_pages/name.html");
      $error=true;
  }else{
        header("Location: error_pages/allfields.html");
        $error=true;
  }


  if(isset($_POST["last"]) && $_POST["last"]!="" && preg_match ("/^[a-zA-z]*$/",$_POST["last"])){
    $lastname = $_POST["last"];
}else if(isset($_POST["last"]) && $_POST["last"]==""  || !preg_match ("/^[a-zA-z]*$/",$_POST["last"])){
    header("Location: error_pages/name.html");
    $error=true;
}else{
      header("Location: error_pages/allfields.html");
      $error=true;
}
  
  if(isset($_POST["phone"]) && $_POST["phone"]!="" && preg_match("/^[0-9]*$/", $_POST["phone"])){
    $phone = $_POST["phone"];
  }else if(isset($_POST["phone"]) && $_POST["phone"]!="" && !preg_match("/^[0-9]*$/", $_POST["phone"])){
    header("Location: error_pages/phone.html");
    $error=true;

  }else{
  
        header("Location: error_pages/allfields.html");
        $error=true;
    
      }
    
  if(isset($_POST["email"]) && $_POST["email"]!="" && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $email = $_POST["email"];
  }else if(isset($_POST["email"]) && $_POST["email"]!="" && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    header("Location: error_pages/email.html");
    $error=true;

  }
  else {
    header("Location: error_pages/allfields.html");
    $error=true;
  }


  if(isset($_POST["information"]) && $_POST["information"]!="" ){
    $information = $_POST["information"];
  }else {
    header("Location: error_pages/allfields.html");
    $error=true;

  }



if ($error==false){
//We should check if tutor already in database;
$query= "INSERT into consultations(first_name,last_name,email_address,phone_number,information) values (?,?,?,?,?);";
$stmt = $connection->prepare($query);
$stmt->bind_param("sssss", $firstname, $lastname, $email,$phone,$information);
$stmt->execute();



$to_email = "yara.chahine@lau.edu";
$subject = "Teachers Consultation Request";
$body = "Hello Admin! You have a new consultation request from $firstname $lastname.";
$headers = "From: yarachahine77@gmail.com";
 
mail($to_email, $subject, $body, $headers);


header("Location: success.html");
}



?>