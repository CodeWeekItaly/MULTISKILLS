<?php
    require 'php/db.php';

    if (!isset($_GET['idOrder']) || !isset($_GET['idProduct'])) {
        exit(header("Location: /"));
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send invoice - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sendinvoice.css">
</head>
<body>
    
    <?php include 'partials/navbar.php';?>

    <main>
        <div class="container">
            <h2>Before you check this order as completed...</h2>
            <p>...you need to send to the buyer the invoice of this purchase, and eventually also the shipping tracking code/URL and a message</p>


            <form action="php/completeorder.php" method="POST">
                <input type="hidden" name="idOrder" value="<?php echo $_GET["idOrder"]; ?>">
                <input type="hidden" name="idProduct" value="<?php echo $_GET["idProduct"]; ?>">
                <div class="form-group">
                    <label for="invoice">Invoice</label>
                    <input type="file" class="form-control" id="invoice" name="invoice" required>
                </div>
                <div class="form-group">
                    <label for="tracking">Tracking Code/URL</label>
                    <input type="text" class="form-control" id="tracking" name="tracking">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Check order as completed</button>
                <p class="info-terms">Remember that IOcommerce will receive the 2% of this transaction, as estabilished from the site's terms and policies.</p>
            </form>

        </div>
    </main>

    <?php include 'partials/footer.php';?>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>