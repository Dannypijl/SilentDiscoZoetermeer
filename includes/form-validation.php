<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($firstname == "") {
    $errors['firstname'] = 'Firstname cannot be empty';
}
if ($lastname == "") {
    $errors['lastname'] = 'Lastname cannot be empty';
}
if ($amount == "") {
    $errors['amount'] = 'Amount cannot be empty';
}
if($amount > 30){
    $errors['amount'] = 'Amount cannot be bigger than 30';
}
if ($address == "") {
    $errors['address'] = 'Address cannot be empty';
}
if ($date == "") {
    $errors['date'] = 'Date cannot be empty';
}