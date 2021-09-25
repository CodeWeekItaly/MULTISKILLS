<?php require 'php/db.php';

    error_reporting(0);

    function getUserFullName($id, $mysqli) {
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $mysqli -> query($query);
        $row = $result -> fetch_assoc();
        return $row['name'] . ' ' . $row['surname'];
    }

    function isProductOnCatalog($id, $mysqli) {
        $query = "SELECT * FROM available WHERE idProduct = '$id'";
        $result = $mysqli -> query($query);
        if ($result && $result -> num_rows > 0) {
            return true;
        }
        return false;
    }

    function isUserOwner($idGuest, $idOwner) {
        if ($idGuest == $idOwner) {
            return true;
        }
        return false;
    }

    // Retrieving product information
    $sql = "SELECT * FROM products WHERE id = '" . $_GET["id"] . "'";
    $result = $mysqli -> query($sql);
    $row = $result -> fetch_assoc();

    $sql = "SELECT * FROM available WHERE idProduct = " . $_GET["id"];
    $result2 = $mysqli -> query($sql);
    $available = $result2 -> fetch_assoc();


    if ($result -> num_rows == 0) {
        require 'views/404.php';
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row["name"] . " by " . getUserFullName($row["idUser"], $mysqli) ?>- IOcommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
</head>
<body>
    <?php include 'partials/navbar.php';?>
    <main>
        <div class="container">
            <div class="product-panel">
                <div class="product-image">
                    <?php
                        if (isset($row["productPicture"])) {
                            echo '<img src="img/productimgs/' . $row["productPicture"] . '" alt="Product image">';
                        } else {
                            echo '<img src="img/productimgs/defaultProduct-placeholder.png" alt="Profile image">';
                        }
                    ?>
                </div>
                <div class="product-info">
                    <div class="product-details">
                        <h2><?php echo $row["name"] ?></h2>
                        <p>By <?php echo '<a class="product-by" href="/profile?id=' . $row["idUser"] . '">' . getUserFullName($row["idUser"], $mysqli) . '</a>'; ?> </p>
                        <p><em><?php echo $row["description"] ?></em></p>

                        <?php
                            if (isUserOwner($_SESSION["id"], $row["idUser"])) {
                                if (!isProductOnCatalog($row["id"], $mysqli)) {
                                    echo '
                                    <div class="owner-panel mt-2">
                                        <span style="color: red"><em><strong>This product isn\'t available in the catalog.</strong><br></span>
                                        Fill the requested fields to add it to make it available.</em>
                                    
                                        <form id="essential-product-form" action="php/goAvailable.php" method="post">
                                            <input type="hidden" name="idProduct" value="' . $_GET["id"] . '">
                                            <input type="hidden" name="returnURI" value="' . $_SERVER['REQUEST_URI'] . '">
                                            <div class="form-group">
                                                <label for="expirydate">Expiry date</label>
                                                <input type="date" class="form-control" id="expirydate" name="expirydate" placeholder="Expiry date">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control" id="price" name="price" step=".01" placeholder="Price">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="stock">Number of products in stock</label>
                                                    <input type="number" class="form-control" id="stock" name="stock" step="1" placeholder="Number of products in stock" value="15">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-4">Publish the product</button>
                                        </form>
                                    </div>
                                    ';
                                } else {
                                    echo '
                                    <div class="owner-panel mt-2">
                                        <span style="color: green"><em><strong>This product is available in the catalog.</strong><br></span>
                                        Fill the requested fields to edit it.</em>

                                        <form action="php/editAvailable.php" method="post">
                                            <input type="hidden" name="idProduct" value="' . $_GET["id"] . '">
                                            <input type="hidden" name="returnURI" value="' . $_SERVER['REQUEST_URI'] . '">
                                            <div class="form-group">
                                                <label for="expirydate">Expiry date</label>
                                                <input type="date" class="form-control" id="expirydate" name="expirydate" min="' . date("Y-m-d") . '" placeholder="Expiry date">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control" id="price" name="price" step=".01" placeholder="Price" value="' . $available["price"] . '">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="stock">Number of products in stock</label>
                                                    <input type="number" class="form-control" id="stock" name="stock" step="1" placeholder="Number of products in stock" value="' . $available["stock"] . '">
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-primary">Edit the product</button>
                                                </div>
                                                <div class="col-6">
                                                    <a href="php/removeAvailable.php?id=' . $_GET["id"] . '&returnURI=' . $_SERVER['REQUEST_URI'] . '" class="btn btn-outline-danger">Delete the product</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    ';
                                }
                            }
                        ?>
                    </div>
                    <?php
                        if (!isUserOwner($_SESSION["id"], $row["idUser"])) {
                            if (isProductOnCatalog($row["id"], $mysqli)) {
                                $sql = "SELECT * FROM available WHERE idProduct = " . $_GET["id"];
                                $result = $mysqli -> query($sql);
                                $product = $result -> fetch_assoc();

                                echo '
                                <div class="product-price">
                                    <div class="price-and-stock">
                                        <h3><span class="green-euro">€</span>' . $product["price"] . '<span class="um-price">/' . $row["um"] . '</span></h3>
                                        <p>' . $product["stock"] . ' ' . $row["um"] . ' in stock</p>
                                    </div>
                                    <div class="qty-picker">
                                        <label for="quantity">Quantity: </label>
                                        <input type="number" id="quantity" name="quantity" step="1" placeholder="Quantity" value="1" min="1" max="' . $product["stock"] . '"> ' .  $row["um"] . '
                                    </div>
                                </div>

                                <div class="purchase-btns">
                                    <a class="btn" id="add-to-cart-btn" href="php/cart.php?action=add&id=' . $_GET["id"] . '&quantity=1">Add to cart</a>
                                    <a class="btn" id="buy-now-btn" onclick="featureNotAvailable()">Buy now</a>
                                </div>
                                ';
                            } else {
                                echo '
                                <span style="color: red; font-size: 20px;"><strong>This product isn\'t available in the catalog.</strong></span><br>
                                <span style="font-size: 16px;"><em>Please, contact the owner to get some information.</em></span>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>

            <hr class="mt-5">

            <div class="product-reviews">
                <div class="heading-reviews">
                    <div class="inner-heading">
                        <h3>Reviews on this product</h3>
                        <p>
                            Average rating:
                            <?php
                                $sql = "SELECT AVG(rating) AS average FROM ratings WHERE idProduct = " . $_GET["id"];
                                $result = $mysqli -> query($sql);
                                if ($result && $result -> num_rows > 0) {
                                    $row2 = $result -> fetch_assoc();
                                    echo number_format($row2["average"], 1) . " stars out of 5";
                                }
                            ?>
                        </p>
                    </div>
                    <?php
                        if (!isUserOwner($_SESSION["id"], $row["idUser"])) {
                            echo '<button class="btn btn-outline-primary" id="add-review-btn">Add a review</button>';
                        }
                    ?>
                </div>
                <div class="review-box hidden">
                    <form action="php/addreview.php" method="POST">
                        <input type="hidden" name="idProduct" value="<?php echo $_GET["id"]; ?>">
                        <input type="hidden" name="returnURI" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <div class="form-group">
                            <label for="review-rating">Your rating</label>
                            <input type="number" class="form-control" id="review-rating" name="rating" step="0.5" min="1" max="5" placeholder="Your rating" value="3" required>
                        </div>
                        <div class="form-group">
                            <label for="review-text">Your review</label>
                            <textarea class="form-control" id="review-text" name="text" rows="3" placeholder="Your review" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                    <hr>
                </div>
                <div class="review-list">
                    <?php
                        $sql = "SELECT * FROM ratings WHERE idProduct = " . $_GET["id"];
                        $result = $mysqli -> query($sql);
                        if ($result && $result -> num_rows > 0) {
                            foreach ($result as $row) {
                                $sql = "SELECT * FROM users WHERE id = " . $row["idUser"];
                                $result2 = $mysqli -> query($sql);
                                $user = $result2 -> fetch_assoc();

                                echo '
                                <div class="review">
                                    <div class="review-header">
                                        <div class="review-rating">';
                                            for ($i = 0; $i < 5; $i++) {
                                                if ($i < $row["rating"]) {
                                                    if ($i + 0.5 == $row["rating"]) {
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
                                            <h4> by <a href="/profile?id=' . $row["idUser"] . '">' . $user["name"] . " " . $user["surname"] . '</a></h4>
                                        </div>
                                    </div>
                                    <div class="review-text">
                                        <p>' . $row["comment"] . '</p>
                                    </div>
                                </div>
                                ';
                            }
                        } else {
                            echo '
                            <em>No reviews yet for this product.</em>
                            ';
                        }
                    ?>
                </div>
            </div>

        </div>
    </main>

    <?php include 'partials/accessibility.php';?>
    <?php include 'partials/footer.php';?>
    
    <script src="js/productpage.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>