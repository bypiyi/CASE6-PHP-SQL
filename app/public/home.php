<?php
declare(strict_types=1);
session_start();

include "_includes/functions.php";

display_flash_message();

// TODO: skapa en funktion för att kontrollera om användaren är authenticated
// OM inte, skicka användaren till login.php
// tips: 
//$is_auth = isset($_SESSION['user_id']);
//if (!$is_auth) {...



$title = "Home";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="styles/style.css">
    
</head>

<body>

    <!-- inkludera sidhuvud -->
    <?php  include "_includes/header.php"; ?>

    <!-- inkludera nav -->
    <?php  include "_includes/nav.php"; ?>

    <h1><?= $title ?></h1>

    <!-- inkludera sidfot -->
    <?php  include "_includes/footer.php"; ?>

</body>

</html>