<?php require 'php/db.php'; ?>

<!-- Retrieving user information -->
<?php
    $sql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";
    $result = $mysqli -> query($sql);
    $row = $result -> fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your profile - IOcommerce</title>
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
                <h2><?php echo $row["name"] . " " . $row["surname"] ?></h2>
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
                        <div id="isSeller">
                            <strong>
                            <?php 
                                $isSeller = $row["seller"] ? "This user is a merchant." : "This user is a buyer."; echo $isSeller; 
                            ?>
                            </strong>
                        </div>
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
                    </div>
                </div>
                <?php
                    $sql = "SELECT * FROM products WHERE idUser = '" . $row["id"] . "'";
                    $result = $mysqli -> query($sql);

                    if ($result && $result -> num_rows > 0) {
                        echo '<h3 class="products-list-heading mt-5">Products</h3>';
                        echo '<div class="users-product-cards-container">';
                        while ($row = $result -> fetch_assoc()) {
                            echo '
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
                                        <h4>' . $row["name"] . '</h4>
                                        <p class"product-description">' . $row["description"] . '</p>
                                        <p class="product-price"> € ' . $row["price"];
                                        if ($row["isPriceToKilos"] != 0) { echo '/kg'; }
                                        echo '
                                        </p>
                                    </div>
                                    <div class="product-buttons">
                                        <a href="/product?id=' . $row["id"] . '">View product
                                            <svg xmlns="http://www.w3.org/2000/svg" class="product-button arrow-view-product" width="48" height="48" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                            </svg>
                                        </a>
                                        <a href="/edit?id=' . $row["id"] . '">Edit product
                                            <svg xmlns="http://www.w3.org/2000/svg" class="product-button arrow-edit-product" width="48" height="48" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                        <a href="/pdelete?id=' . $row["id"] . '">Delete product
                                            <svg xmlns="http://www.w3.org/2000/svg" class="product-button arrow-delete-product" width="48" height="48" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            ';
                        }
                    echo '</div>';
                    }
                ?>
            </div>
        </div>
    </main>

    <?php include 'partials/footer.php';?>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>