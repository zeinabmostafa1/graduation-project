<?php
session_start();

if (isset($_POST['remove_from_cart']) && isset($_POST['key'])) {
    $key = $_POST['key'];
    
    // Remove the item from the cart
    if (isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]);
    }
    
    header('Location: checkout.php');
    exit();
}
?>
