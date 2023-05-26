<?php
    require_once "database.php";
    require_once "models/User.php";
    require_once "helpers/auth.php";

    $user_model = new User($conn);
    $login_error_message = "";

    try 
    {
        if (isset($_POST["login"])) 
        {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $login_response = handleLogin($username, $password, $user_model, $login_error_message);
            $login_error_message = $login_response["error"];
        }
    } 
    catch (Exception $error) 
    {
        $login_error_message = "Oops! An unexpected error occurred";
    }
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit" name="login" value="submit">Login</button>

    <?php if ($login_error_message) {echo "<p>" . $login_error_message . "</p>";} ?>
</form>

