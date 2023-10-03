<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}

$admin_id= $_SESSION['admin_id'];
include('nav.php');
include('../database/db.php');

// Pagination configuration
$limit = 50; // Number of records to show per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query to retrieve orders with pagination and search
$start = ($page - 1) * $limit;
$sql = "SELECT o.id AS order_id, o.total_amount, o.address, o.total_products, o.total_quantity,
        od.product_id, od.quantity, od.price, o.created_at,
        p.name AS product_name, p.price AS product_price,
        u.first_name, u.last_name, u.username, u.email, u.phone
        FROM orders AS o
        INNER JOIN order_details AS od ON o.id = od.order_id
        INNER JOIN products AS p ON od.product_id = p.id
        INNER JOIN users AS u ON o.customer_id = u.id
        WHERE u.first_name LIKE '%$search%' OR u.last_name LIKE '%$search%' OR u.email LIKE '%$search%' OR u.phone LIKE '%$search%'
        ORDER BY o.id DESC
        LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

// Total number of records
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM orders";
$totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Total number of pages
$totalPages = ceil($totalRecords / $limit);

?>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
<div class="container pt-5">
    <div class="row">
        <div class="col-12">
        <?php  include ('../validation/message.php'); ?>

            <h1>All Orders</h1>
            <form action="" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by name, email, or phone"
                        value="<?php echo $search; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer Name </th>
                        <th scope="col">Customer Phone </th>
                        <th scope="col">Customer Email </th>
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
                    if (mysqli_num_rows($result) > 0) {
                        $prev_order_id = null; // Initialize a variable to track the previous order ID
                        while ($row = mysqli_fetch_assoc($result)) {
                            $order_id = $row['order_id'];
                            $name = $row['first_name'] . " ". $row['last_name'] ;
                            $username = $row['username'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                            $total_amount = $row['total_amount'];
                            $address = $row['address'];
                            $created_at = $row['created_at'];
                            $total_products = $row['total_products'];
                            $total_quantity = $row['total_quantity'];
                            // Check if the current order ID is different from the previous one
                            if ($order_id !== $prev_order_id) {
                                ?>

                    <tr>

                        <td><?php echo $order_id; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $total_amount; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $total_products; ?></td>
                        <td><?php echo $total_quantity; ?></td>
                        <td><?php echo $created_at; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal-<?php echo $order_id; ?>">
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
                    <div class="modal fade" id="exampleModal-<?php echo $order_id; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                            $sql_details = "SELECT od.quantity, od.price, p.name AS product_name
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
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Contact Admin Modal -->
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
                        $message_id = $row_message['id'];
                        $message_content = $row_message['message'];
                        $message_date = $row_message['created_at'];
                        $admin_reply = $row_message['admin_reply'];
                        $admin_reply_date = $row_message['admin_reply_updated_at'];
                        ?>
                        <div class="mb-3">
                            <p>Message: <?php echo $message_content; ?></p>
                            <p>Date Message: <?php echo $message_date; ?></p>
                            <p>Admin reply: <?php echo $admin_reply; ?></p>
                            <p>Admin reply Date: <?php echo $admin_reply_date; ?></p>

                            <!-- User Reply Form -->
                            <?php if (empty($admin_reply)) { ?>
                                <form action="reply_order.php" method="post">
                                    <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">
                                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                                    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                                    <div class="mb-3">
                                        <label for="reply-<?php echo $message_id; ?>" class="form-label">Your Reply:</label>
                                        <textarea class="form-control" id="reply-<?php echo $message_id; ?>" name="reply" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Send Reply</button>
                                </form>
                            <?php } ?>

                            <hr>
                        </div>
                        <?php
                    }
                }
                ?>

        </div>
    </div>
</div>

                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='10'>No orders found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

           <!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php
        if ($totalPages > 1) {
            if ($page > 1) {
                ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($page - 1); ?>&search=<?php echo $search; ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                </li>
                <?php
            }
            // Display page numbers
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    ?>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link"><?php echo $i; ?></span>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php
                }
            }
            if ($page < $totalPages) {
                ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($page + 1); ?>&search=<?php echo $search; ?>"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</nav>

        </div>
    </div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>