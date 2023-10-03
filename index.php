<?php 
include('nav.php');
include ('database/db.php');
// include('chatpot.php');
if(isset($_SESSION['user'])){
    $id=$_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}
?>
<!-- end header -->
<!-- start landing -->
<div class="landing"> 
        <div class="text">
            <div class="content">
                <h2>Hello !  <?php if(isset($_SESSION['user'])): ?> <mark> <?php echo $user['first_name']; endif;?> </mark> <br>
                    Get Ready to Have Such A Unique Experience With Us </h2>
                <p>We have got your back. Here you will find all what you need from supplies. You don’t have to pay for useless supplies 
                    so you’re able to customize your package and you get only what you want . You can also get your child’s school
                    supplies and choose their favorites without rolling around for a long time . 
                    All you have are in one place . 
                    </p>
            </div>
        </div>
</div>
<!-- end landing -->
<!--start services section-->
<div class="services" id="services" style="text-transform: capitalize;">
<div class="container">
    <h2 class="special-heading"> Services </h2>
    <p> Don't be busy, be productive </p>
    <div class="service-content" style="display: grid;
    grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
    grid-gap:40px; 
    margin-top: 80px;">
    <!--first column-->
    <div class="col">
        <div class="srv" id="services">
        <div class="text">
            <h3> school packages </h3>
            <p> A school supplies package is a collection of essential items needed by students for their academic pursuits.
                you can buy your package in one click just by choose the school.</p>
        </div>
        </div>
    </div>
    <!-- seconed column-->
    <div class="col">
            <div class="srv">
            <div class="text">
                <h3> office supplies </h3>
                <p>
                    we offer a wide range of products and accessories to support businesses and professionals in their day-to-day operations.
                    From stationery and writing instruments to desk organizers and office equipment, we cater to all your office supply needs."
                </p>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!--end sevices section-->
<!-- start products -->
<div class="products" id="products">
    <h1 class="special-heading">Products</h1>
    <p>get ready to create</p>
    <?php 
    $sql= "SELECT * FROM `products` ORDER BY RAND() LIMIT 5";
    $result1 = mysqli_query($conn, $sql);
    ?>
<div class="section-1">
    <div class="container">
        <?php while ($product = mysqli_fetch_assoc($result1)) { ?>
            <div class="box">
                <img src="uploads/<?php echo $product['IMG']; ?>" alt="" width="300" height="300">
                <div class="content">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Price: <?php echo $product['price']; ?></p>
                </div>
                <div class="info">
                <a href="show-product.php?id=<?php echo $product['id'];?>">Show Product</a>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
    </div>
    </div>
</div>
<!-- start about section -->
<div class="about" id="about">
    <div class="container">
        <h2 class="special-heading"> About</h2>
        <p> Less is more work </p>
        <div class="about-content">
        <div class="image">
            <img src="images/about.jpg" alt="">
        </div>
        <div class="text">
            <p>Suppmart is a startup company that addresses the problems that all parents have; which is the school supplies shenanigans that take place at the beginning of every academic year. The company started as a group of friends that have younger siblings that are still in school; sharing the problems that they are facing in collecting all the supplies before school starts. They threw a few ideas in order to see if it leads them anywhere useful; and after months of brainstorming and seeing if they can actually achieve the idea they dreamt about, they came up with a solution that would help parents now and the parents to be.</p>
            <hr/>
            <p>Suppmart is a solution they came up with in order to make their parent's lives easier and to have all parents lives stress free when it comes to the start of a new academic journey for their kiddos
            </p>
        </div>
        </div>
    </div>
    </div>
    <!-- start contact-->
    <div class="contact" id="contact">
    <div class="container">
    <h2 class="special-heading">
        Contact 
    </h2>
    <p>We are born to create</p>
    <div class="content">
        
        <form action="handlers/contactUs.php" method="post">
        <?php include('validation/message.php'); ?>
    <input class="main-input" type="text" name="name" placeholder="your name">
    <input class="main-input" type="email" name="email" placeholder="your email">
    <textarea class="main-input" name="message" placeholder="your message"></textarea>
    <button type="submit" name="submit" class="btn btn-warning">Submit</button>
</form>
        <div class="info">
            <h4> get in touch </h4>
            <span class="phone">+00 123.456.789</span>
            <br>
            <span class="phone">+00 123.456.789</span>
            <h4> where we are </h4>
            <address>Awesome Address 17 <br> New cairo <br> 123-4567-890 <br> cairo, egypt </address>
        </div>
    </div>
    </div>
    </div>
    <!-- end contact-->
<!-- start footer -->
<div class="footer">
    <div class="container">
        &copy;2023 <span> SuppMart </span> All Right Reserved
    <div class="social">
        Find Us On Social Networks <br>
        <a href="https://www.youtube.com/"  class="p-2" ><i class="fa-brands fa-youtube text-black-50"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100093607941561"  class="p-2"><i class="fa-brands fa-facebook-f text-black-50"></i></a>
        <a href="https://twitter.com/suppmart15896" class="p-2"><i class="fa-brands fa-twitter text-black-50"></i></a>
    </div>
    </div>
</div>
<!-- end footer -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>
</body>
</html>

