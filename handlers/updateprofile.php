<?php
    include('../database/db.php');
    session_start();
$customerId = $_SESSION['user_id'];

// updateprofile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $phone = preg_replace('/\D/', '', $phone);
    // Validate the phone number format
    if (!preg_match('/^(?:\+?20|0)?1[0-9]\d{8}$/', $phone)) {
        $_SESSION['errors'] =  ["Enter a valid Egyptian phone number"];
        header("Location: ../profile.php");
        exit;
    }

    // Check if the username, phone, and email are unique
    $checkQuery = "SELECT id FROM users WHERE (username = '$username' OR phone = '$phone' OR email = '$email') AND id != $customerId";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['errors'] =  ["Username, phone, or email already exists."];
        header("Location: ../profile.php");

    } else {
        // Update the user's profile in the database
        $sql = "UPDATE users SET
                    first_name = '$firstName',
                    last_name = '$lastName',
                    username = '$username',
                    phone = '$phone',
                    email = '$email',
                    `address` = '$address',
                    address2 = '$address2',
                    country = '$country',
                    `state` = '$state',
                    zip = '$zip'
                WHERE id = $customerId";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['Done'] =  "Profile updated successfully.";
            header("Location: ../profile.php");

        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }
}
