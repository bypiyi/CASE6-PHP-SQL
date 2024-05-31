<?php
// Greetings m.m
$greetings = "Athens Food Guide";
$welcome_message = "Welcome to our community of food enthusiasts! Start exploring and discovering the best restaurants in Athens. 
Share your experiences, add new restaurants, and connect with fellow food lovers.";
$instruction = "Ready to get started? Use the navigation menu to add a restaurant or discover new places. Have fun exploring!";
$title = "Athens Food Guide";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="styles/home.css">

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
    <?php include "_includes/menu_active.php"; ?>


    
    <div class="box_image">
        <img src="styles/images/slogan.png" class="slogan" alt="">
    </div>




    <div class="container-content">

        <h1><?= $greetings ?></h1>
        <h2><?= $welcome_message ?></h2> <br>
        <h2><?= $instruction ?></h2>

    </div>

    <div class="box_image">
        <img src="styles/images/picture.jpg" alt="" style="width: 100%; height: auto; padding-top: 10px;">

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
    <script src="script.js"></script>
</body>

</html>