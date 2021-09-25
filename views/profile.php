<?php require 'php/db.php';

    // Retrieving user information
    $sql = "SELECT * FROM users WHERE id = '" . $_GET["id"] . "'";
    $result = $mysqli -> query($sql);

    if ($result -> num_rows == 0) {
        require 'views/404.php';
        exit();
    }

    $row = $result -> fetch_assoc();

    if ($row["id"] == $_SESSION["id"] && $row["seller"] == 1) {
        exit(header("Location: /my-profile"));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if ($row["id"] == $_SESSION["id"] && $row["seller"] == 1) {
            echo "<title>Your profile - IOcommerce</title>";
        } else {
            echo "<title>" . $row["name"] . " " . $row["surname"] . "'s profile - IOcommerce</title>";
        }
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
</head>
<body>
    <?php include 'partials/navbar.php';?>
    <?php include 'partials/accessibility.php';?>
    
    <main>
        <div class="container">
            <div class="profile-info">
                <h2>
                    <?php
                        echo $row["name"] . " " . $row["surname"];
                        if ($row["seller"] == 1) {
                            echo "<span class=\"seller-tag\">Seller</span>";
                        } else {
                            echo "<span class=\"buyer-tag\">Buyer</span>";
                        }
                    ?>
                </h2>
                <div class="profile-specs">
                    <div class="profile-image">
                        <?php
                            if (isset($row["profilePicture"])) {
                                echo '<img src="img/profileimgs/' . $row["profilePicture"] . '" alt="Profile image">';
                            } else {
                                echo '<img src="img/profileimgs/defaultUser-placeholder.png" alt="Profile image">';
                            }
                        ?>
                    </div>
                    <div class="profile-description">
                        <div id="userDescription">
                            <p>
                                <?php
                                    if (isset($row["description"]) && $row["description"] != "") {
                                        echo "<em>" . $row["description"] . "</em>";
                                    } else {
                                        echo "<em>This user has no description.</em>";
                                    }
                                ?>
                            </p>
                        </div>
                        <div id="user-contacts">
                        <?php
                            if (isset($row["telephone"])) {
                                echo '<a class="btn call-button" href="tel:' . $row["telephone"] . '">' . '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                              </svg> Call this user </a>';
                            }
                            echo '<a class="btn     email-button" href="mailto:' . $row["email"] . '">' . '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                          </svg> Send a mail</a>';
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="custom-heading" id="products-section">Products on sale</h2>
            <div class="products-container">
                <?php
                    $sql = "SELECT * FROM available WHERE idUser=" . $_GET["id"];
                    $result = $mysqli -> query($sql);
                    if ($result && $result -> num_rows > 0) {
                        foreach ($result as $row) {
                            $sql = "SELECT * FROM products WHERE id=".$row["idProduct"];
                            $result = $mysqli -> query($sql);
                            $product = $result -> fetch_assoc();
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
                                        <h3>' . $product["name"] . '</h3>
                                        <p>' . $product["description"] . '</p>
                                    </div>
                                </div>
                            </a>
                            ';
                        }
                    } else {
                        echo '<p>This user has no products on sale.</p>';
                    }
                ?>
            </div>

            <h2 class="custom-heading" id="ratings-section">Ratings left by the user</h2>
            <div class="ratings-container">
            <?php
                $GLOBALS["ratingsAvailable"] = 0;
                $sql = "SELECT * FROM ratings WHERE idUser=" . $_GET["id"];
                $result = $mysqli -> query($sql);
                if ($result && $result -> num_rows > 0) {
                    $GLOBALS["ratingsAvailable"] = 1;
                    foreach ($result as $rating) {
                        $sql = "SELECT * FROM products WHERE id=" . $rating["idProduct"];
                        $result = $mysqli -> query($sql);
                        $product = null;
                        if ($result && $result -> num_rows > 0) {
                            $product = $result -> fetch_assoc();
                        } else {
                            $product = null;
                        }
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
                                    <h4> on <a href="/product?id=' . $rating["idProduct"] . '">' . $product["name"] . '</a></h4>
                                </div>
                            </div>
                            <div class="review-text">
                                <p>' . $rating["comment"] . '</p>
                            </div>
                        </div>
                        ';
                    }
                }

                if ($GLOBALS["ratingsAvailable"] == 0) {
                    echo '
                        This user hasn\'t left any ratings yet.
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