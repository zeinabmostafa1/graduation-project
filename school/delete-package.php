<?php
include ('../database/db.php');
session_start();

if(isset($_GET['id'])) {

    $id= $_GET['id'];

        $sql="DELETE from `packages` where `id`='$id' ";
        if(mysqli_query($conn,$sql)){
            $sql1="DELETE from `package_details` where `packge_id`='$id' ";
            mysqli_query($conn,$sql1);
            $_SESSION['Done']= "package Deleted";
        }
        else{
            $_SESSION['errors'] = "package Cannot Deleted";
        
        }
    }
    

    



    header("Location: ../admin/view-package.php");


?>