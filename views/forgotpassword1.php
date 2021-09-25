<?php
    if(isset($_SESSION['id'])){
        exit(header("Location: /"));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password reset - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login-register-reset.css">
</head>
<body>
    <nav>
        <a href="/">
            <img id="top-page-logo" src="img/logo/black_logo.png" alt="IOcommerce">
        </a>
    </nav>

    <main>
        <div id="rlr-panel">

            <h2>Reset your password.</h2>

            <form action="php/passwordreset1.php" method="POST">
                <p>Enter your email, so we can verify your identity through an OTP code.</p>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your email" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-2">Send OTP</button>
                </div>
            </form>

        </div>
    </main>

</body>
</html>