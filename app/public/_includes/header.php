<div>
    <?php
    if (isset($_SESSION['username'])) {
        echo "Inloggad: ". $_SESSION['username'];
    }
    ?>
</div>
<header>
    Site header
</header>