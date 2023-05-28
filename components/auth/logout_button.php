<?php 
    if (isset($_POST["logout"])) 
    {
        // Destroy session
        session_start();
        session_unset();
        session_destroy();
        header("Location: /4rums/index.php");
        exit();
    } 
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <button class="btn btn-outline-danger btn-sm" type="submit" name="logout">Logout</button>
</form>