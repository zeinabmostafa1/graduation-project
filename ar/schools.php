<?php 
include('nav.php');
include ('database/db.php');
$schoolSql = "SELECT * FROM `schools`";

?>

<h1 class="special-heading">المدارس</h1>

<div class="container pt-5">
    <div class="row">
        <div class="col-6 mx-auto">
            <?php
            $schoolSql = "SELECT * FROM `schools`";
            $schoolResult = mysqli_query($conn, $schoolSql);

            while ($school = mysqli_fetch_assoc($schoolResult)) {
            ?>
                <div class="card mb-3">
                    <img src="../uploads/<?php echo $school['img']; ?>" width="150" class="card-img-top" alt="School Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $school['name']; ?></h5>
                        <p class="card-text"><?php echo $school['descrption']; ?></p>
                        <center>
                            <a class="btn btn-warning" href="school-list.php?id=<?php echo $school['id']; ?>">Go to <?php echo $school['name']; ?> المجموعات</a>
                        </center>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>












     <!-- start footer -->
     <div class="footer">
    <div class="container">
    &copy;2023 <span> SuppMart </span> All Right Reserved
   
    <div class="social">
        Find Us On Social Networks <br>
        <i class="fa-brands fa-youtube"></i>
        <i class="fa-brands fa-facebook-f"></i>
        <i class="fa-brands fa-twitter"></i>
    </div>
      </div>
   </div>
   <!-- end footer -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
</body>
</html>