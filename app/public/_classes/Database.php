<?php

class Database
{

    public $db;

    function __construct()
    {

        $host = "mysql";
        $database = "db_learn";
        $user = "db_user";
        $passw = "db_password";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$database", $user, $passw, $options);
        } catch (PDOException $e) {
            echo "Database connection exception $e";
        }
    }
}