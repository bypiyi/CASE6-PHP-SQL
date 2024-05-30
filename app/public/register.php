<?php
declare(strict_types=1);
session_start();

include_once "_includes/functions.php";


// Kontrollera om det finns flash meddelande
// Om det finns, skriv det till sidan
display_flash_message();

// Hantera formulär request för att registera ny användare
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Hämta data från formuläret
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    // steg: kontrollera att fälten inte är tomma
    if (empty($username) || empty($password) || empty($password2)) {
        set_flash_message_and_redirect_to("Alla fält måste vara ifyllda", "register.php");
    }

    // steg: kontrollera att lösenorden matchar varandra
    if ($password !== $password2) {
        set_flash_message_and_redirect_to("Lösenorden matchar inte", "register.php");
    }

    // steg: kontrollera att användarnamnet inte redan finns i databasen
    include "_includes/database_connection.php";

    try {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username
        ]);

        // Hämta användaren från databasen
        $user = $stmt->fetch();

        if ($user) {
            set_flash_message_and_redirect_to("Användarnamnet är upptaget", "register.php");
        }

        // steg: kryptera lösenord
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // steg: registera ny användare i databasen
        // TODO: skapa en funktion för detta i functions.php
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $password_hashed
        ]);

        // skicka användaren till login.php
        set_flash_message_and_redirect_to("Lyckad skapelse av användare. Var god att logga in", "login.php");
    } catch (PDOException $e) {
        echo "Database connection exception $e";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <!-- inkludera sidhuvud -->
    <?php  include "_includes/header.php"; ?>

    <!-- inkludera nav -->
    <?php  include "_includes/nav.php"; ?>


    <!-- Ett Formulär för att registera sig -->
    <h1>Registera ny användare</h1>
    <form action="register.php" method="post">
        <label for="username">Användarnamn</label>
        <input type="text" name="username" id="username">

        <label for="password">Lösenord</label>
        <input type="password" name="password" id="password">

        <label for="password2">Bekräfta Lösenord</label>
        <input type="password" name="password2" id="password2">

        <button type="submit">Registrera</button>
    </form>

    <!-- inkludera nav -->
    <?php  include "_includes/footer.php"; ?>

</body>

</html>