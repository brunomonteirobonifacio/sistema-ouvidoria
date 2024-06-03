<?php
// =========================================================================================
// this file will contain functions referring to `ouvidoria` table
// =========================================================================================

$functions = [
    'getServiceTypes' => function() {
        include "../db-connection/connection.php";

        $query = $connection->prepare("SELECT id_servico, nome_servico FROM servico_afetado ORDER BY nome_servico");

        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        if (!$query->rowCount()) {
            exit();
        }

        $serviceTypes = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($serviceTypes as $serviceType) {
            echo json_encode($serviceType) . ' //\\ ';
        }

        exit();
    },

    'getManifestationTypes' => function() {
        include "../db-connection/connection.php";

        $query = $connection->prepare("SELECT id_tipo, nome_tipo FROM tipo_ouvidoria ORDER BY nome_tipo");

        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        if (!$query->rowCount()) {
            exit();
        }

        $serviceTypes = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($serviceTypes as $serviceType) {
            echo json_encode($serviceType) . ' //\\ ';
        }

        exit();
    },
];

// $function will receive what was passed through $.post() with AJAX, and if the function actually exists it will be executed
$function = $_POST['function'] ?? null;
if (key_exists($function, $functions)) {
    $functions[$function]();
}