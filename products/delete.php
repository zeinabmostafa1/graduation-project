<?php
include ('../database/db.php');
session_start();

if(isset($_GET['id']) && isset($_GET['IMG_name'])) {

    $id= $_GET['id'];
    $user_id= $_SESSION['admin_id'];
    $IMG_name= $_GET['IMG_name'];

    
    if(file_exists("../uploads/$IMG_name")){
        $sql="DELETE from `products` where `id`='$id' and `user_id`='$user_id'";

        if(mysqli_query($conn,$sql)){
            unlink("../uploads/$IMG_name");
            $_SESSION['Done']= "Product Deleted";
        }
        else{
            $_SESSION['errors'] = "Product Cannot Deleted";
        
        }
    }else{
        $sql="DELETE from `products` where `id`='$id' and `user_id`='$user_id'";
        if(mysqli_query($conn,$sql)){
            $_SESSION['Done']= "Product Deleted";
        }
        else{
            $_SESSION['errors'] = "Product Cannot Deleted";
        
        }
    }
    }

    



        header("location: ../admin/viewproducts.php");


?>