<?php

include("connection.php");
$id = $_GET["id"];


$query = "DELETE FROM new_tutor_requests where id = ?;";
$stmt = $connection->prepare($query);
$stmt->bind_param("d", $id);
$stmt->execute();


header("Location: admin_updates.php");
?>