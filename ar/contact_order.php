<?php
include ('database/db.php');
session_start();

if(isset($_POST['submit'])){

    $user_id=$_POST['user_id'];
    $number=$_POST['number'];
    $order_id=$_POST['order_id'];
    $message=$_POST['message'];

        // Insert the form data into the database
        $query = "INSERT INTO orders_messages (user_id, order_id, message) VALUES ('$user_id', '$order_id', '$message')";
        mysqli_query($conn, $query);
        $_SESSION['Done']="Thank you for contact us for order number $number ";
        header('Location: orders.php');
}



?>