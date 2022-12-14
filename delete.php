<?php

if (isset($_GET['id'])){
    require_once "includes/connection.php";

    $id = $_GET['id'];
// Delete the appointment with the id that is given in the url
    $query = "DELETE FROM appointments WHERE id = '$id'";

    if (mysqli_query($db, $query)) {
        mysqli_close($db);
        header("Location: index.php");
        exit();
    } else {
        $error['database'] = "ERROR: Could not connect... "
            . mysqli_error($db);
    }
}
?>
