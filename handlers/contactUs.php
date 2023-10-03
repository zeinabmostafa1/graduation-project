<?php
include('../database/db.php');
session_start();
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert the form data into the database
    $query = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    mysqli_query($conn, $query);
    $_SESSION['Done']="Thank you for contact us ";
    header('Location: ../index.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
