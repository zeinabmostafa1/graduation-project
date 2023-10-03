<?php
include ('../database/db.php');
include ('../validation/validation.php');
include ('../upload-mang/upload.php');

session_start();
$errors=[];

if (isset($_POST["submit"])){
    $schoolname=mysqli_real_escape_string($conn,$_POST['schoolname']);
    $descrption=mysqli_real_escape_string($conn,$_POST['descrption']);
    $IMG= $_FILES['IMG'];


    if(empty($schoolname) ){
        $errors[]= "Enter Name";
    }
        else{
            if(!minLength($schoolname,3)) {
                $errors[]= "Enter Vaild Name";
            }
        }


    $sql= "SELECT `name` from `schools` where `name`='$schoolname' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    if($row!=null){
        $errors[]="Name is already exist";
    }

    if(empty($errors)){

        $target_dir = "../uploads/"; // directory where the uploaded image will be saved
        uploadImage($_FILES['IMG'], $target_dir,$errors=[]);
        $imgName=$_SESSION['IMG'];

        $sql1="INSERT INTO `schools`(`name`,`descrption`,`img`) value ('$schoolname','$descrption','$imgName')";
        if(mysqli_query($conn,$sql1)){
            $_SESSION['Done']= "School Added";
            header("Location: ../admin/add-school.php");
        }
    }
    else{
        $_SESSION['errors'] = $errors;
        header("Location: ../admin/add-school.php");
    }
}

    ?>