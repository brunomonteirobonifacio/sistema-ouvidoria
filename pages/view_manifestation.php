<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Visualizar Ouvidorias</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="../">Ouvidoria Municipal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link" aria-current="page" href="../">Início</a>
            <a class="nav-link" href="create_manifestation.php">Criar ouvidoria</a>
            <a class="nav-link active" href="">Visualizar suas ouvidorias</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container p-3 mx-auto my-3">
        <!-- Accordion -->
        <div class="accordion" id="accordionManifestations">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Accordion Item #1
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionManifestations">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
    </div>
</body>
<script src="../jquery/jquery.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../jquery/jquery-mask/dist/jquery.mask.js"></script>
<script src="../jquery/jquery-mask/dist/jquery.mask.min.js"></script>

<script src="../js-scripts/general.js"></script>
<script src="../js-scripts/manifestation.js"></script>
</html>