<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:adminlogin.php');
}
include('nav.php');
include('../database/db.php');

// Pagination variables
$resultsPerPage = 20; // Number of messages to display per page
$totalResults = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `contact_messages`")); // Total number of messages
$totalPages = ceil($totalResults / $resultsPerPage); // Total number of pages

// Get current page from the URL parameter, default to page 1 if not set
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startIndex = ($page - 1) * $resultsPerPage;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch messages based on search query and pagination
$query = "SELECT * FROM `contact_messages` WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR message LIKE '%$search%' LIMIT $startIndex, $resultsPerPage";
$result = mysqli_query($conn, $query);
?>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
            <p class="fs-1">All Messages</p>

            <?php include('../validation/message.php'); ?>

      <!-- Search form -->
        <form class="mb-3" action="" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search by name, email, message" value="<?php echo $search; ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>


            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $c = $startIndex + 1; // Counter for displaying row numbers
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $c++; ?></th>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['message'] ?></td>
                                <td><a class="btn btn-danger" href="../handlers/deletMsg.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">No messages found.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination links -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($totalPages > 1) {
                        if ($page > 1) {
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo ($page - 1); ?>&search=<?php echo $search; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                </li>
                        <?php
                        }
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
                                <a class="page-link" href="?page=<?php echo ($page + 1); ?>&search=<?php echo $search; ?>" aria-label="Next">
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
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
