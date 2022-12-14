<?php
//Require database in this file
/** @var $db */
require_once "includes/connection.php";

//If the ID isn't given, redirect to the homepage
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: dashboard.php');
    exit;
}

//Retrieve the GET parameter from the 'Super global'
$appointmentId = $_GET['id'];

//Get the record from the database result
$query = "SELECT * FROM appointments WHERE id = " . $appointmentId;
$result = mysqli_query($db, $query);

//If the album doesn't exist, redirect back to the homepage
if (mysqli_num_rows($result) == 0) {
    header('Location: dashboard.php');
    exit;
}

//Transform the row in the DB table to a PHP array
$appointment = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Details - <?= $appointment['firstname'], $appointment['lastname'] ?></title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4"><?= $appointment['firstname'] ?> <?= $appointment['lastname'] ?></h1>
    <section class="content">
        <ul>
            <li>Amount: <?= $appointment['amount'] ?></li>
            <li>Address: <?= $appointment['address'] ?></li>
            <li>Date: <?= $appointment['date'] ?></li>
        </ul>
    </section>
    <div>
        <a class="button" href="dashboard.php">Go back to the list</a>
    </div>
</div>
<div class="container-md">
    <div class="card text-center">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <h1 class="title mt-4"><?= $appointment['firstname'] ?> <?= $appointment['lastname'] ?></h1>
            <ul>
                <li>Amount: <?= $appointment['amount'] ?></li>
                <li>Address: <?= $appointment['address'] ?></li>
                <li>Date: <?= $appointment['date'] ?></li>
            </ul>
            <a href="dashboard.php" class="btn btn-primary">Go back to Dashboard</a>
        </div>
        <div class="card-footer text-muted">
            2 days ago
        </div>
    </div>
</div>

</body>
</html>

