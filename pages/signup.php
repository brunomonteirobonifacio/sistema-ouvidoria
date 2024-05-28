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
    <div class="container px-auto">
        <h1 class="m-2 p-2">Criar conta</h1>
        
        <form action="" method="post" class="">

            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="nome" id="nome" class="form-control">
                        <label for="nome">Nome Completo</label>
                    </div>
                </div>
            </div>
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="email" name="email" id="email" class="form-control">
                        <label for="email">Endereço de E-mail</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="telefone" id="telefone" class="form-control fone">
                        <label for="telefone">Telefone</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="whastapp" id="whatsapp" class="form-control celular">
                        <label for="whatsapp">Número WhatsApp</label>
                    </div>
                </div>
            </div>

            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" name="cpf" id="cpf" class="form-control cpf">
                        <label for="cpf">CPF</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="date" name="data_nasc" id="data_nasc" class="form-control">
                        <label for="data_nasc">Data de Nascimento</label>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-start m-2">
                <div class="col">
                    <select class="form-select" aria-label="Default select example" name="estado" id="estado">
                        <option selected>Estado</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" aria-label="Default select example" name="cidade" id="cidade" disabled>
                        <option selected>Cidade</option>
                    </select>
                </div>
            </div>

            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="password" name="senha" id="senha" class="form-control">
                        <label for="nome">Senha</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="password" name="confirma_senha" id="confirma_senha" class="form-control">
                        <label for="nome">Confirme sua Senha</label>
                    </div>
                </div>
            </div>

            <div class="row align-items-center m-2">
                <div class="col">
                    <button type="button" class="btn btn-primary" name="signup_btn">Criar conta</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../js/masks.js"></script>
  <script src="../js/forms.js"></script>
</html>