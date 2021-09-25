<?php

    require('db.php');
    session_start();

    $password = $mysqli -> real_escape_string($_POST['password']);
    $newpassword = $mysqli -> real_escape_string($_POST['npassword']);
    $userid = $_SESSION['id'];

    $query = "SELECT * FROM users WHERE id = '$userid'";
    $result = $mysqli -> query($query);
    $row = $result -> fetch_assoc();
    $hashToVerify = $row['password'];

    if (password_verify($password, $hashToVerify)) {
        $hashed_npw = password_hash($newpassword, PASSWORD_BCRYPT);
        $query = "UPDATE users SET password = '$hashed_npw' WHERE id = '$userid'";
        $result = $mysqli -> query($query);
        if ($result) {
            // success
            exit(header("Location: /settings?result=0"));
        } else {
            //error updating data
            exit(header("Location: /settings?result=1"));
        }
    } else {
        // password verification failed
        exit(header("Location: /settings?result=2"));
    }

?>