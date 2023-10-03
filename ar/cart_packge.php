<?php
include('database/db.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedProducts = $_POST['selected_products'];
    $packageName = $_POST['packageName'];
    $quantities = $_POST['quantity'];

    // Create an array to store the selected items with their package name
    $cartItems = array();

    // Loop through the selected products and add them to the cart
    foreach ($selectedProducts as $productId) {
        $quantity = intval($quantities[$productId]);

        $sql = "SELECT * FROM `products` WHERE `id` = $productId";
        $result = mysqli_query($conn, $sql);
        $productDetails = mysqli_fetch_assoc($result);
        $productName = $productDetails['name'];
        $price = floatval($productDetails['price']);
        // Create an item array
        $item = array(
            'id' => $productId,
            'name' => "Package " .$packageName . " - " . $productName,
            'price' => $price,
            'quantity' => $quantity
        );
        // Add the item to the cart
        $_SESSION['cart'][] = $item;
        $cartItems[] = $item;
    }
    // Redirect to the shopping cart page
    header('Location: checkout.php');
    exit();
}
?>
