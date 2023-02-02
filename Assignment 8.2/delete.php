<?php>
session_start();
// Connect to database
    require_once("database.php");

// Create variables 
    $user = $_SESSION['name'];
    $post = $_POST['postId'];

// Check the user created the post
    $checkstatement = "SELECT `user` FROM `posts` WHERE `post_id`= $post";
    $checkresult = mysqli_query($conn, $checkstatement);
    if (mysqli_num_rows($checkresult) === 1) {
        $row = mysqli_fetch_assoc($checkresult);
        if ($row['user'] === $user) {
            echo "Validation successful";
            // Delete data
            $statement = $conn->prepare("DELETE FROM `posts` WHERE `post_id`= ?");
            $statement = bind_param("s", $post);
            $statement->execute();
            $result = $statement->get_result();
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                    echo "Delete successful";
                    header("Location: profile.php");
            else {
                echo "Delete failed";
                }} 
            
        } else {
            echo "Post failed";
            header("Location: feed.php");
            exit();
        }
    }
    ?>

