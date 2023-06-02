<?php
    require_once "../models/Post.php";
    require_once "../models/User.php";
    require_once "../models/Reply.php";
    require_once "../database.php";
    require_once "../helpers/datetime.php";

    session_start();

    if (!isset($_SESSION["user_id"]))
    {
        header("Location: /4rums/index.php");
        exit();
    }

    $current_post_id = $_GET["post"];
    if (!$current_post_id)
    {
        header("Location: /4rums/pages/board.php");
        exit();
    }

    $user_model = new User($conn);
    $post_model = new Post($conn);
    $reply_model = new Reply($conn);

    $post = $post_model->getSinglePost($current_post_id);
    $original_poster = $user_model->getSingleUser($post["user_id"]);
    $replies = $reply_model->getPostReplies($current_post_id);

    // Handle reply creation
    if (isset($_POST["reply"]))
    {
        $user_id = $_SESSION["user_id"];
        $post_id = $current_post_id;
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

        $reply_model->createReply($user_id, $post_id, $content);

        // Reload page
        header("Location:".$_SERVER['PHP_SELF']."?post=".$current_post_id);
    }
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
                             Posted by: " .$original_poster["username"]. "
                         </span>
                     </div>
                 </div>
             ";
        ?>

        <div>
            <!-- Reply modal -->
            <div class="modal" id="reply-post-modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reply</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    
                    <form action="<?php echo $_SERVER['PHP_SELF']."?post=".$current_post_id ?>" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" class="form-control" id="content" cols="30" rows="10" maxlength="200"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="reply" value="reply">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#reply-post-modal">Reply</button>

            <!-- Show replies -->
            <?php
                if ($replies["error"])
                {
                    echo "<p class='text-danger pt-2'>".$replies["error"]."</p>";
                }
                else 
                {
                    foreach ($replies as $reply)
                    {
                        $reply_by = $user_model->getSingleUser($reply["user_id"])["username"];


                        $badge_color = $reply["user_id"] == $post["user_id"] ? "badge rounded-pill text-bg-primary" : "badge rounded-pill text-bg-success";

                        echo 
                        "
                            <div class='card mb-3'>
                                <div class='card-body'>
                                    <p class='card-text'>
                                        " .$reply["content"]. "
                                    </p>
                                    <span class='".$badge_color."'> 
                                        By: " .$reply_by. "
                                    </span>
                                </div>
                            </div>
                        ";
                    }

                }

            ?>
        </div>
    </section>

<?php require_once "../components/footer.php" ?>