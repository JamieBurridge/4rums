<?php 

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
</form>