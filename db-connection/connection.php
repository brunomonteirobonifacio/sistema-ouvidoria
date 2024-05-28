<?php
require "../config.php";

[$host, $user, $pass, $database] = $_ENV['db_config'];

$connection = new PDO("mysql:host=$host;dbname=$database", $user, $pass);