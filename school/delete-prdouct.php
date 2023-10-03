<?php
include ('../database/db.php');
session_start();

if(isset($_GET['id'])) {

    $id= $_GET['id'];

        $sql="DELETE from `package_details` where `id`='$id' ";
        if(mysqli_query($conn,$sql)){
            $_SESSION['Done']= "package Deleted";
        }
        else{
            $_SESSION['errors'] = "package Cannot Deleted";
        
        }
    }
    

    



    header("Location: ../admin/edit-packge.php");


?>