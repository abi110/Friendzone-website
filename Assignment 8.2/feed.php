<?php
session_start();
  $name = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feed</title>
  </head>
  <body>
    <h1 id=welcome>Hi <?php echo("$name"); ?>!</h1><br class="welpro">
    <a id='profile' href='profile.php'>View your profile</a><br>
    <div id=createpost>
      <p>Create post (280 characters only)</p>
      <form action="createpost.php" method="post">
        <input id=createpost type="text" maxlength="280" name="content" placeholder="Content" /><br />
        <button id=createpost type="submit" name="submit">Create post</button><br />
      </form>
    </div>
    <br>
    <div id="posts">
      <h1>Posts</h1>
      <?php
        require_once("database.php");
        $poststatement = "SELECT * FROM `posts` ORDER BY `createdAt` DESC;";
        $postresult = mysqli_query($conn, $poststatement);
        if (mysqli_num_rows($postresult) > 0) {
          while ($row = mysqli_fetch_assoc($postresult)) {
            $post = $row['post_id'];
            echo "<div id='post'>";
            echo "<p><b>" . $row['user'] . "</b></p><br>";
            echo "<p>" . $row['content'] . "</p><br>";
            echo "<p><em>" . $row['createdAt'] . "</em></p>";
            echo "<br />";
            echo "<form name='comment' action='comment.php' method='post'>
            <input type='text' name='comment' maxlength='100' placeholder='Comment' />
            <input type='hidden' id='postId' name='postId' value= $post /><br>
            <button type='submit' name='submit'>Send Comment</button><br />
            </form><br /><br>";
            $comstatement = "SELECT * FROM `comments` WHERE `post_id` = '$post' ORDER BY `createdAt` DESC;";
            $comresult = mysqli_query($conn, $comstatement);
            if (mysqli_num_rows($comresult) > 0) {
              while ($row = mysqli_fetch_assoc($comresult)) {
                echo "<p> Comments: </p>";
                echo "<p><b>" . $row['user'] . "</b></p>";
                echo "<p>" . $row['comment'] . "</p>";
                echo "<p><em>" . $row['createdAt'] . "</em></p>";
                echo "<br />";
                echo "</div><br /><br />";
            }
          }
          }
          }
      ?>
    </div>
    <div class = 'userinfo' id="users">
      <h1>Users</h1>
      <?php
        require_once("database.php");
        $userstatement = "SELECT * FROM `users`;";
        $userresult = mysqli_query($conn, $userstatement);
        if (mysqli_num_rows($userresult) > 0) {
          while ($row = mysqli_fetch_assoc($userresult)) {
            $user = $row['fullName'];
            echo "<p class='username'>Name: " . $row['fullName'] . "</p>";
            echo "<p>Bio: " . $row['bio'] . "</p>";
            echo "<p>Mobile: " . $row['mobile'] . "</p>";
            echo "<br />";
          }
        }
      ?>
  </body>
</html>
