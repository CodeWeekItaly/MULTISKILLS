<?php

    require 'db.php';
    session_start();

    $idUser = $_SESSION['id'];
    $idProduct = $mysqli -> real_escape_string($_GET['id']);
    $returnURI = $mysqli -> real_escape_string($_GET['returnURI']);

    $sql = "DELETE FROM available WHERE idProduct=" . $idProduct;
    $result = $mysqli -> query($sql);

    if ($result) {
        exit(header("Location: " . $returnURI));
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli -> error;
        //exit(header("Location: " . $returnURI . "&presult=1"));
    }

?>