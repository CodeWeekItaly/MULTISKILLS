<?php

    require('db.php');
    session_start();

    $newemail = $mysqli -> real_escape_string($_POST['email']);
    $password = $mysqli -> real_escape_string($_POST['password']);
    $userid = $_SESSION['id'];

    $query = "SELECT * FROM users WHERE id = '$userid'";
    $result = $mysqli -> query($query);
    $row = $result -> fetch_assoc();
    $hashToVerify = $row['password'];

    if (password_verify($password, $hashToVerify)) {
        $query = "UPDATE users SET email = '$newemail' WHERE id = '$userid'";
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