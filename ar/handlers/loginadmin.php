<?php
include ('../database/db.php');
session_start();

$errors = [];

if (isset($_POST['submit'])) {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE (username = '$username_email' OR email = '$username_email') AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) { // If username/email and password exist in database
        $row = mysqli_fetch_assoc($result);
        
        if ($row['is_status'] == 0) {
            $_SESSION['errors'] = ["You are blocked. Please contact the administrator."];
            header("Location: ../admin/adminlogin.php");
            exit();
        }

        $_SESSION['admin'] = true;
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];

        header("Location: ../admin/admin.php");
        exit();
    } else { // If username/email and password do not exist in database
        $_SESSION['errors'] = ["Invalid username/email or password"];
        header("Location: ../admin/adminlogin.php");
        exit();
    }
}
?>
