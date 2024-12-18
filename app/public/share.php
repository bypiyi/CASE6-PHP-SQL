<?php
include "_includes/database_connection.php";
session_start();

// Kontrollera om användaren inte är inloggad
if (!isset($_SESSION['user_id'])) {
    // Om användaren inte är inloggad, omdirigera till startsidan
    header("Location: /");
    exit; // Stoppa vidare körning av skriptet
}

$status_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $description = trim($_POST['description']);

    if (empty($name) || empty($address) || empty($description)) {
        $status_message = "Missing values";
    } else {
        try {
            $sql = "SELECT * FROM business WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':name' => $name]);
            $company = $stmt->fetch();

            if ($company) {
                $status_message = "The business already exists";
            } else {
                $file_name = null;
                if (!empty($_FILES['file']['name'])) {
                    $target_dir = "uploads/";
                    $file_name = basename($_FILES['file']['name']);
                    $target_file_path = $target_dir . $file_name;
                    $file_type = pathinfo($target_file_path, PATHINFO_EXTENSION);
                    $allow_types = ['jpg', 'png', 'jpeg', 'gif'];

                    if (in_array($file_type, $allow_types)) {
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file_path)) {
                            // File uploaded successfully
                        } else {
                            $status_message = "Error uploading file";
                        }
                    } else {
                        $status_message = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed";
                    }
                }

                $sql = "INSERT INTO business (name, address, description, image_url, user_id) VALUES (:name, :address, :description, :image_url, :user_id)";
                $stmt = $pdo->prepare($sql);
                $insert = $stmt->execute([
                    ':name' => $name,
                    ':address' => $address,
                    ':description' => $description,
                    ':image_url' => $file_name,
                    ':user_id' => $_SESSION['user_id']
                ]);

                if ($insert) {
                    $status_message = "Business registered successfully";
                } else {
                    $status_message = "Error inserting data into database";
                }
            }
        } catch (PDOException $e) {
            $status_message = "Database connection exception: " . $e->getMessage();
        }
    }
}

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
    <!-- Hjärta -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KtM4B7lGRpLN4ZC2MkCbqVoVtyzQfK8b9vYFgUn37Jp9E6J" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
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

    <div class="search">
        <h1>Add your new, old or recently discovered favorite</h1>

        <?php if (!empty($status_message)) {
            echo '<p>' . $status_message . '</p>';
        } ?>

        <form action="share.php" method="post" enctype="multipart/form-data">
            <label for="name">NAME</label>
            <input type="text" name="name" id="name" required>

            <label for="address">ADDRESS</label>
            <input type="text" name="address" id="address" required>

            <label for="description">DESCRIPTION</label>
            <textarea name="description" id="description" required></textarea>

            <label for="file">UPLOAD IMAGE (optional)</label>
            <input type="file" name="file" id="file" class="file">

            <button type="submit">SHARE THE JOY!</button>
        </form>
    </div>

    <div class="added">
        <h1>hey, you just added:</h1>
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

    <!-- Footer -->
    <footer class="footer">
        <h1><?= $greetings ?></h1>
        <p>&copy; Alicia Piyi Tsirigotis <br> Glimåkra Folkhögskola <br> PHP & SQL</p>
        <div>
            <img src="styles/images/logo.png" class="header-logo" alt="">
        </div>
    </footer>

    <script src="script.js"></script>

</body>

</html>
