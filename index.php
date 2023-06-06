<?php
    require_once "helpers/auth.php";
    require_once "database.php";
    require_once "models/User.php";

    $user_model = new User($conn);

    // Login
    $login_error_message = "";
    try
    {
        if (isset($_POST["login"]))
        {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $login_response = handleLogin($username, $password, $user_model);
            $login_error_message = $login_response["error"];
        }
    }
    catch (Exception $error)
    {
        $login_error_message = "Oops! An unexpected error occurred";
    }

    // Signup
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

<?php require_once "components/header.php" ?>
    <section class="mt-2">
        <h1>4rums</h1>
        <p>A place where people can hang out and discuss their favorite topics.</p>

        <!-- Login form -->
        <h3>Login</h3>
        <?php require_once "components/auth/login_form.php" ?>

        <hr>

        <!-- Signup form -->
        <h3>Signup</h3>
        <?php require_once "components/auth/signup_form.php" ?>
    </section>
<?php require_once "components/footer.php" ?>