<?php
include('nav.php');
include('database/db.php');

$customerId = $_SESSION['user_id'];

$sql = "SELECT o.id AS order_id, o.total_amount, o.address, o.total_products, o.total_quantity, 
        od.product_id, od.quantity, od.price, o.created_at,
        p.name AS product_name, p.price AS product_price
        FROM orders AS o
        INNER JOIN order_details AS od ON o.id = od.order_id
        INNER JOIN products AS p ON od.product_id = p.id
        WHERE o.customer_id = $customerId";

$result = mysqli_query($conn, $sql);
?>

<div class="container pt-5">
    <div class="row">
        <div class="col-12">
            <h1 style="text-align:center;" class="mb-3">All Orders</h1>
            <?php include ('validation/message.php'); ?>
            <table class="table table-bordered border-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Address</th>
                        <th scope="col">Total Products</th>
                        <th scope="col">Total Quantity</th>
                        <th scope="col">Created At </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $c=1;
    if (mysqli_num_rows($result) > 0) {
    $prev_order_id = null; // Initialize a variable to track the previous order ID
    while ($row = mysqli_fetch_assoc($result)) {
        $order_id = $row['order_id'];
        $total_amount = $row['total_amount'];
        $address = $row['address'];
        $created_at = $row['created_at'];
        $total_products = $row['total_products'];
        $total_quantity = $row['total_quantity'];

        // Check if the current order ID is different from the previous one
        if ($order_id !== $prev_order_id) {
            ?>
            <tr>
            <td><?php echo $c; ?></td>
                <td><?php echo $total_amount; ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $total_products; ?></td>
                <td><?php echo $total_quantity; ?></td>
                <td><?php echo $created_at; ?></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $order_id; ?>">
                        View Details
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal-<?php echo $order_id; ?>">
                        Contact
                    </button>
                </td>
            </tr>
            <?php
            $prev_order_id = $order_id; // Update the previous order ID
        }
        ?>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal-<?php echo $order_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $sql_details = "SELECT  od.quantity, od.price, p.name AS product_name
                                        FROM order_details AS od
                                        INNER JOIN products AS p ON od.product_id = p.id
                                        WHERE od.order_id = $order_id";
                        $result_details = mysqli_query($conn, $sql_details);
                        if (mysqli_num_rows($result_details) > 0) {
                            while ($row_details = mysqli_fetch_assoc($result_details)) {
                                $product_name = $row_details['product_name'];
                                $quantity = $row_details['quantity'];
                                $price = $row_details['price'];
                                ?>
                                <p>Product: <?php echo $product_name; ?></p>
                                <p>Quantity: <?php echo $quantity; ?></p>
                                <p>Price: <?php echo $price; ?></p>
                                <hr>
                                <?php
                            }
                        } else {
                            echo "No order details found.";
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Admin Modal -->
<div class="modal fade" id="contactModal-<?php echo $order_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Contact Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // Retrieve previous messages for the order
                $sql_messages = "SELECT * FROM orders_messages WHERE order_id = $order_id";
                $result_messages = mysqli_query($conn, $sql_messages);
                
                if (mysqli_num_rows($result_messages) > 0) {
                    while ($row_message = mysqli_fetch_assoc($result_messages)) {
                        $message_content = $row_message['message'];
                        $message_date = $row_message['created_at'];
                        $admin_reply = $row_message['admin_reply'];
                        $admin_reply_updated_at = $row_message['admin_reply_updated_at'];
                        ?>
                        <div class="mb-3">
                            <p>Message: <?php echo $message_content; ?></p>
                            <p>Date Message: <?php echo $message_date; ?></p>
                            <p>Admin reply: <?php echo $admin_reply; ?></p>
                            <p>Admin reply Date: <?php echo $admin_reply_updated_at; ?></p>

                            <hr>
                        </div>
                        <?php
                    }
                }
                ?>

                <form action="contact_order.php" method="post">
            
                    <input type="hidden" name="number" value="<?php echo $c++; ?>">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $customerId; ?>">
                    <div class="mb-3">
                        <label for="message" class="form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

        <?php
    }
} else {
    echo "<tr><td colspan='7'>No orders found.</td></tr>";
}
?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
