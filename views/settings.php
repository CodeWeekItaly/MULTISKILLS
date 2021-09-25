<?php 
    require 'php/db.php';

    // Retrieving user information
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
    <title>Settings - IOcommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
</head>
<body>
    <div id="email-change" class="hidden">
        <div class="panel">
            <h3>Change your e-mail</h3>
            <form action="php/changeemail.php" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="ec-password">Actual password</label>
                    <input type="password" class="form-control" id="ec-password" name="password" placeholder="Actual password" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="ec-email" name="email" placeholder="New e-mail address" required>
                </div>
                <div class="change-submit form-group mt-4">
                    <input type="submit" class="btn btn-primary" value="Submit change">
                    <a class="btn btn-outline-danger cancel-btn" id="cancel-email-btn"> Cancel </a>
                </div>
            </form>
        </div>
    </div>

    <div id="password-change" class="hidden">
        <div class="panel">
            <h3>Change your password</h3>
            <form action="php/changepassword.php" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="pc-password">Actual password</label>
                    <input type="password" class="form-control" id="pc-password" name="password" placeholder="Actual password" required>
                </div>
                <div class="form-group">
                    <label for="npassword">New password</label>
                    <input type="password" class="form-control" id="pc-npassword" name="npassword" placeholder="New password" required>
                </div>
                <div class="change-submit form-group mt-4">
                    <input type="submit" class="btn btn-primary" value="Submit change">
                    <a class="btn btn-outline-danger cancel-btn" id="cancel-password-btn"> Cancel </a>
                </div>
            </form>
        </div>
    </div>

    <div id="profilepic-change" class="hidden">
        <div class="panel">
            <h3>Change your profile picture</h3>
            <form action="php/changeprofilepic.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pic-file">New profile picture</label>
                    <input class="form-group file-upload" type="file" name="picfile" id="pic-file" required>
                </div>
                <div class="change-submit form-group mt-4">
                    <input type="submit" class="btn btn-primary" value="Submit change">
                    <a class="btn btn-outline-danger cancel-btn" id="cancel-profilepic-btn"> Cancel </a>
                </div>
            </form>
        </div>
    </div>

    <?php include 'partials/navbar.php'; ?>
    <?php include 'partials/accessibility.php';?>

    <main>
        <div class="container">

            <h2>Settings</h2>

            <hr>

            <h3>Your information</h3>
            <div class="user-info">
                <?php
                    if (isset($_GET['pcresult'])) {
                        if ($_GET['pcresult'] == '0') {
                            echo '
                            <br>
                            <div class="alert alert-success" role="alert">
                                Profile picture updated successfully!
                            </div>
                            ';
                        } elseif ($_GET['pcresult'] == '1') {
                            echo '
                            <br>
                            <div class="alert alert-danger" role="alert">
                                The picture you uploaded is too big! Please upload a picture equal or less than 8MB.
                            </div>
                            ';
                        } elseif ($_GET['pcresult'] == '2') {
                            echo '
                            <br>
                            <div class="alert alert-danger" role="alert">
                                Error during the upload! Please try again.
                            </div>
                            ';
                        } elseif ($_GET['pcresult'] == '3') {
                            echo '
                            <br>
                            <div class="alert alert-danger" role="alert">
                                The picture you uploaded is not an image! Please upload a picture.
                            </div>
                            ';
                        } elseif ($_GET['pcresult'] == '4') {
                            echo '
                            <br>
                            <div class="alert alert-danger" role="alert">
                                No file was uploaded! Please upload a picture.
                            </div>
                            ';
                        }
                    }

                    if (isset($_GET['uresult'])) {
                        if ($_GET['uresult'] == '0') {
                            echo '
                            <br>
                            <div class="alert alert-success" role="alert">
                                User information updated successfully!
                            </div>
                            ';
                        } elseif ($_GET['uresult'] == '1') {
                            echo '
                            <br>
                            <div class="alert alert-danger" role="alert">
                                There has been an error during the update! Please try again later.
                            </div>
                            ';
                        }
                    }
                ?>            
                <div id="user-description">
                    <div id="user-image">
                        <?php
                            if (isset($row["profilePicture"])) {
                                echo '<img src="img/profileimgs/' . $row["profilePicture"] . '" alt="Profile image">';
                            } else {
                                echo '<img src="img/profileimgs/defaultUser-placeholder.png" alt="Profile image">';
                            }
                        ?>
                        <a id="change-photo-btn" class="btn btn-primary">Change your picture</a>
                        <a href="php/removeprofilepic.php" class="btn btn-outline-danger">Remove your picture</a>
                    </div>
                    <div id="user-info">
                        <form action="php/updateuserinfo.php" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row["name"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $row["surname"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Company</label>
                                <input type="text" class="form-control" id="company" name="company" value="<?php echo $row["company"]; ?>">
                            </div>
                            <?php
                                if ($row["seller"] == 1) {
                                    echo '
                                        <div class="form-group">
                                        <label for="text">Company location</label>
                                        <input type="text" class="form-control" id="companylocation" name="companylocation" value="' . $row["companylocation"] . '">
                                    </div>
                                    ';
                                }
                            ?>
                            <div class="form-group">
                                <label for="tel">Telephone number</label>
                                <input type="tel" class="form-control" id="tel" name="tel" maxlength="15" value="<?php echo $row["telephone"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="4" name="description"><?php echo $row["description"]; ?></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary mt-2" value="Submit changes">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <hr>

            <h3>Your credentials</h3>
            <div id="user-credentials">
                <?php 
                    if (isset($_GET['result'])) {
                        if ($_GET['result'] == '0') {
                            echo '
                            <br>
                            <div class="alert alert-success" role="alert">
                                Account credentials updated successfully!
                            </div>
                            ';
                        } elseif ($_GET['result'] == '1') {
                            echo '
                            <br>
                            <div class="alert alert-danger" role="alert">
                                Error updating account credentials! Please try again later.
                            </div>
                            ';
                        } elseif ($_GET['result'] == '2') {
                            echo '
                            <br>
                            <div class="alert alert-danger" role="alert">
                                Invalid password! Please try again.
                            </div>
                            ';
                        }
                    }
                ?>
                <div>
                    <a id="change-email-btn" class="btn btn-primary">Change your e-mail</a>
                    <a id="change-password-btn" class="btn btn-primary">Change your password</a>
                </div>
            </div>

            <hr>

            <h3>Your shipping address</h3>
            <div id="user-shipping-addr">
                <?php 
                    if (isset($_GET['sresult'])) {
                        if ($_GET['sresult'] == '0') {
                            echo '
                            <br>
                            <div class="alert alert-success" role="alert">
                                Shipping address updated successfully!
                            </div>
                            ';
                        } elseif ($_GET['sresult'] == '1') {
                            echo '
                            <br>
                            <div class="alert alert-danger" role="alert">
                                Error updating shipping address! Please try again later.
                            </div>
                            ';
                        }
                    }
                ?>
                <form action="/php/updateshipping.php" method="POST">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php if(isset($row["city"])) echo $row["city"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" value="<?php if(isset($row["state"])) echo $row["state"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Zip code</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php if(isset($row["zipcode"])) echo $row["zipcode"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php if(isset($row["address"])) echo $row["address"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary mt-2" value="Submit changes">
                    </div>
                </form>
            </div>

        </div>
    </main>

    <?php include 'partials/footer.php';?>

    <script src="js/settings.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>