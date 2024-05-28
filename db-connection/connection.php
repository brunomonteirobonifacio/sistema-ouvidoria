<?php
require "../config.php";
// this file is absent on GitHub
// Its structure can be seen below:

// $_ENV['pepper'] = *password pepper*;
// $_ENV['db_config'] = [*host*, *user*, *password*, *database*];

[$host, $user, $pass, $database] = $_ENV['db_config'];

$connection = new PDO("mysql:host=$host;dbname=$database", $user, $pass);