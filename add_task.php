<?php

include("connection.php");

session_start();
$id = $_SESSION["user_id"];
$my_date = date("Y-m-d H:i:s");

if(isset($_POST['title'])){
    echo("we are here");

    $title = $_POST['title'];
    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else {
        $stmt = $connection->prepare("INSERT INTO to_do_list(user_id,title,date_time) VALUE(?,?,?)");
        $stmt->bind_param("iss",$id, $title, $my_date);
        $stmt->execute();
        $res= $stmt->get_result();

        if($res){
            header("Location: todolist2.php"); 
        }else {
            header("Location: todolist2.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: todolist2.php");
}
