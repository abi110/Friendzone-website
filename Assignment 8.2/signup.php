<?php
    // Connect to database
    require_once("database.php");
    
    // Create variables from POST data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    // Data Validation
    if (!isset($email) || !str_contains($email, "@")) {
        echo "<p>Invalid email</p>";
        exit();
    }

    // Insert new data
    $statement = $conn->prepare("INSERT INTO `users`(`fullName`, `email`, `password`) VALUES (?,?,?)");
    $statement->bind_param("sss", $name, $email, $password);
    $statement->execute();
    $result = $statement->get_result();
    if ($result === false) {
        echo "Record updated successfully, please login ";
        header("Location: index.html");
    } else {
        echo "Sign up error","Error updating record: ", "Please try again ";
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css" />
        <title>Signup</title>
    </head>
    <body>
     <a id="pglink" href="index.html">here</a>
    </body>
    </html>