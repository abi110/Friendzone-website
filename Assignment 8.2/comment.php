<?php>
session_start();
// Connect to database
    require_once("database.php");

// Create variables 
    $user = $_SESSION['name'];
    $post = $_POST['postId'];
    $comment = $_POST['comment'];

// Data validation
if (!isset($comment) || !is_string($comment)) {
    echo "<p>Invalid comment</p>";
    exit();
}
// Insert new data
    $statement = $conn->prepare("INSERT INTO `comments`(`user`, `post_Id`, `content`) VALUES (?, ?, ?)");
    $statement->bind_param("sss", $user, $post, $comment);
    $statement->execute();
    $result = $statement->get_result();
     if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
            echo "Post successful";
            header("Location: feed.php");
    else {
        echo "Post failed";
        }} ?>
<html>
    <head>
        <link rel="stylesheet" href="style.css" />
        <title>Comment Failed</title>
    </head>
    <body>
        <h1>Comment Failed to send</h1> 
        <a id="pglink" href="feed.php">Back to feed</a>
    </body>
    </html>

