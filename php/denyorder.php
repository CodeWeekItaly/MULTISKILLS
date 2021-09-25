<?php
    
    require 'db.php';
    session_start();

    function sendMail($email, $name, $surname, $lastOrderId, $shippingAddressFull, $billingAddressFull, $paymentMethod, $shippingMethod, $mysqli) {

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
        $mail -> Subject = "One of the ordered products was not taken over - Order #" . $lastOrderId;
        $mail -> Body = " ";

        if (!$mail -> send()) {
            exit("Error sending mail.");
        }
    }

    $idUser = $_SESSION['id'];
    if (isset($_POST['idOrder']) && isset($_POST['idProduct'])) {
        $idOrder = $_POST['idOrder'];
        $idProduct = $_POST['idProduct'];

        $actualDate = date("Y-m-d H:i:s");
        $sql = "DELETE orders WHERE id = $idOrder";
        $result = $mysqli -> query($sql);
        if ($result) {
            echo "Order successfully deleted!";
            exit();
        } else {
            echo "Error deleting order.";
            exit();
        }


    } else {
        echo "Error in request";
        exit();
    }

?>