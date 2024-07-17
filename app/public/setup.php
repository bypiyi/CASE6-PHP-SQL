<?php

include "_includes/database_connection.php";


try {

    // ny tabell med namnet users för att registrera användare och för att användare ska kunna logga in
    $sql = "CREATE TABLE IF NOT EXISTS `users` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `username` varchar(50) DEFAULT NULL,
         `password` varchar(100) DEFAULT NULL,
         PRIMARY KEY (`id`),
         UNIQUE KEY `username` (`username`)
        ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $pdo->exec($sql);

    // ny tabell med namnet category för registrerad användare
    $sql = "CREATE TABLE IF NOT EXISTS `category` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `category` varchar(50) NOT NULL,
         PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $pdo->exec($sql);

    // ny tabell med namnet business där användare kan registrera sitt företag
    $sql = "CREATE TABLE IF NOT EXISTS `business` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(50) NOT NULL,
        `address` varchar(100) NOT NULL,
        `open_hours` varchar(50) DEFAULT NULL,
        `image_url` varchar(100) DEFAULT NULL,
        `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
        `user_id` int(11) DEFAULT NULL,
        `category_id` int(11) DEFAULT NULL,
        PRIMARY KEY (`id`)
       ) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $pdo->exec($sql);


    // Meddelande om att databasen är klar med tabell setup
    echo "Database setup complete <br>";
} catch (PDOException $e) {
    echo "Database setup exception $e";
}