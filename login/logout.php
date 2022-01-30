<?php 

session_start();
session_destroy();

header("Location: /DataBase_Project/index.php");

?>