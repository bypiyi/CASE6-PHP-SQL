<?php

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

    <link rel="stylesheet" href="styles/discover.css">

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




    <div class="container-content">

        <p id="greetings2">
            DISCOVER A FAVORITE
        </p>

        <p id="get_started">
            Type something in the searchbar to get started. <br><br>
            Find your favorite today!
        </p>



        <div class="search">

            <form action="discover.php" method="post">
                <input id="search" type="search" name="search">

                <button type="submit">SHOW ME THE GOOD STUFF!</button>

            </form>

        </div>


        <div class="exampels">
            <p id="greetings2">
                Don't know what to serch for?<br>
                Here are some <br> exampels!
            </p> <br>

            <p id="get_started">
                "Breakfast" "Sushi"<br> "Italian" "Downtown" "Fish"
            </p>
        </div>

    </div>

    <div class="result_discover">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $searchTerm = trim($_POST['search']);

            include "_includes/database_connection.php";

            try {
                $sql = "SELECT `name`, `address`, `description` FROM `business` WHERE `name` LIKE :searchTerm OR `description` LIKE :searchTerm";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':searchTerm' => '%' . $searchTerm . '%']);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($rows) {
                    echo "<div id='results'>";
                    foreach ($rows as $row) {
                        echo "<div class='result'>";
                        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                        echo "<p>" . htmlspecialchars($row['address']) . "</p>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>No results found for '" . htmlspecialchars($searchTerm) . "'</p>";
                }
            } catch (PDOException $e) {
                echo "Database connection exception: $e";
            }
        }
        ?>
    </div>


    <div class="box_image">
        <img src="styles/images/slogan.png" class="slogan" alt="">
    </div>



    <div class="box_image">
        <img src="styles/images/restaurant5.jpg" alt="" style="width: 100%; height: auto; padding-top: 30px;">

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