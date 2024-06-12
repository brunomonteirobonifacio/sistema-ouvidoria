<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Ouvidoria Pública</title>
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
            <a class="navbar-brand" href="">Ouvidoria Pública</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">Início</a>
                    </li>
                    <li class="nav-item user-logged">
                        <a class="nav-link" href="pages/create_manifestation.php">Criar ouvidoria</a>
                    </li>
                    <li class="nav-item user-logged">
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
        <div class="text-center">
            <p>
                <span class="fs-2">Bem vindo ao site da Ouvidoria Pública</span>
                <br>Abaixo uma breve introdução às funções oferecidas pelo serviço.
            </p>
        </div>

        <!-- Introduction selection -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="createManifestationSelector" aria-current="page">Criação de Ouvidorias</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" id="viewManifestationSelector" style="cursor: pointer;">Visualizar ouvidorias abertas</a>
            </li>
        </ul>
        <!-- Introduction to website -->
    
        <div id="createManifestationIntroduction">

            <h2 class="my-2 pd-2 display-6 border-dark-subtle border-bottom">Criação de ouvidorias</h2>
            <p>
                Para criar uma nova ouvidoria ou manifestação, clique em "Criar ouvidoria". Caso não encontre, certifique-se que está conectado em sua conta.
                <br>Você deverá fazer uma descrição detalhada sobre o motivo de sua manifestação, escolher o tipo de serviço que será afetado, a natureza da manifestação, e anexar ao menos um arquivo de imagem ou documento
                <br>OBS: Formatos aceitos são PDF, JPeG, JPG e PNG
            </p>
            <p>
                Ao final da criação de sua ouvidoria, será informado o número do protocolo que você utilizará para encontrar a ouvidoria na página "Minhas Ouvidorias".
            </p>
            <p>
                <span class="fw-bold">Tipos de serviço afetados:</span> <span class="service-types"></span>.
            </p>
            <p>
                <span class="fw-bold">Tipos de manifestação:</span>
            <ul class="manifestation-types-list"></ul>
            </p>
        </div>
    
        <div id="viewManifestationIntroduction" style="display: none;">

            <h2 class="my-2 pd-2 display-6 border-dark-subtle border-bottom">Minhas ouvidorias</h2>
            <p>
                Você pode visualizar suas ouvidorias através da página "Minhas ouvidorias". Caso não encontre, certifique-se que está conectado em sua conta.
            </p>
            <p>
                Por meio desta página, você poderá encontrar todas suas ouvidorias e manifestações, contendo o tipo de manifestação e o tipo de serviço afetado, além do número de protocolo.
                <p>
                    Exemplo:
                    <div class="accordion accordion-flush" id="accordionManifestations">
                        <div class="accordion-item my-2 border">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item1" aria-expanded="true" aria-controls="item1">
                                    Protocolo <div class="vr mx-2"></div> Reclamação, Educação <div class="vr mx-2"></div> Data: 8/5/2024
                                </button>
                            </h2>
                            <div id="item1" class="accordion-collapse collapse" data-bs-parent="#accordionManifestations">
                                <div class="accordion-body">
                                    <div class="row text-start" id="description">
                                        <div class="col">
                                            <span class="fw-bold">Descrição:</span> Descrição de sua ouvidoria aqui
                                        </div>
                                    </div>
                                    <div class="row text-start" id="attachments">
                                        <span class="fw-bold"> Anexos: </span>
                                        <div class="col">
                                            Seus anexos aqui
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </p>
                <br>É possível também pesquisar por uma ouvidoria ou manifestação específica informando o protocolo da manifestação desejada, que lhe é informado ao concluir a criação da manifestação.
            </p>
        </div>
    </div>
</body>
<script src="jquery/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="jquery/jquery-mask/dist/jquery.mask.js"></script>
<script src="jquery/jquery-mask/dist/jquery.mask.min.js"></script>

<script src="js-scripts/general.js"></script>
<script src="js-scripts/user.js"></script>
<script src="js-scripts/manifestation.js"></script>
<script src="js-scripts/homepage.js"></script>
</html>