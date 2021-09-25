<?php

	$mysqli = new mysqli('127.0.0.1', 'root', '', 'iocdb');

	function sendWelcomeMail($email, $name, $surname) {

        require 'libraries/PHPMailer/src/PHPMailer.php';
        require 'libraries/PHPMailer/src/SMTP.php';
        require 'libraries/PHPMailer/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail -> isSMTP();
        $mail -> Host = 'ssl://smtp.gmail.com';
        $mail -> SMTPAuth = true;
        $mail -> Port = 465;
        $mail -> Username = "iocommerce.multiskills@gmail.com";
        $mail -> Password = "Multiskills2021@";
        $mail -> From = "iocommerce.multiskills@gmail.com";
        $mail -> FromName = "IOcommerce Team (by MULTISKILLS)";
        $mail -> isHTML(true);
        $mail -> setFrom('IOcommerce Team (by MULTISKILLS)');
        $mail -> addAddress($email);
        $mail -> Subject = "Welcome to IOCommerce, $name";
        $mail -> Body = "Dear $name $surname,<br><br>
                        Thank you for registering at IOcommerce! <br>
                        You can now start shopping and enjoy the benefits of our online platform!<br><br>
                        Best regards,<br>
                        the IOcommerce Team.";
        if (!$mail -> send()) {
            exit("Error sending mail.");
        }
    }

    if (!$mysqli) {
        echo "Unable to connect to MySQL: ", $mysqli -> connect_error();
    } else {
        $email = $mysqli -> real_escape_string($_POST["email"]);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $mysqli -> query($sql);
        if (mysqli_num_rows($result) > 0) {
            exit(header("Location: /register?registerSuccessful=false&reason=email"));
        } else {
            $password = $mysqli -> real_escape_string($_POST["password"]);
            $name = $mysqli -> real_escape_string($_POST["name"]);
            $surname = $mysqli -> real_escape_string($_POST["surname"]);
            $isSeller = isset($_POST["isSeller"]) ? true : false;
            $company = null;
            $companylocation = null;

            if (isset($_POST["company"])) {
                $company = $mysqli -> real_escape_string($_POST["company"]);
            }

            if (isset($_POST["companylocation"])) {
                $companylocation = $mysqli -> real_escape_string($_POST["companylocation"]);
            }

            $hashed_pw = password_hash($password, PASSWORD_BCRYPT);

            if($isSeller) {
                $sql = "INSERT INTO users (name, surname, company, companylocation, email, password, seller) VALUES ('$name', '$surname', '$company', '$companylocation', '$email', '$hashed_pw', 1)";
            }
            else {
                $sql = "INSERT INTO users (name, surname, company, companylocation, email, password, seller) VALUES ('$name', '$surname', '$company', '$companylocation', '$email', '$hashed_pw', 0)";
            }
            if(!$mysqli -> query($sql)) {
                exit(header("Location: /register?registerSuccessful=false&reason=internal"));
            }
            sendWelcomeMail($email, $name, $surname);
            exit(header("Location: /login?registerSuccessful=true"));
        }
    }

?>