<?php
    // Connect to database
    require_once("database.php");
    

    // Create variables from POST data
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    
    // Data validation
    if (!isset($email) || !str_contains($email, "@")) {
        echo "<p>Invalid email</p>";
        exit();
    }
    // Insert new data
    $statement = $conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            session_start();
                $_SESSION['user'] = $row['fullName'];
            echo "Logged in!";
            header("Location: feed.php");
            exit();

        }else{ }

        }
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css" />
        <title>Login Failed</title>
    </head>
    <body>
        <h1>Login Failed</h1> 
        <p>Incorrect email or password.</p>
        <a id="pglink" href="index.html">Try Again</a>
    </body>
    </html>