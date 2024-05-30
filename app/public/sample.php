<?php
declare(strict_types=1);
session_start();

include "_includes/functions.php";
include "_includes/database_connection.php";
include_once "_classes/Database.php";
include_once "_classes/Sample.php";


// använd klassen Sample (vårtecken)
$sample = new Sample();

// kontrollera om det finns en POST request
// se vad som är användbart i den globala arrayen $_SERVER
// print_r2($_SERVER);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // print_r2($_POST);

    $description = $_POST['description'];
    $date = $_POST['date'];
    $user_id = $_SESSION['user_id'];

    // validera
    if (strlen($description) > 0 && strlen($description) <= 50) {

        // exempel på att använda namngiven platshållare för variabler
        $sql = "INSERT INTO `spring_sign` (`description`, `date`, `user_id`) VALUES (:description, :date, :user_id)";
        $stmt = $pdo->prepare($sql);

        // variabel med ersatt platshållare - bindParam bindValue
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':date', $date, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $result = $stmt->execute();
        // print_r2($result);

    } else {
        echo "Det var inget giltigt vårtecken - du har angett " . strlen($description) . " tecken...";
    }
}


// $sql = "SELECT spring_sign.*, users.username FROM spring_sign JOIN users ON spring_sign.user_id = users.id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute();

// $rows = $stmt->fetchAll();

$rows = $sample->get_all();

// print_r2($rows);


$title = "Sample";

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
    <?php include "_includes/header.php"; ?>

    <!-- inkludera nav -->
    <?php include "_includes/nav.php"; ?>

    <h1><?= $title ?></h1>

    <!-- formulär för autentiserade användare -->
    <?php if (isset($_SESSION['username'])) { ?>

        <form action="sample.php" method="post">

            <p>
                <label for="description">Ett vårtecken!</label>
                <input type="text" name="description" id="description">
            </p>
            <p>
                <label for="date">Datum:</label>
                <input type="date" name="date" id="date" value="<?= date("Y-m-d") ?>">
            </p>
            <p>
                <input type="submit" value="Spara">
            </p>

        </form>

    <?php } ?>

    <hr>

    <h3>Vårtecken</h3>

    <ul id="result">
        <?php

        // skapa en iteration av $rows - ex en foreach loop
        // skapa li element med innehåll från tabellen

        foreach ($rows as $row) {

            $li = "<li>";

            $li .= "<span class=\"description\">";
            $li .= $row['description'];
            $li .= "</span>";

            $li .= "<span class=\"date\">";
            $li .= $row['date'];
            $li .= "</span>";

            $li .= "<span class=\"username\">";
            $li .= $row['username'];
            $li .= "</span>";

            // knappen redigera visas för autentisera användare
            // se om ni kan fixa så att endast den som skrivit ett vårtecken kan redigera/uppdatera sitt eget...!
            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $row['user_id']) {
                

                // olika sätt att hantera citationstecken...
                // $li .= "<a href=sample_edit.php?id=". $row['id'] .">";
                $li .= "<a href='sample_edit.php?id=" . $row['id'] . "'>";
                $li .= "redigera";
                $li .= "</a>";
            } else {
                $li .= "<span></span>";
            }

            $li .= "</li>";
            echo $li;
        }
        ?>
    </ul>


    <!-- inkludera sidfot -->
    <?php include "_includes/footer.php"; ?>

</body>

</html>