<?php
include ('../database/db.php');
include ('../validation/validation.php');
session_start();
$errors=[];

if (isset($_POST["submit"])){
    $productname=mysqli_real_escape_string($conn,$_POST['prodctname']);
    $productprice=mysqli_real_escape_string($conn,$_POST['prodctprice']);
    $quantity=mysqli_real_escape_string($conn,$_POST['quantity']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);

    if(empty($productname) ){
        $errors[]= "Enter Name";
    }
        else{
            if(!minLength($productname,3)) {
                $errors[]= "Enter Vaild Name";
            }
        }
    
    if(empty($productprice) ){
        $errors[]= "Enter Price";
    }
    if (empty($quantity) && $quantity !== '0') {
        $errors[] = "Enter quantity";
    }
    

    if(isset($_SESSION['admin_id']) && isset($_GET['id'])){
        $user_id= $_SESSION['admin_id'];
        $id=$_GET['id'];
    }


    if (empty($errors)) {
        $IMG = $_FILES['IMG'];
        $sql2 = "SELECT IMG FROM products WHERE id = '$id'";
        $result2 = mysqli_query($conn, $sql2);
        $img = mysqli_fetch_assoc($result2);
        $currentImg = $img['IMG'];
        // Check if a new image is provided
        if (!empty($IMG['name'])) {

            $target_dir = "../uploads/"; // Directory where the uploaded image will be saved
            // Delete the current image file
            if (!empty($currentImg)) {
                $filePath = $target_dir . $currentImg;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
    
            include('../upload-mang/upload.php');
            // Upload the new image file
            uploadImage($_FILES['IMG'], $target_dir, $errors);
            $imgName = $_SESSION['IMG'];
    
            // Update query with image
            $sql1 = "UPDATE `products` SET `user_id`='$user_id',`quantity`='$quantity',`categ_id`='$category',`name`='$productname',`price`='$productprice',`IMG`='$imgName' WHERE `id`='$id'";
    
            if (mysqli_query($conn, $sql1)) {
                $_SESSION['Done'] = "Product Updated";
                header("location: ../admin/update-products.php?id=$id");
                exit;
            } else {
                $_SESSION['errors'] = ['Product Not Updated'];
                header("location: ../admin/update-products.php?id=$id");
                exit;
            }
        } else {
            // Update query without image
            $sql2 = "UPDATE `products` SET `user_id`='$user_id',`quantity`='$quantity',`categ_id`='$category',`name`='$productname',`price`='$productprice' WHERE `id`='$id'";
    
            if (mysqli_query($conn, $sql2)) {
                $_SESSION['Done'] = "Product Updated";
                header("location: ../admin/update-products.php?id=$id");
                exit;
            } else {
                $_SESSION['errors'] = ['Product Not Updated'];
                header("location: ../admin/update-products.php?id=$id");
                exit;
            }
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location: ../admin/update-products.php?id=$id");
        exit;
    }
    
    
}
    
    ?>