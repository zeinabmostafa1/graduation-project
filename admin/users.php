   

<?php
session_start();

if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}

include('nav.php');

include('../database/db.php');

// Pagination configuration
$limit = 20; // Number of records to show per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query to retrieve users with pagination and search
$start = ($page - 1) * $limit;
$sql = "SELECT * FROM `users` WHERE `first_name` LIKE '%$search%' OR `last_name` LIKE '%$search%' OR `phone` LIKE '%$search%' OR `email` LIKE '%$search%' LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

// Total number of records
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM `users`";
$totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Total number of pages
$totalPages = ceil($totalRecords / $limit);
?>
<div class="container pt-5">
    <div class="row">
        <div class="col-9 mx-auto">
            <h1>All Users</h1>
            <?php include('../validation/message.php'); ?>
            <form action="" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by name, email, or phone" value="<?php echo $search; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">State</th>
                        <th scope="col">Zip</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $c = ($page - 1) * $limit + 1;
                    if (isset($result)) {
                        foreach ($result as $value) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $c++; ?></th>
                                <td><?php echo $value['first_name']; ?></td>
                                <td><?php echo $value['last_name']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['phone']; ?></td>
                                <td><?php echo $value['address']; ?></td>
                                <td><?php echo $value['state']; ?></td>
                                <td><?php echo $value['zip']; ?></td>
                                <td>
                                    <?php if ($value['is_status'] == 1): ?>
                                        <a href="../handlers/block.php?id=<?php echo $value['id']?>" class="btn btn-danger">Block</a>
                                    <?php elseif ($value['is_status'] == 0): ?>
                                        <a href="../handlers/unblock.php?id=<?php echo $value['id']?>" class="btn btn-primary">Unblock</a>
                                        <?php endif; ?>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        // no records found
                        ?>
                        <tr>
                            <td colspan="9">No records found.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo $search; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo $search; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>

            <?php if (!empty($search)): ?>
                <div class="text-center">
                    <a href="?page=1" class="btn btn-primary">Show All Users</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
