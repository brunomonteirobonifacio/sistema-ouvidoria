<?php
require "../config.php";

[$host, $user, $pass, $database] = $_ENV['db_config'];

$connection = new PDO("mysql:host=$host;dbname=$database", $user, $pass);

// assures that real prepared statements are being used
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// throws exceptions when mysql errors happen
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);