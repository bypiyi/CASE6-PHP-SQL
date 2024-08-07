<?php

declare(strict_types=1);
session_start();

include "_includes/database_connection.php";


$sql = "SELECT business.*, users.username FROM business JOIN users ON business.user_id = users.id";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$rows = $stmt->fetchAll();



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

    <link rel="stylesheet" href="styles/share.css">

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


    <main>


        <div class="account">
            <p class="account_text">
                Welcome to your account. <br>
                Here you'll see your added
                restaurants
            </p>
        </div>

        <!-- Results -->
        <div class="results">
            <ul id="result">
                <?php
                $sql = "SELECT * FROM business";
                $stmt = $pdo->query($sql);
                $rows = $stmt->fetchAll();

                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        echo "<li>";
                        echo "<span class=\"name\">" . htmlspecialchars($row['name']) . "</span>";
                        echo "<span class=\"address\">" . htmlspecialchars($row['address']) . "</span>";
                        echo "<span class=\"description\">" . htmlspecialchars($row['description']) . "</span>";
                        if (!empty($row['image_url'])) {
                            echo "<img src=\"uploads/" . htmlspecialchars($row['image_url']) . "\" alt=\"" . htmlspecialchars($row['name']) . "\" style=\"max-width:100px;\">";
                        }
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $row['user_id']) {
                            echo "<a href='account_edit.php?id=" . $row['id'] . "'>EDIT</a>";
                        }
                        // Försök till hjärta, funkar inte?
                        echo "<i class='fa fa-heart' onclick='toggleFavorite(this)'></i>"; // Hjärtikonen
                        echo "</li>";
                    }
                } else {
                    echo "<li>No restaurants found.</li>";
                }
                ?>
            </ul>
        </div>



        <div class="box_image">
            <img src="styles/images/restaurant5.jpg" alt="" style="width: 100%; height: auto; padding-top: 30px;">

        </div>
    </main>

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