<?php

// Setup connection with database
require_once 'includes/connection.php';
require_once 'includes/secure.php';


$query = "SELECT * FROM appointments";
// Stap 4: Query uitvoeren op de database. Als dit goed gaat, geeft
//         mysqli_query een mysqli_result terug. Let op, dit is een tabel.
// Stap 5: Foutafhandeling. Als de query niet uitgevoerd kan worden treedt
//         er een foutmelding op via "or die". Ook de query, met ingevulde
//         variabelen, wordt op het scherm getoond. Deze kan je kopieren
//         en plakken in PhpMyAdmin om te kijken waarom het fout gaat.
$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

// Stap 6: Resultaat verwerken. Er wordt een nieuwe array gemaakt waarin alle
//         rijen uit de db komen. In dit geval is een rij een album.
$appointments = [];
//         mysqli_fetch_assoc haalt een rij uit de db en zet deze om naar
//         een associatieve array. De namen van de index corresponderen met de
//         kolomnamen (velden) van de tabel
//         Als er geen rijen meer zijn in het resultaat geeft mysqli_fetch_assoc
//         'false' terug en stopt de while loop.
while ($row = mysqli_fetch_assoc($result)) {
    // elke rij (dit is een album) wordt aan de array 'albums' toegevoegd.
    $appointments[] = $row;
}

// Stap 7: Sluit de verbinding met de db. Deze is niet meer nodig. Al het
//         resultaat zit in de variabele $albums
mysqli_close($db);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Document</title>
</head>
<body>

<div class="container">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">FirstName</th>
            <th scope="col">LastName</th>
            <th scope="col">Amount</th>
            <th scope="col">Address</th>
            <th scope="col">Date</th>
            <th scope="col">Details</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($appointments as $appointment) { ?>
            <tr>
                <td><?= $appointment['firstname'] ?></td>
                <td><?= $appointment['lastname'] ?></td>
                <td><?= $appointment['amount'] ?></td>
                <td><?= $appointment['address'] ?></td>
                <td><?= $appointment['date'] ?></td>
                <td><a class="btn btn-info" href="details.php?id=<?= $appointment['id']?>" class="has-text-black">Details</a></td>
                <td><a class="btn btn-info" href="delete.php?id=<?= $appointment['id']?>" class="has-text-black">Delete</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <a class="button mt-4" href="index.php">&laquo; Go back to home</a>
</div>
</body>
</html>