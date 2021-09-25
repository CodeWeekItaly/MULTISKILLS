<?php

    require('db.php');
    session_start();

    $city = $mysqli -> real_escape_string($_POST['city']);
    $state = $mysqli -> real_escape_string($_POST['state']);
    $zipcode = $mysqli -> real_escape_string($_POST['zipcode']);
    $address = $mysqli -> real_escape_string($_POST['address']);
    $userid = $mysqli -> real_escape_string($_SESSION['id']);

    $sql = "UPDATE users SET city = '$city', state = '$state', zipcode = '$zipcode', address = '$address' WHERE id = '$userid'";
    $result = $mysqli -> query($sql);

    if (!$result) {
        exit(header("Location: /settings?sresult=1"));
    } else {
        header("Location: /settings?sresult=0");
    }

?>