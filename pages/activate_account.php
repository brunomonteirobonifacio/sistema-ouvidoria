<!-- start working on account activation -->
<?php
include "../db-connection/connection.php";

$token = $_GET['token'];
$tokenHash = hash('sha256', $token);

$query = $connection->prepare("SELECT * FROM usuario WHERE hash_ativacao_usuario = :token");
$query->bindParam('token', $tokenHash);

$query->execute();

$user = $query->fetchAll(PDO::FETCH_ASSOC);

if ($user === null) {
    die("token not found");
}

$query = $connection->prepare("UPDATE usuario SET hash_ativacao_usuario = NULL WHERE id_usuario = :userId");
$query->bindParam('userId', $user[0]['id_usuario']);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Conta Ativada</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h2 class="my-2 pd-2 display-6 border-dark-subtle border-bottom">Conta ativada com sucesso!</h2>

    <div class="container">

    </div>

</body>
</html>