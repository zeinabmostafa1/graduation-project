<?php
include ('../database/db.php');
include ('../validation/validation.php');
include ('../upload-mang/upload.php');

session_start();
$errors=[];

if (isset($_POST["submit"])){
    $categname=mysqli_real_escape_string($conn,$_POST['categname']);

    if(empty($categname) ){
        $errors[]= "Enter Name";
    }
        else{
            if(!minLength($categname,3)) {
                $errors[]= "Enter Vaild Name";
            }
        }

    if(isset($_SESSION['admin_id'])){
        $user_id= $_SESSION['admin_id'];
    }

    $sql= "SELECT `name` from `categ` where `user_id`='$user_id' and `name`='$categname' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    if($row!=null){
        $errors[]="Name is already exist";
    }

    if(empty($errors)){

        $target_dir = "../uploads/"; // directory where the uploaded image will be saved
        uploadImage($_FILES['IMG'], $target_dir,$errors=[]);
        $imgName=$_SESSION['IMG'];

        $sql1="INSERT INTO `categ`(`name`,`user_id`,`img`) value ('$categname','$user_id','$imgName')";
        if(mysqli_query($conn,$sql1)){
            $_SESSION['Done']= "Category Added";
            header("Location: ../admin/categories.php");
        }
    }
    else{
        $_SESSION['errors'] = $errors;
        header("Location: ../admin/categories.php");
    }
}

    ?>