<?php
session_start();
include ('database/db.php');

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];


    $sql = "SELECT * FROM `products` WHERE `id` = $product_id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
    
    // Check if the product exists and has available stock
    if ($product && $quantity > 0 && $quantity <= $product['quantity']) {
        $cart_item = array(
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        );

        // Check if the cart session variable exists, create it if not
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Check if the product already exists in the cart, update the quantity if so
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $cart_item['id']) {
                $item['quantity'] += $cart_item['quantity'];
                $found = true;
                break;
            }
        }

        // If the product is not already in the cart, add it as a new item
        if (!$found) {
            $_SESSION['cart'][] = $cart_item;
        }

        // Redirect back to the cart page

        header('Location: checkout.php');
        exit();
    }
}
