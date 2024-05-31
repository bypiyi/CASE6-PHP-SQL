<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "user trying to submit form";
    var_dump($_POST);

    // med denna kod hämtas data från formuläret
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // här kontrolleras att fälten inte är tomma
    if (empty($username) || empty($password)) {
        echo "missing values<br>";
        exit;
    }

    // här kontrolleras att användaren finns
    include "_includes/database_connection.php";

    try {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username
        ]);

        // hämtar användare från databasen
        $user = $stmt->fetch();

        // här kontrollera att användaren finns, om inte, skicka till register.php
        if (!$user) {
            header("Location: register.php");
            exit;
        }

        // här kontrolleras att lösenordet stämmer
        $is_matching_passwords = password_verify($password, $user['password']);
        if (!$is_matching_passwords) {
            echo "The password dosen't match<br>";
            exit;
        }

        // skapar en session för inloggad användare
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION["username"] = $user["username"];

        // skicka användaren till home.php
        header("Location: home.php");
        exit;

    } catch (PDOException $e) {
        echo "database connection exception";
    }
}

// Greetings m.m
$greetings = "Athens Food Guide";
$information = "Your ultimate guide to discovering the best restaurants in Athens.
Here, you can find recommendations, share your own tips, and get advice from fellow food enthusiasts";
$information_extra = "Create an account to share your experiences and join our community of food lovers.";
$title = "Athens Food Guide";
$account = "Don't have an account yet? Create one here!";

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
    <?php include "_includes/nav.php"; ?>


    <div class="box_image">
        <img src="styles/images/slogan.png" class="slogan" alt="">
    </div>


    <div class="container">


        <form action="login.php" method="post">

            <label for="username">USERNAME</label>
            <input type="text" name="username" id="username">

            <label for="password">PASSWORD</label>
            <input type="password" name="password" id="password">

            <button type="submit">LOG IN</button>
        </form>
    </div>



    <div class="container-content">

        <h1><?= $account ?></h1>

        <div class="button-container">
            <a href="register.php" class="btn register-btn">Register</a>
        </div>
    </div>


    <div class="box_image">
        <img src="styles/images/restaurant2.jpg" alt="" style="width: 100%; height: auto; padding-top: 10px;">

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