<?php

    require 'db.php';
    session_start();

    $id = $_SESSION['id'];

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
        $mail -> Subject = "Thanks for your order! - Order #" . $lastOrderId;
        $mail -> Body = "Dear $name $surname,<br><br>
                        Thank you for your order!<br><br>
                        Your order has been successfully placed, and will be processed by the sellers.<br><br>
                        <hr>
                        Your shipping and billing details are as follows:<br><br>
                        <strong>Order ID:</strong> #$lastOrderId<br>
                        <strong>Shipping Address:</strong> $shippingAddressFull<br>
                        <strong>Billing Address:</strong> $billingAddressFull<br>
                        <strong>Payment Method:</strong> $paymentMethod<br>
                        <strong>Shipping Method:</strong> $shippingMethod<br><br>
                        <hr>
                        The products you ordered are as follows:<br><br>

                        <table border='1' cellpadding='5' cellspacing='0'>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>";
                            $sql = "SELECT * FROM orderdetails WHERE idOrder = $lastOrderId";
                            $result = $mysqli -> query($sql);
                            foreach ($result as $row) {
                                $sql = "SELECT name FROM products WHERE id = " . $row['idAvailable'];
                                $result2 = $mysqli -> query($sql);
                                $row2 = $result2 -> fetch_assoc();
                                $mail -> Body .= "<tr>
                                <tr> 
                                    <td>" . $row2['name'] . "</td>
                                    <td>" . $row['quantity'] . "</td>
                                    <td>€ " . $row['totalPrice'] . "</td>
                                </tr>";
                            }

                            $mail -> Body .=  "</tbody>
                        </table>

                        <hr>
                        Please leave a feedback on the product you have purchased, you could help other people to know what you think about the product.<br><br>
                        You can check the status of your order at any time by logging in to your account.<br>
                        In case you have any questions, please feel free to contact us at any time at <a href=\"mailto:iocommerce.multiskills@gmail.com\">this mail</a>!<br>
                        Remember that you can also contact the sellers directly by clicking on their names in the product page.<br><br>
                        Thanks again for shopping on our website!<br><br>
                        Best regards,<br>
                        the IOcommerce Team.";

        if (!$mail -> send()) {
            exit("Error sending mail.");
        }
    }

    if (!isset($_SESSION["cart"])) {
        echo "Error: cart empty. Checkout not available.";
        exit();
    }

    $shippingAddress = array (
        'name' => $mysqli -> real_escape_string($_POST['name']),
        'surname' => $mysqli -> real_escape_string($_POST['surname']),
        'city' => $mysqli -> real_escape_string($_POST['city']),
        'state' => $mysqli -> real_escape_string($_POST['state']),
        'zipcode' => $mysqli -> real_escape_string($_POST['zipcode']),
        'address' => $mysqli -> real_escape_string($_POST['address'])
    );

    $shippingAddressFull = $shippingAddress['name'] . " " . $shippingAddress['surname'] . ", " . $shippingAddress['address'] . ", " . $shippingAddress['city'] . ", " . $shippingAddress['zipcode'] . ", " . $shippingAddress['state'];

    $billingAddressFull = "";

    $billingIsSame = isset($_POST["isSeller"]) ? true : false;
    if ($billingIsSame) {
        $billingAddress = array (
            'name' => $mysqli -> real_escape_string($_POST['billing-name']),
            'surname' => $mysqli -> real_escape_string($_POST['billing-surname']),
            'city' => $mysqli -> real_escape_string($_POST['billing-city']),
            'state' => $mysqli -> real_escape_string($_POST['billing-state']),
            'zipcode' => $mysqli -> real_escape_string($_POST['billing-zipcode']),
            'address' => $mysqli -> real_escape_string($_POST['billing-address'])
        );
        $billingAddressFull = $billingAddress['name'] . " " . $billingAddress['surname']  . ", " . $billingAddress['address'] . ", " . $billingAddress['city'] . ", " . $billingAddress['zipcode'] . ", " . $billingAddress['state'];
    } else {
        $billingAddressFull = $shippingAddressFull;
    }

    /* NOT IMPLEMENTED FEATURE (SITE IS ONLY DEMO)
    $paymentInfo = array (
        'cardNumber' => $mysqli -> real_escape_string($_POST['card-number']),
        'cardExpiration' => $mysqli -> real_escape_string($_POST['card-expire']),
        'cardCVV' => $mysqli -> real_escape_string($_POST['card-cvv']),
        'cardHolder' => $mysqli -> real_escape_string($_POST['card-holder'])
    );
    */

    $shippingMethod = $mysqli -> real_escape_string($_POST['delivery']);
    $paymentMethod = $mysqli -> real_escape_string($_POST['payment-method']);

    if ($shippingMethod == 'homedelivery') {
        $shippingMethod = 'Home Delivery';
    } else if ($shippingMethod == 'instorepickup') {
        $shippingMethod = 'In-Store Pickup';
    }

    if ($paymentMethod == 'paywithcard') {
        $paymentMethod = 'Paid with Credit/Debit/Prepaid Card';
    } else if ($paymentMethod == 'paywithpaypal') {
        $paymentMethod = 'Paid with PayPal';
    } else if ($paymentMethod == 'payinstore') {
        $paymentMethod = 'Will pay in store';
    }

    $actualDate = date('Y-m-d H:i:s');
    $sql = "INSERT INTO orders (idUser, dateOrder, paymentMethod, shippingAddress, billingAddress) VALUES ('$id', '$actualDate', '$paymentMethod', '$shippingAddressFull', '$billingAddressFull')";
    $result = $mysqli -> query($sql);
    if ($result) {
        $lastOrderId = $mysqli -> insert_id;
        foreach ($_SESSION['cart'] as $item => $quantity) {
            $sql = "INSERT INTO orderdetails (idOrder, idAvailable, quantity) VALUES ('$lastOrderId', '" . $item . "', '" . $quantity["quantity"] . "')";
            $result = $mysqli -> query($sql);
            if ($result) {
                $sql = "UPDATE available SET stock = stock - " . $quantity["quantity"] . " WHERE idProduct = " . $item;
                $result = $mysqli -> query($sql);
                $sql = "UPDATE orderdetails SET totalPrice = totalPrice + (" . $quantity["quantity"] . " * (SELECT price FROM available WHERE idProduct = " . $item . ")) WHERE idAvailable='" . $item . "' AND idOrder='" . $lastOrderId . "'";
                $result = $mysqli -> query($sql);
                if (!$result) {
                    echo "Error: " . $mysqli -> error;
                    exit();
                }
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli -> error . "<br><br>";
                exit();
            }
        }
        unset($_SESSION['cart']);
        echo "Purchase completed!";

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = $mysqli -> query($sql);
        $row = $result -> fetch_assoc();
        sendMail($row["email"], $row["name"], $row["surname"], $lastOrderId, $shippingAddressFull, $billingAddressFull, $paymentMethod, $shippingMethod, $mysqli);
        exit();
        // exit(header("Location: /my-profile?presult=1"));
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli -> error;
        exit();
    }

?>