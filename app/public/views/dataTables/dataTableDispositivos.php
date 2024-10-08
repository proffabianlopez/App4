<?php
session_start();
require_once '../../models/Dispositivos.php';

use Clases\Dispositivos;

$dispositivos = new Dispositivos;

$dataTable = $dispositivos->selectDispositivos();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Dispositivos</title>
    <!-- Vincular Bootstrap y el archivo CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<style>
	table th, table td {
    	text-align: center; /* Centrar el contenido de las celdas */
	}

	table td:last-child {
    	white-space: nowrap; /* Evitar que el texto se rompa en varias líneas */
	}
</style>

<body class="form-background">
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h3 class="text-center">Consulta de Dispositivos</h3>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>IMEI</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataTable[2] as $key => $value) : ?>
                                <tr>
                                    <td><?php echo $value['id'] ?></td>
                                    <td><?php echo $value['marca'] ?></td>
                                    <td><?php echo $value['modelo'] ?></td>
                                    <td><?php echo $value['imei'] ?></td>
									<td>
										<a href="../get/verDispositivos.php?id=<? echo $value['id'] ?>" class="btn btn-info btn-sm">Ver</a>
										<a href="../edit/editarDispositivos.php?id=<? echo $value['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
										<a href="../delete/deleteDispositivos.php?id=<? echo $value['id'] ?>" class="btn btn-danger btn-sm">Borrar</a>
									</td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>