<?php
// This file is dedicated to user-related functions in database, such as sign-up and log-in
function login($email, $pass) {
    include "../db-connection/connection.php";
    session_start();

    $query = $connection->prepare("SELECT id_usuario FROM usuario WHERE email_usuario = :email AND senha_usuario = SHA2(:pass, 512)");
    $query->bindParam('email', $email);
    $query->bindParam('pass', $pass);
    
    if (!$query->execute()) {
        return false;
    }

    $userId = $query->fetchAll(PDO::FETCH_ASSOC)[0]['id_usuario'];

    $_SESSION['userId'] = $userId;
    return true
}

$functions = [
    'createUser' => function() {
        include "../db-connection/connection.php";

        $username = strtoupper($_POST['name']);
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $whatsapp = $_POST['whatsapp'];
        $cpf = $_POST['cpf'];
        $cityId = $_POST['city'];
        $birthdate = $_POST['birthdate'];
        $pass = $_POST['password'] . $_ENV['pepper'];

        $query = $connection->prepare("INSERT INTO usuario (nome_usuario, email_usuario, telefone_usuario, whatsapp_usuario, cpf_usuario, data_nasc, cod_cidade, senha_usuario) VALUES
        (:username, :email, :phone, :whatsapp, :cpf, :birthdate, :cityId, SHA2(:pass, 512))");

        $query->bindParam('username', $username);
        $query->bindParam('email', $email);
        $query->bindParam('phone', $phone);
        $query->bindParam('whatsapp', $whatsapp);
        $query->bindParam('cpf', $cpf);
        $query->bindParam('birthdate', $birthdate);
        $query->bindParam('cityId', $cityId);
        $query->bindParam('pass', $pass);

        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }
        
        echo "Status 201";
        
        login($email);
        exit();
    },

    'loginUser' => function() {
        login($_POST['email']);
        exit();
    },

    'logoffUser' => function() {
        // ends session, where userId was stored
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

        // checks if there was any user already registered with given cpf
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

                // checks if there was any user already registered with given e-mail
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

        // checks if there was any user already registered with given phone number
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

        // checks if there was any user already registered with given whatsapp number
        echo $query->rowCount() > 0 ? $query->rowCount() : "0";
        exit();
    },
];

// $function will receive what was passed through $.post() with AJAX, and if the function actually exists it will be executed
$function = $_POST['function'] ?? null;
if (key_exists($function, $functions)) {
    $functions[$function]();
}