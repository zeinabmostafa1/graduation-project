<?php 
session_start();
if(isset($_SESSION['admin'])){
    header('location:admin.php');
}
?>
<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <title>Admin login</title>
</head>
<body>
<div class="container pt-5">
        <div class="row">
            <div class="col-8 mx-auto">

            <?php  include ('../validation/message.php'); ?>

               
                <form class="row g-3 border p-4" action="../handlers/loginadmin.php" method="POST">
                    <div class="col-12">
                        <label for="inputEmail4" class="form-label">Email or Username</label>
                        <input type="text" name="username_email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-12">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>

</body>

</html>