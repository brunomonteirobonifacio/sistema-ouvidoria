<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Ouvidoria</title>
</head>
<body>
    <!-- Logoff Modal -->
    <div class="modal fade" id="logoffModal" tabindex="-1" aria-labelledby="logoffModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="logoffModalLabel">...</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalBtn">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="logoffModalBtn">Sair</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Ouvidoria Municipal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/create_manifestation.php">Criar ouvidoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/view_manifestation.php">Minhas ouvidorias</a>
                    </li>
                    <li class="nav-item dropdown user-logged user-options" style="display: none;">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Olá, <span class="username"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Alterar dados cadastrais</a></li>
                            <li><a class="dropdown-item" id="logoff" style="cursor: pointer;">Sair</a></li>
                        </ul>
                    </li>
                    <li class="nav-item user-not-logged">
                        <a href="pages/signup.php" class="nav-link">Criar conta</a>
                    </li>
                    <li class="nav-item user-not-logged">
                        <a href="pages/login.php" class="nav-link">Entrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <p>
            Bem vindo ao site da Ouvidoria pública. 
            <?php
                session_start();

                if (!isset($_SESSION['userId'])) {
            ?>
            Para ter acesso à criação de ouvidorias,
            <a href="pages/signup.php">Crie uma conta</a>
        </p>
        <p>
            Já tem uma conta? <a href="pages/login.php">Fazer login</a>
        </p>
        <?php
            } else {
                ?>
                Para criar uma ouvidoria, <a href="pages/create_manifestation.php">clique aqui</a>
                
                <?php
            }
        ?>
    </div>
</body>
<script src="jquery/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="jquery/jquery-mask/dist/jquery.mask.js"></script>
<script src="jquery/jquery-mask/dist/jquery.mask.min.js"></script>

<script src="js-scripts/general.js"></script>
<script src="js-scripts/user.js"></script>
</html>