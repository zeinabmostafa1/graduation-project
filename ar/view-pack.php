<?php
include('nav.php');

if (isset($_GET['id'])) {
    $package_id = $_GET['id'];
}
$id = $package_id;

$sql1 = " SELECT * FROM `packages` where id=$id";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

$sql = "SELECT pd.id, pd.packge_id, pd.product_id, pd.price, pd.quantity, p.img AS product_img, p.name AS product_name, p.price AS product_price, p.quantity AS product_quantity
        FROM package_details pd
        JOIN products p ON pd.product_id = p.id
        WHERE pd.packge_id = $id";

$result = mysqli_query($conn, $sql);
?>
<div class="products" id="products">
    <h1 class="special-heading"><?php echo $row1['name']; ?></h1>
    <h1 class="special-heading">سعر المجموعة: <?php echo $row1['price']; ?></h1>
    <div class="section-1">
        <form action="cart_packge.php" method="post">
            <div class="container">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $packageDetailId = $row['id'];
                        $packageId = $row['packge_id'];
                        $productId = $row['product_id'];
                        $img = $row['product_img'];
                        $price = $row['price'];
                        $quantity = $row['quantity'];
                        $productName = $row['product_name'];
                        $productPrice = $row['product_price'];
                        $product_quantity = $row['product_quantity'];
                ?>
                <div class="box">
                    <div class="product-image">
                        <img src="../uploads/<?php echo $img; ?>" alt="">
                    </div>
                    <div class="product-info">
                        <h3><?php echo $productName; ?></h3>
                        <p>السعر: <?php echo $price; ?></p>
                        <?php if ($product_quantity == 0): ?>
                            <p class="error">ناسف لعدم توافر المنتج</p>
                        <?php elseif ($product_quantity < $quantity): ?>
                            <p>Quantity: 
                                <input type="number" name="quantity[<?php echo $productId; ?>]" value="<?php echo $product_quantity; ?>" min="0" max="<?php echo $product_quantity; ?>">
                            </p>
                            <p class="error">عذرًا ، الكمية المتاحة أصغر من الكمية المطلوبة. الكمية المطلوبة <?php echo $quantity; ?></p>
                            <?php if ($product_quantity >= $quantity): ?>
                                <div class="info">
                                    <input type="checkbox" name="selected_products[]" id="product_<?php echo $productId; ?>" value="<?php echo $productId; ?>" checked>
                                    <label for="product_<?php echo $productId; ?>">اختر</label>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <p>الكمية: 
                                <input type="number" name="quantity[<?php echo $productId; ?>]" value="<?php echo $quantity; ?>" min="1" max="<?php echo $product_quantity; ?>">
                            </p>
                            <p>المتوفر: <?php echo $quantity * $price; ?></p>
                            <div class="info">
                                <?php if ($product_quantity >= $quantity): ?>
                                    <input type="checkbox" name="selected_products[]" id="product_<?php echo $productId; ?>" value="<?php echo $productId; ?>" checked>
                                    <label for="product_<?php echo $productId; ?>">محدد</label>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "No package details found.";
                }
                ?>
            </div>
        </div>
        <center>
            <div class="customize-package">
                <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                <input type="hidden" name="packageName" value="<?php echo $row1['name']; ?>">
                <?php if ($product_quantity != 0): ?>
                    <button type="submit" class="btn btn-dark m-1" name="addToCart">اضف الي السلة</button>
                <?php endif; ?>
            </div>
        </center>
    </form>
</div>
<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const label = this.parentNode.querySelector('label');
            if (this.checked) {
                label.textContent = 'محدد';
            } else {
                label.textContent = 'ازالة';
            }
        });
    });
</script>
