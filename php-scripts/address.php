<?php
// =========================================================================================
// this file will contain functions referring to address tables (`cidade` and `estado`)
// =========================================================================================

$functions = [
    'getStates' => function() {
        include "../db-connection/connection.php";

        $query = $connection->prepare("SELECT id_estado, nome_estado FROM estado ORDER BY nome_estado");

        if (!$query->execute()) {
            echo "[]";
            exit();
        }

        if (!$query->rowCount()) {
            echo "[]";
            exit();
        }

        $states = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($states as $state) {
            echo json_encode($state) . ' //\\ ';
        }

        exit();
    },

    'getCities' => function() {
        include "../db-connection/connection.php";

        $stateId = $_POST['state'];

        $query = $connection->prepare("SELECT id_cidade, nome_cidade FROM cidade WHERE cod_estado = '$stateId' ORDER BY nome_cidade");

        if (!$query->execute()) {
            echo "[]";
            exit();
        }

        if (!$query->rowCount()) {
            echo "[]";
            exit();
        }

        $states = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($states as $state) {
            echo json_encode($state) . ' //\\ ';
        }
        
        exit();
    }
];

// $function will receive what was passed through $.post() with AJAX, and if the function actually exists it will be executed
$function = $_POST['function'] ?? null;
if (key_exists($function, $functions)) {
    $functions[$function]();
}