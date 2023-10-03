<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}

include('../database/db.php');

$package_name = $_SESSION['package_name'];
$package_id = $_SESSION['package_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Loop through the submitted quantities
    foreach ($_POST['products'] as $product_id) {
        $new_quantity = intval($_POST['quantity_' . $product_id]);
        $price = floatval($_POST['price']);

        // Retrieve the previous quantity from the package_details table
        $selectSql = "SELECT `quantity` FROM `package_details` WHERE `product_id` = $product_id AND `packge_id` = $package_id";
        $result = mysqli_query($conn, $selectSql);
        $row = mysqli_fetch_assoc($result);
        $previous_quantity = intval($row['quantity']);

        // Calculate the difference in quantity
        $quantity_diff = $new_quantity - $previous_quantity;
        $price_diff = $quantity_diff * $price; // Calculate the price difference

        // Update the quantity in the package_details table
        $updateSql = "UPDATE `package_details` SET `quantity` = $new_quantity WHERE `product_id` = $product_id AND `packge_id` = $package_id";
        mysqli_query($conn, $updateSql);

        // Update the price in the package table
        $updatePackageSql = "UPDATE `packages` SET `price` = `price` + $price_diff WHERE `id` = $package_id";
        mysqli_query($conn, $updatePackageSql);
    }

    $_SESSION['Done'] = "Product Updated";
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

include('nav.php');

$sql = "SELECT pd.*, p.name AS product_name, p.quantity AS product_quantity, p.price AS product_price, p.img AS product_img, pd.quantity AS pack_quantity
    FROM `package_details` pd
    INNER JOIN `products` p ON pd.product_id = p.id
    WHERE pd.packge_id = '$package_id'";

$result = mysqli_query($conn, $sql);
?>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
<center>
    <h1 style="color: #e74c3c; font-size: 32px; text-align: center; text-transform: uppercase; font-weight: bold; letter-spacing: 2px;"><?php echo $_SESSION['school_name'] ?> School</h1>
</center>
<a href="view-package.php" class="btn btn-primary col-1 mx-auto m-3">Go back</a>
<div class="container pt-5">
    <div class="row">
        <div class="col-9 mx-auto">
            <p class="fs-1">View <mark><?php echo $package_name ;?></mark> Products</p>
            <?php include('../validation/message.php'); ?>

            <form method="POST">
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">IMG</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Available Quantity</th>
                            <th scope="col">Update Quantity </th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $c = 1; if(isset($result)): foreach($result as $value):?>
                            <tr>
                                <th scope="row"><?php echo $c++; ?></th>
                                <td><?php echo $value['product_name'] ?></td>
                                <td> 
                                    <center>
                                        <img src="../uploads/<?php echo $value['product_img'] ?>" width="150px" alt=""> 
                                    </center>
                                </td>
                                <td><?php echo $value['product_price'] ?></td>
                                <td><?php echo $value['pack_quantity'] ?></td>
                                <td><?php echo $value['product_quantity'] ?></td>
                                <td>
                                    <input type="checkbox" class="update-checkbox" name="products[]" value="<?php echo $value['product_id']; ?>">
                                    <input type="hidden" value="<?php echo $value['product_price'] ?>" name="price">
                                    <div class="update-quantity-input">
                                        <input type="number" name="quantity_<?php echo $value['product_id']; ?>"
                                            class="quantity-input col-12" placeholder="Quantity" min="1"
                                            max="<?php echo $value['product_quantity']; ?>" disabled value="<?php echo $value['pack_quantity']; ?>">
                                    </div>
                                </td>
                                <td>
                                   
                                <a href="../school/delete-prdouct.php?id=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach;endif ?>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Update Quantity</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleQuantityInput(checkbox) {
        const quantityInput = checkbox.parentElement.querySelector('.quantity-input');
        quantityInput.disabled = !checkbox.checked;
    }

    const updateCheckboxes = document.querySelectorAll('.update-checkbox');

    updateCheckboxes.forEach((checkbox) => {
        const quantityInput = checkbox.parentElement.querySelector('.quantity-input');

        checkbox.addEventListener('change', () => {
            toggleQuantityInput(checkbox);
        });

        // Disable quantity input initially if checkbox is not checked
        if (!checkbox.checked) {
            toggleQuantityInput(checkbox);
        }
    });
</script>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>