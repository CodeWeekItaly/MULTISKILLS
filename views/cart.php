<?php require 'php/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <?php include 'partials/navbar.php';?>
    <?php include 'partials/accessibility.php';?>
    
    <main>
        <div class="container">
            <h2>Your cart</h2>
            <?php
                if (isset($_GET['cresult'])) {
                    if ($_GET['cresult'] == '1') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            You\'ve reached the stock limit of the product.
                        </div>
                        ';
                    } else if ($_GET['cresult'] == '2') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            This item is not available anymore.
                        </div>
                        ';
                    }
                }
            ?>
            <div class="cart-panel">
                <div class="cart-list">
                    <?php
                        //for each element in the cart, display the product name, price, and quantity
                        if (isset($_SESSION['cart'])) {
                            // for each product in the cart
                            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                $result = $mysqli -> query("SELECT * FROM products WHERE id='$product_id'");
                                $product = $result -> fetch_assoc();
                                $sql = "SELECT * FROM available WHERE idProduct='$product_id'";
                                $available = $mysqli -> query($sql);
                                $available = $available -> fetch_assoc();

                                echo '<div class="cart-item">';
                                    echo '<div class="cart-item-name"><a href="/product?id=' . $product['id'] . '">' . $product['name'] . '</a></div>';
                                    echo '<div class="cart-item-price-container">';
                                    echo '<div class="cart-item-price"> € ' . $available['price'] . '</div>';
                                    echo '<div class="cart-item-quantity"> ';
                                        echo '<div class="cart-item-quantity-label">Qty:</div>';
                                        echo '<a class="qty-btn" href="php/cart.php?action=add&id=' . $product_id  . '&quantity=-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                            </svg>
                                        </a> <span class="cart-item-quantity-number">' . $quantity["quantity"] . ' ' . $product["um"] .'</span> <a class="qty-btn" href="php/cart.php?action=add&id=' . $product_id . '&quantity=1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                            </svg>
                                        </a>';
                                        echo '<a class="remove-btn" href="php/cart.php?action=remove&id=' . $product_id . '">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </a> ';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="cart-item-total"> € ' . $available['price'] * $quantity["quantity"] . '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="alert alert-warning text-center" role="alert">Your cart is empty!</div>';
                        }
                    ?>
                </div>
                <div class="cart-summary">
                    <h3>Your cart summary</h3>
                    <div class="cart-summary-list">
                        <?php
                            if (!isset($_SESSION['cart'])) {
                                echo '<div style="text-align: center;"><em>Your cart is empty!</em></div>';
                            }
                        ?>
                    </div>
                    <?php
                        if (isset($_SESSION['cart'])) {
                            echo '
                            <hr>
                            <div class="end-summary">
                                <h3>Your total: <span id="cart-total">€ 0,00</span></h3>
                                <p class="total-note">(plus commissions or shipping)</p>
                                <a class="checkout" href="/checkout">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                    </svg>
                                    Proceed to checkout
                                </a>
                                or <br>
                                <a class="empty-btn" href="php/cart.php?action=empty">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                    </svg>
                                    Empty cart
                                </a>
                            </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <?php include 'partials/footer.php';?>

    <script src="js/cart.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>