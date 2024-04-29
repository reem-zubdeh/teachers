<?php


session_start();
 
// Destroying session
session_unset();
session_destroy();

header("Location: index.php");
?>