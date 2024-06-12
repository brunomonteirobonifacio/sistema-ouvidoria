<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Abrir Ouvidoria - Ouvioria Pública</title>
</head>
<body>
    <?php
        // checks if the user is already logged in
        session_start();
        if (!isset($_SESSION['userId'])) {
            header('location: ../index.php');
        }
    ?>
    
    <!-- Modal -->
    <div class="modal fade" id="createManifestModal" tabindex="-1" aria-labelledby="createManifestModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="createManifestModalLabel">...</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalBtn">Fechar</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confirmModalBtn">Ok</button>
          </div>
        </div>
      </div>
    </div>

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
                    <li class="nav-item">
                        <a class="nav-link active" href="">Criar ouvidoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_manifestation.php">Minhas ouvidorias</a>
                    </li>
                    <li class="nav-item dropdown user-logged user-options" style="display: none;">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Olá, <span class="username"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" id="logoff" style="cursor: pointer;">Sair</a></li>
                        </ul>
                    </li>
                    <li class="nav-item user-not-logged">
                        <a href="signup.php" class="nav-link">Criar conta</a>
                    </li>
                    <li class="nav-item user-not-logged">
                        <a href="login.php" class="nav-link">Entrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center p-3 mx-auto my-3 border border-dark-subtle rounded w-50">
        <div class="row align-items-center m-2 d-inline-flex">
            <div class="col">
                <h1 class="m-2 pd-2 display-2 border-bottom border-dark-subtle">Abrir ouvidoria</h1>
            </div>
        </div>
        
        <form method="post" id="create_manifestation" class="needs-validation" novalidate>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <textarea name="description" id="description" class="form-control" autocomplete="off" rows="3" required></textarea>
                        <label for="description" class="text-dark">Descreva o motivo de sua ouvidoria *</label>
                        <div class="invalid-feedback" style="text-align: start">
                            Este campo é obrigatório.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <select class="form-select"  name="service-type" id="service-type" required>
                        <option selected>Tipo de serviço afetado *</option>
                    </select>
                    <div class="invalid-feedback" style="text-align: start">
                        Este campo é obrigatório.
                    </div>
                </div>
                <div class="col">
                    <select class="form-select" name="manifestation-type" id="manifestation-type" required>
                        <option selected>Tipo de manifestação *</option>
                    </select>
                    <div class="invalid-feedback" style="text-align: start">
                        Este campo é obrigatório.
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <div id="attachments" class="input-group">
                        <label class="input-group-text" for="attachments">Anexos</label>
                        <input type="file" class="form-control rounded-end" id="attachments" multiple="multiple" required>
                        <div class="invalid-feedback" style="text-align: start" id="invalid-attachment">
                            É necessário pelo menos um anexo.
                        </div>
                    </div>
                    <div style="text-align: start" class="lead fs-6">
                        * Anexe aqui fotos e documentos referentes à sua ouvidoria <br>
                        * (Permitidos apenas os tipos JPEG e PDF)
                    </div>
                </div>
            </div>

            <div class="row align-items-center m-2 p-2">
                <div class="col">
                    <button type="button" class="btn btn-primary p-2 validate_form" id="create_manifestation_btn">Abrir ouvidoria</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../jquery/jquery.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../jquery/jquery-mask/dist/jquery.mask.js"></script>
<script src="../jquery/jquery-mask/dist/jquery.mask.min.js"></script>

<script src="../js-scripts/general.js"></script>
<script src="../js-scripts/user.js"></script>
<script src="../js-scripts/manifestation.js"></script>
<script src="../js-scripts/manifestation_form.js"></script>
<script src="../js-scripts/forms.js"></script>
</html>