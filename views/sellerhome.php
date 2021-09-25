<?php
    require 'php/db.php';

    function getCustomerName($id, $mysqli) {
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = $mysqli -> query($sql);
        $row = $result -> fetch_assoc();
        return $row['name']. " " . $row['surname'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your profile - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sellerhome.css">
</head>
<body>

    <?php include 'partials/navbar.php';?>
    <?php include 'partials/accessibility.php';?>

    <!-- Retrieving seller informations -->
    <?php
        $sql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";
        $result = $mysqli -> query($sql);
        $row = $result -> fetch_assoc();
    ?>

    <main>
        <div class="container">
            <div class="welcome-header">
                <div class="propic">
                    <?php
                        if (isset($row['profilePicture'])) {
                            echo '<img src="img/profileimgs/' . $row['profilePicture'] . '" alt="Profile picture">';
                        } else {
                            echo '<img src="img/profileimgs/defaultUser-placeholder.png" alt="Profile picture">';
                        }
                    ?>
                </div>
                <div class="user-infos">
                    <h1>Welcome <?php echo $row['name']. " " . $row['surname']; ?></h1>
                    <?php
                        if (isset($row['company']) && $row['company'] != "") {
                            echo '<span class="company-label">' . $row["company"] . '</span>';
                        }
                    ?>
                </div>
            </div>

            <?php
                if (isset($_GET['result'])) {
                    if ($_GET['result'] == '0') {
                        echo '
                        <br>
                        <div class="alert alert-success" role="alert">
                            Order processed successfully!
                        </div>
                        ';
                    }
                }
            ?>

            <h2 class="custom-heading">Your profile stats</h2>
            <div class="seller-stats">
                <div class="sales-stats">
                    <div class="inner-stats">
                        <div>Total earnings: <span id="total-earnings-value">0</span></div>
                        <div>Total sales: <span id="total-sales-value">0</span></div>
                        <hr>
                        <div>New orders to process: <span id="orders-to-process-value">0</span></div>
                    </div>
                </div>
                <div class="new-orders-list">
                    <h3>New orders to process</h3>
                    <div class="products-table">
                        <table class="table table-striped" id="new-orders-table">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Delivery address</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM products WHERE idUser = " . $_SESSION['id'];
                                    $result = $mysqli -> query($sql);
                                    if ($result && $result -> num_rows > 0) {
                                        foreach ($result as $product) {
                                            $sql = "SELECT * FROM orderdetails WHERE idAvailable = " . $product['id'] . " AND processed = 0";
                                            $result2 = $mysqli -> query($sql);
                                            if ($result2 && $result2 -> num_rows > 0) {
                                                foreach ($result2 as $order) {
                                                    $sql = "SELECT * FROM orders WHERE id = " . $order['idOrder'];
                                                    $result3 = $mysqli -> query($sql);
                                                    $row3 = $result3 -> fetch_assoc();
                                                    echo "<tr>";
                                                    echo "<td>" . $order["idOrder"] . "</td>";
                                                    echo "<td>" . $order["idAvailable"] . "</td>";
                                                    echo "<td>€". $order["totalPrice"] . " - " . $row3["paymentMethod"] . "</td>";
                                                    echo "<td>" . $row3["dateOrder"] . "</td>";
                                                    echo "<td>" . $row3["shippingAddress"] . "</td>";
                                                    echo "<td><a href='/confirmorder?idOrder=" . $order["idOrder"] . "&idProduct=" . $order["idAvailable"] . "' class=\"check-completed-order\" title='Check this order as completed' class='check-as-completed'>
                                                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" fill=\"currentColor\" class=\"bi bi-check-circle-fill\" viewBox=\"0 0 16 16\">
                                                            <path d=\"M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z\"/>
                                                        </svg>
                                                    </a>
                                                    <a href='php/denyorder.php?idOrder=" . $order["idOrder"] . "&idProduct=" . $order["idAvailable"] . "' class=\"deny-order\" title='Deny this order'>
                                                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" fill=\"currentColor\" class=\"bi bi-x-circle-fill\" viewBox=\"0 0 16 16\">
                                                        <path d=\"M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z\"/>
                                                    </svg>
                                                    </a></td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <h3 class="custom-heading">Orders being processed</h3>
            <div class="processing-orders-container">
                <?php
                    $sql = "SELECT * FROM orders WHERE idUSER = '" . $_SESSION["id"] . "' AND dateDelivery IS NULL";
                    $result = $mysqli -> query($sql);
                    if ($result && $result -> num_rows > 0) {
                        foreach ($result as $row) {
                            $total = 0.0;
                            $sql = "SELECT * FROM orderdetails WHERE idOrder=" . $row["id"];
                            $result2 = $mysqli -> query($sql);

                            echo '<div class="order-card">';
                                echo '<div class="order-card-heading">';
                                    echo '<h4>Order #' . $row["id"] . '</h4>';
                                    echo '<p>Purchase made on ' . $row["dateOrder"] . '</p>';
                                echo '</div>';
                                echo '<div class="order-card-body">';
                                    echo 'Products bought:';
                                    echo '<ul>';
                                        foreach ($result2 as $row2) {
                                            $sql = "SELECT * FROM products WHERE id=" . $row2["idAvailable"];
                                            $result3 = $mysqli -> query($sql);
                                            if ($result3 && $result3 -> num_rows > 0) {
                                                $row3 = $result3 -> fetch_assoc();
                                                echo '<li>' . $row2["quantity"] . ' &#xd7; ' . $row3["name"]. '</li>';
                                                $total += $row2["totalPrice"];
                                            } else {
                                                echo '<li>' . $row2["quantity"] . ' &#xd7; Unknown product</li>';
                                                $total += $row2["totalPrice"];
                                            }
                                        }
                                    echo '</ul>';
                                echo '</div>';
                                echo '<div class="order-card-footer">';
                                    echo '<p>Total: €' . $total . '</p>';
                                echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "You have no orders being processed.";
                    }
                ?>
            </div>

            <h3 class="custom-heading">Completed orders</h3>
            <div class="completed-orders-container">
                <?php
                    $sql = "SELECT * FROM orders WHERE idUSER = '" . $_SESSION["id"] . "' AND dateDelivery IS NOT NULL";
                    $result = $mysqli -> query($sql);
                    if ($result && $result -> num_rows > 0) {
                        foreach ($result as $row) {
                            $total = 0.0;
                            $sql = "SELECT * FROM orderdetails WHERE idOrder=" . $row["id"];
                            $result2 = $mysqli -> query($sql);

                            echo '<div class="order-card">';
                                echo '<div class="order-card-heading">';
                                    echo '<h4>Order #' . $row["id"] . '</h4>';
                                    echo '<p>Purchase made on ' . $row["dateOrder"] . '</p>';
                                echo '</div>';
                                echo '<div class="order-card-body">';
                                    echo 'Products bought:';
                                    echo '<ul>';
                                        foreach ($result2 as $row2) {
                                            $sql = "SELECT * FROM products WHERE id=" . $row2["idAvailable"];
                                            $result3 = $mysqli -> query($sql);
                                            if ($result3 && $result3 -> num_rows > 0) {
                                                $row3 = $result3 -> fetch_assoc();
                                                echo '<li>' . $row2["quantity"] . ' &#xd7; ' . $row3["name"]. '</li>';
                                                $total += $row2["totalPrice"];
                                            } else {
                                                echo '<li>' . $row2["quantity"] . ' &#xd7; Unknown product</li>';
                                                $total += $row2["totalPrice"];
                                            }
                                        }
                                    echo '</ul>';
                                echo '</div>';
                                echo '<div class="order-card-footer">';
                                    echo '<p>Total: €' . $total . '</p>';
                                echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "You have no orders being processed.";
                    }
                ?>
            </div>            

            <h2 class="custom-heading" id="products-section">Your available products</h2>
            <div class="available-list">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">Product name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity in stock</th>
                            <th scope="col">Expiry date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM products WHERE idUser = " . $_SESSION['id'];
                            $result = $mysqli -> query($sql);
                            if ($result && $result -> num_rows > 0) {
                                foreach ($result as $product) {
                                    $sql = "SELECT * FROM available WHERE idProduct = '" . $product["id"] . "'";
                                    $result2 = $mysqli -> query($sql);
                                    if ($result2 && $result2 -> num_rows > 0) {
                                        foreach ($result2 as $available) {
                                            echo "<tr>";
                                            echo "<td>" . $product["name"] . "</td>";
                                            echo "<td>" . "€ " . $available["price"] . "/" . $product["um"] . "</td>";
                                            echo "<td>" . $available["stock"] . "</td>";
                                            echo "<td>" . $available["avTo"] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <h2 class="custom-heading" id="products-section">All your products</h2>
            <div class="products-container">
                <?php
                    $sql = "SELECT * FROM products WHERE idUser = '" . $_SESSION["id"] . "'";
                    $result = $mysqli -> query($sql);

                    if ($result && $result -> num_rows > 0) {
                        while ($row = $result -> fetch_assoc()) {
                            echo '
                                <a href="/product?id=' . $row["id"] . '">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <img src="img/productimgs/';
                                        if (isset($row["productPicture"])) {
                                            echo $row["productPicture"];
                                        } else {
                                            echo 'defaultProduct-placeholder.png';
                                        }
                                        echo '" alt="A picture of ' . $row["name"] . '">
                                    </div>
                                    <div class="product-card-info">
                                        <h3>' . $row["name"] . '</h3>
                                        <p>' . $row["description"] . '</p>
                                    </div>
                                </div>
                                </a>
                            ';
                        }
                    }
                ?>
                <a href="/addproduct" class="add-product-card-link">
                    <div class="add-product-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                        </svg>
                        <h4>Add a product</h4>                 
                    </div>
                </a>
            </div>

            <h2 class="custom-heading" id="ratings-section">Ratings by the users</h2>
            <div class="ratings-container">
                <?php
                    $GLOBALS["ratingsAvailable"] = 0;
                    $sql = "SELECT * FROM products WHERE idUser = '" . $_SESSION["id"] . "'";
                    $result = $mysqli -> query($sql);
                    if ($result && $result -> num_rows > 0) {
                        foreach ($result as $product) {
                            $sql = "SELECT * FROM ratings WHERE idProduct = '" . $product["id"] . "'";
                            $result2 = $mysqli -> query($sql);
                            if ($result2 && $result2 -> num_rows > 0) {
                                $GLOBALS["ratingsAvailable"] = 1;
                                foreach ($result2 as $rating) {
                                    $sql = "SELECT * FROM users WHERE id = '" . $rating["idUser"] . "'";
                                    $result3 = $mysqli -> query($sql);
                                    $user = $result3 -> fetch_assoc();
                                    echo '
                                    <div class="review">
                                        <div class="review-header">
                                            <div class="review-rating">';
                                                for ($i = 0; $i < 5; $i++) {
                                                    if ($i < $rating["rating"]) {
                                                        if ($i + 0.5 == $rating["rating"]) {
                                                            echo '
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
                                                            </svg>
                                                            ';
                                                        } else {
                                                            echo '
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                            </svg>
                                                            ';
                                                        }
                                                    } else {
                                                        echo '
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                                        </svg>
                                                        ';
                                                    }
                                                }
                                            echo '
                                            </div>
                                            <div class="review-user mx-2">
                                                <h4> by <a href="/profile?id=' . $rating["idUser"] . '">' . $user["name"] . ' ' . $user["surname"] . '</a> on <a href="/product?id=' . $rating["idProduct"] . '">' . $product["name"] . '</a></h4>
                                            </div>
                                        </div>
                                        <div class="review-text">
                                            <p>' . $rating["comment"] . '</p>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        }
                    }

                    if ($GLOBALS["ratingsAvailable"] == 0) {
                        echo '
                            No ratings were left for your products yet.
                        ';
                    }
                ?>
        </div>
    </main>

    <?php include 'partials/footer.php';?>

    <script src="js/sellerhome.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>