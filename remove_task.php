<?php
include("connection.php");
session_start();
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "" && strcmp($_SESSION["type"],"2")==0 || strcmp($_SESSION["type"],"3")==0)
{

$id = $_SESSION["user_id"];
if(isset($_POST['id'])){
    include("connection.php");

    $id = $_POST['id'];

    if(empty($id)){
       echo 0;
    }else {
        $stmt = $connection->prepare("DELETE FROM to_do_list WHERE id=?");
      

        $stmt->bind_param("i",$id);
        $stmt->execute();
        $res= $stmt->get_result();

        if($res){
            echo 1;
        }else {
            echo 0;
        }
        $connection = null;
        exit();
    }
}else {
    header("Location: todolist2.php");
}
} else {header("Location: index.php");}
