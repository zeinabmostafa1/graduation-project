<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}

include ('nav.php');
include ('../database/db.php');

if(isset($_SESSION['admin_id'])){

    $user_id= $_SESSION['admin_id'];
    $sql="SELECT *  from  `categ` ";
    $result=mysqli_query($conn,$sql);
}
?>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">


            <p class="fs-1">Add Products</p>

            <?php include ('../validation/message.php'); ?>

            <form class="row g-3 border p-4" action="../products/create.php" method="POST" enctype="multipart/form-data">
                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="prodctname" class="form-control" required>
                </div>

                <div class="input-group mb-3">
                    <label class="form-label">Price</label>
                    <div class="input-group mb-3">
  <span class="input-group-text">L.E</span>
  <span class="input-group-text">0.00</span>
  <input type="text" class="form-control" name="prodctprice" aria-label="Dollar amount (with dot and two decimal places)" required>
</div>
                </div>

                <div class="col-12">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" required >
                </div>

                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="IMG" class="form-control" required>

                </div>
                <div class="col-12">
                    <label class="form-label">Category</label>

                    <select class="form-select" aria-label="Default select example" name="category" required>

                        <?php if (isset($result)): foreach($result as $value):?>

                        <option value=" <?php echo $value['id'];?> "> <?php echo $value['name'];?> </option>

                        <?php endforeach; endif; ?>

                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary">Add Products</button>
                </div>

                <hr>
                <a href="viewproducts.php" class="btn btn-warning mb-3"  >View All
                    Products</a>

            </form>
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>