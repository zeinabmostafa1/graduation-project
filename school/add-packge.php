<?php
include ('../database/db.php');
include ('../validation/validation.php');
include ('../upload-mang/upload.php');
session_start();
$errors=[];



if (isset($_POST['sub'])) {
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
    $quality_id = mysqli_real_escape_string($conn, $_POST['quality_id']);
    $image = $_FILES['IMG'];


    if(empty($package_name) ){
        $errors[]= "Enter Name";
    }
        else{
            if(!minLength($package_name,3)) {
                $errors[]= "Enter Vaild Name";
            }
        }

        if(empty($image) ){
            $errors[]= "Enter image ";
        }

    if(empty($errors)){

        $target_dir = "../uploads/"; // directory where the uploaded image will be saved
        uploadImage($_FILES['IMG'], $target_dir,$errors=[]);
        $imgName=$_SESSION['IMG'];

        $sql1="INSERT INTO `packages`(`name`,`img`,`school_id`,`quality_id`) value ('$package_name','$imgName','$school_id','$quality_id')";
        if(mysqli_query($conn,$sql1)){
            $_SESSION['Done']= "Package Added";
            header("Location: ../admin/add-package.php");
        }
    }
    else{
        $_SESSION['errors'] = $errors;
        header("Location: ../admin/add-package.php");
    }

    header("Location: ../admin/add-package.php");
    exit();
}
?>