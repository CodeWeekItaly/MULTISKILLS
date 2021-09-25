<?php

session_start();
require 'php/db.php';

$request = $_SERVER['REQUEST_URI'];

function isSeller($id, $mysqli) {
    $query = "SELECT * FROM `users` WHERE `id` = '$id'";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    if ($row['seller'] == 1) {
        return true;
    }
    return false;
}

/*  ********** ENABLE ONLY IF SITE IS ONLINE ********** */

if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
}

switch ($request) {
    case '':
    case '/':
        if (!isset($_SESSION['id'])) {
            require __DIR__ . '/views/landing.php';
        } else {
            require __DIR__ . '/views/home.php';
        }
        break;

    case (substr($_SERVER['REQUEST_URI'], 0, 6) == '/login') ? true : false :
        if (!isset($_SESSION['id'])) {
            require __DIR__ . '/views/login.php';
        } else {
            header("Location: /");
        }
        break;
        
    case (substr($_SERVER['REQUEST_URI'], 0, 9) == '/register') ? true : false :
        if (!isset($_SESSION['id'])) {
            require __DIR__ . '/views/register.php';
        } else {
            require __DIR__ . '/views/home.php';
        }
        break;

    case (substr($_SERVER['REQUEST_URI'], 0, 14) == '/passwordreset') ? true : false :
        if (!isset($_SESSION['id'])) {
            if (isset($_SESSION['resetStep']) && $_SESSION['resetStep'] == 1) {
                require __DIR__ . '/views/forgotpassword2.php';
            } else if (isset($_SESSION['resetStep']) && $_SESSION['resetStep'] == 2) {
                require __DIR__ . '/views/forgotpassword3.php';
            } else {
                require __DIR__ . '/views/forgotpassword1.php';
            }
        } else {
            header("Location: /");
            exit();
        }
        break;

    case (substr($_SERVER['REQUEST_URI'], 0, 11) == '/my-profile') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            if (isSeller($_SESSION['id'], $mysqli)) {
                require __DIR__ . '/views/sellerhome.php';
            } else {
                require __DIR__ . '/views/selfprofile.php';
            }
        }
        break;

    // searching for products
    case (substr($_SERVER['REQUEST_URI'], 0, 7) == '/search') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            require __DIR__ . '/views/search.php';
        }
        break;

    // displaying other users profile
    case (substr($_SERVER['REQUEST_URI'], 0, 8) == '/profile') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            require __DIR__ . '/views/profile.php';
        }
        break;

    // displaying a product
    case (substr($_SERVER['REQUEST_URI'], 0, 8) == '/product') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            require __DIR__ . '/views/product.php';
        }
        break;

    // adding a product
    case (substr($_SERVER['REQUEST_URI'], 0, 11) == '/addproduct') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            require __DIR__ . '/views/addproduct.php';
        }
        break;

    case (substr($_SERVER['REQUEST_URI'], 0, 5) == '/cart') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            require __DIR__ . '/views/cart.php';
        }
        break;

    case (substr($_SERVER['REQUEST_URI'], 0, 9) == '/settings') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            require __DIR__ . '/views/settings.php';
        }
        break;

    // checkout page
    case (substr($_SERVER['REQUEST_URI'], 0, 9) == '/checkout') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            if (isset($_SESSION['cart'])) {
                require __DIR__ . '/views/checkout.php';
            } else {
                header("Location: /");
                exit();
            }
        }
        break;

    // orders page
    case (substr($_SERVER['REQUEST_URI'], 0, 7) == '/orders') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            require __DIR__ . '/views/orders.php';
        }
        break;

    // policies page
    case (substr($_SERVER['REQUEST_URI'], 0, 9) == '/policies') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            require __DIR__ . '/views/policies.php';
        }
        break;

    // send invoice page
    case (substr($_SERVER['REQUEST_URI'], 0, 13) == '/confirmorder') ? true : false :
        if (!isset($_SESSION['id'])) {
            header("Location: /login");
            exit();
        } else {
            require __DIR__ . '/views/sendinvoice.php';
        }
        break;
        
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}

?>