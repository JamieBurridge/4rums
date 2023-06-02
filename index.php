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
