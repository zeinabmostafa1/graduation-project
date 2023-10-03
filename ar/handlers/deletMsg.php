<?php 

include('../database/db.php');
session_start();


if(isset($_GET['id'])){
$id=$_GET['id'];
    $query = "DELETE FROM contact_messages WHERE id = '$id'";
    mysqli_query($conn, $query);
    $_SESSION['Done'] = "Contact message deleted successfully";
    header('Location: ../admin/contact.php');
}

?>