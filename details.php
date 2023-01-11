<?php
//Require database in this file
/** @var $db */
require_once "includes/connection.php";

if (isset($_POST['submit'])) {


    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $amount  = $_POST['amount'];
    $address   = $_POST['address'];
    $date = $_POST['date'];

    //Require the form validation handling
    if (empty($errors)) {
        //Require database in this file & image helpers
        require_once "includes/connection.php";
        /** @var mysqli $db */
        //Save the record to the database
        $query = "UPDATE `appointments` SET `amount`='$amount', `address`='$address', `date`='$date' WHERE `id`='{$_GET['id']}'";
        $result = mysqli_query($db, $query)or die('Error: '.mysqli_error($db). ' with query ' . $query);

        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: details.php?id=' . $_GET["id"]);
        exit;
    }
}

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
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Registreren</title>
</head>
<body>

<section class="section">
    <div class="container content">
        <h2 class="title mt-4"><?= $appointment['firstname'] ?> <?= $appointment['lastname'] ?></h2>

        <div class="notification is-success mt-2" id="alert" style="display: none;">
            Opgeslagen
        </div>

        <section class="columns">
            <form class="column is-6" action="" method="post">


                <!-- Amount -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="text">Amount</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="amount" type="text" name="amount" value="<?= $appointment['amount'] ?>" onchange="document.getElementById('alert').style.display='block'" />
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="text">Address</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="adress" type="text" name="address" value="<?= $appointment['address'] ?>" onchange="document.getElementById('alert').style.display='block'" />
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- date -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="date">Datum</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="date" type="text" name="date" value="<?= $appointment['date'] ?>" onchange="document.getElementById('alert').style.display='block'" />
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Pas aan</button>
                    </div>
                </div>

            </form>
        </section>

    </div>
    <a href="dashboard.php" class="btn btn-primary">Go back to Dashboard</a>
</section>
</body>
</html>

