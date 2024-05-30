<?php

// Variabedl i PHP, inleds alltid med dollartecken och
// avslutas med ett semikolon.
$greetings = "The ultimate guide to Athens restaurants";
$information = "Find your favorites today!";
$title = "Athens Food Guide";

// strlen (antal tecken)
$numberOfCharacters = strlen ($title);
echo $numberOfCharacters;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>

    <h1><?php echo $greetings ?></h1>

    <h2><?php echo $information ?></h2>


    <!-- Lite Javascript -->
    <script>

        const language = "PHP";
        // Antal tecken
        const numberOfCharacters = language.length;
        console.log("numberOfCharacters", numberOfCharacters);

    </script>

</body>

</html>