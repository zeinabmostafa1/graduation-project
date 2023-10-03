<?php 
if(isset($_SESSION['user'])){
    header('location:index.php');
  }
include('nav.php');

// Check if there are any errors in the session
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
// Get the previously entered values from the session
$firstName = isset($_SESSION['form_data']['firstName']) ? $_SESSION['form_data']['firstName'] : '';
$lastName = isset($_SESSION['form_data']['lastName']) ? $_SESSION['form_data']['lastName'] : '';
$username = isset($_SESSION['form_data']['username']) ? $_SESSION['form_data']['username'] : '';
$phone = isset($_SESSION['form_data']['phone']) ? $_SESSION['form_data']['phone'] : '';
$email = isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '';
$address = isset($_SESSION['form_data']['address']) ? $_SESSION['form_data']['address'] : '';
$address2 = isset($_SESSION['form_data']['address2']) ? $_SESSION['form_data']['address2'] : '';
$country = isset($_SESSION['form_data']['country']) ? $_SESSION['form_data']['country'] : '';
$state = isset($_SESSION['form_data']['state']) ? $_SESSION['form_data']['state'] : '';
$zip = isset($_SESSION['form_data']['zip']) ? $_SESSION['form_data']['zip'] : '';

// Clear the session data
unset($_SESSION['form_data']);
?>
<div class="container">
<main>
    <div class="py-1 text-center"> 
    <div class="col-md-12 col-lg-12">
        <img class="mb-1 mt-2" src="images/logo2.jpg" alt="" width="150" height="150">
    <h1 class="h3  fw-normal">Sign up</h1>
    </div>
    </div>
    <div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
        <?php include ('validation/message.php'); ?>

    <form class="row g-3 border p-4" action="handlers/register.php" method="POST" >
            <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstName" placeholder="" value="<?php echo $firstName; ?>" required>
                <div class="invalid-feedback">
                Valid first name is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastName" placeholder="" value="<?php echo $lastName; ?>" required>
                <div class="invalid-feedback">
                Valid last name is required.
                </div>
            </div>

            <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                <div class="invalid-feedback">
                    Your username is required.
                </div>
                </div>
            </div>

            <div class="col-12">
                <label for="phone" class="form-label">Phone</label>
                <div class="input-group has-validation">
                <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo $phone; ?>" required>
                <div class="invalid-feedback">
                    Your Phone is required.
                </div>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
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


            <div class="col-sm-6">
    <label for="confirmPassword" class="form-label">Confirm Password</label>
    <div class="input-group">
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Enter your password" required>
        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
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
                <label for="email" class="form-label">Email </label>
                <input type="email" class="form-control" name="email" placeholder="you@example.com" value="<?php echo $email; ?>">
                <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
                </div>
            </div>

            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" placeholder="1234 Main St" value="<?php echo $address; ?>" required>
                <div class="invalid-feedback">
                Please enter your shipping address.
                </div>
            </div>

            <div class="col-12">
                <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" name="address2" placeholder="Apartment or suite" value="<?php echo $address2; ?>">
            </div>

            <div class="col-md-5">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" name="country" required>
                <option value="">Choose...</option>
                <option selected >Egypt</option>
                </select>
                <div class="invalid-feedback">
                Please select a valid country.
                </div>
            </div>

            <div class="col-md-4">
    <label for="state" class="form-label">State</label>
    <select class="form-select" name="state" required>
        <option value="">Choose...</option>
        <option value="Cairo" selected>Cairo</option>
    </select>
    <div class="invalid-feedback">
        Please provide a valid state.
    </div>
</div>
            <div class="col-md-3">
                <label for="zip" class="form-label">Zip</label>
                <input type="text" class="form-control" name="zip" placeholder="" value="<?php echo $zip; ?>" required>
                <div class="invalid-feedback">
                Zip code required.
                </div>
            </div>
            </div>
            <button class="my-3 w-30 btn btn-warning" type="submit" name="submit" id="submit"> sign up </button>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
</main>
</div>
    <!-- start footer -->
    <div class="footer">
    <div class="container">
    &copy;2023 <span> SuppMart </span> All Right Reserved

    <div class="social">
        Find Us On Social Networks <br>
        <i class="fa-brands fa-youtube"></i>
        <i class="fa-brands fa-facebook-f"></i>
        <i class="fa-brands fa-twitter"></i>
    </div>
    </div>
    </div>
    <!-- end footer -->
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
    $(document).ready(function() {
        $('#toggleConfirmPassword').click(function() {
            var passwordInput = $('#confirmPassword');
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