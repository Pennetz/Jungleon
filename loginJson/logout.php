<?php
	session_start();
    unset($_SESSION["name"]);    
    unset($_SESSION["role"]);
    unset($_SESSION["color"]);
    session_destroy();
    
    header("location:./index.php");
    exit();
?>
