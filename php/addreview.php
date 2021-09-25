<?php

    require('db.php');
    session_start();
    
    $returnURI = $_POST['returnURI'];

    $idUser = $_SESSION['id'];
    $idProduct = $_POST['idProduct'];
    $rating = $mysqli -> real_escape_string($_POST['rating']);
    $text = $mysqli -> real_escape_string($_POST['text']);

    $sql = "INSERT INTO ratings (idProduct, idUser, rating, comment) VALUES ('$idProduct', '$idUser', '$rating', '$text')";
    $result = $mysqli -> query($sql);

    if ($result) {
        exit(header("Location: " . $returnURI));
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli -> error;
    }

?>