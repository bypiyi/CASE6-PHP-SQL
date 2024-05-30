<?php

include_once "Database.php";

final class Sample extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    // en metod som hämtar alla vårtecken
    function get_all()
    {
        $sql = "SELECT spring_sign.*, users.username FROM spring_sign JOIN users ON spring_sign.user_id = users.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    // skapa andra metoder...

}