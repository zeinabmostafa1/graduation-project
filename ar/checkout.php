<?php 
include('nav.php');

if(isset($_SESSION['user'])){
  $id=$_SESSION['user_id'];
  $query = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
}
//echo '<pre>';
//print_r($_SESSION['cart']);
?>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>الدفع</h2>
    </div>
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">مشترياتك</span>
          <span class="badge bg-primary rounded-pill"><?php if(isset($_SESSION['cart'])) { echo count($_SESSION['cart']); } else { echo 0; } ?></span>
        </h4>
        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <ul class="list-group mb-3">
        <?php
        $total_price = 0;
        foreach ($_SESSION['cart'] as $key => $item) {
          $product_id = $item['id'];
            $product_name = $item['name'];
            $product_quantity = $item['quantity'];
            $product_price = $item['price'];
            $subtotal = $product_price * $product_quantity;
            $total_price += $subtotal;
            ?>
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0"><?php echo $product_name; ?></h6>
                    <small class="text-muted">الكمية: <?php echo $product_quantity; ?></small>
                    <small class="text-muted">السعر: <?php echo $product_price; ?></small>
                    <input type="hidden" name="productId" value="<?php echo $product_id; ?>">
                </div>
                <span class="text-muted"><?php echo $subtotal; ?> L.E</span>
                <form action="remove_from_cart.php" method="post">
                    <input type="hidden" name="key" value="<?php echo $key; ?>">
                    <button type="submit" class="btn btn-danger btn-sm" name="remove_from_cart">ازالة</button>
                </form>
            </li>
        <?php } ?>
          <li class="list-group-item d-flex justify-content-between">
            <span>الاجمالى (L.E)</span>
            <strong><?php echo $total_price; ?> L.E</strong>
          </li>
        </ul>
        <?php else: ?>
    <p>سلة مشترياتك فارغة</p>
  <?php endif; ?>
        <form >
        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <form class="card p-2" action="" method="post" >
          <div class="input-group">
            <input type="text" class="form-control" placeholder="رمز ترويجي">
            <button type="submit" class="btn btn-secondary">استرداد</button>
          </div>
        </form>
        <?php endif; ?>
      </div>
      <div class="col-md-7 col-lg-8 mx-auto">
        <form class="card p-2 mx-auto" action="checkout_process.php" method="post" >
        <?php if(isset($_SESSION['user'])) {?>
      <h4 class="mb-3">عنوان الفواتير</h4>
        <div class="row gy-3">
            <div class="col-md-12">
              <label for="cc-name" class="form-label">العنوان</label>
              <input type="text" class="form-control" name="address" value=" <?php echo $user['address']?>" placeholder="" >
            </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="same-address">
          <label class="form-check-label" for="same-address">عنوان الشحن هو نفسه عنوان إرسال الفواتير الخاص بي</label>
        </div>
            <?php
        }
        ?>
          <h4 class="mb-3">الدفع</h4>
          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked >
              <label class="form-check-label" for="credit">بطاقة ائتمانية</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" >
              <label class="form-check-label" for="debit">بطاقة سحب</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" >
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div>
          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">الاسم على البطاقة</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" >
              <small class="text-muted">الاسم الكامل كما يظهر على البطاقة</small>
              <div class="invalid-feedback">
              مطلوب الاسم الموجود على البطاقة
              </div>
            </div>
            <div class="col-md-6">
              <label for="cc-number" class="form-label">رقم البطاقة الائتمانية</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" >
              <div class="invalid-feedback">
              مطلوب رقم بطاقة الائتمان
              </div>
            </div>
            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">انتهاء الصلاحية</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" >
              <div class="invalid-feedback">
              تاريخ انتهاء الصلاحية مطلوب
              </div>
            </div>
            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" >
              <div class="invalid-feedback">
              مطلوب رمز الأمان
              </div>
            </div>
          </div>

          <hr class="my-4">

          <?php if(!isset($_SESSION['user'])) {?>
            <button class="w-100 btn btn-warning btn-lg"  disabled name="checkout" type="submit">استمرار عملية الدفع</button>
            
            <p> الرجاء تسجيل الدخول لاستمرار عملية الدفع</p>
            <?php }else{ ?>
              <button class="w-100 btn btn-warning btn-lg" name="checkout" type="submit">استمرار عملية الدفع</button>

          <?php } ?>
        </form>
      </div>
    </div>
  </main>
</div>
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

    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <script src="form-validation.js"></script>
  </body>
</html>
