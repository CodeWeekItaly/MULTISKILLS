<?php
    require 'php/db.php';

    function getTotal($mysqli) {
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $quantity) {
            $sql = "SELECT * FROM products WHERE id = " . $id;
            $result = $mysqli -> query($sql);
            foreach ($result as $row) {
                $sql = "SELECT * FROM available WHERE idProduct = " . $row["id"];
                $result2 = $mysqli -> query($sql);
                foreach ($result2 as $row2) {
                    $total += $row2["price"] * $quantity['quantity'];
                }
            }
        }
        return $total;
    }

    $sql = "SELECT * FROM users WHERE id=" . $_SESSION["id"];
    $result = $mysqli -> query($sql);
    $row = $result -> fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout and payment - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>
    <?php include 'partials/navbar.php';?>
    <?php include 'partials/accessibility.php';?>
    <main>
        <div class="container">
            <form action="php/checkout.php" method="POST">
                <h3>Do you prefer to collect your order in-store or receive home delivery?</h3>
                <div class="grid">

                    <label class="card">
                        <input type="radio" name="delivery" id="athome" class="radio" value="homedelivery" checked>
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg>
                        <span class="card-title">Home delivery</span>
                    </label>

                    <label class="card">
                        <input type="radio" name="delivery" id="instorepickup" class="radio" value="instorepickup">
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-basket-fill" viewBox="0 0 16 16">
                            <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
                        </svg>
                        <span class="card-title">In-store pick up</span>
                    </label>

                </div>

                <div id="shipping-address-div">
                    <h3 class="mt-4">Please enter your shipping address</h3>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John" value="<?php if(isset($row["name"])) echo $row["name"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Appleseed" value="<?php if(isset($row["surname"])) echo $row["surname"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Rome" value="<?php if(isset($row["city"])) echo $row["city"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Italy" value="<?php if(isset($row["state"])) echo $row["state"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Zip code</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="00100" value="<?php if(isset($row["zipcode"])) echo $row["zipcode"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Via del Corso, 1" value="<?php if(isset($row["address"])) echo $row["address"]; ?>" required>
                    </div>
                    <div class="form-group text-center mt-2">
                        <input class="form-check-input" type="checkbox" id="card-same-billing-address" name="same-billing-address" checked>
                        <label class="form-check-label" for="card-same-billing-address"> Use same addess as billing address?</label>
                    </div>

                    <div class="card-billing-info hidden">
                        <h3>Billing address</h3>
                        <div class="form-group">
                            <label for="billing-name">Name</label>
                            <input type="text" class="form-control" id="billing-name" name="billing-name" placeholder="John">
                        </div>
                        <div class="form-group">
                            <label for="billing-surname">Surname</label>
                            <input type="text" class="form-control" id="billing-surname" name="billing-surname" placeholder="Appleseed">
                        </div>
                        <div class="form-group">
                            <label for="billing-city">City</label>
                            <input type="text" class="form-control" id="billing-city" name="billing-city" placeholder="Rome">
                        </div>
                        <div class="form-group">
                            <label for="billing-state">State</label>
                            <input type="text" class="form-control" id="billing-state" name="billing-state" placeholder="Italy">
                        </div>
                        <div class="form-group">
                            <label for="billing-zipcode">Zip code</label>
                            <input type="text" class="form-control" id="billing-zipcode" name="billing-zipcode" placeholder="00100">
                        </div>
                        <div class="form-group">
                            <label for="billing-address">Address</label>
                            <input type="text" class="form-control" id="billing-address" name="billing-address" placeholder="Via del Corso, 1">
                        </div>
                    </div>
                </div>


                <h3 class="mt-4">Select a payment method</h3>
                <div class="grid">

                    <label class="card">
                        <input name="payment-method" class="radio" type="radio" id="pay-with-card" value="paywithcard" checked>
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-credit-card-2-front-fill" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                        </svg>
                        <span class="card-title">Credit/Debit card</span>
                    </label>

                    <label class="card">
                        <input name="payment-method" class="radio" type="radio" id="pay-with-paypal" value="paywithpaypal">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="248px" height="66px" viewBox="0 0 124 33" enable-background="new 0 0 124 33" xml:space="preserve">
                            <path fill="#253B80" d="M46.211,6.749h-6.839c-0.468,0-0.866,0.34-0.939,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.564,0.658
                                h3.265c0.468,0,0.866-0.34,0.939-0.803l0.746-4.73c0.072-0.463,0.471-0.803,0.938-0.803h2.165c4.505,0,7.105-2.18,7.784-6.5
                                c0.306-1.89,0.013-3.375-0.872-4.415C50.224,7.353,48.5,6.749,46.211,6.749z M47,13.154c-0.374,2.454-2.249,2.454-4.062,2.454
                                h-1.032l0.724-4.583c0.043-0.277,0.283-0.481,0.563-0.481h0.473c1.235,0,2.4,0,3.002,0.704C47.027,11.668,47.137,12.292,47,13.154z"
                                />
                            <path fill="#253B80" d="M66.654,13.075h-3.275c-0.279,0-0.52,0.204-0.563,0.481l-0.145,0.916l-0.229-0.332
                                c-0.709-1.029-2.29-1.373-3.868-1.373c-3.619,0-6.71,2.741-7.312,6.586c-0.313,1.918,0.132,3.752,1.22,5.031
                                c0.998,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.562,0.66h2.95
                                c0.469,0,0.865-0.34,0.939-0.803l1.77-11.209C67.271,13.388,67.004,13.075,66.654,13.075z M62.089,19.449
                                c-0.316,1.871-1.801,3.127-3.695,3.127c-0.951,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.668-1.391-0.514-2.301
                                c0.295-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C62.034,17.721,62.232,18.543,62.089,19.449z"/>
                            <path fill="#253B80" d="M84.096,13.075h-3.291c-0.314,0-0.609,0.156-0.787,0.417l-4.539,6.686l-1.924-6.425
                                c-0.121-0.402-0.492-0.678-0.912-0.678h-3.234c-0.393,0-0.666,0.384-0.541,0.754l3.625,10.638l-3.408,4.811
                                c-0.268,0.379,0.002,0.9,0.465,0.9h3.287c0.312,0,0.604-0.152,0.781-0.408L84.564,13.97C84.826,13.592,84.557,13.075,84.096,13.075z
                                "/>
                            <path fill="#179BD7" d="M94.992,6.749h-6.84c-0.467,0-0.865,0.34-0.938,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.562,0.658
                                h3.51c0.326,0,0.605-0.238,0.656-0.562l0.785-4.971c0.072-0.463,0.471-0.803,0.938-0.803h2.164c4.506,0,7.105-2.18,7.785-6.5
                                c0.307-1.89,0.012-3.375-0.873-4.415C99.004,7.353,97.281,6.749,94.992,6.749z M95.781,13.154c-0.373,2.454-2.248,2.454-4.062,2.454
                                h-1.031l0.725-4.583c0.043-0.277,0.281-0.481,0.562-0.481h0.473c1.234,0,2.4,0,3.002,0.704
                                C95.809,11.668,95.918,12.292,95.781,13.154z"/>
                            <path fill="#179BD7" d="M115.434,13.075h-3.273c-0.281,0-0.52,0.204-0.562,0.481l-0.145,0.916l-0.23-0.332
                                c-0.709-1.029-2.289-1.373-3.867-1.373c-3.619,0-6.709,2.741-7.311,6.586c-0.312,1.918,0.131,3.752,1.219,5.031
                                c1,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.564,0.66h2.949
                                c0.467,0,0.865-0.34,0.938-0.803l1.771-11.209C116.053,13.388,115.785,13.075,115.434,13.075z M110.869,19.449
                                c-0.314,1.871-1.801,3.127-3.695,3.127c-0.949,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.666-1.391-0.514-2.301
                                c0.297-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C110.816,17.721,111.014,18.543,110.869,19.449z"/>
                            <path fill="#179BD7" d="M119.295,7.23l-2.807,17.858c-0.055,0.346,0.213,0.658,0.562,0.658h2.822c0.469,0,0.867-0.34,0.939-0.803
                                l2.768-17.536c0.055-0.346-0.213-0.659-0.562-0.659h-3.16C119.578,6.749,119.338,6.953,119.295,7.23z"/>
                            <path fill="#253B80" d="M7.266,29.154l0.523-3.322l-1.165-0.027H1.061L4.927,1.292C4.939,1.218,4.978,1.149,5.035,1.1
                                c0.057-0.049,0.13-0.076,0.206-0.076h9.38c3.114,0,5.263,0.648,6.385,1.927c0.526,0.6,0.861,1.227,1.023,1.917
                                c0.17,0.724,0.173,1.589,0.007,2.644l-0.012,0.077v0.676l0.526,0.298c0.443,0.235,0.795,0.504,1.065,0.812
                                c0.45,0.513,0.741,1.165,0.864,1.938c0.127,0.795,0.085,1.741-0.123,2.812c-0.24,1.232-0.628,2.305-1.152,3.183
                                c-0.482,0.809-1.096,1.48-1.825,2c-0.696,0.494-1.523,0.869-2.458,1.109c-0.906,0.236-1.939,0.355-3.072,0.355h-0.73
                                c-0.522,0-1.029,0.188-1.427,0.525c-0.399,0.344-0.663,0.814-0.744,1.328l-0.055,0.299l-0.924,5.855l-0.042,0.215
                                c-0.011,0.068-0.03,0.102-0.058,0.125c-0.025,0.021-0.061,0.035-0.096,0.035H7.266z"/>
                            <path fill="#179BD7" d="M23.048,7.667L23.048,7.667L23.048,7.667c-0.028,0.179-0.06,0.362-0.096,0.55
                                c-1.237,6.351-5.469,8.545-10.874,8.545H9.326c-0.661,0-1.218,0.48-1.321,1.132l0,0l0,0L6.596,26.83l-0.399,2.533
                                c-0.067,0.428,0.263,0.814,0.695,0.814h4.881c0.578,0,1.069-0.42,1.16-0.99l0.048-0.248l0.919-5.832l0.059-0.32
                                c0.09-0.572,0.582-0.992,1.16-0.992h0.73c4.729,0,8.431-1.92,9.513-7.476c0.452-2.321,0.218-4.259-0.978-5.622
                                C24.022,8.286,23.573,7.945,23.048,7.667z"/>
                            <path fill="#222D65" d="M21.754,7.151c-0.189-0.055-0.384-0.105-0.584-0.15c-0.201-0.044-0.407-0.083-0.619-0.117
                                c-0.742-0.12-1.555-0.177-2.426-0.177h-7.352c-0.181,0-0.353,0.041-0.507,0.115C9.927,6.985,9.675,7.306,9.614,7.699L8.05,17.605
                                l-0.045,0.289c0.103-0.652,0.66-1.132,1.321-1.132h2.752c5.405,0,9.637-2.195,10.874-8.545c0.037-0.188,0.068-0.371,0.096-0.55
                                c-0.313-0.166-0.652-0.308-1.017-0.429C21.941,7.208,21.848,7.179,21.754,7.151z"/>
                            <path fill="#253B80" d="M9.614,7.699c0.061-0.393,0.313-0.714,0.652-0.876c0.155-0.074,0.326-0.115,0.507-0.115h7.352
                                c0.871,0,1.684,0.057,2.426,0.177c0.212,0.034,0.418,0.073,0.619,0.117c0.2,0.045,0.395,0.095,0.584,0.15
                                c0.094,0.028,0.187,0.057,0.278,0.086c0.365,0.121,0.704,0.264,1.017,0.429c0.368-2.347-0.003-3.945-1.272-5.392
                                C20.378,0.682,17.853,0,14.622,0h-9.38c-0.66,0-1.223,0.48-1.325,1.133L0.01,25.898c-0.077,0.49,0.301,0.932,0.795,0.932h5.791
                                l1.454-9.225L9.614,7.699z"/>
                        </svg>
                        <span class="card-title">Paypal</span>
                    </label>

                    <label class="card" style="opacity: 0.5;">
                        <input name="payment-method" class="radio" type="radio" id="pay-in-store" value="payinstore" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                        </svg>
                        <span class="card-title">In-store payment</span>
                    </label>

                </div>

                <div class="payCardDiv">
                    <h3 class="mt-5">Enter your credit card information</h3>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="card-number">Card number</label>
                            <input type="text" class="form-control" id="card-number" name="card-number" placeholder="XXXX XXXX XXXX XXXX" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="card-holder">Card holder</label>
                            <input type="text" class="form-control" id="card-holder" name="card-holder" placeholder="John Appleseed" value="<?php if(isset($row["name"])) echo $row["name"] .  ' ' . $row["surname"]; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="card-expire">Expiration date</label>
                            <input type="text" class="form-control" id="card-expire" name="card-expire" placeholder="MM/YY" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="card-cvv">CVV</label>
                            <input type="text" class="form-control" id="card-cvv" name="card-cvv" placeholder="XXX" required>
                        </div>
                    </div>
                    
                    <button type="submit" id="complete-purchase" class="btn btn-primary mt-4">Complete purchase</button>
                        <p class="info-terms">By clicking "Complete purchase", you agree to the payment of € <?php echo getTotal($mysqli); ?> and agree to the terms of use of the site.</p>
                    </div>

                    <div class="payPalDiv hidden">
                        <button type="submit" id="proceed-paypal" class="btn btn-primary mt-4"><span class="iconify" data-icon="il:paypal"></span> Complete purchase with PayPal</button>
                        <p class="info-terms">By clicking "Complete purchase", you agree to the payment of € <?php echo getTotal($mysqli); ?> and agree to the terms of use of the site.</p>
                    </div>

                    <div class="payInStoreDiv hidden">
                        <button type="submit" id="complete-purchase" class="btn btn-primary mt-4"> Complete purchase </button>
                        <p class="info-terms">By clicking "Complete purchase", you agree to the payment of € <?php echo getTotal($mysqli); ?> and agree to the terms of use of the site.</p>
                    </div>

            </form>

        </div>
    </main>

    <?php include 'partials/footer.php';?>

    <script src="js/checkout.js"></script>

    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>