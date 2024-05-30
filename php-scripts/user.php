<?php
// This file is dedicated to user-related functions in database, such as sign-up and log-in
function login($email) {
    include "../db-connection/connection.php";
    session_start();

    $query = $connection->prepare("SELECT id_usuario FROM usuario WHERE email_usuario = :email");
    $query->bindvalue('email', $email);
    
    $query->execute();

    $userId = $query->fetchAll(PDO::FETCH_ASSOC)[0]['id_usuario'];

    $_SESSION['userId'] = $userId;
    exit();
}

$functions = [
    'createUser' => function() {
        include "../db-connection/connection.php";

        $username = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $whatsapp = $_POST['whatsapp'];
        $cpf = $_POST['cpf'];
        $cityId = $_POST['city'];
        $birthDate = $_POST['birthdate'];
        $pass = $_POST['password'] . $_ENV['pepper'];

        $query = $connection->prepare("INSERT INTO usuario (nome_usuario, email_usuario, telefone_usuario, whatsapp_usuario, cpf_usuario, data_nasc, cod_estado, cod_cidade, senha_usuario) VALUES
        (:username, :email, :phone, :whatsapp, :cpf, :birthDate, :stateId, :cityId, SHA2(:pass, 512))");

        $query->bindValue('username', $username);
        $query->bindValue('email', $email);
        $query->bindValue('phone', $phone);
        $query->bindValue('whatsapp', $whatsapp);
        $query->bindValue('cpf', $cpf);
        $query->bindValue('birthDate', $birthDate);
        $query->bindValue('cityId', $cityId);
        $query->bindValue('pass', $pass);

        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }
        
        login($email);

        echo "Status 201";
        exit();
    },

    'loginUser' => function() {
        login($_POST['email']);
        exit();
    },

    'logoffUser' => function() {
        session_start();
        session_destroy();
        exit();
    },

    'checkCPF' => function() {
        include "../db-connection/connection.php";
        $cpf = $_POST['cpf'];

        $query = $connection->prepare("SELECT cpf_usuario FROM usuario WHERE cpf_usuario = :cpf");
        $query->bindValue('cpf', $cpf);

        if (!$query->execute()) {
            echo "500";
            exit();
        }

        echo $query->rowCount() > 0 ? $query->rowCount() : "0";
        exit();
    },

    'checkEmail' => function() {
        include "../db-connection/connection.php";
        $email = $_POST['email'];

        $query = $connection->prepare("SELECT email_usuario FROM usuario WHERE email_usuario = :email");
        $query->bindValue('email', $email);

        if (!$query->execute()) {
            echo "500";
            exit();
        }

        echo $query->rowCount() > 0 ? $query->rowCount() : "0";
        exit();
    },

    'checkPhone' => function() {
        include "../db-connection/connection.php";
        $phone = $_POST['phone'];

        $query = $connection->prepare("SELECT telefone_usuario FROM usuario WHERE telefone_usuario = :telefone");
        $query->bindValue('telefone', $phone);

        if (!$query->execute()) {
            echo "500";
            exit();
        }

        echo $query->rowCount() > 0 ? $query->rowCount() : "0";
        exit();
    },

    'checkWhatsapp' => function() {
        include "../db-connection/connection.php";
        $whatsapp = $_POST['phone'];

        $query = $connection->prepare("SELECT whatsapp_usuario FROM usuario WHERE whatsapp_usuario = :whatsapp");
        $query->bindValue('whatsapp', $whatsapp);

        if (!$query->execute()) {
            echo "500";
            exit();
        }

        echo $query->rowCount() > 0 ? $query->rowCount() : "0";
        exit();
    },
];

// $function will receive what was passed through $.post() with AJAX, and if the function actually exists it will be executed
$function = $_POST['function'] ?? null;
if (key_exists($function, $functions)) {
    $functions[$function]();
}