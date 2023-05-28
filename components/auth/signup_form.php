<?php 
    require_once "database.php";
    require_once "models/User.php";
    require_once "helpers/auth.php";

    $user_model = new User($conn);
    $signup_error_message = "";

    try 
    {
        if (isset($_POST["signup"])) 
        {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $new_user = $user_model->createUser($username, $password);

            if ($new_user["error"])
            {
                $signup_error_message = $new_user["error"];
            } 
            else 
            {
                // Immediately login after creating an account
                $signup_response = handleLogin($username, $password, $user_model, $signup_error_message);
                $signup_error_message = $signup_response["error"];
            }
        }
    }
    catch (Exception $error)
    {
        $signup_error_message = "Oops! An unexpected error ocurred.";
    }
?>

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
</form>