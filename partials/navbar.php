<?php
    echo '
    <nav id="pcNavbar">
        <div class="navbar-logo">
            <a href="/"><img src="img/logo/black_logo.png" alt="IOcommerce logo"></a>
        </div>
        <div>
            <form action="/search" method="GET">
                <div class="row">
                    <div class="col">
                        <input type="text" name="q" class="navbar-searchbox form-control" autocomplete="off" placeholder="Search something here...">
                    </div>
                    <div class="col">
                        <button type="submit" class="navbar-searchbox-submit "><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                      </svg></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="navbar-links">
            <a href="/cart">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                </svg>
            </a>
            <div class="dropdown">
                <a class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/my-profile">Your profile</a>
                <a class="dropdown-item" href="/settings">Account settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item logout-navbar" href="php/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <nav id="phoneNavbar">
        <div class="navbar-logo">
            <a href="/"><img src="img/logo/black_logo.png" alt="IOcommerce logo"></a>
        </div>

        <div class="nav-menu" id="nav-menu-drop-btn">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>

    <nav id="dropdown-phone-menu">
        <form action="/search" method="GET">
            <div class="nav-searchbox">
                <input type="text" name="q" class="navbar-searchbox form-control" autocomplete="off" placeholder="Search something here...">

                <button type="submit" class="navbar-searchbox-submit "><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                </button>

            </div>
        </form>
        <a class="my-profile-drop-btn" href="/my-profile">Your profile</a>
        <a class="settings-drop-btn" href="/settings">Account settings</a>
        <a class="logout-navbar logout-drop-btn" href="php/logout.php">Logout</a>
    </nav>

    <script src="js/navbar.js"></script>
    ';
?>