<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}
include ('nav.php');
include ('../database/db.php');
?>

<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">


        <p class="fs-1">Add School</p>

        <?php include ('../validation/message.php'); ?>

            <form class="row g-3 border p-4" action="../school/add.php" method="POST"  enctype="multipart/form-data">

                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="schoolname" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Descrption</label>
                    <input type="text" name="descrption" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="IMG" class="form-control" required>

                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary">Add School</button>
                </div>
                
                <a href="view-school.php" class="btn btn-primary mb-3" >View All Schools</a>
            </form>
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>