<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a product - IOcommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/addproduct.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
</head>
<body>
    <?php include 'partials/navbar.php';?>
    <?php include 'partials/accessibility.php';?>
    <main>
        <div class="container">
            <h2>Add a product</h2>

            <hr>

            <?php
                if (isset($_GET['upresult'])) {
                    if ($_GET['upresult'] == '1') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            Internal error during the upload of your product. Please try again later.
                        </div>
                        ';
                    } elseif ($_GET['upresult'] == '2') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            The image is too big. Please upload an image equal or less than 8MB.
                        </div>
                        ';
                    } elseif ($_GET['upresult'] == '3') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            Error during the upload of the image. Please try again.
                        </div>
                        ';
                    } elseif ($_GET['upresult'] == '4') {
                        echo '
                        <br>
                        <div class="alert alert-danger" role="alert">
                            The file is not an image. Please upload an image.
                        </div>
                        ';
                    }
                }
            ?>

            <form action="php/addproduct.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-8">
                        <label for="name">Name of the product (maximum of 50 characters)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name of the product">
                    </div>
                    <div class="form-group col-4">
                        <label for="image">Image of the product</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description of the product (maximum of 300 characters)</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description of the product"></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="category">Category of the product</label>
                        <select class="form-control" id="category" name="category">
                            <option value="fruit">Fruit</option>
                            <option value="vegetable">Vegetable</option>
                            <option value="meat">Meat</option>
                            <option value="dairy">Dairy</option>
                            <option value="bakery">Bakery</option>
                            <option value="drink">Drink</option>
                            <option value="other" selected>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="unitmeasure">Unit of measure for which the product is sold</label>
                        <select class="form-control" id="unitmeasure" name="unitmeasure">
                            <option value="Kg">Kg</option>
                            <option value="g">g</option>
                            <option value="L">L</option>
                            <option value="mL">mL</option>
                            <option value="unit">unit</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mt-4">Add product</button>
                <p class="info-add">Note that once you added this product to your profile, it will not be available yet on our catalog. You'll need to change its visibility by adding other informations.</p>
            </form>
        </div>
    </main>

    <?php include 'partials/footer.php';?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>