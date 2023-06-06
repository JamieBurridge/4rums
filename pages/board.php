<?php
    require_once "../database.php";
    require_once "../models/Topic.php";
    require_once "../models/User.php";

    session_start();

    $topic_model = new Topic($conn);
    $user_model = new User($conn);

    $user;
    if (isset($_SESSION["user_id"]))
    {
        $user = $user_model->getSingleUser($_SESSION["user_id"]);
    }
    else 
    {
        header("Location: /index.php");
    }
?>

<?php require_once "../components/header.php" ?>
<?php require_once "../components/navbar.php" ?>
<section>
    <h1>Welcome, <?php if ($user) {echo $user["username"];} ?> </h1>

    <hr>

    <div>
        <ul>
            <?php
                $topics = $topic_model->getTopics();

                if (array_key_exists("error", $topics)) 
                {
                    echo $topics["error"];
                }
                else 
                {
                    foreach ($topics as $topic)
                    {
                        $topic_url = "/pages/posts.php?topic=".$topic["id"];
    
                        echo 
                        "
                            <li>
                                <a href='".$topic_url."'>
                                    " .$topic["name"]. "
                                </a>
                            </li>
                        ";
                    }
                }
            ?>
        </ul>
    </div>

    <hr>

    <?php require_once "../components/auth/logout_button.php"  ?>  
</section>
<?php require_once "../components/footer.php"; ?>