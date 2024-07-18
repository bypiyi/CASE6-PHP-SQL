<?php declare(strict_types=1);
session_start();

include "_includes/database_connection.php";


// förvalda värden för variabler
$name = "";
$id = 0;
$address = "";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $user_id = $_SESSION['user_id'];


    // om posten ska raderas
    if (isset($_POST['delete'])) {

        $sql = "DELETE FROM `business` WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        $result = $stmt->execute();

        header("Location: sample.php");
    }



    if (strlen($name) > 0 && strlen($name) <= 50) {

        $sql = "UPDATE `business` SET `name` = :name, `address` = :address, `user_id` = :user_id  WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue('name', $name, PDO::PARAM_STR);
        $stmt->bindValue('address', $address, PDO::PARAM_STR);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->bindValue('user_id', $user_id, PDO::PARAM_INT);

        $result = $stmt->execute();

        header("Location: account.php");

    }
}


if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $sql = "SELECT * FROM `business` WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch();

    if ($row) {
        $name = $row['name'];
        $address = $row['address'];
        $description = $row['description'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="styles/login.css">

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

    <main>

        <form action="account_edit.php" method="post">


            <label for="name">business name</label>
            <input type="text" name="name" id="name" value="<?= $name ?>">


            <label for="address">address</label>
            <input type="text" name="address" id="address" value="<?= $address ?>">

            <label for="description">description</label>
            <input type="description" name="description" id="description" value="<?= $description ?>">

            <input type="submit" value="SAVE" name="save" id="edits">
            <input type="submit" value="REMOVE" name="delete" id="edits">



            <input type="hidden" name="id" value="<?= $id ?>">
        </form>
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