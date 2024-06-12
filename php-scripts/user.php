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
        // new accounts come with activation tokens. When the user enters the URL provided on E-mail message, the activation token wil be removed and the account will be accessible 
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

        // if query could not be executed
        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        // file with E-mail messaging settings
        require "mailer.php";

        try {
            $mail->addAddress($email);
            $mail->Subject = 'Ativação de conta ouvidoria';
            $mail->isHTML(true);

            // E-mail message containing user activation token
            $mail->Body = "
            Olá, $username!<br>
            Clique <a href='localhost/sistema-ouvidoria-web-brain/pages/activate_account.php?token=$activationToken'>aqui</a> para ativar sua conta.
            ";

            $mail->AltBody = "Olá, $username! Para ativar sua conta, clique no link abaixo
            localhost/sistema-ouvidoria-web-brain/pages/activate_account.php
            ";

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
    
        // selects user with corresponding Email and password and with account activated (no activation hash)
        $query = $connection->prepare("SELECT id_usuario, nome_usuario FROM usuario WHERE email_usuario = :email AND senha_usuario = SHA2(:pass, 512) AND hash_ativacao_usuario IS NULL");
        $query->bindParam('email', $email);
        $query->bindParam('pass', $pass);
        
        // if query could not be executed
        if (!$query->execute()) {
            echo '0';   
            exit();
        }
            
        // if the user could not be found
        if (!$query->rowCount()) {
            echo '0';
            exit();
        }
        
        $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        
        session_start();

        // stores user ID in session
        $_SESSION['userId'] = $user['id_usuario'];
        $_SESSION['username'] = $user['nome_usuario'];

        echo '1';
        exit();
    },

    'logoffUser' => function() {
        // ends session, where user ID was stored
        session_start();
        session_destroy();

        exit();
    },

    // returns username of the logged user (whose ID is stored in session)
    'getLoggedUsername' => function() {
        include "../db-connection/connection.php";
        
        session_start();

        echo isset($_SESSION['username']) ? $_SESSION['username'] : '0';

        exit();
    },

    // checks if CPF is already registered
    'checkCPF' => function() {
        include "../db-connection/connection.php";

        $cpf = $_POST['cpf'];

        $query = $connection->prepare("SELECT cpf_usuario FROM usuario WHERE cpf_usuario = :cpf");
        $query->bindValue('cpf', $cpf);

        // if query could not be executed
        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        // checks if there was any user already registered with given CPF
        echo $query->rowCount() > 0 ? $query->rowCount() : "0";
        exit();
    },

    // checks if E-mail is already registered
    'checkEmail' => function() {
        include "../db-connection/connection.php";

        $email = $_POST['email'];

        $query = $connection->prepare("SELECT email_usuario FROM usuario WHERE email_usuario = :email");
        $query->bindValue('email', $email);

        // if query could not be executed
        if (!$query->execute()) {
            echo "Status 500";
            exit();
        }

        // checks if there was any user already registered with given E-mail
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