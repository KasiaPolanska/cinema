<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BereKatarzynaMovies </title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- OWL CAROUSEL -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <!-- BOX ICONS -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- APP CSS -->
    <link rel="stylesheet" href="style/grid.css">
    <link rel="stylesheet" href="style/app.css">
    <link rel="stylesheet" href="../style/grid.css">
    <link rel="stylesheet" href="../style/app.css">
    <style>
        input[type=submit]{
            background: none;
            border: none;
            text-transform: uppercase;
            font-weight: 700;
            color: white;
            font-size: 17px;
        }

    </style>

</head>
<body>
    <!-- NAV -->
    <div class="nav-wrapper">
        <div class="container">
            <div class="nav">
                <a class="logo" onclick='nav_home();'>

                    BereKatarzynaMovies
                </a>
                <ul class="nav-menu" id="nav-menu">
                    <?php
                    $cart_count = 0;
                    if(!empty($_SESSION['shopping_cart']))
                    {
                        foreach($_SESSION["shopping_cart"] as $i)
                        {
                            $cart_count = $cart_count + $i['quantity'];
                        }
                        ?>
                        <li> 
                            <a onclick="nav_order();">
                            <i class='bx bx-cart'></i>
                                <span>
                                    <?php echo $cart_count;?>
                                </span>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <li><a onclick='nav_home()'>Home</a></li>
                    <li><a onclick='nav_genre()'>Genre</a></li>
                    <li><a href="#">Movies</a></li>
                    <li><a href="#">About</a></li>
                    <li>
                        <div class="search-container">
                            <form action="frontend/details.php">
                              <a ><input type="text" placeholder="Search.." name="search"></a>
                              <button type="submit"<i class="material-icons">search</button>
                            </form>
                        </div>
                        <?php
                        if(isset($_GET['action'])){
                            if($_GET['action'] == "frontend/details.php"){
                                $contr->find_film();
                            }
                        }
                        ?>
                    </li>
                    <?php
                   
                   
                    if(isset($_SESSION['logged_in']))
                    {
                        
                            ?>
                        <li id='signIn_li'>
                        <a onclick="nav_user()" class='btn btn-hover'>
                            <span id="Loguit">Board</span>
                        </a>
                        </li>
                        <?php
                    }
                    else {
                        ?><li id='signIn_li'>
                        <a onclick="nav_login()" class='btn btn-hover'>
                            <span id="signIn">Sign in</span>
                        </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <!-- Mobiel Menu -->
                <div class="hamburger-menu" id="hamburger-menu">
                    <div class="hamburger"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- EINDE NAV -->
