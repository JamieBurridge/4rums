<?php 
    require_once "../database.php";
    require_once "../models/Post.php";
    require_once "../models/User.php";

    $user_model = new User($conn);
    $post_model = new Post($conn);
    $posts = $post_model->getTopicPosts($_GET["topic"]);
?>

<?php require_once "../components/header.php" ?>
    <?php require_once "../components/navbar.php" ?>

    <!-- Show posts related to topic -->
    <section>
        <?php

            foreach ($posts as $post)
            {
                $user = $user_model->getSingleUser($post["user_id"]);
                echo
                "
                    <div>
                        <h6>
                            " .$post["subject"]. "
                        </h6>
                        <p>
                            " .$post["content"]. "
                        </p>
                        <span>
                            Posted by: " .$user["username"]. "
                        </span>
                    </div>
                ";
            }

        ?>
    </section>


<?php require_once "../components/footer.php" ?>