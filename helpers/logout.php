<?php 
    // Destroy session
    session_start();
    session_unset();
    session_destroy();
    header("Location: /4rums/index.php");
    exit();
?>
