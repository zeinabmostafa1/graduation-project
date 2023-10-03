<?php 
session_start();

include ('nav.php');
include ('../database/db.php');

if(isset($_GET['id'])){

    $id= $_GET['id'];
    $sql="SELECT * FROM `packages` where id=$id    ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    $sql1 = "SELECT * FROM `quality`";
    $result1=mysqli_query($conn,$sql1);

    $selected_quality_id = $row['quality_id'];

    

}

?>
<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">


        <p class="fs-1">Edit Package</p>

        <?php include ('../validation/message.php'); ?>

            <form class="row g-3 border p-4" action="../school/updatepackage.php?id=<?php echo $id; ?>" method="POST"  enctype="multipart/form-data">
                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value= "<?php if(isset($row['name'])): echo $row['name']; endif; ?>">
                </div>

                <div class="col-12">
                <label class="form-label">Quality</label>
                <select class="form-select" aria-label="Default select example" name="quality">
                    <?php 
                        if (isset($result)) {
                        while ($value = mysqli_fetch_assoc($result1)) {
                            $selected = ($value['id'] == $selected_quality_id) ? 'selected' : '';
                            echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['name'] . '</option>';
                        }
                        }
                    ?>
                    </select>
                    </div>

                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="IMG" class="form-control" >
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary">Update Package</button>
                </div>
                
                <hr>
                    <a href="view-package.php" class="btn btn-primary mb-3" role="button" >View All Packages</a>

            </form>
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>