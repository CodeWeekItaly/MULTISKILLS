<?php 
    if (!isset($_GET["q"]) || empty($_GET["q"])) {
        exit(header("Location: /"));
    }

    require 'php/db.php';

    function isAnyAvailable($mysqli) {
        $sql = "SELECT * FROM available";
        $result = $mysqli -> query($sql);
        if ($result && $result -> num_rows > 0) {
            foreach ($result as $available) {
                $sql = "SELECT * FROM products WHERE id = " . $available["idProduct"] . " AND name LIKE '%" . $_GET["q"] . "%'";
                $result2 = $mysqli -> query($sql);
                if ($result2 && $result2 -> num_rows > 0) {
                    return true;
                }
            }
        }
        return false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search results for <?php echo $_GET["q"]; ?> - IOcommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
</head>
<body>
    <?php include 'partials/navbar.php'; ?>
    <?php include 'partials/accessibility.php';?>
    <main>

        <div class="container">
            <h2>Search results for <strong><?php echo $_GET["q"]; ?></strong></h2>

            <?php   // sellers search
                $sql = "SELECT * FROM users WHERE CONCAT(name, ' ', surname) LIKE '%" . $_GET["q"] . "%' AND seller = 1";
                $result = $mysqli -> query($sql);
                if ($result && $result -> num_rows > 0) {
                    $GLOBALS["usersFound"] = 1;
                    echo '<h3 class="custom-heading">Sellers</h3>';
                    echo '<div class="seller-cards-container">';
                    while ($row = $result -> fetch_assoc()) {
                        echo '
                            <a href="/profile?id=' . $row["id"] . '">
                            <div class="seller-card">
                                <div class="seller-card-img">
                                    <img src="img/profileimgs/';
                                    if (isset($row["profilePicture"])) {
                                        echo $row["profilePicture"];
                                    } else {
                                        echo 'defaultUser-placeholder.png';
                                    }
                                    echo '" alt="' . $row["name"] . '\'s profile picture">
                                </div>
                                <div class="seller-card-info">
                                    <h4>' . $row["name"] . ' ' . $row["surname"] . '</h4>
                                    <p>' . $row["description"] . '</p>
                                </div>
                            </div>
                            </a>
                        ';
                    }
                    echo '</div>';
                } else {
                    $GLOBALS["usersFound"] = 0;
                }
            ?>


            <?php   // products search
                if (isAnyAvailable($mysqli)) {
                    $sql = "SELECT * FROM available";
                    $result = $mysqli -> query($sql);
                    if ($result && $result -> num_rows > 0) {
                        $GLOBALS["productsFound"] = 1;
                        echo '<h3 class="custom-heading">Products</h3>';
                        echo '<div class="product-cards-container">';
                        foreach ($result as $available) {
                            $sql = "SELECT * FROM products WHERE id = " . $available["idProduct"] . " AND name LIKE '%" . $_GET["q"] . "%'";
                            $result2 = $mysqli -> query($sql);
                            if ($result2 && $result2 -> num_rows > 0) {
                                foreach ($result2 as $product) {
                                    echo '
                                    <a href="/product?id=' . $product["id"] . '">
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                <img src="img/productimgs/';
                                                if (isset($product["productPicture"])) {
                                                    echo $product["productPicture"];
                                                } else {
                                                    echo 'defaultProduct-placeholder.png';
                                                }
                                                echo '" alt="A picture of ' . $product["name"] . '">
                                            </div>
                                            <div class="product-card-info">
                                                <h4>' . $product["name"] . '</h4>
                                                <p>' . $product["description"] . '</p>
                                                <p class="price-label">€ ' . $available["price"] . '/' . $product["um"] .'</p>
                                                <p class="stock-label">' . $available["stock"] . ' ' . $product["um"] . ' left in stock</p>
                                            </div>
                                        </div>
                                    </a>
                                    ';
                                }
                            }
                        }
                        echo '</div>';
                    } else {
                        $GLOBALS["productsFound"] = 0;
                    }
                } else {
                    $GLOBALS["productsFound"] = 0;
                }
            ?>

            <?php   // no results
                if ($GLOBALS["usersFound"] == 0 && $GLOBALS["productsFound"] == 0) {
                    echo '
                        <div class="alert alert-danger text-center mt-5" role="alert">
                            <strong>No results found!</strong>
                        </div>
                    ';
                }
            ?>
            
        </div>
    </main>

    <?php include 'partials/footer.php';?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>