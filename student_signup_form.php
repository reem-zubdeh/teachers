<?php

include("connection.php");

//Personal Information

if (isset($_POST["first_name"]) && $_POST["first_name"] != "" && preg_match("/^[a-zA-z]*$/", $_POST["first_name"])){
    $first_name = $_POST["first_name"]; //check variable is set and not null && make sure input is composed of only alphabets
}else if (isset($_POST["first_name"]) && $_POST["first_name"] != "" && !preg_match("/^[a-zA-z]*$/", $_POST["first_name"])) {
    die("First name should only contain alphabets."); //if input is not made of alphabets then it prints out this message
}else{
    die("Error1");
}

if(isset($_POST["last_name"]) && $_POST["last_name"] != "" && preg_match("/^[a-zA-z]*$/", $_POST["last_name"])){
    $last_name = $_POST["last_name"]; //check variable is set and not null && make sure input is composed of only alphabets
}else if (isset($_POST["last_name"]) && $_POST["first_name"] != "" && !preg_match("/^[a-zA-z]*$/", $_POST["last_name"])) {
    die("Last name should only contain alphabets."); //if input is not made of alphabets then it prints out this message
}else{
    die("Error2");
}

if(isset($_POST["phone_number"]) && $_POST["phone_number"] !="" && preg_match("/^[0-9]*$/", $_POST["phone_number"])){
    $phone_number = $_POST["phone_number"]; //check variable is set and not null && make sure input is composed of only numbers
}else if(isset($_POST["phone_number"]) && $_POST["phone_number"] !="" && !preg_match("/^[0-9]*$/", $_POST["phone_number"])){
    die("Phone number should contain numbers only."); //if input is not composed of only numbers it wont be accepted
}else{
    die("Error3");
}

if(isset($_POST["email_address"]) && $_POST["email_address"]!="" && filter_var($_POST["email_address"], FILTER_VALIDATE_EMAIL)){
    $email_address = $_POST["email_address"];
}else if(isset($_POST["email_address"]) && $_POST["email_address"]!="" && !filter_var($_POST["email_address"], FILTER_VALIDATE_EMAIL)){
    die("Incorrect email format.");
}else{
    die("Error4");
}


if(isset($_POST["password"]) && $_POST["password"] != "" && preg_match('@[A-Z]@', $_POST["password"]) && preg_match('@[a-z]@',  $_POST["password"]) && preg_match('@[0-9]@',  $_POST["password"]) && preg_match('@[^\w]@',  $_POST["password"]) && strlen($_POST["password"]) > 7 && strlen($_POST["password"]) < 21){
    $password = hash("sha256",$_POST["password"]);//check variable is set and not null && accepts these symbols for the password composition and hashes the password for extra security
}else if(isset($_POST["password"]) && $_POST["password"] != "" && !preg_match('@[A-Z]@', $_POST["password"]) || !preg_match('@[a-z]@',  $_POST["password"]) || !preg_match('@[0-9]@',  $_POST["password"]) || !preg_match('@[^\w]@',  $_POST["password"]) || strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20){
    die("Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.");
}else{
    die("Error5");
}

//Course Details

if(isset($_POST["education"]) && $_POST["education"] != "" ){
    $education_level_student = $_POST["education"];
}else{
    die("Error6");
}
   

if ($education_level_student == "college") {
    if(isset($_POST["course-name"]) && $_POST["course-name"]!=""){ //for education level = college
        $course_choice = $_POST["course-name"];
    }else{
        die("Error7");
    }
}
elseif($education_level_student != "college") {
    if(isset($_POST["course"]) && $_POST["course"]!=""){ //for education levels != college
        $course_choice = $_POST["course"];
    }else{
        die("Error8");
    }
}
else{
    die("Error9");
}


//Tutor Details

if(isset($_POST["tutor"]) && $_POST["tutor"] != "" && preg_match("/^[0-9]*$/", $_POST["tutor"]) && $_POST["tutor"] >= 0){
    $tutor = $_POST["tutor"];
}else{
    die("Error10");
}

//Session Details


if(isset($_POST["date"]) && $_POST["date"] != "" && preg_match("/$/", $_POST["date"])){
    $date = $_POST["date"];
}else if(isset($_POST["date"]) && $_POST["date"] != "" && !preg_match("/$/", $_POST["date"])){
    die("Enter correct date format");
}else{
    die("Error11");
}



//come back to do the dates

$days_of_session = "";

if(isset($_POST["monday"]) && $_POST["monday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}


if(isset($_POST["tuesday"]) && $_POST["tuesday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}

if(isset($_POST["wednesday"]) && $_POST["wednesday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}


if(isset($_POST["thursday"]) && $_POST["thursday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}

if(isset($_POST["friday"]) && $_POST["friday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}


if(isset($_POST["saturday"]) && $_POST["saturday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}

if(isset($_POST["sunday"]) && $_POST["sunday"]!=""){
    $days_of_session .= 1;
}
else{
    $days_of_session .= 0;

}


if ($_POST["sunday"]="" && $_POST["saturday"]="" && $_POST["friday"]="" && $_POST["thursday"]="" && $_POST["tuesday"]="" &&$_POST["monday"]=""){
    //Blank string, add error to $errors array.        
    $errors['nodate'] = "Please let us know your prefered tutoring dates!";
}       

if(isset($_POST["price"]) && $_POST["price"] !="" && preg_match("/^[0-9]*$/", $_POST["price"])){
    $price = $_POST["price"]; //check variable is set and not null && make sure input is composed of only numbers
}else if(isset($_POST["price"]) && $_POST["price"] !="" && !preg_match("/^[0-9]*$/", $_POST["price"])){
    die("Price option should be composed of numbers."); //if input is not composed of only numbers it wont be accepted
}else{
    die("Error12");

}




    $mysql1 = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $mysql1->bind_param("s", $email_address);
    $mysql1->execute();
    $results1 = $mysql1->get_result();
    $row1 = $results1->fetch_assoc();
    if(empty($row1)) {
        $mysql2 = $connection->prepare("SELECT * FROM pending_students WHERE email = ?");
        $mysql2->bind_param("s", $email_address);
        $mysql2->execute();
        $results2 = $mysql2->get_result();
        $row2 = $results2->fetch_assoc();
      }else {  
       die("Email already exists");
      }
       if(empty($row2)) {
        $mysql3 = $connection->prepare("SELECT * FROM pending_tutors WHERE email = ?");
        $mysql3->bind_param("s", $email_address);
        $mysql3->execute();
        $results3 = $mysql3->get_result();
        $row3 = $results3->fetch_assoc();
    }else {  
        die("Email already exists");
       }
       if(empty($row3)) {
        $mysql = $connection->prepare("INSERT INTO pending_students(first_name,last_name,phone_number,email,password,education_level_student,course,preferred_tutor,starting_date,days_of_sessions,price) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $mysql->bind_param("sssssssdssd",$first_name,$last_name,$phone_number,$email_address,$password,$education_level_student,$course_choice,$tutor,$date,$days_of_session,$price);
       }else {  
            die("Email already exists");
           }
        if (!$mysql->execute()){
            echo ("\n");
            echo($mysql->error);
        }
        echo $connection->error;
        $mysql->close();
        $connection->close();
        
        
     header("Location: index.php");

?>