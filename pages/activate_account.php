<!-- Account activation -->
<?php
include "../db-connection/connection.php";

$token = $_GET['token'];
$tokenHash = hash('sha256', $token);

$query = $connection->prepare("SELECT * FROM usuario WHERE hash_ativacao_usuario = :token");
$query->bindParam('token', $tokenHash);

$query->execute();

$user = $query->fetchAll(PDO::FETCH_ASSOC);

// variable responsible for storing whether token could be found or not, used for showing the right message later
$tokenNotFound = $user === [];

// removes activation hash
$query = $connection->prepare("UPDATE usuario SET hash_ativacao_usuario = NULL WHERE id_usuario = :userId");
$query->bindParam('userId', $user[0]['id_usuario']);

$query->execute();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Conta Ativada</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

    <div class="container my-3 py-3">
        <?php
            if (!$tokenNotFound) {
        ?>

        <h2 class="my-2 pd-2 display-6 border-dark-subtle border-bottom">Conta ativada com sucesso!</h2>
        <p class="lead fs-5">Você pode entrar em sua conta <a href="login.php">clicando aqui</a></p>

        <?php
            } else {
        ?>

        <h2 class="my-2 pd-2 display-6 border-dark-subtle border-bottom">Token não encontrado</h2>
        <p class="lead fs-5">
            Não foi possível ativar sua conta, pois o token de ativação provido não foi encontrado.
            <br><a href="../">Clique aqui para voltar para a tela inicial</a>
        </p>

        <?php
            }
        ?>
    </div>

</body>
</html>