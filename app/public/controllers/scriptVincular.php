<?php
session_start();
require_once '../models/Vincular.php';
require_once '../utils/utils.php';

use Clases\Vincular;

$asociar = new Vincular();
$message = "";

if (isset($_POST['vincular'])) {

    $asociar->setPeople($_POST['people']);
    $asociar->setDispositivo($_POST['dispositivo']);

    $result = $asociar->insert();
    $message = validarResonseQuery($result);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Resultado de Operaciones</title>
</head>

<body class="form-background">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <form action="../../controllers/scriptSession.php" method="post">
                        <div class="text-center">
                            <p>
                                <?php if (!empty($message)): ?>
                            <div class="alert alert-info text-center">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        </p>
                        <a href="../views/forms/formVincular.php" class="btn btn-info">Ir a Vincular dispositivos</a>
                        <br><br><a href="../views/dataTables/dataTableVinculados.php" class="btn btn-info">Ir a Consulta de Vinculados</a>
                        <?php include_once '../views/links/linkPantallas.php' ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>