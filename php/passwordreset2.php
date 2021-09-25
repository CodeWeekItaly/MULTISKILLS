<?php

    session_start();
    require('db.php');

    $otp = $mysqli -> real_escape_string($_POST['otp']);
    $email = $_SESSION["mailToReset"];

    $sql = "SELECT otp FROM users WHERE email = '$email'";
    $result = $mysqli -> query($sql);
    $row = $result -> fetch_assoc();

    if($row['otp'] == $otp) {
        $_SESSION['resetStep'] = 2;
        exit(header("Location: /passwordreset"));
    } else {
        exit(header("Location: /passwordreset?result=2"));
    }
    
?>