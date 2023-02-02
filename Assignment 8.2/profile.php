<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Profile</title>
  </head>
  <body>
    <h1>Profile</h1>
    <div id="publicprofile"> 
        <p><u>Public Profile</u>
        <?php
            require_once("database.php");
            $name = $_SESSION['user'];
            $statement = "SELECT * FROM `users` WHERE `fullName` = '$name';";
            $result = mysqli_query($conn, $statement);
            if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            echo "<p> Name: <b>" . $row['fullName'] . "</b></p><br>";
            echo "<p> Mobile: 0" . $row['mobile'] . "</p><br>";
            echo "<p> Bio: " . $row['bio'] . "</p><br>";
            }
        ?>
        </p>
    </div>
    <br />
    <h1 class='editprofile'>Edit Profile</h1>
    <form name="edit" action="editprofile.php" method="POST">
        <input type="text" name="mobile" maxlength="11" placeholder="Mobile Number" /><br />
        <input type="text" name="bio" maxlength="300" placeholder="Bio" /><br />
        <button type="submit" name="submit">Update</button><br />
    </form>
    <h1 class='urposts'>Your Posts</h1>
    <?php
        require_once("database.php");
        $name = $_SESSION['user'];
        $statement = "SELECT * FROM `posts` WHERE `user` = '$name' ORDER BY `createdAt` DESC;";
$result = mysqli_query($conn, $statement);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $post = $row['post_id'];
        echo "<p class='urposts'><b>" . $row['user'] . "</b></p>";
        echo "<p class='urposts'><em>" . $row['createdAt'] . "</em></p><br>";
        echo "<p class='urposts'>" . $row['content'] . "</p>";

        // Display comments for the post
        $comstatement = "SELECT * FROM `comments` WHERE `post_id` = '$post' ORDER BY `createdAt` DESC;";
        $comresult = mysqli_query($conn, $comstatement);
        if (mysqli_num_rows($comresult) > 0) {
            while ($row = mysqli_fetch_assoc($comresult)) {
                echo "<p class='urposts'> Comments: </p>";
                echo "<p class='urposts'><b>" . $row['user'] . "</b></p>";
                echo "<p class='urposts'>" . $row['comment'] . "</p>";
                echo "<p class='urposts'><em>" . $row['createdAt'] . "</em></p>";
                echo "</div>";
            }
        }
        // Display delete button for the post
        echo "<br /><form action='delete.php' method='POST'>";
        echo "<input type='hidden' name='post' value='$post'>";
        echo "<button type='submit' name='delete'>Delete</button></form><br /><br>";
    }
}
    ?>
    <a id="pglink" href="feed.php"><u>Back to Feed</u></a>
    <p id="pglink">Or <a id="pglink" href="logout.php"><u>Logout</u></a></p>
  </body>
</html>

