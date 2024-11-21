<?php
declare(strict_types=1);
session_start();

// Logga ut 
session_destroy();
$_SESSION = [];

header("Location: /");