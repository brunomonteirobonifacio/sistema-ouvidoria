<?php
require "config.php";

[$host, $user, $pass, $port] = getenv('db_config');
$connection = mysqli_connect($host, $user, $pass, $port);