<?php 
include ('../database/db.php');
include ('../validation/validation.php');

session_start();
$errors = [];

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    // Validate the phone number format
    $phone = preg_replace('/\D/', '', $phone);

    // Validate the phone number format
    if (!preg_match('/^(?:\+?20|0)?1[0-9]\d{8}$/', $phone)) {
        $_SESSION['errors'] =  ["Enter a valid Egyptian phone number"];
        $_SESSION['form_data'] = $_POST; // Save form data in session
        header("Location: ../sign-up.php");
        exit;
    }

    // Check if the password is at least 8 characters long
    if (strlen($_POST['password']) < 8) {
        $_SESSION['errors'] = ["Password must be at least 8 characters long."];
        $_SESSION['form_data'] = $_POST; // Save form data in session

        header("Location: ../sign-up.php");
        exit;
    }

    // Check if the username, phone, and email are unique
    $checkSql = "SELECT * FROM users WHERE username = '$username' OR phone = '$phone' OR email = '$email'";
    $result = mysqli_query($conn, $checkSql);
    $existingUser = mysqli_fetch_assoc($result);
    if ($existingUser) {
        // If any of the username, phone, or email already exists, display an error message
        $_SESSION['errors'] =  ["Username, phone, or email already exists."];
        $_SESSION['form_data'] = $_POST; // Save form data in session
        header("Location: ../sign-up.php");
    } elseif ($password !== $confirmPassword) {
        // If passwords do not match, display an error message
        $_SESSION['errors'] = ["Passwords do not match."];
        $_SESSION['form_data'] = $_POST; // Save form data in session

        header("Location: ../sign-up.php");
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the data into the users table
        $insertSql = "INSERT INTO users (first_name, last_name, username, phone, email, address, address2, country, state, zip, password)
            VALUES ('$firstName', '$lastName', '$username', '$phone', '$email', '$address', '$address2', '$country', '$state', '$zip', '$hashedPassword')";
        mysqli_query($conn, $insertSql);

        // Display success message or redirect to another page
        $_SESSION['Done'] =  "User registration successful Please login!";
        header("Location: ../login.php");
    }
}
