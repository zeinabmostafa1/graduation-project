<?php

include('../database/db.php');
session_start();

if(isset($_POST['submit'])){
  $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
  $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
  $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

  // Check if new password matches confirm password
  if($new_password != $confirm_password) {

    $errors[] = "New password and confirm password do not match.";
    $_SESSION['errors']=$errors;
    header("Location: ../profile.php");
    exit();
  }

  // Check if old password is correct
  $customerId = $_SESSION['user_id'];
  $query = "SELECT `password` FROM users WHERE id='$customerId'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $hashed_password = $row['password'];
  if(!password_verify($old_password, $hashed_password)) {

    $errors[] = "Old password is incorrect.";
    $_SESSION['errors']=$errors;
    header("Location: ../profile.php");
    exit();
  }

  // Update password in database
  $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
  $query = "UPDATE users SET password='$hashed_new_password' WHERE id='$customerId'";
  mysqli_query($conn, $query);

  // Notify user that password has been changed
  $_SESSION['Done']="Your password has been changed successfully.";
  header("Location: ../profile.php");
  exit();
}
?>
