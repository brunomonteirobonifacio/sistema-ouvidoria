<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Entrar</title>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="loginModalLabel">...</h1>
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

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
      <a class="navbar-brand" href="../">Ouvidoria Municipal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="../">Início</a>
            <a class="nav-link" href="create_manifestation.php">Criar ouvidoria</a>
            <a class="nav-link" href="view_manifestation.php">Visualizar suas ouvidorias</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container text-center p-3 mx-auto my-3 border border-dark-subtle rounded w-50">
        <div class="row align-items-center m-2 d-inline-flex">
            <div class="col">
                <h1 class="m-2 pd-2 display-2 border-dark-subtle border-bottom">Entrar</h1>
            </div>
        </div>
        
        <form method="post" class="needs-validation">
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="email" name="email" id="email" class="form-control" required>
                        <label for="email">Endereço de E-mail</label>
                        <div class="invalid-feedback" style="text-align: start" id="invalid-email">
                                Digite seu endereço de E-mail.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <label for="nome">Senha</label>
                        <div class="invalid-feedback" style="text-align: start" id="invalid-password">
                                Digite sua senha.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center m-2">
                <div class="col">
                    <button type="button" class="btn btn-primary" id="login_btn">Entrar</button>
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
<script src="../js-scripts/forms.js"></script>
<script src="../js-scripts/forms_validation.js"></script>
<script src="../js-scripts/user.js"></script>

<script src="../js-scripts/login_form.js"></script>

</html>