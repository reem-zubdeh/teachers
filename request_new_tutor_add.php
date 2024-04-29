<?php
include("connection.php");
session_start();
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "" && strcmp($_SESSION["type"],"3")==0)
{

$id = $_SESSION["user_id"];

//Course Details

if(isset($_POST["education"]) && $_POST["education"] != "" ){
    $education_level_student = $_POST["education"];
}

if ($education_level_student == "college") {
    if(isset($_POST["course-name"]) && $_POST["course-name"]!=""){ //for education level = college
        $course_choice = $_POST["course-name"];
    }
}
elseif($education_level_student != "college") {
    if(isset($_POST["course"]) && $_POST["course"]!=""){ //for education levels != college
        $course_choice = $_POST["course"];
    }
}


//Tutor Details

    // if(isset($_POST["tutor"]) && $_POST["tutor"]!="" && preg_match ("/^[a-zA-z ]*$/",$_POST["tutor"])){
    //     $tutor = $_POST["tutor"];
    // }
    // elseif(isset($_POST["tutor"]) && $_POST["tutor"]!="" && !preg_match ("/^[a-zA-z ]*$/",$_POST["tutor"])){
    //     die("Only letters and white space allowed"); //Since full name, we need to allow spacing
    // }
    // else{
    //     die("Name is required.");
    // }
    if(isset($_POST["tutor"]) && $_POST["tutor"] != "" && preg_match("/^[0-9]*$/", $_POST["tutor"]) && $_POST["tutor"] >= 0){
        $tutor = $_POST["tutor"];
    }else{
        die("Error10");
    }

//Session Details

if(isset($_POST["date"]) && $_POST["date"] != "" && preg_match("/$/", $_POST["date"])){
    $starting_date = $_POST["date"];
}else if(isset($_POST["date"]) && $_POST["date"] != "" && !preg_match("/$/", $_POST["date"])){
    die("Enter correct date format");
}else{
    die("Error11");
}


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
        $price = $_POST["price"]; 
    }else if(isset($_POST["price"]) && $_POST["price"] !="" && !preg_match("/^[0-9]*$/", $_POST["price"])){
        die("Price option should be composed of numbers."); 
    }else{
        die("Price is required.");

    }

    $mysql1 = $connection->prepare("SELECT * FROM users WHERE user_id = ?");
    $mysql1->bind_param("d", $id);
    $mysql1->execute();
    $results1 = $mysql1->get_result();
    $row1 = $results1->fetch_assoc();
    if(!empty($row1)) {

    $mysql = $connection->prepare("INSERT INTO students(student_id, price_range) VALUES (?,?)");
    $mysql->bind_param("dd",$id, $price);
    $mysql->execute();


    $mysql = $connection->prepare("INSERT INTO new_tutor_requests(student_id, education_level_student, course, preferred_tutor, starting_date, days_of_sessions) VALUES (?,?,?,?,?)");
    $mysql->bind_param("dssdds",$student_id, $education_level_student,$course_choice,$tutor,$starting_date,$days_of_session);
    $mysql->execute();
    }

    if (!$mysql->execute()){
        echo ("\n");
        echo($mysql->error);
    }
    
    $mysql->close();
    $connection->close();

    // header("Location: profile.php");


} else {header("Location: index.php");}

?>