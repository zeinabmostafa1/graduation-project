<?php 
include('nav.php');
if(isset($_SESSION['user'])){
header('location:index.php');
}
?>
    <!-- end header -->
    <div class="sign  m-5">
        <center>
            <img class="mb-1 mt-5" src="images/logo2.jpg" alt="" width="150" height="150">
            <h1 class="h3 mb-3 fw-normal">Sign In</h1>
        </center>
    <div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
        <?php include ('validation/message.php'); ?>
    <form class="row g-3 border p-4" action="handlers/login.php" method="POST" >
    <div class="col-sm-12">
                <label  class="form-label">Username, Email, or Phone</label>
                <div class="input-group">
                    <input type="text" class="form-control"  name="identifier" placeholder="Enter your Username, Email, or Phone" required>
                </div>
                <div class="invalid-feedback">
                    Valid identifier is required.
                </div>
            </div>
    <br>
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
    <br>
    <button class="my-3 w-30 btn btn-warning" type="submit" name="submit" id="submit"> Sign in </button>
    <p> not yet a member?<a href="sign-up.php"> Sign up </a></p> 
    </form>
    </div>
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
</body>
</html>