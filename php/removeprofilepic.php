<?php

    require('db.php');
    session_start();

    $idUser= $_SESSION['id'];

    $sql = "SELECT profilePicture FROM users WHERE id = '$idUser'";
    $result = $mysqli -> query($sql);

    if ($result -> num_rows > 0) {
        $row = $result -> fetch_assoc();
        if ($row['profilePicture'] != "NULL") {
            $profilePicture = $row['profilePicture'];
            unlink("../img/profileimgs/" . $profilePicture);

            $sql = "UPDATE users SET profilePicture = NULL WHERE id = '$idUser'";
            $result = $mysqli -> query($sql);
        }
    } else {
        exit(header("Location: /settings"));
    }

    exit(header("Location: /settings"));

?>