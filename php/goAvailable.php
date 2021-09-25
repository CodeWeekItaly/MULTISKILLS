<?php

    require 'db.php';
    session_start();

    $idUser = $_SESSION['id'];
    $idProduct = $mysqli -> real_escape_string($_POST['idProduct']);
    $returnURI = $mysqli -> real_escape_string($_POST['returnURI']);

    $uploadDate = date("Y-m-d H:i:s");
    $expiryDate = date('Y-m-d  H:i:s', strtotime($_POST['expirydate']));
    $stock = $mysqli -> real_escape_string($_POST['stock']);
    $price = $mysqli -> real_escape_string($_POST['price']);

    $sql = "INSERT INTO available (idProduct, avFrom, avTo, price, stock) VALUES ('$idProduct', '$uploadDate', '$expiryDate', '$price', '$stock')";
    $result = $mysqli -> query($sql);

    if ($result) {
        exit(header("Location: " . $returnURI));
    } else {
        //echo "Error: " . $sql . "<br>" . $mysqli -> error;
        exit(header("Location: " . $returnURI . "&presult=1"));
    }

?>