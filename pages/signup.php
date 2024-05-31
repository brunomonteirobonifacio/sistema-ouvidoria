<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Crie uma conta</title>
</head>
<body>
    <!-- TODO: Find a way to text-start invalid-feedback messages -->
    <div class="container text-center p-3 mx-auto my-3 border rounded w-50">
        <div class="row align-items-center m-2 d-inline-flex">
            <div class="col">
                <h1 class="m-2 pd-2 display-2">Criar conta</h1>
                <hr>
            </div>
        </div>
        
        <form method="post" class="needs-validation" novalidate>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" require>
                        <label for="name">Nome Completo</label>
                        <div class="invalid-feedback" style="text-align: start">
                            Por favor, digite seu nome completo.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="email" name="email" id="email" class="form-control" autocomplete="off" require>
                        <label for="email">Endereço de E-mail</label>
                        <div class="invalid-feedback" id="invalid-email" style="text-align: start">
                            Digite um endereço de E-mail válido.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="phone" id="phone" class="form-control phone" autocomplete="off" require>
                        <label for="phone">Telefone</label>
                        <div class="invalid-feedback" id="invalid-phone" style="text-align: start">
                            Digite um número de telefone válido.
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="whatsapp" id="whatsapp" class="form-control phone" autocomplete="off" require>
                        <label for="whatsapp">Número WhatsApp</label>
                        <div class="invalid-feedback" id="invalid-whatsapp" style="text-align: start">
                            Digite um número WhatsApp válido.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="cpf" id="cpf" class="form-control cpf" autocomplete="off" require>
                        <label for="cpf">CPF</label>
                        <div class="invalid-feedback" id="invalid-cpf" style="text-align: start">
                            Digite um CPF válido.
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="date" name="birthdate" id="birthdate" class="form-control" autocomplete="off" require>
                        <label for="birthdate">Data de Nascimento</label>
                        <div class="invalid-feedback" style="text-align: start">
                            É necessário ter mais de 18 anos para realizar o cadastro.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <select class="form-select"  name="state" id="state">
                        <option selected>Estado</option>
                    </select>
                    <div class="invalid-feedback" style="text-align: start">
                            Por favor, escolha seu estado.
                    </div>
                </div>
                <div class="col">
                    <select class="form-select" name="city" id="city" disabled>
                        <option selected>Cidade</option>
                    </select>
                    <div class="invalid-feedback" style="text-align: start">
                            Por favor, escolha sua cidade.
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control" autocomplete="off" require>
                        <label for="password">Senha</label>
                        <div class="invalid-feedback" id="invalid-password" style="text-align: start" autocomplete="off" require>
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
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                        <label for="confirm_password">Confirme sua Senha</label>
                    </div>
                </div>
            </div>

            <div class="row align-items-center m-2 p-2">
                <div class="col">
                    <button type="button" class="btn btn-primary p-2 validate_form" name="signup_btn" id="signup_btn">Cadastrar-se</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  <script src="../jquery/jquery.js"></script>
  <script src="../jquery/jquery-mask/dist/jquery.mask.js"></script>
  <script src="../jquery/jquery-mask/dist/jquery.mask.min.js"></script>
  
  <script src="../js-scripts/masks.js"></script>
  <script src="../js-scripts/forms.js"></script>
  <script src="../js-scripts/forms_validation.js"></script>
  <script src="../js-scripts/user.js"></script>
</html>