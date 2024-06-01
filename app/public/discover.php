<?php

// Variabedl i PHP, inleds alltid med dollartecken och
// avslutas med ett semikolon.
$greetings = "Athens Food Guide";
$greetings2 = "DISCOVER A FAVORITE";
$get_started = "Type something in the searchbar to get started.";
$favorite = "Find your favorite today!";
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

        <h1><?= $greetings2 ?></h1>
        <h2><?= $get_started ?></h2> <br>
        <h2><?= $favorite ?></h2>




        <div class="search">

            <form action="discover.php" method="post">
                <input id="search" type="search" name="search" >

                <button type="submit">SHOW ME THE GOOD STUFF!</button>

            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = trim($_POST['search']);

                include "_includes/database_connection.php";

                try {
                    $sql = "SELECT `name`, `address` FROM `business` WHERE `name` LIKE :name";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':name' => '%' . $name . '%']);
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($rows) {
                        echo "<div id='results'>";
                        foreach ($rows as $row) {
                            echo "<div class='result'>";
                            echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                            echo "<p>" . htmlspecialchars($row['address']) . "</p>";

                            echo "</div>";
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No results found for '" . htmlspecialchars($name) . "'</p>";
                    }
                } catch (PDOException $e) {
                    echo "Database connection exception: $e";
                }
            }
            ?>
        </div>


        <div class="exampels">
            <h2>Don't know what to serach for? <br>
                Here are some exampels!</h2> <br>

            <h2>"Breakfast" "Sushi" "Italian" "Downtown" "Fish"</h2>


        </div>

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