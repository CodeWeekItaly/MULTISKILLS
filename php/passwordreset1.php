<?php

    session_start();
    require('db.php');

    function sendOTPMail($email, $name, $surname, $otp) {

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
        $mail -> Subject = "Password reset - IOcommerce";
        $mail -> Body = "Dear $name $surname,<br><br>
                        You have requested a password reset for your IOcommerce account.<br><br>
                        Here is the OTP you need to use to reset your password: <br><br>
                        <b>$otp</b><br><br>
                        If you did not request this password reset, please ignore this email
                        and consider updating your password.<br><br>
                        In case you have any questions, please contact us at <a href='mailto:iocommerce.multiskills@gmail.com'>this mail</a><br><br>
                        Best regards,<br>
                        the IOcommerce Team.";

        if (!$mail -> send()) {
            exit("Error sending mail.");
        }
    }

    $email = $mysqli -> real_escape_string($_POST['email']);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $mysqli -> query($sql);
    $row = $result -> fetch_assoc();

    if ($row) {
        for ($i = 0; $i < 6; $i++) {
            $otp = substr($otp, 0, $i) . rand(0, 9) . substr($otp, $i + 1);
        }
        $sql = "UPDATE users SET otp = '$otp' WHERE email = '$email'";
        $mysqli -> query($sql);

        sendOTPMail($email, $row['name'], $row['surname'], $otp);
        $_SESSION['resetStep'] = 1;
        $_SESSION['mailToReset'] = $email;
        exit(header("Location: /passwordreset"));
    } else {
        exit(header("Location: /passwordreset?result=1"));
    }

?>