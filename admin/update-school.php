<?php 
session_start();
include ('nav.php');
include ('../database/db.php');

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql1="SELECT *  from  `schools` where `id`='$id'";
    $result1=mysqli_query($conn,$sql1);
    $row=mysqli_fetch_assoc($result1);
}
?>

<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
        <p class="fs-1">Update School</p>
        <?php include ('../validation/message.php'); ?>
            <form class="row g-3 border p-4" action="../school/update.php?id=<?php echo $id;?>" method="POST"  enctype="multipart/form-data">
                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="schoolname" value="<?php echo $row['name']; ?>" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Descrption</label>
                    <input type="text" name="descrption" value="<?php echo $row['descrption']; ?>" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="IMG"  class="form-control">
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary">Update School</button>
                </div>
                <a href="view-school.php" class="btn btn-primary mb-3" >View All Schools</a>

            </form>

            
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>