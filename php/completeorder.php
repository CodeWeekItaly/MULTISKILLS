<?php
    
    require 'db.php';
    session_start();

    function sendMail($email, $name, $surname, $idOrder, $idProduct, $invoice, $message, $trackerCode) {

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
        $mail -> Subject = "An item from order #" . $idOrder . " has been processed!";
        $mail -> Body = "
            Dear " . $name . " " . $surname . ",<br><br>
            An item from order #" . $idOrder . " has been processed.<br><br>

            The link of the product that has been sent is <a href='https://iocommerce.didamatteifortunato.it/product?id=" . $idProduct . "'>this</a>.<br><br>

            In this mail attachment you will find the invoice for this product.<br>";

            if (isset($trackerCode)) {
                $mail -> Body .= "Here's the tracker code for this product: <strong>" . $trackerCode . "</strong><br><br>";
            } else {
                $mail -> Body .= "The seller hasn't left any tracker code. Try to contact him for some info.";
            }

            if (isset($message)) {
                $mail -> Body .= "Here's a message from the seller:<br>
                <p><em>" . $message . "</em></p>";
            }

            $mail -> Body .= "
            <br><br>
            Thanks again for shopping on our website!<br><br>
            Best regards,<br>
            the IOcommerce Team.
        ";
        $mail -> AddAttachment($invoice['tmp_name'], $invoice['name']);

        if (!$mail -> send()) {
            exit("Error sending mail.");
        }
    }

    $idUser = $_SESSION['id'];

    $idOrder = $mysqli -> real_escape_string($_POST['idOrder']);
    $idProduct = $mysqli -> real_escape_string($_POST['idProduct']);
    $invoice = null;

    if (isset($_FILES['invoice']) && $_FILES['invoice']['error'] == UPLOAD_ERR_OK) {
        $invoice = $_FILES['invoice'];
    }

    $message = isset($_POST['message']) ? $mysqli -> real_escape_string($_POST['message']) : null;
    $trackerCode = isset($_POST['message']) ? $mysqli -> real_escape_string($_POST['tracking']) : null;

    $sql = "UPDATE orderdetails SET processed = 1 WHERE idOrder = '$idOrder' AND idAvailable = '$idProduct'";
    $result = $mysqli -> query($sql);
    if ($result) {
        $sql = "SELECT * FROM orders WHERE id = " . $idOrder;
        $result = $mysqli -> query($sql);
        if ($result) {
            $order = $result -> fetch_assoc();
            $idUser = $order['idUser'];
            $sql = "SELECT * FROM users WHERE id = " . $idUser;
            $result = $mysqli -> query($sql);
            if ($result) {
                $user = $result -> fetch_assoc();
                $name = $user['name'];
                $surname = $user['surname'];
                $email = $user['email'];
                sendMail($email, $name, $surname, $idOrder, $idProduct, $invoice, $message, $trackerCode);
            } else {
                echo $mysqli -> error;
                exit("Error getting user data.");
            }
        } else {
            echo $mysqli -> error;
            exit("Error getting order data.");
        }
    } else {
        echo $mysqli -> error;
        exit("Error updating order.");
    }

    exit(header("Location: /my-profile?result=0"));

?>