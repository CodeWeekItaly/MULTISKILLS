<?php

    require('db.php');
    session_start();

    define('MB', 1048576);

    if (isset($_FILES['picfile'])) {

        $profilepic = $_FILES['picfile'];
        $profilepic_name = $profilepic['name'].$_SESSION['id'];
        $idUser = $_SESSION['id'];

        $check = getimagesize($profilepic["tmp_name"]);

        if ($check !== false) {
            if ($profilepic['error'] ===  0){
                if ($profilepic['size'] < 8*MB){            
                    $fileNameNew = "idProfile-" . $idUser . ".jpg";
                    $fileDestination = '../img/profileimgs/' . $fileNameNew;
                    move_uploaded_file($profilepic['tmp_name'], $fileDestination);
                    $sql = "UPDATE users SET profilePicture = '$fileNameNew' WHERE id = '$idUser'";
                    $result = $mysqli -> query($sql);
                    if ($result) {
                        exit(header("Location: /settings?pcresult=0"));
                    } else {
                        exit(header("Location: /settings?pcresult=3"));
                    }
                }else{
                    // error - size limit
                    exit(header("Location: /settings?pcresult=2"));
                }
            }else{
                // error - error during upload
                exit(header("Location: /settings?pcresult=3"));
            }
        }else{
            // error - file's not an image
            exit(header("Location: /settings?pcresult=4"));
        }
    } else {
        // error - no file selected
        exit(header("Location: /settings?pcresult=5"));
    }
?>