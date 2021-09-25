<?php require 'php/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your orders - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/orders.css">
</head>
<body>

    <?php include 'partials/navbar.php';?>
    <?php include 'partials/accessibility.php';?>

    <main>
        <div class="container">
            <h2>Your orders</h2>
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
                            echo "<p class=\"no-orders\">You have no orders being processed.</p>";
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
                            echo "<p class=\"no-orders\">You have no orders being processed.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <?php include 'partials/footer.php';?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>