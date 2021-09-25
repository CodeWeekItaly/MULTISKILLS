<?php

    require 'db.php';
    session_start();

    $idUser = $_SESSION['id'];
    $idProduct = $mysqli -> real_escape_string($_POST['idProduct']);
    $returnURI = $mysqli -> real_escape_string($_POST['returnURI']);

    $newExpiryDate = date('Y-m-d  H:i:s', strtotime($_POST['expirydate']));
    $newStock = $mysqli -> real_escape_string($_POST['stock']);
    $newPrice = $mysqli -> real_escape_string($_POST['price']);

    $sql = "UPDATE available SET avTo='$newExpiryDate', stock='$newStock', price='$newPrice' WHERE idProduct = '$idProduct'";
    $result = $mysqli -> query($sql);

    if ($result) {
        exit(header("Location: " . $returnURI));
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli -> error;
        //exit(header("Location: " . $returnURI . "&presult=1"));
    }

?>