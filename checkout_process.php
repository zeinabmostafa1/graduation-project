<?php
include('database/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {

  $address = $_POST['address'];

  // Retrieve user ID 
  $customerId = $_SESSION['user_id']; 

  // Calculate the total amount, total products and total quantity
  $totalAmount = 0;
  $totalProducts = 0;
  $totalQuantity = 0;
  foreach ($_SESSION['cart'] as $item) {
    $totalProducts += 1;
    $totalQuantity += $item['quantity'];
    $totalAmount += $item['price'] * $item['quantity'];

    // Reduce the quantity in the product table
    $productId = $item['id'];
    $productQuantity = $item['quantity'];

    $sql = "UPDATE products SET quantity = quantity - $productQuantity WHERE id = $productId";
    mysqli_query($conn, $sql);
  }

  // Insert into order table
  $sql = "INSERT INTO orders (customer_id, total_amount, total_products, total_quantity, address) VALUES ($customerId, $totalAmount, $totalProducts, $totalQuantity, '$address')";
  mysqli_query($conn, $sql);
  $orderId = mysqli_insert_id($conn); // Get the inserted order ID

  // Insert into order_details table
  foreach ($_SESSION['cart'] as $item) {
    $productId = $item['id'];
    $productQuantity = $item['quantity'];
    $price = $item['price'];

    $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ($orderId, $productId, $productQuantity, $price)";
    mysqli_query($conn, $sql);
  }

  // Clear the cart
  unset($_SESSION['cart']);
  header('Location: order_done.php');
  exit();
}
?>