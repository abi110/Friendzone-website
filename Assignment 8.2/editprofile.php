<?php
session_start();
// Connect to database
    require_once("database.php");

// Create variables 
    $user = $_SESSION['name'];
    $mobile = $_POST['mobile'];
    $bio = $_POST['bio'];

// Data validation
if (!isset($mobile) || !is_numeric($mobile)) {
    echo "<p>Invalid mobile number</p>";
    exit();
}
// Insert new data
    $statement = $conn->prepare("UPDATE `users` SET `mobile`='$mobile',`bio`='$bio' WHERE `fullName` = '?'");
    $statement->bind_param("s", $user);
    $statement->execute();
    $result = $statement->get_result();
if (mysqli_num_rows($result) === 1) {
    echo "Post successful";
    header("Location: profile.php");
} else {
    echo "Post failed";
    header("Location: profile.php");
}
?>
