<?php
// =========================================================================================
// this file is dedicated to user-related functions in database, such as signup and login
// =========================================================================================

// prevents from accessing this page through URL
if (!isset($_POST['function'])) {
    header("location: javascript:history.go(-1)");
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

        // this will be used to account activation
        $activationToken = bin2hex(random_bytes(16));
        $activationTokenHash = hash("sha256", $activationToken);

        $query = $connection->prepare("INSERT INTO usuario (nome_usuario, email_usuario, telefone_usuario, whatsapp_usuario, cpf_usuario, data_nasc, cod_cidade, senha_usuario, hash_ativacao_usuario) VALUES
        (:username, :email, :phone, :whatsapp, :cpf, :birthdate, :cityId, SHA2(:pass, 512), :activationHash)");

        $query->bindParam('username', $username);
        $query->bindParam('email', $email);
        $query->bindParam('phone', $phone);
        $query->bindParam('whatsapp', $whatsapp);
        $query->bindParam('cpf', $cpf);
        $query->bindParam('birthdate', $birthdate);
        $query->bindParam('cityId', $cityId);
        $query->bindParam('pass', $pass);
        $query->bindParam('activationHash', $activationTokenHash);

        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        // send Email
        $mail = require "mailer.php";

        $mail->setFrom('noreply@example.com');
        $mail->setAddress($email);
        $mail->Subject = 'Ativação de conta';
        $mail->Body = <<<END

        Clique <a href="localhost/sistema-ouvidoria-web-brain/pages/activate_account.php?token=$activationToken">aqui</a> para ativar sua conta.

        END;

        try {
            $mail->send();
        } catch (Exception $e) {
            echo "A mensagem não pôde ser enviada. Erro: {$mail->ErrorInfo}";
            exit();
        }
        
        echo "Status 201";
        exit();
    },

    'loginUser' => function() {
        include "../db-connection/connection.php";
    
        $email = $_POST['email'];
        $pass = $_POST['password'];

        // include password peppering
        $pass = $pass . $_ENV['pepper'];
    
        $query = $connection->prepare("SELECT id_usuario FROM usuario WHERE email_usuario = :email AND senha_usuario = SHA2(:pass, 512)");
        $query->bindParam('email', $email);
        $query->bindParam('pass', $pass);
        
        if (!$query->execute()) {
            echo '0';   
            exit();
        }
        
        if (!$query->rowCount()) {
            echo '0';
            exit();
        }
        
        $userId = $query->fetchAll(PDO::FETCH_ASSOC)[0]['id_usuario'];
        
        session_start();

        $_SESSION['userId'] = $userId;

        echo '1';
        exit();
    },

    'logoffUser' => function() {
        // ends session, where userId was stored
        session_start();
        session_destroy();

        exit();
    },

    'getLoggedUsername' => function() {
        session_start();

        include "../db-connection/connection.php";

        $query = $connection->prepare("SELECT nome_usuario FROM usuario WHERE id_usuario = :id");
        $query->bindParam('id', $_SESSION['userId']);

        if (!$query->execute()) {
            echo '0';
            exit();
        }

        if (!$query->rowCount()) {
            echo '0';
            exit();
        }

        $username = $query->fetchAll(PDO::FETCH_ASSOC)[0]['nome_usuario'];
        echo $username;

        exit();
    },

    'checkCPF' => function() {
        include "../db-connection/connection.php";
        $cpf = $_POST['cpf'];

        $query = $connection->prepare("SELECT cpf_usuario FROM usuario WHERE cpf_usuario = :cpf");
        $query->bindValue('cpf', $cpf);

        if (!$query->execute()) {
            echo "Status 500";
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
            echo "Status 500";
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
            echo "Status 500";
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
            echo "Status 500";
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