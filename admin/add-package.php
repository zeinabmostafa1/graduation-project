<?php
session_start();

if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}



include ('nav.php');
include ('../database/db.php');


$school_name= $_SESSION['school_name'];

$school_id= $_SESSION['school_id'];
?>

<a href="view-package.php" class="btn btn-primary col-1 mx-auto m-3">Go back</a>

<p class="fs-1">Add Package For <mark><?php echo $school_name; ?></mark> School</p>

<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">

        <?php include ('../validation/message.php'); ?>

<form action="../school/add-packge.php" method="post" class="row g-3 border p-4" enctype="multipart/form-data">

<input type="text" hidden class="form-control" value="<?php echo $school_id;?>" name="school_id" required>

    <div class="mb-3">
        <label for="package_name" class="form-label">Package Name</label>
        <input type="text" class="form-control" id="package_name" name="package_name" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="IMG" required>
    </div>
    <div class="mb-3">
    <label for="quality_id" class="form-label">Quality</label>
    <select class="form-control" id="quality_id" name="quality_id" required>
        <?php
        $sql = "SELECT * FROM `quality`";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
        }
        ?>
        <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
    </select>
</div>
    <button type="submit" name="sub" class="btn btn-primary">Submit</button>
</form>
</div>
</div>

</div>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
