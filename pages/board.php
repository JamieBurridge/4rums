<?php
    require_once "../helpers/user.php";
    require_once "../database.php";
    require_once "../models/Topic.php";

    $topics_model = new Topic($conn);
    
    use User;
    $username = User\getUsername();

?>

<?php require_once "../components/header.php" ?>
<?php require_once "../components/navbar.php" ?>

<section>
    <h1>Welcome, <?php if($username) {echo $username;} ?> </h1>

    <!-- Handle post logic -->
    <hr>
    <!-- <div>
        <h2>Make a post</h2>
        <form action="" method="POST">
            <div>
                <label for="subject">Subject</label>
                <input type="text" placeholder="A subject here..." name="subject" required>
            </div>

            <div>
                <label for="post">Post</label>
                <textarea name="post" id="" cols="30" rows="10" maxlength="200" placeholder="Your post"></textarea>
            </div>

            <button type="submit">Post</button>
        </form>
    </div> -->

    <div>
        <ul>
            <?php
                $topics = $topics_model->getTopics();

                foreach ($topics as $topic)
                {
                    $topicUrl = "/4rums/pages/posts.php?topic=".$topic["id"];

                    echo 
                    "
                        <li>
                            <a href='".$topicUrl."'>
                                " .$topic["name"]. "
                            </a>
                        </li>
                    ";
                }
            ?>
        </ul>
    </div>

    <hr>

    <?php require_once "../components/auth/logout_button.php"  ?>  
</section>

<?php require_once "../components/footer.php"; ?>
