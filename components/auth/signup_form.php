<?php 
    require_once "database.php";
    require_once "models/User.php";

    $user_model = new User($conn);
    $signup_error_message;

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
        }
    
    }
    catch (Exception $error)
    {
        $signup_error_message = "Oops! An unexpected error ocurred.";
    }

?>

<form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit" name="signup" value="submit">Signup</button>

    <?php if ($signup_error_message) {echo "<p>" . $signup_error_message . "</p>";} ?>
</form>

