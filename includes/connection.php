<?php
// General settings
$host = "localhost";
$database = "silent_disco_zoetermeer";
$user = "root";
$password = "";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());;