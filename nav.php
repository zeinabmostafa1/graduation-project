<?php 
session_start();
include ('database/db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuppMart</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/supp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap" 
    rel="stylesheet">
</head>

<body>
    <!-- start header -->
    <header class="p-3 bg-white text-black sticky-top">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        </a>
        <a href="index.php">
            <img src="images/logo2.jpg" alt="" class="rounded-circle px-2" width="80">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 text-black link-warning " onclick="document.location='index.php'">Home</a></li>
            <li><a href="#services" class="nav-link px-2 text-black link-warning">Services</a></li>
            <li><a href="#" class="nav-link px-2 text-black link-warning" onclick="document.location='products.php'">Products</a></li>
            <li class="nav-item dropdown">
    <a href="schools.php" class="nav-link px-2 text-black link-warning dropdown-toggle btn" role="button" data-bs-toggle="dropdown" aria-expanded="false">Schools</a>
    <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="schools.php"> Show All Schools</a></li>
        <?php
        $schoolSql = "SELECT * FROM `schools`";
        $schoolResult = mysqli_query($conn, $schoolSql);
        while ($school = mysqli_fetch_assoc($schoolResult)) {
            ?>
            <li><a class="dropdown-item" href="school-list.php?id=<?php echo $school['id']; ?>"><?php echo $school['name']; ?></a></li>
        <?php } ?>
    </ul>
</li>
            <li><a href="index.php #contact" class="nav-link px-2 text-black link-warning">Contact Us</a></li>
            <li><a href="index.php #about" class="nav-link px-2 text-black link-warning">About</a></li>
            <?php 
            if(isset($_SESSION['user'])){?>
                <li><a href="orders.php" class="nav-link px-2 text-black link-warning">My Orders</a></li>
                <li><a href="profile.php" class="nav-link px-2 text-black link-warning">Profile</a></li>
                <?php
            } ?>
        </ul>
        <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item active" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul>
        <div class="text-end">
            <?php 
            if(!isset($_SESSION['user'])){?>
                <button type="button" class="btn btn-outline-dark me-2" onclick="document.location='login.php'">Login</button>
                <button type="button" class="btn btn-warning" onclick="document.location='Sign-up.php'">Sign-up</button>
                <?php
            } else {?>
                <a href="checkout.php"> <img src="images/logo1.png" width=70 alt=""> </a>
                <a type="button" href="handlers/logout.php" class="btn btn-outline-dark me-2">Logout</a>
                <?php
            }
            ?>
            <a href="ar/index.php"> <img src="egypt.JPG" width=40 alt="" class="ps-2"></a>

        </div>
        </div>
    </div>
    </header>