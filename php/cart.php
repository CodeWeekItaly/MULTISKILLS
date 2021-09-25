<?php

    require 'db.php';
    session_start();

    function isStockEnough($id, $quantity, $mysqli) {
        // retrieve the stock quantity from the database, then,
        // check if the stock quantity is enough to add the specified item quantity
        // in the cart
        $sql = "SELECT stock FROM available WHERE idProduct = '$id'";
        $result = $mysqli -> query($sql);
        $row = $result -> fetch_assoc();
        $stock = $row['stock'];
        if ($stock >= $quantity) {
            return true;
        }
        return false;
    }

    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "add":
                if (isset($_GET["id"]) && isset($_GET["quantity"])) {
                    $id = $_GET["id"];
                    $quantity = $_GET["quantity"];
                    if (isset($_SESSION["cart"][$id])) {
                        if (isStockEnough($id, $quantity, $mysqli)) {
                            $_SESSION["cart"][$id]["quantity"] += $quantity;
                        } else {
                            exit(header("Location: /cart?cresult=1"));
                        }
                    } else {
                        if (isStockEnough($id, $quantity, $mysqli)) {
                            $_SESSION["cart"][$id] = array("quantity" => $quantity);
                        } else {
                            exit(header("Location: /cart?cresult=1"));
                        }
                    }
                    if ($_SESSION["cart"][$id]["quantity"] < 1) {
                        unset($_SESSION["cart"][$id]);
                    }
                    if (count($_SESSION["cart"]) == 0) {
                        unset($_SESSION["cart"]);
                    }                 
                }
                break;

            case "remove":
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    if (isset($_SESSION["cart"][$id])) {
                        unset($_SESSION["cart"][$id]);
                    }
                }
                if (count($_SESSION["cart"]) == 0) {
                    unset($_SESSION["cart"]);
                }
                break;

            case "empty":
                unset($_SESSION["cart"]);
                break;

            default:
                exit(header("Location: /cart"));
                break;
        }
    }

    exit(header("Location: /cart"));

?>