<?php
// this file will contain functions referring to address tables (`cidade` and `estado`)

$functions = [
    'getStates' => function() {
        include "../db-connection/connection.php";

        $query = $connection->prepare('SELECT * FROM estado SORT BY nome_estado');

        echo $query;

    },

    'getCities' => function() {
        
    }
];

$function = $_POST['function'];
if (key_exists($function, $functions)) {
    $functions[$function]();
}