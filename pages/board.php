<?php
    require_once "../helpers/user.php";

    use User;
    $username = User\getUsername();
?>

<?php require_once "../components/header.php" ?>
<?php require_once "../components/navbar.php" ?>

<section>
    <h1>Welcome, <?php if($username) {echo $username;} ?> </h1>

    <!-- Put posts here -->
    <div>

    </div>
    
    <?php require_once "../components/auth/logout_button.php"  ?>  
</section>

<?php require_once "../components/footer.php"; ?>
