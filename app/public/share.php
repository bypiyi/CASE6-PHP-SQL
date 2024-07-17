<?php
// include_once "_includes/upload.php";
include "_includes/database_connection.php";
session_start();
$status_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $hours = trim($_POST['hours']);
    $category = filter_input(INPUT_POST, 'bars', FILTER_VALIDATE_INT);

    if (empty($name) || empty($address) || empty($hours) || empty($category)) {
        echo "Missing values<br>";
        exit;
    }

    try {
        $sql = "SELECT * FROM business WHERE name = :name";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name' => $name]);
        $company = $stmt->fetch();

        if ($company) {
            echo "Företaget finns redan<br>";
            exit;
        }

        if (!empty($_FILES['file']['name'])) {
            $target_dir = "uploads/";
            $file_name = basename($_FILES['file']['name']);
            $target_file_path = $target_dir . $file_name;
            $file_type = pathinfo($target_file_path, PATHINFO_EXTENSION);
            $allow_types = ['jpg', 'png', 'jpeg', 'gif'];

            if (in_array($file_type, $allow_types)) {

                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file_path)) {

                    $sql = "INSERT INTO business (name, address, open_hours, image_url, category_id, user_id) VALUES (:name, :address, :open_hours, :image_url, :category_id, :user_id)";
                    $stmt = $pdo->prepare($sql);
                    $insert = $stmt->execute([
                        ':name' => $name,
                        ':address' => $address,
                        ':open_hours' => $hours,
                        ':category_id' => $category,
                        ':image_url' => $file_name,
                        ':user_id' => $_SESSION['user_id']
                    ]);

                    if ($insert) {
                        // $status_message = "Business registered successfully";
                    } else {
                        // $status_message = "Error inserting data into database";
                    }
                } else {
                    // $status_message = "Error uploading file";
                }
            } else {
                // $status_message = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed";
            }
        } else {
            // $status_message = "Please select an image to upload";
        }
    } catch (PDOException $e) {
        echo "Database connection exception: " . $e->getMessage();
    }
}



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




    <div class="search">

        <!-- <p class="slogan">Add your business here</p> -->

        <?php if (!empty($status_message)) {
            echo '<p>' . $status_message . '</p>';
        } ?>

        <form action="share.php" method="post" enctype="multipart/form-data">
            <label for="name">NAME</label>
            <input type="text" name="name" id="name">

            <label for="address">ADDRESS</label>
            <input type="text" name="address" id="address">

            <label for="hours">OPENING HOURS</label>
            <input type="text" name="hours" id="hours">

            <label for="bars">CHOOSE A CATEGORY</label>
            <select name="bars" id="bars">
                <?php
                $sql = "SELECT category, id FROM category";
                $stmt = $pdo->query($sql);
                $rows = $stmt->fetchAll();

                foreach ($rows as $row) {
                    $category = htmlspecialchars($row["category"]);
                    $id = $row['id'];
                    echo '<option value=' . $id . '>' . $category . '</option>';
                }
                ?>
            </select>

            <label for="file">UPLOAD IMAGE</label>
            <input type="file" name="file" id="file" class="file">

            <button type="submit">SHARE THE JOY!</button>
        </form>
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