<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to IOcommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/landing.css">
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
</head>
<body>
    <nav class="fixed-top navbar-light navbar">
        <a class="navbar-brand" href="#">
            <img src="img/logo/black_logo.png" class="mx-5" width="215" alt="IOcommerce">
        </a>

        <div class="mx-5" id="access-section-navbar">
            <a class="btn" id="login-btn" href="/login">Log in</a>
            <a class="btn" id="register-btn" href="/register">Register</a>
        </div>
    </nav>

    <main>
        <section class="hero-section">
            <div id="home" class="top"></div>
            <img src="img/logo/black_logo.png" alt="IOcommerce">
            <h2 class="slogan">Buy from home, by the local</h2>

            <div class="access-section">
                <a class="btn" id="login-btn" href="/login" role="button">Log in</a>
                <a class="btn" id="register-btn" href="/register" role="button">Register</a>
            </div>

            <a id="arrow-down" href="#features">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="64"
                    fill="currentColor"
                    class="bi bi-arrow-down-short"
                    viewBox="0 0 16 16"
                >
                    <path
                    fill-rule="evenodd"
                    d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"
                    />
                </svg>
                <br>Scroll down for more info.
            </a>
            
            <a id="arrow-up" href="#home" class="fixed-bottom">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="64"
                    fill="currentColor"
                    class="bi bi-arrow-down-short"
                    viewBox="0 0 16 16"
                >
                    <path
                    fill-rule="evenodd"
                    d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"
                    />
                </svg>
            </a>

        </section>
        <div class="shape-divider">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="rgb(255, 255, 255)" fill-opacity="1" d="M0,224L80,192C160,160,320,96,480,96C640,96,800,160,960,186.7C1120,213,1280,203,1360,197.3L1440,192L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
            </svg>
        </div> 

        <div id="features"></div>

        <section class="other-section">
            <h2>&#128722; By using IOcommerce, you can...</h2>
            <div class="feature-highlight">
                <div class="image-sect img-on-left">
                    <img src="img/landing/iocommerce-cart-forest.jpg" alt="IOcommerce cart">
                </div>
                <div class="text-sect text-on-right">
                    <h3>
                        Help small and<br> medium-sized activities.
                    </h3>
                    <p>
                        Shop at affordable prices in your area by helping small
                        and medium-sized businesses local businesses, through IOcommerce.
                    </p>
                </div>
            </div>
            <div class="below-feature-highlight">
                <div class="text-sect text-on-left">
                    <h3>
                        Order at home,<br> or pick up in store.
                    </h3>
                    <p>
                        You can choose to pay on the site or as soon as you go to the store<strong>*</strong>.
                        If you order from home, a rider / deliveryman will bring your order straight to your home.
                    </p>
                    <p class="smaller-text"><strong>*</strong>option available for in-store pickup only</p>
                </div>
                <div class="image-sect img-on-right">
                    <img src="img/landing/iocommerce-rider.jpg" alt="IOcommerce rider">
                </div>
            </div>
        </section>
    </main>

    <div id="author">
        Made with &#10084; by <strong>Multiskills</strong><br>Hackathon Italy 2021 Team
    </div>

    <script src="js/landing.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>