<?php 
session_start();

include ('nav.php');
include ('../database/db.php');

if(isset($_GET['id'])){

    $id= $_GET['id'];
    $sql="SELECT  `name` from  `categ` where `id`='$id' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
}

?>

<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">


        <p class="fs-1">Update Categories</p>

        <?php include ('../validation/message.php'); ?>

            <form class="row g-3 border p-4" action="../categories/update.php?id=<?php echo $id; ?>" method="POST"  enctype="multipart/form-data">
                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="categname" class="form-control" value= "<?php if(isset($row['name'])): echo $row['name']; endif; ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="IMG" class="form-control" >
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary">Update Category</button>
                </div>
                
                <hr>
                    <a href="view.php" class="btn btn-primary mb-3" role="button" >View All Categories</a>

            </form>
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>