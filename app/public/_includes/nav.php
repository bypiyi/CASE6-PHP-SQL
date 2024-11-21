<?php

// skapa länkar via en array
// uppgift - skriv om som en associativ array
$nav_links = array(
    "index.php" => "HOME",
    "register.php" => "REGISTER",
);

// om man är inloggad ska meny inte visa Logga in - utan Logga ut
if (isset($_SESSION['user_id'])) {
    $nav_links['logout.php'] = "Logga ut";
} else {
    $nav_links['login.php'] = "LOGIN";    
}

?>

<nav>
    <ul>
        <?php
        foreach ($nav_links as $key => $value) {
            $class = str_contains($_SERVER['SCRIPT_NAME'], $key) ? "class=active" : "";
            $html = "<li><a href=\"$key\" $class>";
            $html .= $value;
            $html .= "</a></li>";
            echo $html;
        }
        ?>
    </ul>
</nav>
