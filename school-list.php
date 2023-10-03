<?php 
include('nav.php');

if(isset($_GET['id'])){
        $school_id=$_GET['id'];
    }
    $sql= "SELECT * FROM `packages` where school_id = $school_id ";
    $result1 = mysqli_query($conn, $sql);

    $schools_sql= "SELECT * FROM `schools` where id = $school_id ";
    $schools_result = mysqli_query($conn, $schools_sql);
    $schools = mysqli_fetch_assoc($schools_result)
?>

<div class="products" id="products">
    <h1 class="special-heading"> <?php echo $schools['name'] ;?> Packages</h1>

<!-- start Product -->
<div class="section-1">
    <div class="container">
        <?php while ($packages = mysqli_fetch_assoc($result1)) { ?>
            <div class="box">
                <img src="uploads/<?php echo $packages['img']; ?>" alt="">
                <div class="content">
                    <h3><?php echo $packages['name']; ?></h3>
                    <p>Price: <?php echo $packages['price']; ?></p>
                </div>
                <div class="info">
                    <a href="view-pack.php?id=<?php echo $packages['id'];?>">View Package </a>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<!-- start footer -->
 <div class="footer">
    <div class="container">
    &copy;2023 <span> SuppMart </span> All Right Reserved
   
    <div class="social">
        Find Us On Social Networks <br>
        <a href="https://www.youtube.com/"  class="p-2" ><i class="fa-brands fa-youtube text-black-50"></i></a>
        <a href="https://www.facebook.com/"  class="p-2"><i class="fa-brands fa-facebook-f text-black-50"></i></a>
        <a href="https://www.twitter.com/" class="p-2"><i class="fa-brands fa-twitter text-black-50"></i></a>
    </div>
      </div>
   </div>
   <!-- end footer -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
</body>
</html>