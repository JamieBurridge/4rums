<?php
    require_once "../models/Post.php";
    require_once "../models/User.php";
    require_once "../database.php";
    require_once "../helpers/datetime.php";

    session_start();

    $current_post = $_GET["post"];
    if (!$current_post)
    {
        header("Location: /4rums/pages/board.php");
        exit();
    }

    $user_model = new User($conn);
    $post_model = new Post($conn);

    $post = $post_model->getSinglePost($current_post);
    $user = $user_model->getSingleUser($post["user_id"]);

?>

<?php require_once "../components/header.php" ?>
    <?php require_once "../components/navbar.php" ?>

    <section>
        <!-- Original post -->
        <?php 
             echo
             "
                 <div class='card mb-3'>
                     <div class='card-body'>
                         <h5 class='card-title'>
                            " .$post["subject"]. "
                         </h5>
                         <p class='card-text'>
                             " .$post["content"]. "
                         </p>
                         <span class='badge rounded-pill text-bg-primary'> 
                             Posted by: " .$user["username"]. "
                             at ".convertDateTime($post["created_at"])."
                         </span>
                     </div>
                 </div>
             ";
        ?>

        <!-- Post replies -->
        <div>
            
        </div>
    </section>

<?php require_once "../components/footer.php" ?>