<?php

if (isset($_GET['id'])) {
    include('../database/db.php');
    session_start();
    $errors=[];
    $user_id = $_GET['id'];

    $sql = "UPDATE admin SET is_status = '1' WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['Done']= "User blocked successfully!";
        header('Location: ../admin/admins.php');
    } else {
        $_SESSION['errors'] = "User Cannot blocked";
        header('Location: ../admin/admins.php');
    }
}
?>