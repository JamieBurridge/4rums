<?php 
    require_once "../database.php";
    require_once "../models/Post.php";
    require_once "../models/User.php";
    require_once "../helpers/datetime.php";

    session_start();

    if (!isset($_SESSION["user_id"]))
    {
        header("Location: /4rums/index.php");
        exit();
    }

    $current_topic = $_GET["topic"];
    if (!$current_topic)
    {
        header("Location: /4rums/pages/board.php");
        exit();
    }
    
    $user_model = new User($conn);
    $post_model = new Post($conn);

    $posts = $post_model->getTopicPosts($current_topic);
    
    // Post something
    if (isset($_POST["post"]))
    {
        $user_id = $_SESSION["user_id"];
        $topic_id = $current_topic;
        $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $post_model->createPost($user_id, $topic_id, $subject, $content);

        // Reload page
        header("Location:".$_SERVER['PHP_SELF']."?topic=".$current_topic);
    }
?>

<?php require_once "../components/header.php" ?>
    <?php require_once "../components/navbar.php" ?>

    <!-- Show posts related to topic -->
    <section>
        <?php
            if ($posts["error"])
            {
                echo "<p>".$posts["error"]."</p>";
            } 
            else 
            {
                foreach ($posts as $post)
                {   
                    // Get user who made the post
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
                                at ".convertDateTime($post["created_at"])."
                            </span>
                        </div>
                        <hr>
                    ";
                }
            }
        ?>
    </section>

    <hr>

    <!-- Create post -->
    <section>
        <form action="<?php echo $_SERVER['PHP_SELF']."?topic=".$current_topic ?>" method="POST">
            <div>
                <label for="subject">Subject</label>
                <input type="text" name="subject">
            </div>

            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" maxlength="200"></textarea>
            </div>

            <button type="submit" name="post" value="post">Post</button>
        </form>
    </section>


<?php require_once "../components/footer.php" ?>