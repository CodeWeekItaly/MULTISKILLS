<?php

    require('db.php');
    session_start();

    define('MB', 1048576);

    function getSellerLocation($idUser, $mysqli) {
        $query = "SELECT companylocation FROM users WHERE id = '$idUser'";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        return $row['companylocation'];
    }

    $idUser = $_SESSION['id'];

    $name = $mysqli -> real_escape_string($_POST['name']);
    $description = $mysqli -> real_escape_string($_POST['description']);
    $category = $mysqli -> real_escape_string($_POST['category']);
    $um = $mysqli -> real_escape_string($_POST['unitmeasure']);

    $categories = array("fruit" => "1",
                        "vegetable" => "2",
                        "meat" => "3",
                        "dairy" => "4",
                        "bakery" => "5",
                        "drink" => "6",
                        "other" => "7");

    if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
        $sql = "INSERT INTO products (idUser, name, category, description, um, location) VALUES ('$idUser', '$name', '$categories[$category]', '$description', '$um', '" . getSellerLocation($idUser, $mysqli) . "')";
        $result = $mysqli -> query($sql);
        if ($result) {
            exit(header("Location: /my-profile"));
        } else {
            // error in db
            header("Location: /addproduct?upresult=1");
        }
    } else {
        $image = $_FILES["image"];
        $image_name = $image['name'].time();
        $check = getimagesize($image['tmp_name']);
        if ($check !== false) {
            if ($image['error'] === 0) {
                if ($image['size'] <= 8*MB) {
                    $fileNameNew = $idUser . '_' . time() . '_' . $name . '.jpg';
                    $fileDestination = '../img/productimgs/' . $fileNameNew;
                    move_uploaded_file($image['tmp_name'], $fileDestination);
                    $sql = "INSERT INTO products (idUser, name, category, description, um, location, productPicture) VALUES ('$idUser', '$name', '$categories[$category]', '$description', '$um', '" . getSellerLocation($idUser, $mysqli) . "', '$fileNameNew')";
                    $result = $mysqli -> query($sql);
                    if ($result) {
                        exit(header("Location: /my-profile"));
                    } else {
                        // error in db
                        exit(header("Location: /addproduct?upresult=1"));
                    }
                } else {
                    // error - size limit
                    exit(header("Location: /addproduct?upresult=2"));
                }
            } else {
                // error - error during upload
                exit(header("Location: /addproduct?upresult=3"));
            }
        } else {
            // error - file's not an image
            exit(header("Location: /addproduct?upresult=4"));
        }
    }
    
?>