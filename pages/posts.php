<?php 
    require_once "../database.php";
    require_once "../models/Post.php";
    require_once "../models/User.php";
    require_once "../models/Topic.php";
    require_once "../helpers/datetime.php";

    session_start();

    if (!isset($_SESSION["user_id"]))
    {
        header("Location: /index.php");
        exit();
    }

    $current_topic_id = $_GET["topic"];
    if (!$current_topic_id)
    {
        header("Location: /pages/board.php");
        exit();
    }

    $user_model = new User($conn);
    $post_model = new Post($conn);
    $topic_model = new Topic($conn);

    $posts = $post_model->getTopicPosts($current_topic_id);
    $current_topic_name = $topic_model->getSingleTopic($current_topic_id)["name"];

    // Post something
    if (isset($_POST["post"]))
    {
        $user_id = $_SESSION["user_id"];
        $topic_id = $current_topic_id;
        $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Split content into paragraphs
        $paragraphs = explode("\n", $content);

        // Filter out empty paragraphs
        $paragraphs = array_filter($paragraphs, function($paragraph) {
            return trim($paragraph) !== '';
        });

        // Rejoin paragraphs with line breaks
        $content = implode("\n", $paragraphs);

        // Convert new lines to line breaks
        $content = nl2br($content);

        $post_model->createPost($user_id, $topic_id, $subject, $content);

        // Reload page
        header("Location:".$_SERVER['PHP_SELF']."?topic=".$current_topic_id);
    }
?>

<?php require_once "../components/header.php" ?>
    <?php require_once "../components/navbar.php" ?>

    <!-- Create post modal -->
    <div class="modal" id="create-post-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            <form action="<?php echo $_SERVER['PHP_SELF']."?topic=".$current_topic_id ?>" method="POST">
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

    <hr>

    <!-- Show posts related to topic -->
    <section>
        <h4>Topic: <?php echo $current_topic_name ?></h4>
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
                    $user = $user_model->getSingleUser($post["user_id"])["username"];
                    $post_url = "/pages/post.php?post=".$post["id"];

                    echo
                    "
                        <div class='card mb-3'>
                            <div class='card-body'>
                                <h5 class='card-title'>
                                    <a href="."$post_url ".">
                                        " .$post["subject"]. "
                                    </a>
                                </h5>
                                <p class='card-text'>
                                    " .$post["content"]. "
                                </p>
                                <span class='badge rounded-pill text-bg-primary'>
                                    Posted by: " .$user. "
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
