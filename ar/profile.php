<?php 
include('nav.php');
include('database/db.php');
$customerId = $_SESSION['user_id'];
$sql = "SELECT * from users
        WHERE id = $customerId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="container">
<main>
    <div class="py-5 text-center">
    <div class="col-md-12 col-lg-12">
        <img class="" src="images/logo.png" alt="" width="72" height="57" style="border-radius: 50%;">
        <h1 class="h3  fw-normal">الملف الشخصي</h1>
    </div>
    </div>
    <div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
        <?php include ('validation/message.php'); ?>
    <form class="row g-3 border p-4" action="handlers/updateprofile.php" method="POST" >
            <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">الاسم الاول</label>
                <input type="text" class="form-control" name="firstName" placeholder="" value="<?php echo $row['first_name'] ?>" required>
                <div class="invalid-feedback">
                الاسم الاول مطلوب
                </div>
            </div>
            <div class="col-sm-6">
                <label for="lastName" class="form-label">اسم العائلة</label>
                <input type="text" class="form-control" name="lastName" placeholder="" value="<?php echo $row['last_name'] ?>" required>
                <div class="invalid-feedback">
                Valid last name is required.
                </div>
            </div>
            <div class="col-12">
                <label for="username" class="form-label">اسم المستخدم</label>
                <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>" placeholder="اسم المستخدم" required>
                <div class="invalid-feedback">
                    Your username is required.
                </div>
                </div>
            </div>
            <div class="col-12">
                <label for="phone" class="form-label"> رقم الهاتف</label>
                <div class="input-group has-validation">
                <input type="text" class="form-control" name="phone" placeholder="رقم الهاتف" value="<?php echo $row['phone'] ?>" required>
                <div class="invalid-feedback">
                    Your Phone is required.
                </div>
                </div>
            </div>
            <div class="col-12">
                <label for="email" class="form-label">البريد الالكتروني </label>
                <input type="email" class="form-control" name="email"  value="<?php echo $row['email'] ?>" placeholder="you@example.com">
                <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
                </div>
            </div>
            <div class="col-12">
                <label for="address" class="form-label">العنوان</label>
                <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>"  placeholder="1234 Main St" required>
                <div class="invalid-feedback">
                Please enter your shipping address.
                </div>
            </div>
            <div class="col-12">
                <label for="address2" class="form-label">العنوان 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" name="address2" value="<?php echo $row['address2'] ?>"  placeholder="Apartment or suite">
            </div>
            <div class="col-md-5">
                <label for="country" class="form-label">الدولة</label>
                <select class="form-select" name="country" required>
                <option value="Egypt" selected>مصر</option>
                </select>
                <div class="invalid-feedback">
                Please select a valid country.
                </div>
            </div>
            <div class="col-md-4">
            <label for="state" class="form-label">State</label>
            <select class="form-select" name="state" required>
            <option value="">Choose...</option>
            <option value="Cairo" <?php $selectedState = $row['state']; echo $selectedState == 'Cairo' ? 'selected' : ''; ?>>القاهرة</option>
            </select>
    <div class="invalid-feedback">
        Please provide a valid state.
    </div>
</div>
            <div class="col-md-3">
                <label for="zip" class="form-label">لالرمز البريدي</label>
                <input type="text" class="form-control" name="zip" value="<?php echo $row['zip'] ?>" placeholder="" required>
                <div class="invalid-feedback">
                الرمز البريدي مطلوب
                </div>
            </div>
            </div>
            <button class="my-3 w-30 btn btn-warning" type="submit" name="submit" id="submit"> تعديل</button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#password">تغيير كلمة السر</button>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">تغيير كلمة السر</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="handlers/changepassword.php" method="post">
        <div class="col-sm-12">
                <label for="password" class="form-label">كلمة السر الحالية</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="كلمة السر" required>
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
        <div class="col-sm-12">
                <label for="password" class="form-label">كلمة السر الجديد</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="ادخل كلمة السر" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
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
            <div class="col-sm-12">
    <label for="confirmPassword" class="form-label">تأكيد كلمة السر الجديدة</label>
    <div class="input-group">
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="ادخل كلمة السر" required>
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
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
    <button type="submit" class="btn btn-warning" name="submit">حفظ التغييرات</button>
</form>
      </div>
    </div>
  </div>
</div>
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
            var passwordInput = $('#old_password');
            var passwordType = passwordInput.attr('type');

            if (passwordType === 'password') {
                passwordInput.attr('type', 'text');
            } else {
                passwordInput.attr('type', 'password');
            }
        });
    });

    $(document).ready(function() {
        $('#togglePassword1').click(function() {
            var passwordInput = $('#new_password');
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
            var passwordInput = $('#confirm_password');
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