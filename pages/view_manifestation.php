<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>Visualizar Ouvidorias - Ouvidoria Pública</title>
</head>
<body>
    <?php
        // checks if the user is already logged in
        session_start();
        if (!isset($_SESSION['userId'])) {
            header('location: ../index.php');
        }
    ?>

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
            <a class="navbar-brand" href="../">Ouvidoria Pública</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../">Início</a>
                    </li>
                    <li class="nav-item user-logged" style="display: none;">
                        <a class="nav-link" href="create_manifestation.php">Criar ouvidoria</a>
                    </li>
                    <li class="nav-item user-logged" style="display: none;">
                        <a class="nav-link active" href="">Minhas ouvidorias</a>
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
                        <a href="   signup.php" class="nav-link">Criar conta</a>
                    </li>
                    <li class="nav-item user-not-logged">
                        <a href="login.php" class="nav-link">Entrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container p-3 mx-auto my-3 align-self-center text-center">
        <div class="row align-items-center m-2 d-inline-flex">
            <div class="col">
                <h1 class="m-2 pd-2 display-2 border-bottom border-dark-subtle">Minhas ouvidorias</h1>
            </div>
        </div>

        <!-- Search query -->
        <div class="row text-end">
            <div class="col">Digite o número de seu protocolo para pesquisa: </div>
            <div class="col d-flex">
                <input type="search" name="search_input" id="searchInput" class="search_protocol form-control">
                <button type="button" class="btn btn-primary p-2 mx-2" id="">Pesquisar</button>
            </div>
        </div>

        <!-- Accordion -->
        <div class="accordion accordion-flush" id="accordionManifestations" class="">
        </div>

        <div class="row d-flex align-self-center">
            <div class="col">
                <!-- TODO: make pagination work -->
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
<script src="../jquery/jquery.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../jquery/jquery-mask/dist/jquery.mask.js"></script>
<script src="../jquery/jquery-mask/dist/jquery.mask.min.js"></script>

<script src="../js-scripts/masks.js"></script>
<script src="../js-scripts/general.js"></script>
<script src="../js-scripts/manifestation_view.js"></script>
<script src="../js-scripts/user.js"></script>   
<script src="../js-scripts/manifestation.js"></script>
</html>