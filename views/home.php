<?php 
    require 'php/db.php';

    function calculateDistance($lat1, $lon1, $lat2, $lon2, $earthRadius = 6371000) {
        // convert from degrees to radians
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <?php include 'partials/navbar.php';?>
    <?php include 'partials/accessibility.php';?>

    <main>
        <!-- Retrieving user information -->
        <?php
            $sql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";
            $result = $mysqli -> query($sql);
            $row = $result -> fetch_assoc();
        ?>

        <div class="container">
            <h1>Welcome to IOcommerce, <?php echo $row["name"] ?></h1>
            <?php   // latest 10 products made available
                $sql = "SELECT * FROM available ORDER BY avFrom DESC LIMIT 10";
                $result = $mysqli -> query($sql);
                if ($result && $result -> num_rows > 0) {
                    echo "<h3 class='custom-heading'>Products added recently</h3>";
                    echo "<div class='products-container'>";
                    foreach ($result as $available) {
                        $sql = "SELECT * FROM products WHERE id = " . $available["idProduct"];
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
                                    <h4>' . $product["name"] . '</h4>
                                    <p>' . $product["description"] . '</p>
                                    <p class="price-label">€ ' . $available["price"] . '/' . $product["um"] .'</p>
                                    <p class="stock-label">' . $available["stock"] . ' ' . $product["um"] . ' left in stock</p>
                                </div>
                            </div>
                        </a>
                        ';
                    }
                    echo "</div>";
                }
            ?>

            <h3 class="custom-heading" id="nearest-products">Product nearest your home city</h3>
            <div class="products-container">
                <div class="alert alert-primary" role="alert" id="coming-soon">
                    Feature coming soon!
                </div>
            </div>

            <!-- STILL WORKING ON
            <?php   // products nearest user's home city
            /*
                $sql = "SELECT city FROM users WHERE id = " . $_SESSION['id'];
                $result = $mysqli -> query($sql);
                if ($result && $result -> num_rows > 0) {
                    $usercity = $result -> fetch_assoc();
                    
                    $url = "https://api.geoapify.com/v1/geocode/search?text=" . $usercity["city"] . "&limit=5&apiKey=30255c5c2a2846008e5bc04f440b9ce8";
                    $urlresult = file_get_contents($url);

                    $coords = json_decode($urlresult, true);
                    $lat = $coords["features"][0]["properties"]["lat"];
                    $lon = $coords["features"][0]["properties"]["lon"];
                    $usercoords = array($lat, $lon);

                    $sql = "SELECT * FROM products";
                    $result = $mysqli -> query($sql);
                    if ($result && $result -> num_rows > 0) {
                        $products = $result -> fetch_assoc();
                        foreach ($products as $product) {
                            $url = "https://api.geoapify.com/v1/geocode/search?text=" . $product["location"] . "&limit=5&apiKey=30255c5c2a2846008e5bc04f440b9ce8";
                            $urlresult = file_get_contents($url);

                            $coords = json_decode($urlresult, true);
                            $userlat = $coords["features"][0]["properties"]["lat"];
                            $userlon = $coords["features"][0]["properties"]["lon"];

                            $distance = calculateDistance($lat, $lon, $userlat, $userlon);
                            $product["distance"] = $distance;
                        }                        
                        $distances = array_column($products, 'distance');
                        array_multisort($distances, SORT_DESC, $products);

                        echo "<h3 class='custom-heading'>Products nearest your city</h3>";
                        echo "<div class='products-container'>";
                        foreach ($products as $product) {
                            $sql = "SELECT * FROM available WHERE idProduct = " . $product["id"];
                            $result = $mysqli -> query($sql);
                            if ($result && $result -> num_rows > 0) {
                                $available = $result -> fetch_assoc();
                                $sql = "SELECT * FROM products WHERE id = " . $available["idProduct"];
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
                        echo "</div>";
                    }
                }
            -*/
            ?>
            -->

        </div>
    </main>

    <?php include 'partials/footer.php';?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>