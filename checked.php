<?php

if(isset($_POST['id'])){
    include("connection.php");
    

    $id = $_POST['id'];

    if(empty($id)){
       echo 'error';
    }else {
        $todos = $connection->prepare("SELECT id, checked FROM todo WHERE id=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $connection->query("UPDATE todo SET checked=$uChecked WHERE id=$uId");

        if($res){
            echo $res["checked"];
        }else {
            echo "error";
        }
        $connection= null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}