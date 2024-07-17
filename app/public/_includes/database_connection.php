<?php

// databas koppling
$host = "mysql";
$database = "db_case";
$usern = "db_user";
$passw = "db_password";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $usern, $passw, $options);
} catch (PDOException $e) {
    echo "Database connection exception $e";
}
