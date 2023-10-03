<?php
include ('../database/db.php');
include ('../validation/validation.php');
session_start();
$errors=[];

if (isset($_POST["submit"])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $quality=mysqli_real_escape_string($conn,$_POST['quality']);


    if(empty($name) ){
        $errors[]= "Enter Name";
    }
        else{
            if(!minLength($name,3)) {
                $errors[]= "Enter Vaild Name";
            }
        }
    

    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }

    if (empty($errors)) {
        $IMG= $_FILES['IMG'];
        $sql2 = "SELECT img FROM packages WHERE id = '$id'";
        $result2 = mysqli_query($conn, $sql2);
        $img = mysqli_fetch_assoc($result2);
        $currentImg = $img['img'];
        // Check if a new image is provided
        if (!empty($IMG['name'])) {
            $target_dir = "../uploads/"; // directory where the uploaded image will be saved

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
            $sql1 = "UPDATE `packages` SET `name`='$name',`img`='$imgName',`quality_id`='$quality' WHERE `id`='$id'";
        
            if (mysqli_query($conn, $sql1)) {
                $_SESSION['Done'] = "Package Updated";
                header("location: ../admin/update-package.php?id=$id");
                exit; 
            } else {
                $_SESSION['errors'] = ['Package Not Updated'];
                header("location: ../admin/update-package.php?id=$id");
                exit; 
            }
        } else{
                        $sql1 = "UPDATE `packages` SET `name`='$name',`quality_id`='$quality' WHERE `id`='$id'";
        
            if (mysqli_query($conn, $sql1)) {
                $_SESSION['Done'] = "Package Updated";
                header("location: ../admin/update-package.php?id=$id");
                exit; 
            } else {
                $_SESSION['errors'] = ['Package Not Updated'];
                header("location: ../admin/update-package.php?id=$id");
                exit; 
            }
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location: ../admin/update-package.php?id=$id");
        exit; 
    }
}
    
    ?>