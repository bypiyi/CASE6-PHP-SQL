<!-- För att logga in  -->

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

    // steg: kontrollera att fälten inte är tomma
    if (empty($username) || empty($password)) {
        set_flash_message_and_redirect_to("Alla fält måste vara ifyllda", "login.php");
    }

    // steg: kontrollera att användarnamnet finns i databasen
    include "_includes/database_connection.php";

    try {
        // TODO NR 1 create helper function for this. T.ex 
        // get_user_by_username($username)
        // Se functions.php
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username
        ]);

        // Hämta användaren från databasen
        $user = $stmt->fetch();

        // Kontrollera att användaren finns i databasen 
        // (OM inte finns skicka användaren till register.php)
        if (!$user) {
            set_flash_message_and_redirect_to("Användarnamnet finns inte, registrera dig", "register.php");
        }

        // steg: kontrollera att lösenorden matchar varandra
        $is_matching_password = password_verify($password, $user['password']);
        if (!$is_matching_password) {
            set_flash_message_and_redirect_to("Fel lösenord", "login.php");
        }

        // steg: skapa en session för inloggad användare
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // skicka användaren till home.php
        set_flash_message_and_redirect_to("Lyckad inloggning", "home.php");
    } catch (PDOException $e) {
        echo "Database connection exception $e";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <!-- inkludera sidhuvud -->
    <?php  include "_includes/header.php"; ?>

    <!-- inkludera nav -->
    <?php  include "_includes/nav.php"; ?>

    <!-- Ett Formulär för att logga in -->
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="username">Användarnamn</label>
        <input type="text" name="username" id="username">

        <label for="password">Lösenord</label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
    </form>

    <!-- inkludera nav -->
    <?php  include "_includes/footer.php"; ?>

</body>

</html>