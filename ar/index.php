<?php 
include('nav.php');
include ('database/db.php');
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
        <div class="overlay"></div> 
            <div class="text">
                <div class="content">
                    <h2>مرحبا !  <?php if(isset($_SESSION['user'])): ?> <mark> <?php echo $user['first_name']; endif;?> </mark> <br> استعد لتجربة فريدة معنا!</h2>
                    <p>
نحن هنا لمساعدتك. ستجد هنا كل ما تحتاجه من مستلزمات. لا حاجة لدفع ثمن مستلزمات غير ضرورية، بحيث يمكنك تخصيص طلبك والحصول فقط على ما ترغب فيه. يمكنك أيضًا الحصول على مستلزمات مدرسية لطفلك واختيار ما يحبونه دون البحث لفترة طويلة. كل ما تحتاجه متاح في مكان واحد.
                        </p>
                </div>
            </div>
    </div>
    <!-- end landing -->
    <!--start services section-->
<div class="services" id="services">
<div class="container">
    <h2 class="special-heading"> الخدمات </h2>
    <p>لا تكن مشغولاً ، كن منتجاً </p>
    <div class="service-content" style="display: grid;
    grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
    grid-gap:40px; 
    margin-top: 80px;">
    <!--first column-->
    <div class="col">
        <!-- stat services-->
        <div class="srv" id="services">
        <div class="text">
            <h3> مجموعة مدرسية </h3>
            <p>
            مجموعة اللوازم المدرسية هي مجموعة من العناصر الأساسية التي يحتاجها الطلاب في مساعيهم الأكاديمية.يمكنك شراء مجوعتك بنقرة واحدة فقط عن طريق اختيار المدرسة.
            </p>
        </div>
        </div>
    </div>
    <!-- seconed column-->
    <div class="col">
            <div class="srv">
            <div class="text">
                <h3> ادوات مكتبية </h3>
                <p>
                نقدم لكم مجموعة واسعة من المنتجات والملحقات لدعم الشركات والمهنيين في عملياتهم اليومية من الأدوات المكتبية وأدوات الكتابة إلى منظمات المكاتب ومعدات المكاتب، نلبي جميع احتياجاتك من اللوازم المكتبية.
                </p>
            </div>
            </div>
    </div>
        <!-- end services-->
        </div>
    </div>
    </div>
</div>
</div>
<!--end sevices section-->
<!-- start products -->
 <div class="products" id="products">
    <h1 class="special-heading">المنتجات</h1>
    <p>كن مستعدا للابداع</p>
    <?php 
    $sql= "SELECT * FROM `products` ORDER BY RAND() LIMIT 5";
    $result1 = mysqli_query($conn, $sql);
    ?>
<div class="section-1">
    <div class="container">
        <?php while ($product = mysqli_fetch_assoc($result1)) { ?>
            <div class="box">
                <img src="../uploads/<?php echo $product['IMG']; ?>" alt="">
                <div class="content">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>السعر: <?php echo $product['price']; ?></p>
                </div>
                <div class="info">
                <a href="show-product.php?id=<?php echo $product['id'];?>">عرض المنتج</a>
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
        <h2 class="special-heading"> حول</h2>
        <p> العمل الاقل هو الاكثر </p>
        <div class="about-content">
        <div class="image">
        <img src="images/about.jpg" alt="">
        </div>
        <div class="text">
            <p>سب مارت هي شركة ناشئة تعالج المشاكل التي يعاني منها جميع الآباء ؛ وهي خدع اللوازم المدرسية التي تحدث في بداية كل عام دراسي. بدأت الشركة كمجموعة من الأصدقاء الذين لديهم أشقاء أصغر سناً لديهم بعض المشاكل التي يواجهونها في جمع كل المستلزمات قبل بدء العام الدراسي. طرح الاصدقاء بعض الأفكار لمعرفة ما إذا كانت ستقودهم إلى أي شئ مفيد، وبعد أشهر من العصف الذهني ومعرفة ما إذبإمكانهم تحقيق الفكرة التي حلموا بها ، توصلوا إلى حل من شأنه أن يساعد الآباء الآن والآباء على ذلك. </p>
            <hr/>
            <p>سب مارت  هو الحل الذي توصلوا إليه من أجل تسهيل حياة والديهم وجعل جميع الآباء يعيشون حياة خالية من التوتر عندما يتعلق الأمر ببدء رحلة أكاديمية جديدة لأطفالهم
            </p>
        </div>
        </div>
    </div>
    </div>
    <!-- start contact-->
    <div class="contact" id="contact">
    <div class="container">
    <h2 class="special-heading"> اتصل بنا </h2>
    <p>ارسل لنا رسالة</p>
    <div class="content">
        <form action="handlers/contactUs.php" method="post">
        <?php include('validation/message.php'); ?>
    <input class="main-input" type="text" name="name" placeholder="اسمك">
    <input class="main-input" type="email" name="email" placeholder="بريدك الالكتروني">
    <textarea class="main-input" name="message" placeholder="رسالتك"></textarea>
    <button type="submit" name="submit" class="btn btn-warning">ارسل رسالتك</button>
</form>
        <div class="info">
            <h4> لنبقي عل تواصل</h4>
            <span class="phone">+00 123.456.789</span>
            <br>
            <span class="phone">+00 123.456.789</span>
            <h4> اين نحن؟ </h4>
            <address>عنواننا 17 <br>القاهرة الجديدة<br> 123-4567-890 <br> القاهرة ،مصر </address>
        </div>
    </div>
    </div>
    </div>
    <!-- end contact-->
    <!-- start footer  -->
    <div class="footer">
    <div class="container">
        &copy;2023 <span> SuppMart </span> جميع الحقوق محفوظة
    <div class="social">
        تواصل معنا  <br>
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

