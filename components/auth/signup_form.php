<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" class="form-control" id="username" placeholder="JohnDoe" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="supersecret123" required>
  </div>
  <button type="submit" name="signup" class="btn btn-primary">Signup</button>

  <?php if ($signup_error_message) {echo "<p class='text-danger pt-2'>" . $signup_error_message . "</p>";} ?>
  <?php if ($signup_success_message) {echo "<p class='text-success pt-2'>" . $signup_success_message . "</p>";} ?>
</form>