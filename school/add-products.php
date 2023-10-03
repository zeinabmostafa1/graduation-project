<?php
session_start();

include('../database/db.php');

if (isset($_SESSION['admin_id'])) {
    $user_id = $_SESSION['admin_id'];
    $package_id = $_POST['package_id'];
    $selectedProducts = $_POST['products'];
    $totalPrice = 0; // Variable to store the total price of selected products

    // Process each selected product
    foreach ($selectedProducts as $productId) {
        $quantity = $_POST['quantity_' . $productId];
        $price = $_POST['price_' . $productId];


        // Insert the product into the package_details table
        $insertSql = "INSERT INTO `package_details` (`packge_id`, `product_id`, `price`, `quantity`, `user_id`) VALUES ('$package_id', '$productId', '$price', '$quantity', '$user_id')";
        mysqli_query($conn, $insertSql);

        // Calculate the price of the selected quantity of the product and add it to the total price
        $totalPrice += $price * $quantity;
    }

    // Update the total price in the package table
    $updatePackageSql = "UPDATE `packages` SET `price` = `price` + '$totalPrice' WHERE `id` = '$package_id'";
    mysqli_query($conn, $updatePackageSql);

    // Redirect to a success page or perform any additional actions
    $_SESSION['Done'] = "Product Added";
    header("Location: ../admin/add-prod-to-packge.php");
    exit();
}
?>
