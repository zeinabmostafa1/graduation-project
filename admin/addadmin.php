
<?php 
session_start();
include ('nav.php');
include ('../database/db.php');
?>


<div class="content w-full">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-10 mx-auto">


            <?php include ('../validation/message.php'); ?>

                <form class="row g-3 border p-4" action="../handlers/addadmin.php" method="POST">
                    <div class="col-12">
                        <label for="inputEmail4" class="form-label">name</label>
                        <input type="text" name="name" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-12">
                        <label for="inputEmail4" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-12">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-sm-12">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control"  id="password" name="password"  placeholder="Enter your password" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg>
                    </button>
                </div>
                <div class="invalid-feedback">
                    Valid password is required.
                </div>
            </div>

                    <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>


    </div>

    
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            var passwordInput = $('#password');
            var passwordType = passwordInput.attr('type');

            if (passwordType === 'password') {
                passwordInput.attr('type', 'text');
            } else {
                passwordInput.attr('type', 'password');
            }
        });
    });
    </script>
        <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>