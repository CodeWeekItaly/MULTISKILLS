<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/register-reset.css">
</head>
<body>

    <nav>
        <a href="/">
            <img id="top-page-logo" src="img/logo/black_logo.png" alt="IOcommerce">
        </a>
    </nav>

    <main>
        <div id="rlr-panel">
            <h2 id="register-heading">Welcome!</h2>
            <p>All fields are mandatory.</p>

            <?php 
                if(isset($_GET['registerSuccessful']) && $_GET['registerSuccessful'] == 'false') {
                    if ($_GET['reason'] == 'email') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            This email is already registered.<br>
                            If you don\'t remember your password, please reset it.
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
            ?>

            <form action="php/createuser.php" method="POST">
                <div class="row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Your password" required>
                    </div>
                    <div class="form-group col-6">
                        <label class="repeat-p-label"for="rpassword">Repeat password</label>
                        <input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Repeat password" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Your name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="surname">Your surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Your surname" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="company">Company name</label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="Company name (leave blank if none)">
                    </div>
                </div>

                <div class="form-group mt-2">
                    <input class="form-check-input" type="checkbox" id="isSeller" name="isSeller">
                    <label class="form-check-label" for="isSeller"> Are you a merchant?</label>
                </div>

                <div class="form-group hidden" id="companylocationdiv">
                    <label for="companylocation">City of your company</label>
                    <input type="text" class="form-control" id="companylocation" name="companylocation" placeholder="Company location">
                </div>

                <div class="form-group">
                    <button type="submit" id="register-btn" class="btn btn-primary mt-2">Register</button>
                </div>

            </form>

            <div id="login-redirect"><a href="/login">Already have an account?</a></div>

        </div>
    </main>

    <script src="js/register.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>