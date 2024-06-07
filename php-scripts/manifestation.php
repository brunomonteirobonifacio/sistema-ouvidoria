<?php
// =========================================================================================
// this file will contain functions referring to `ouvidoria` table
// =========================================================================================

$functions = [
    'createManifestation' => function() {
        include "../db-connection/connection.php";
        session_start();

        $description = $_POST['description'];
        $serviceType = $_POST['service-type'];
        $manifestationType = $_POST['manifestation-type'];
        $attachments = $_POST['files'];
        $userId = $_SESSION['userId'];
        
        $protocol = date('Ymd') . sprintf("%02d", $manifestationType);

        // search for the last added protocol number
        $query = $connection->prepare("SELECT MAX(protocolo_ouvidoria) AS ultimo_protocolo FROM ouvidoria WHERE protocolo_ouvidoria LIKE :protocol");
        $query->bindValue('protocol', $protocol . '%');
        
        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        $lastProtocol = $query->fetchAll(PDO::FETCH_ASSOC)[0]['ultimo_protocolo'];
        
        // adds the sequential number, either incrementing to the last added or starting with 0001 if there was nothing before
        $protocol = $lastProtocol ? intval($lastProtocol) + 1 : $protocol . '0001';
        
        $query = $connection->prepare("INSERT INTO ouvidoria(descricao_ouvidoria, cod_tipo, cod_servico, protocolo_ouvidoria, cod_usuario) VALUES (:descript, :manifestationType, :serviceType, :protocol, :userId)");
        
        $query->bindParam('descript', $description);
        $query->bindParam('manifestationType', $manifestationType);
        $query->bindParam('serviceType', $serviceType);
        $query->bindParam('protocol', $protocol);
        $query->bindParam('userId', $userId);

        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        // adds attachments to `anexo` table
        $manifestationId = $connection->lastInsertId();

        $query = $connection->prepare("INSERT INTO anexo(arquivo_anexo, cod_ouvidoria) VALUES (:attachment, :manifestationId)");

        // adds each attachment to a separate row linked to the same manifestationId
        foreach ($attachments as $attachment) {
            $query->bindParam('attachment', $attachment);
            $query->bindParam('manifestationId', $manifestationId);

            if (!$query->execute()) {
                echo "Status 500";
                exit();
            }
        }

        echo $protocol;
        exit();
    },

    'getManifestations' => function() {
        include "../db-connection/connection.php";
        session_start();

        $userId = $_SESSION['userId'];

        $query = $connection->prepare("SELECT o.id_ouvidoria, o.descricao_ouvidoria, s.nome_servico AS tipo_servico_afetado, t.nome_tipo AS tipo_ouvidoria, o.protocolo_ouvidoria, o.data_ouvidoria FROM ouvidoria AS o INNER JOIN tipo_ouvidoria AS t INNER JOIN servico_afetado AS s ON t.id_tipo = o.cod_tipo AND s.id_servico = o.cod_servico AND cod_usuario = :userId");
        $query->bindParam('userId', $userId);

        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        if (!$query->rowCount()) {
            exit();
        }

        $manifestations = $query->fetchAll(PDO::FETCH_ASSOC);
        
        // retrieves data as JSON separate by '//\\', which will be used to split it into an array of objects later
        foreach($manifestations as $manifestation) {
            echo json_encode($manifestation) . '//\\';
        }

        exit();
    },

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

        // retrieves data as JSON separate by '//\\', which will be used to split it into an array of objects later
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
        
        // retrieves data as JSON separate by '//\\', which will be used to split it into an array of objects later
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