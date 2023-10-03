<?php 
include('nav.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];

    $sql = "SELECT * from products where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
}
?>
<div class="product">
    <div class="container">
        <div class="details">
            <h2><?php echo $row['name'] ?></h2>
            <p>Price: <span> <?php echo $row['price'] ?> L.E</span></p>
            <p>In Stock: <span> <?php echo $row['quantity'] ?> Unit</span></p>
<form action="add_cart.php" method="post">
    

    <?php if ($row['quantity'] == 0): ?>
        <label for="">Sorry the Product out of stock </label>
        <button type="submit" class="btn btn-warning" name="add_to_cart" disabled>Add to Cart</button>
    <?php else: ?>
        <label for="">Enter Quantity</label>
        <input type="number" name="quantity" class="m-2" value="1" min="1" max="<?php echo $row['quantity'] ?>" required>
    <input type="hidden" name="product_id" value="<?php echo $row['id'] ?>">
        <button type="submit" class="btn btn-warning" name="add_to_cart">Add to Cart</button>
    <?php endif; ?>
</form>
            <div class="social-media">
                <h3>share via social media</h3>
                <ul>
                    <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://www.samirandaly.com/default/242112510.html"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a target="_blank" href="https://twitter.com/intent/tweet?url=https://www.samirandaly.com/default/242112510.html&amp;text=قلم رصاص بدون استيكةFC جولد فابر رقم1221 F"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a target="_blank" href="#"><i class="fa-brands fa-instagram"></i></a></li> 
                </ul>
            </div>
        </div>
        <div class="image">
            <img src="uploads/<?php echo $row['IMG'] ?>" alt="">
        </div>
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
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
</body>
</html>