<?php
session_start();
include('../database/db.php');

if (isset($_POST['submit'])) {
    $identifier = $_POST['identifier']; // Email, username, or phone
    $password = $_POST['password'];

    // Check if the user exists in the database
    $query = "SELECT * FROM users WHERE email = '$identifier' OR username = '$identifier' OR phone = '$identifier'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Check if the user is blocked
        if ($user['is_status'] == 0) {
            // User is blocked, display an error message
            $_SESSION['errors'] = ['You are blocked. Please contact the administrator.'];
        } else {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                if(isset($_SESSION['cart'])){
                 // Password is correct, set session variables and go to cart page
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = true;
                header('Location: ../checkout.php');
                exit();
                }else{
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = true;
                header('Location: ../index.php');
                exit();
                }

            } else {
                // Password is incorrect, display an error message
                $_SESSION['errors'] = ['Invalid password'];
            }
        }
    } else {
        // User doesn't exist, display an error message
        $_SESSION['errors'] = ['Invalid email, username, or phone'];
    }

    // Redirect back to the login page with error messages
    header('Location: ../login.php');
    exit();
}
?>
