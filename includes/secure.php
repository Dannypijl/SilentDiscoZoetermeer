<?php
session_start();

//May I even visit this page?
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

//Get email from session
$name = $_SESSION['loggedInUser']['name'];
?>
