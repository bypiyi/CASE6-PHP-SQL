<?php

// skapa länkar via en array
// uppgift - skriv om som en associativ array
$nav_links = array(
    "index.php" => "Start",
    "home.php" => "Home",
    "sample.php" => "Sample",
    "register.php" => "Registrera användare"
);

 // om man är inloggad ska meny inte visa Logga in - utan Logga ut
 if (isset($_SESSION['user_id'])) {
    $nav_links['logout.php'] = "Logga ut";
} else {
    $nav_links['login.php'] = "Logga in";    
}

// skriv ut global $_SERVER - för att få hjälpmed aktuellt filnamn
// print_r($_SERVER);
?>

<nav>
    <ul>
        <!-- <li><a href="index.php">Start</a></li>
        <li><a href="home.php">Home</a></li>
        <li><a href="sample.php">Sample</a></li> -->
        <?php

        // skapa strukturlänkar med array $nav_links 
        foreach ($nav_links as $key => $value) {

            // använd $_SERVER['SCRIPT_NAME] för att få hjälp vad aktuell fil heter
            // om filen överensstämmer med $key - ange att klassen active ska finnas
            // kan göras  med metoden str_contains - sök efter nål i en höstack
            // kan göras med if - else... alternativt med en s k ternary operator
            // med ternary operator: tilldela ett värde, kontroll ? värde om sant : värde om falskt
            $class = str_contains($_SERVER['SCRIPT_NAME'], $key) ? "class=active" : "";
            $html = "<li><a href=\"$key\" $class>";
            $html .= $value;
            $html .= "</a></li>";
            echo $html;
        }

        ?>
    </ul>
</nav>