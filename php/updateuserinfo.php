<?php

    require('db.php');
    session_start();

    $name = $mysqli -> real_escape_string($_POST['name']);
    $surname = $mysqli -> real_escape_string($_POST['surname']);
    $company = $mysqli -> real_escape_string($_POST['company']);
    $companylocation = $mysqli -> real_escape_string($_POST['companylocation']);
    $description = "";
    if($mysqli -> real_escape_string($_POST['description']) == "" || $mysqli -> real_escape_string($_POST['description']) == null) {
        $description = null;
    } else {
        $description = $mysqli -> real_escape_string($_POST['description']);
    }
    $telephone = $mysqli -> real_escape_string($_POST['tel']);
    $userid = $mysqli -> real_escape_string($_SESSION['id']);

    $sql = "UPDATE users SET name = '$name', surname = '$surname', company = '$company', companylocation = '$companylocation', telephone = '$telephone', description = '$description' WHERE id = '$userid'";
    $result = $mysqli -> query($sql);

    if (!$result) {
        exit(header("Location: /settings?uresult=1"));
    } else {
        header("Location: /settings?uresult=0");
    }

?>