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

    <!-- Create post -->
    <div class="modal" id="create-post-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
            <form action="<?php echo $_SERVER['PHP_SELF']."?topic=".$current_topic ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control">
                    </div>
        
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" class="form-control" id="content" cols="30" rows="10" maxlength="200"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="post" value="post">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-post-modal">Create post</button>

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
                }
            }
        ?>
    </section>
<?php require_once "../components/footer.php" ?>