<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Crie uma conta - Ouvidoria Pública</title>
</head>
<body>
    <?php
        // checks if the user is already logged in
        session_start();
        if (isset($_SESSION['userId'])) {
            header('location: ../index.php');
        }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="signupModalLabel">...</h1>
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
                        <a class="nav-link active" aria-current="page" href="../">Início</a>
                    </li>
                    <li class="nav-item user-logged" style="display: none;">
                        <a class="nav-link" href="create_manifestation.php">Criar ouvidoria</a>
                    </li>
                    <li class="nav-item user-logged" style="display: none;">
                        <a class="nav-link" href="view_manifestation.php">Minhas ouvidorias</a>
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
                        <a href="" class="nav-link active">Criar conta</a>
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
                <h1 class="m-2 pd-2 display-2 border-bottom border-dark-subtle">Criar conta</h1>
            </div>
        </div>
        
        <form method="post" id="signup" class="needs-validation" novalidate>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                        <label for="name" class="text-dark">Nome Completo *</label>
                        <div class="invalid-feedback" style="text-align: start">
                            Por favor, digite seu nome completo.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="email" name="email" id="email" class="form-control" autocomplete="off" required>
                        <label for="email" class="text-dark">Endereço de E-mail *</label>
                        <div class="invalid-feedback" id="invalid-email" style="text-align: start">
                            Digite um endereço de E-mail válido.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="phone" id="phone" class="form-control phone" autocomplete="off" required>
                        <label for="phone" class="text-dark">Telefone *</label>
                        <div class="invalid-feedback" id="invalid-phone" style="text-align: start">
                            Digite um número de telefone válido.
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="whatsapp" id="whatsapp" class="form-control phone" autocomplete="off" required>
                        <label for="whatsapp" class="text-dark">Número WhatsApp *</label>
                        <div class="invalid-feedback" id="invalid-whatsapp" style="text-align: start">
                            Digite um número WhatsApp válido.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="cpf" id="cpf" class="form-control cpf" autocomplete="off" required>
                        <label for="cpf" class="text-dark">CPF *</label>
                        <div class="invalid-feedback" id="invalid-cpf" style="text-align: start">
                            Digite um CPF válido.
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="date" name="birthdate" id="birthdate" class="form-control" autocomplete="off" required>
                        <label for="birthdate" class="text-dark">Data de Nascimento *</label>
                        <div class="invalid-feedback" id="invalid-date" style="text-align: start">
                            É necessário ter mais de 18 anos para realizar o cadastro.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <select class="form-select"  name="state" id="state" required>
                        <option selected>Estado (selecione)*</option>
                    </select>
                    <div class="invalid-feedback" style="text-align: start">
                            Por favor, escolha seu estado.
                    </div>
                </div>
                <div class="col">
                    <select class="form-select" name="city" id="city" disabled required>
                        <option selected>Cidade (selecione)*</option>
                    </select>
                    <div class="invalid-feedback" style="text-align: start">
                            Por favor, escolha sua cidade.
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <label for="password" class="text-dark">Senha *</label>
                        <div class="invalid-feedback" id="invalid-password" style="text-align: start">
                            Digite uma senha válida.
                        </div>
                        <p style="text-align: start" class="password_requirements lead fs-6">
                            Sua senha deve conter:
                            <ul style="text-align: start" class="lead fs-6">
                                <li>Pelo menos 8 caracteres</li>
                                <li>Letras maiúsculas e minúsculas</li>
                                <li>Pelo menos um caracter especial</li>
                                <li>Pelo menos um dígito</li>
                            </ul>
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        <label for="confirm_password" class="text-dark">Confirme sua Senha *</label>
                    </div>
                </div>
            </div>

            <div class="row align-items-center m-2 p-2">
                <div class="col">
                    <button type="button" class="btn btn-primary p-2 validate_form" id="signup_btn">Cadastrar-se</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../jquery/jquery.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../jquery/jquery-mask/dist/jquery.mask.js"></script>
<script src="../jquery/jquery-mask/dist/jquery.mask.min.js"></script>

<script src="../js-scripts/masks.js"></script>
<script src="../js-scripts/forms_validation.js"></script>
<script src="../js-scripts/general.js"></script>
<script src="../js-scripts/forms.js"></script>
<script src="../js-scripts/user.js"></script>

<script src="../js-scripts/signup_form.js"></script>

</html>