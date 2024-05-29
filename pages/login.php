<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Entrar</title>
</head>
<body>
    <div class="container text-center p-3 mx-auto my-3 border rounded w-50">
        <div class="row align-items-center m-2 d-inline-flex">
            <div class="col">
                <h1 class="m-2 pd-2 display-2">Entrar</h1>
                <hr>
            </div>
        </div>
        
        <form action="" method="post" class="">
            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="email" name="email" id="email" class="form-control">
                        <label for="email">Endereço de E-mail</label>
                    </div>
                </div>
            </div>

            <div class="row align-items-start m-2">
                <div class="col">
                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control">
                        <label for="nome">Senha</label>
                    </div>
                </div>
            </div>

            <div class="row align-items-center m-2">
                <div class="col">
                    <button type="button" class="btn btn-primary" name="login_btn">Entrar</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  <script src="../jquery/jquery-mask/dist/jquery.mask.js"></script>
  <script src="../jquery/jquery-mask/dist/jquery.mask.min.js"></script>
  <script src="../js-scripts/masks.js"></script>
  <script src="../js-scripts/forms.js"></script>
</html>