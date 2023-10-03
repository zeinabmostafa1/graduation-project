<?php

include('../database/db.php');
session_start();
$errors=[];

    if (isset($_POST['submit'])) {

        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);

        // check if admin with the same username or email already exists
        $query = "SELECT * FROM admin WHERE username = '$username' OR email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // admin with the same username or email already exists
            $errors[] = "Admin with the same username or email already exists.";
            header("Location: ../admin/addadmin.php");
        } else {
            // insert new admin into database
            $query = "INSERT INTO admin (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";
            mysqli_query($conn, $query);
            $_SESSION['Done']= "Admin added successfully!";
            header("Location: ../admin/addadmin.php");
        }
    }
?>
