<?php
declare(strict_types=1);
session_start();

include "_includes/functions.php";

// Variabedl i PHP, inleds alltid med dollartecken och
// avslutas med ett semikolon.
$greetings = "The ultimate guide to Athens restaurants";
$information = "Find your favorites today!";
$title = "Athens Food Guide";


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

    <header>
        <div>
        <img src="styles/images/logo.png" class="header-logo" alt="">
        </div>
    </header>


    <!-- inkludera nav -->
    <?php include "_includes/nav.php"; ?>


    <h1><?= $greetings ?></h1>
    <h2><?= $information ?></h2>


</body>

</html>