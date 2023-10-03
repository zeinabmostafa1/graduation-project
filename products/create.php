<?php
include ('../database/db.php');
include ('../validation/validation.php');
include ('../upload-mang/upload.php');
session_start();
$errors=[];

if (isset($_POST["submit"])){
    $productname=mysqli_real_escape_string($conn,$_POST['prodctname']);
    $productprice=mysqli_real_escape_string($conn,$_POST['prodctprice']);
    $quantity=mysqli_real_escape_string($conn,$_POST['quantity']);

    $IMG= $_FILES['IMG'];
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
    if(empty($quantity) ){
        $errors[]= "Enter quantity";
    }

    if(isset($_SESSION['admin_id'])){
        $user_id= $_SESSION['admin_id'];
    }

    $sql= "SELECT `name` from `products` where `user_id`='$user_id' and `name`='$productname' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    if($row!=null){
        $errors[]="Name is already exist";
    }
    
    if(empty($errors)){
        
        $target_dir = "../uploads/"; // directory where the uploaded image will be saved
        uploadImage($_FILES['IMG'], $target_dir,$errors=[]);
        
        if(isset($_SESSION['IMG'])){
            $imgName=$_SESSION['IMG'];
            $sql1="INSERT INTO `products`(`user_id`,`categ_id`,`name`,`price`,`IMG` , `quantity`) value ('$user_id','$category','$productname','$productprice','$imgName','$quantity')";
            
            if(mysqli_query($conn,$sql1)){
                $_SESSION['Done']= "Product Added";
                
                header("Location: ../admin/products.php");
            }else{
                $_SESSION['errors'] = ['Product Not Added'];
                header("location: ../admin/products.php");
                
            }
            
            
        }
        
    }
    else{
        $_SESSION['errors'] = $errors;
        header("location: ../admin/products.php");
    }
}

    ?>