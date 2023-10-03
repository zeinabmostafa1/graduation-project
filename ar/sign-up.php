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
    <div class="py-5 text-center">
    
    <div class="col-md-12 col-lg-12">
        <img class="" src="images/logo.png" alt="" width="72" height="57" style="border-radius: 50%;">
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
                <label for="firstName" class="form-label">الاسم الاول</label>
                <input type="text" class="form-control" name="firstName" placeholder="" value="<?php echo $firstName; ?>" required>
                <div class="invalid-feedback">
                Valid first name is required.
                </div>
            </div>
            <div class="col-sm-6">
                <label for="lastName" class="form-label">اسم العائلة</label>
                <input type="text" class="form-control" name="lastName" placeholder="" value="<?php echo $lastName; ?>" required>
                <div class="invalid-feedback">
                Valid last name is required.
                </div>
            </div>
            <div class="col-12">
                <label for="username" class="form-label">اسم المستخدم</label>
                <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                <div class="invalid-feedback">
                    Your username is required.
                </div>
                </div>
            </div>
            <div class="col-12">
                <label for="phone" class="form-label">رقم الهاتف</label>
                <div class="input-group has-validation">
                <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo $phone; ?>" required>
                <div class="invalid-feedback">
                    Your Phone is required.
                </div>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="password" class="form-label">كلمة السر</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="ادخل كلمة السر" required>
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
    <label for="confirmPassword" class="form-label">تاكيد كلمة السر</label>
    <div class="input-group">
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="ادخل كلمة السر" required>
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
                <label for="email" class="form-label">البريد الاكتروني </label>
                <input type="email" class="form-control" name="email" placeholder="you@example.com" value="<?php echo $email; ?>">
                <div class="invalid-feedback">
                الرجاء إدخال عنوان بريد إلكتروني صالح لتحديثات الشحن.
                </div>
            </div>
            <div class="col-12">
                <label for="address" class="form-label">العنوان</label>
                <input type="text" class="form-control" name="address" placeholder="1234 Main St" value="<?php echo $address; ?>" required>
                <div class="invalid-feedback">
                من فضلك أدخل عنوان الشحن الخاص بك.
                </div>
            </div>
            <div class="col-12">
                <label for="address2" class="form-label"> 2 العنوان<span class="text-muted">(اختياري)</span></label>
                <input type="text" class="form-control" name="address2" placeholder="Apartment or suite" value="<?php echo $address2; ?>">
            </div>
            <div class="col-md-5">
                <label for="country" class="form-label">الدولة</label>
                <select class="form-select" name="country" required>
                <option value="">اختر...</option>
                <option selected >مصر</option>
                </select>
                <div class="invalid-feedback">
                يرجى تحديد دولة صالحة.
                </div>
            </div>
            <div class="col-md-4">
    <label for="state" class="form-label">ولاية</label>
    <select class="form-select" name="state" required>
        <option value="">اختر...</option>
        <option value="Cairo" selected>القاهرة</option>
    </select>
    <div class="invalid-feedback">
        يرجي ادخال ولاية صالحة.
    </div>
</div>
            <div class="col-md-3">
                <label for="zip" class="form-label">الرمز البريدى</label>
                <input type="text" class="form-control" name="zip" placeholder="" value="<?php echo $zip; ?>" required>
                <div class="invalid-feedback">
                الرمز البريدى مطلوب</div>
            </div>
            </div>
            <button class="my-3 w-30 btn btn-warning" type="submit" name="submit" id="submit"> انشاء حساب </button>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
</main>
</div>
<!-- start footer  -->
<div class="footer">
    <div class="container">
        &copy;2023 <span> SuppMart </span> جميع الحقوق محفوظة
    <div class="social">
        تواصل معنا  <br>
        <a href="https://www.youtube.com/"  class="p-2" ><i class="fa-brands fa-youtube text-black-50"></i></a>
        <a href="https://www.facebook.com/"  class="p-2"><i class="fa-brands fa-facebook-f text-black-50"></i></a>
        <a href="https://www.twitter.com/" class="p-2"><i class="fa-brands fa-twitter text-black-50"></i></a>
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