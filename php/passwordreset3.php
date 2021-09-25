<?php

    session_start();
    require('db.php');

    $email = $_SESSION["mailToReset"];
    $password = $mysqli -> real_escape_string($_POST['password']);
    $hashed_npw = password_hash($password, PASSWORD_BCRYPT);

    $sql = "UPDATE users SET password = '$hashed_npw' WHERE email = '$email'";
    $result = $mysqli -> query($sql);
    if ($result) {
        // success
        $_SESSION["mailToReset"] = null;
        $_SESSION["resetStep"] = null;

        exit(header("Location: /login?pwdchanged=true"));
    } else {
        //error updating data
        exit("Error updating data. Try again later.");
    }  

?>