<?php
include('../database/db.php');
session_start();

if (isset($_POST['submit'])) {
    $message_id = $_POST['message_id'];
    $admin_id = $_POST['admin_id'];
    $order_id = $_POST['order_id'];
    $reply = $_POST['reply'];

    // Insert the admin's reply into the database
    $query = "UPDATE orders_messages SET admin_id = '$admin_id', admin_reply = '$reply', admin_reply_updated_at = CURRENT_TIMESTAMP WHERE id = $message_id AND order_id = $order_id";
    mysqli_query($conn, $query);
    $_SESSION['Done'] = "Thank you for your reply for Order ID: $order_id";
    header('Location: order.php');
}
?>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
    