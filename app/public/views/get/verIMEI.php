<?php
session_start();

require_once '../../models/Dispositivos.php';
require_once '../../models/Vincular.php';

use Clases\Vincular;
use Clases\Dispositivos;

// rol_id = 1 es perfil root
if ($_SESSION['rol_id'] == 1) :

    $dispositivos = new Dispositivos;
    $selectDispositivos = $dispositivos->selectDispositivos();

    $vinculados = new Vincular;
    $sectVinculados = $vinculados->selectAll();

    // Obtener la URL del servicio Flask desde la variable de entorno
    $GEO_API_BASE_URL = getenv('GEO_API_BASE_URL') ?: $_ENV['GEO_API_BASE_URL'];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buscar por IMEI</title>
        <link href="../css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <style>
        .form-background {
            background-image: url('./static/img/mapa-ciudad.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }
    </style>

    <body class="form-background">
        <div class="container-fluid mt-5">
            <div class="row mb-4 justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card p-4 text-left">
                        <h1 class="text-center mb-4">Consulta Ubicación</h1>
                        <form id="imeiForm">
                            <div class="mb-3">
                                <label for="imei" class="form-label">Selecciona el Dispositivo:</label>
                                <select id="imei" name="imei" class="form-select" required>
                                    <option value="">-- Selecciona un Dispositivo --</option>
                                    <?php foreach ($sectVinculados[2] as $dispositivo) : ?>
                                        <option value="<?= $dispositivo['imei']; ?>">
                                            <?= $dispositivo['titular'] . ' - IMEI: ' . $dispositivo['imei'] . ' - Marca: ' . $dispositivo['marca'] . ' - Modelo: ' . $dispositivo['modelo']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="button" id="gpsNowBtn" class="btn btn-info">Consultar Última Ubicación</button><br>
                                <button type="button" id="gpsByAllBtn" class="btn btn-info">Consultar Historial de Ubicaciones</button><br>
                                <button type="button" id="gpsNowBtn2" class="btn btn-info">PRUEBA Última Ubicación</button><br>
                                <button type="button" id="gpsByAllBtn2" class="btn btn-info">PRUEBA Historial de Ubicaciones</button>
                                <?php include_once '../links/linkPantallas.php' ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Capturar IMEI
            const imeiSelect = document.getElementById('imei');

            // Obtener la URL de la API desde PHP
            const geoApiBaseUrl = "<?= $GEO_API_BASE_URL ?>";

            // Botón para consultar gpsnow
            document.getElementById('gpsNowBtn').addEventListener('click', function() {
                const imei = imeiSelect.value;
                if (imei) {
                    window.location.href = `${geoApiBaseUrl}/gpsnow/${imei}`;

                } else {
                    alert('Por favor, selecciona un IMEI.');
                }
            });

            // Botón para consultar gpsbyall
            document.getElementById('gpsByAllBtn').addEventListener('click', function() {
                const imei = imeiSelect.value;
                if (imei) {
                    window.location.href = `${geoApiBaseUrl}/gpsbyall/${imei}`;
                } else {
                    alert('Por favor, selecciona un IMEI.');
                }
            });

            // PRUEBA Botón para consultar gpsnow
            document.getElementById('gpsNowBtn2').addEventListener('click', function() {
                const imei = imeiSelect.value;
                if (imei) {
                    // Redirigir a gps_request.php con IMEI y acción
                    window.location.href = `../../gps_request.php?imei=${imei}&action=gpsnow2`;
                } else {
                    alert('Por favor, selecciona un IMEI.');
                }
            });

            // PRUEBA Botón para consultar gpsbyall
            document.getElementById('gpsByAllBtn2').addEventListener('click', function() {
                const imei = imeiSelect.value;
                if (imei) {
                    // Redirigir a gps_request.php con IMEI y acción
                    window.location.href = `../../gps_request.php?imei=${imei}&action=gpsbyall2`;
                } else {
                    alert('Por favor, selecciona un IMEI.');
                }
            });
        </script>
        <?php include_once '../../views/footer/footer.php' ?>
    </body>

    </html>

<?php else : ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sin permisos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../style.css">
    </head>

    <body class="form-background">
        <div class="container mt-5 text-center">
            <div class="card p-4">
                <?php include_once '../links/linkSinPermisos.php'; ?>
            </div>
        </div>
    </body>

    </html>
<?php endif ?>