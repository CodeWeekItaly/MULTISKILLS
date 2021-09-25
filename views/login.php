<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login-reset.css">
</head>
<body>

    <nav>
        <a href="/">
            <img id="top-page-logo" src="img/logo/black_logo.png" alt="IOcommerce">
        </a>
    </nav>

    <main>
        <div id="rlr-panel">
            <h2>Welcome back!</h2>

            <?php 
                if (isset($_GET['loginFailed']) && $_GET['loginFailed'] == 'true') {
                    if ($_GET['reason'] == 'email') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            This email isn\'t registered.
                        </div>
                        ';
                    } elseif ($_GET['reason'] == 'password') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            Wrong password. Please try again.
                        </div>
                        ';
                    } elseif ($_GET['reason'] == 'internal') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            Please try again later.<br>
                            We\'re having some problems with our server.
                        </div>
                        ';
                    }
                }

                if (isset($_GET['registerSuccessful']) && $_GET['registerSuccessful'] == 'true') {
                    echo '
                    <br>
                    <div class="alert alert-success" role="alert">
                        You are now registered to IOcommerce!<br>
                        Please now log in with your credentials.
                    </div>
                    ';
                }
            ?>

            <form action="php/authenticateuser.php" method="POST">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Your password" required>
                </div>

                <div id="forgot-password">
                    <a href="/passwordreset">Forgot password?</a>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-2">Log in</button>
                </div>

            </form>

            <div id="register-redirect"><a href="/register">You don’t have an account?</a></div>

        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>