<?php
include ('../database/db.php');
session_start();

if(isset($_GET['id'])) {

    $id= $_GET['id'];

        $sql="DELETE from `schools` where `id`='$id' ";
        if(mysqli_query($conn,$sql)){
            $sql1="DELETE from `packages` where `school_id`='$id' ";
            mysqli_query($conn,$sql1);
            $_SESSION['Done']= "school Deleted";
        }
        else{
            $_SESSION['errors'] = "school Cannot Deleted";
        
        }
    }
    

    



        header("location: ../admin/view-school.php");


?>