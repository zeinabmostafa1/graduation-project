<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}

include ('nav.php');

?>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">


        <p class="fs-1">Add Categories</p>

        <?php include ('../validation/message.php'); ?>

            <form class="row g-3 border p-4" action="../categories/create.php" method="POST"  enctype="multipart/form-data">

                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="categname" class="form-control" required >
                </div>
                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="IMG" class="form-control" required>

                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                </div>
                
                <hr>
                    <a href="view.php" class="btn btn-warning mb-3" role="button" >View All Categories</a>

            </form>
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>