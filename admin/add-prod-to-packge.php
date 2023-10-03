<?php
session_start();

if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}


include('../database/db.php');
include('nav.php');

$package_name = $_SESSION['package_name'];
$package_id = $_SESSION['package_id'];

if (isset($_SESSION['admin_id'])) {
    $user_id = $_SESSION['admin_id'];

    // Pagination configuration
    $resultsPerPage = 20; // Number of results per page
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
    $offset = ($currentPage - 1) * $resultsPerPage; // Offset for database query

    // Build the SQL query with pagination
    $sql = "SELECT * FROM `products` ";
    
    // Check if a search query is submitted
    if (isset($_GET['search'])) {
        $searchQuery = $_GET['search'];
        $sql .= " WHERE  (`name` LIKE '%$searchQuery%' OR `price` LIKE '%$searchQuery%' OR `quantity` LIKE '%$searchQuery%')";
    }

    $countSql = "SELECT COUNT(*) AS total FROM (`products`)";
    $result = mysqli_query($conn, $sql);
    $countResult = mysqli_query($conn, $countSql);
    $row = mysqli_fetch_assoc($countResult);
    $totalResults = $row['total'];

    $totalPages = ceil($totalResults / $resultsPerPage); // Calculate total pages

    // Limit the query based on pagination
    $sql .= " LIMIT $offset, $resultsPerPage";

    $result = mysqli_query($conn, $sql);
}
?>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
 <center>

<h1 style="color: #e74c3c; font-size: 32px; text-align: center; text-transform: uppercase; font-weight: bold; letter-spacing: 2px;"><?php echo $_SESSION['school_name'] ?> School</h1>
</center>

<a href="view-package.php" class="btn btn-primary col-1 mx-auto m-3">Go back</a>
<div class="container pt-5">
    <div class="row">
        <div class="col-12 mx-auto">
            <p class="fs-1">Add Products To <mark><?php echo $package_name; ?></mark> Package</p>

            <?php include('../validation/message.php'); ?>

            <form class="d-flex" role="search" method="get">
                <input class="form-control me-2" type="search" placeholder="Search by name or price or quantity "
                    aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <form action="../school/add-products.php" method="post">
                <div class="selected-counter">
                    <h3>0 Product selected</h3>
                </div>

                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $c = 1; if(isset($result)): foreach($result as $value): ?>
                        <?php
                                $productId = $value['id'];
                                $isProductInPackage = false;

                                // Check if the product is already in the package_details table
                                $checkSql = "SELECT * FROM `package_details` WHERE `packge_id`='$package_id' AND `product_id`='$productId'";
                                $checkResult = mysqli_query($conn, $checkSql);

                        if (mysqli_num_rows($checkResult) > 0) {
                            $isProductInPackage = true;
                        }
                    ?>
                        <tr>

                            <th scope="row"><?php echo $c++; ?></th>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['price']; ?></td>
                            <td><?php echo $value['quantity']; ?></td>

                            <td>
                                <center>
                                    <img width="150px" src="../uploads/<?php echo $value['IMG']; ?>" alt="">
                                </center>
                            </td>
                            <td>
                                <center>
                                    <div class="counter">
                                        <?php if ($isProductInPackage): ?>
                                        <p>Product already in package</p>
                                        <?php else: ?>
                                        <input type="checkbox" name="products[]" value="<?php echo $value['id']; ?>"
                                            onclick="toggleQuantityInput(this)">
                                        <input type="number" name="quantity_<?php echo $value['id']; ?>"
                                            class="quantity-input col-12" placeholder="Quantity" min="1"
                                            max="<?php echo $value['quantity']; ?>" disabled required >
                                        <input type="number" hidden name="price_<?php echo $value['id']; ?>"
                                            class="price-input col-12" placeholder="Price" min="0"
                                            value="<?php echo $value['price']; ?>">
                                        <?php endif; ?>
                                    </div>
                                </center>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>


                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link"
                                href="?page=<?php echo $currentPage - 1; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                            <a class="page-link"
                                href="?page=<?php echo $i; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php endfor; ?>
                        <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link"
                                href="?page=<?php echo $currentPage + 1; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <center>

                    <button type="button" class="btn btn-warning" onclick="checkAllProducts()">Check All</button>
                    <button type="button" class="btn btn-danger" onclick="uncheckAllProducts()">Uncheck All</button>
                    <button type="submit" class="btn btn-primary">Add Selected Products</button>
                    <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
                </center>

            </form>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
<script>
function toggleQuantityInput(checkbox) {
    var quantityInput = checkbox.parentNode.querySelector('.quantity-input');
    quantityInput.disabled = !checkbox.checked;

    var selectedCounter = document.querySelector('.selected-counter h3');
    var counter = parseInt(selectedCounter.innerText.split(' ')[0]);
    var selectedText = checkbox.checked ? (counter + 1) : (counter - 1);
    selectedCounter.innerText = selectedText + ' Product selected';
}
function checkAllProducts() {
    var checkboxes = document.getElementsByName('products[]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = true;
        toggleQuantityInput(checkbox);
    });
}
function uncheckAllProducts() {
    var checkboxes = document.getElementsByName('products[]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
        toggleQuantityInput(checkbox);
    });
}
</script>