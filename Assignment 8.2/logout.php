<?php
session_start();
    session_unset();
        unset($_SESSION["user"]);
        $_SESSION = array();
        header("location: index.html");
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css" />
        <title>Logout Failed</title>
    </head>
    <body>
        <h1>Logout Failed</h1> 
        <p>Please use your back button to try again, or return to</p>
        <a id="pglink" href="index.html">Login</a>
    </body>
    </html>