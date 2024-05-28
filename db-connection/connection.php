<?php
require "../config.php";

[$host, $user, $pass, $database] = $_ENV['db_config'];

$connection = mysqli_connect($host, $user, $pass, $database);