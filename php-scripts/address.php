<?php
// =========================================================================================
// this file will contain functions referring to address tables (`cidade` and `estado`)
// =========================================================================================

$functions = [
    'getStates' => function() {
        include "../db-connection/connection.php";

        $query = $connection->prepare("SELECT id_estado, nome_estado FROM estado ORDER BY nome_estado");

        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        if (!$query->rowCount()) {
            exit();
        }

        $states = $query->fetchAll(PDO::FETCH_ASSOC);

        // retrieves data as JSON separate by '//\\', which will be used to split it into an array of objects later
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
            echo "Status 500";
            exit();
        }

        if (!$query->rowCount()) {
            exit();
        }

        $cities = $query->fetchAll(PDO::FETCH_ASSOC);

        // retrieves data as JSON separate by '//\\', which will be used to split it into an array of objects later
        foreach($cities as $city) {
            echo json_encode($city) . ' //\\ ';
        }
        
        exit();
    }
];

// $function will receive what was passed through $.post() with AJAX, and if the function actually exists it will be executed
$function = $_POST['function'] ?? null;
if (key_exists($function, $functions)) {
    $functions[$function]();
}