<?php
include ('../database/db.php');
session_start();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['admin_id'];

    // Delete all products related to the category


    $sql_delete_products = "SELECT * FROM `products` WHERE `categ_id` =$id";
    $result=mysqli_query($conn,$sql_delete_products);
    $row=mysqli_fetch_assoc($result);

    if ($row != null) {
        $_SESSION['errors'] = ["Failed to delete category "];
        header("location: ../admin/view.php");
        exit();
    } 

    // Delete the category
    $sql_delete_category = "DELETE FROM `categ` WHERE `id`='$id'";
    if(mysqli_query($conn, $sql_delete_category)){
        $_SESSION['Done'] = "Category and related products deleted successfully.";
    } else {
        $_SESSION['errors'] = "Failed to delete the category.";
    }
}

header("location: ../admin/view.php");
exit();
?>
