<?php
    session_start();

	$mysqli = new mysqli('127.0.0.1', 'root', '', 'iocdb');


    if (!$mysqli) {
        exit(header("Location: /login?loginFailed=true&reason=internal"));
    } else {
        $email = $mysqli -> real_escape_string($_POST['email']);
        $password = $mysqli -> real_escape_string($_POST['password']);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $mysqli -> query($sql);
        if ($result -> num_rows > 0) {
            $row = $result -> fetch_assoc();
            $hashToVerify = $row['password'];

            if (password_verify($password, $hashToVerify)) {
                $_SESSION['id'] = $row['id'];
                exit(header("Location: /"));
            } else {
                exit(header("Location: /login?loginFailed=true&reason=password"));
            }
        } else {
            exit(header("Location: /login?loginFailed=true&reason=email"));
        }
        
    }

?>