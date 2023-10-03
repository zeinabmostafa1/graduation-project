<?php 
session_start();
include ('nav.php');
include('../database/db.php');

if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}
$admin_id=$_SESSION['admin_id'];
$sql = "SELECT * FROM `admin` WHERE `id` = $admin_id ";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);


$sq1 = "SELECT SUM(total_amount) AS total_sales FROM orders;";
$sales_result = mysqli_query($conn, $sq1);
$sales = mysqli_fetch_assoc($sales_result);

$sq1 = "SELECT COUNT(*) AS order_count FROM orders";
$order_result = mysqli_query($conn, $sq1);
$order = mysqli_fetch_assoc($order_result);

$sq1 = "SELECT COUNT(*) AS cutomer_count FROM users";
$cutomer_result = mysqli_query($conn, $sq1);
$cutomer = mysqli_fetch_assoc($cutomer_result);

$sq1 = "SELECT COUNT(*) AS school_count FROM schools";
$schools_result = mysqli_query($conn, $sq1);
$schools = mysqli_fetch_assoc($schools_result);

$sq1 = "SELECT COUNT(*) AS prdocut_count FROM products";
$products_result = mysqli_query($conn, $sq1);
$products = mysqli_fetch_assoc($products_result);
?>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>

<h1> Welcome, <?php echo $admin['name']?> </h1>

<div class="container">

    <div class="row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body bg-primary">
                    <h3 class="card-title">Total Sales</h3>
                    <hr>
                    <h5 class="card-text"><?php echo $sales['total_sales'] ?> L.E</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body bg-secondary">
                    <h3 class="card-title">Total Orders</h3>
                    <hr>
                    <h5 class="card-text"><?php echo $order['order_count'] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body bg-danger">
                    <h3 class="card-title">Total Customers</h3>
                    <hr>
                    <h5 class="card-text"><?php echo $cutomer['cutomer_count'] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body bg-warning">
                    <h3 class="card-title">Total Schools</h3>
                    <hr>
                    <h5 class="card-text"> <?php echo $schools['school_count'] ?> </h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body bg-info">
                    <h3 class="card-title">Total Products</h3>
                    <hr>
                    <h5 class="card-text"><?php echo $products['prdocut_count'] ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>