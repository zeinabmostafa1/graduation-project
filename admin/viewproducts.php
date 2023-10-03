<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:adminlogin.php');
}

include('nav.php');
include('../database/db.php');

// Pagination configuration
$resultsPerPage = 30; // Number of results per page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($currentPage - 1) * $resultsPerPage; // Offset for database query

// Build the SQL query with pagination
$sql = "SELECT p.*, c.name AS category_name
    FROM products p
    INNER JOIN categ c ON p.categ_id = c.id";


// Check if a search query is submitted
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $sql .= " WHERE (p.name LIKE '%$searchQuery%' OR c.name LIKE '%$searchQuery%' OR p.price LIKE '%$searchQuery%' OR p.quantity LIKE '%$searchQuery%')";
}
$countSql = "SELECT COUNT(*) AS total FROM ($sql) AS countTable";
$result = mysqli_query($conn, $sql);
$countResult = mysqli_query($conn, $countSql);
$row = mysqli_fetch_assoc($countResult);
$totalResults = $row['total'];

$totalPages = ceil($totalResults / $resultsPerPage); // Calculate total pages

// Limit the query based on pagination
$sql .= " LIMIT $offset, $resultsPerPage";

$result = mysqli_query($conn, $sql);
?>


<div class="container pt-5">
    <div class="row">
        <div class="col-12 mx-auto">
            <p class="fs-1">All Products</p>

            <?php include('../validation/message.php'); ?>

            <form class="d-flex" role="search" method="get">
                <input class="form-control me-2" type="search" placeholder="Search by name, category, price or quantity"
                    aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $c = 1;
                    if (isset($result)) : foreach ($result as $value) : ?>
                            <tr>
                                <th scope="row"><?php echo $c++; ?></th>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo $value['category_name'] ?></td>
                                <td><?php echo $value['price'] ?></td>
                                <td><?php echo $value['quantity'] ?></td>
                                <td>
                                    <center>
                                        <img width="150px" src="../uploads/<?php echo $value['IMG'] ?>" alt="">
                                    </center>
                                </td>
                                <td>
                                    <a href="update-products.php?id=<?php echo $value['id']; ?>" class="btn btn-primary">Update</a>
                            <a href="../products/delete.php?id=<?php echo $value['id']; ?>&IMG_name=<?php echo $value['IMG']?> " class="btn btn-danger "> Delete</a>
                            </td>
                    </tr>
                    <?php endforeach;endif ?>
                </tbody>
            </table>
            <?php if ($totalResults > 0) : ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($currentPage > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($currentPage < $totalPages) : ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>


            <a href="products.php" class="btn btn-primary mb-3" role="button" >Add New Product</a>
            <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>




