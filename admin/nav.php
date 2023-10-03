

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SuppMart Admin </title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
</head>

<body>

<nav class="navbar navbar-expand-lg  bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admins.php">Admins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="categories.php">Add Categories</a></li>
                            <li><a class="dropdown-item" href="view.php">View Categories</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="products.php">Add Products</a></li>
                            <li><a class="dropdown-item" href="viewproducts.php">View Products</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Orders</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Schools
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="add-school.php">Add School</a></li>
                            <li><a class="dropdown-item" href="view-school.php">View Schools</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="addadmin.php">Add new Admin</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../handlers/adminlogout.php">Logout</a>
                    </li>

          
            </ul>
        </div>
    </div>
</nav>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>