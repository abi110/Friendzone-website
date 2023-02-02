<?php>
session_start();
// Connect to database
    require_once("database.php");

// Create variables 
    $user = $_SESSION['name'];
    $content = $_POST['content'];

    // Data validation
if (!isset($content) || !is_numeric($content)) {
    echo "<p>Invalid post content</p>";
    exit();
}
// Insert new data
    $statement = $conn->prepare("INSERT INTO `posts`(`user`, `content`) VALUES (?,?)");
    $statement->bind_param("ss", $user, $content);
    $statement->execute();
    $result = $statement->get_result();
     if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
            echo "Post successful";
            header("Location: feed.php");
            exit();
    else {
        echo "Post failed";
        exit();
        }}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css" />
        <title>Post Failed</title>
    </head>
    <body>
        <h1>Post Failed</h1> 
        <a id="pglink" href="feed.php">Try Again</a>
    </body>
    </html>

