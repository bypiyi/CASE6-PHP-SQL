<?php
declare(strict_types=1);
session_start();

include "_includes/functions.php";

// Variabedl i PHP, inleds alltid med dollartecken och
// avslutas med ett semikolon.
$greetings = "Athens Food Guide";
$information = "Your ultimate guide to discovering the best restaurants in Athens.
Here, you can find recommendations, share your own tips, and get advice from fellow food enthusiasts";
$information_extra = "Create an account to share your experiences and join our community of food lovers.";
$title = "Athens Food Guide";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="styles/index.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

</head>

<body>

    <header>
        <div>
            <img src="styles/images/logo.png" class="header-logo" alt="">
        </div>
    </header>


    <!-- inkludera nav -->
    <?php include "_includes/nav.php"; ?>


    <div class="box_image">
        <img src="styles/images/slogan.png" class="slogan" alt="">
    </div>

    <div class="container-content">

        <h1><?= $greetings ?></h1>
        <h2><?= $information ?></h2> <br>
        <h2><?= $information_extra ?></h2>

    </div>

    <div class="button-container">
        <a href="register.php" class="btn register-btn">Register</a>
        <a href="login.php" class="btn login-btn">Login</a>
    </div>

    <div class="box_image">
        <img src="styles/images/restaurant1.jpg" alt="" style="width: 100%; height: auto; padding-top: 10px;">

    </div>


    <!-- Footer -->
    <footer class="footer">

        <h1><?= $greetings ?></h1>
        <p>&copy; Alicia Piyi Tsirigotis <br>
            Glimåkra Folkhögskola <br>
            PHP & SQL</p>

        <div>
            <img src="styles/images/logo.png" class="header-logo" alt="">
        </div>

    </footer>


</body>

</html>