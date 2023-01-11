<?php

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {


    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $amount  = $_POST['amount'];
    $address   = $_POST['address'];
    $date = $_POST['date'];

    //Require the form validation handling
    require_once "includes/form-validation.php";
    if (empty($errors)) {
        //Require database in this file & image helpers
        require_once "includes/connection.php";
        /** @var mysqli $db */
        //Save the record to the database
        $query = "INSERT INTO appointments (firstname, lastname, amount, address, date)
                  VALUES ('$firstname', '$lastname', '$amount', '$address', '$date')";
        $result = mysqli_query($db, $query)or die('Error: '.mysqli_error($db). ' with query ' . $query);

        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: index.php');
        exit;
    }
}
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
    <title> - Create</title>
</head>
<body>
<?php
require_once 'includes/header.php'
?>
<div class="container px-4">


    <h1 class="title mt-4">Create new reservation</h1>

    <form action="" method="post">
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input class="form-control" id="firstname" type="text" name="firstname" value="<?= $firstname ?? '' ?>"/>
            <?= $errors['firstname'] ?? '' ?>
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input class="form-control" id="lastname" type="text" name="lastname" value="<?= $lastname ?? '' ?>"/>
            <?= $errors['lastname'] ?? '' ?>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input class="form-control number" id="amount" type="number" name="amount" min="1" max="30" value="<?= $amount ?? '' ?>"/>
            <?= $errors['amount'] ?? '' ?>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input class="form-control" id="address" type="text" name="address" value="<?= $address ?? '' ?>"/>
            <?= $errors['address'] ?? '' ?>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input class="form-control" id="date" type="text" name="date" value="<?= $date ?? '' ?>"/>
            <?= $errors['date'] ?? '' ?>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    <a class="button mt-4" href="index.php">&laquo; Go back to home</a>
</div>
</body>
</html>
