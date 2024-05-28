<?php
// this file will contain functions referring to address tables (`cidade` and `estado`)

$functions = [
    'getStates' => function() {
        include "../db-connection/connection.php";

        $query = $connection->prepare("SELECT id_estado, nome_estado FROM estado ORDER BY nome_estado");

        if (!$query->execute()) {
            echo "[]";
            return;
        }

        if (!$query->rowCount()) {
            echo "[]";
            return;
        }

        $states = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($states as $state) {
            echo json_encode($state) . ' //\\ ';
        }

    },

    'getCities' => function() {
        include "../db-connection/connection.php";

        $stateId = $_POST['state'];

        $query = $connection->prepare("SELECT * FROM cidade WHERE cod_estado = '$stateId' ORDER BY nome_cidade");

        if (!$query->execute()) {
            echo "[]";
            return;
        }

        if (!$query->rowCount()) {
            echo "[]";
            return;
        }

        $states = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($states as $state) {
            echo json_encode($state) . ' //\\ ';
        }
    }
];

$function = $_POST['function'] ?? null;
if (key_exists($function, $functions)) {
    $functions[$function]();
}