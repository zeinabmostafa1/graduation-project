<?php
session_start();

if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    unset($_SESSION['user_id']);
    unset($_SESSION['cart']);

    session_destroy();
    session_unset();
    header("location: ../index.php");
}


?>