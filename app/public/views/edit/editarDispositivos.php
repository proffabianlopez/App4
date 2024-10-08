<?php
session_start();
require_once '../../models/Dispositivos.php';

use Clases\Dispositivos;

if ($_SESSION['rol_id'] == 1) :

	$dispositivos = new Dispositivos;
	$dispositivos = $dispositivos->selectOneDispositivo($_GET['id']);
?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editar Dispositivo</title>
		<!-- Vincular Bootstrap y el archivo CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../css/style.css">
	</head>

	<body class="form-background"> <!-- Aplicamos la clase para el fondo -->
		<div class="container mt-4">
			<div class="row justify-content-center">
				<div class="col-md-5">
					<div class="card p-3">
						<h3 class="text-center">Editar Dispositivo</h3>
						<form action="../../controllers/scriptDispositivos.php" method="post">
							<div class="mb-3">
								<label for="marca" class="form-label">Marca:</label>
								<input type="text" name="marca" class="form-control" value="<?php echo trim($dispositivos[2]['marca']) ?>" required>
							</div>
							<div class="mb-3">
								<label for="modelo" class="form-label">Modelo:</label>
								<input type="text" name="modelo" class="form-control" value="<?php echo trim($dispositivos[2]['modelo']) ?>" required>
							</div>
							<div class="mb-3">
								<label for="imei" class="form-label">IMEI:</label>
								<input type="text" name="imei" class="form-control" value="<?php echo $dispositivos[2]['imei'] ?>" required>
							</div>
							<div class="text-center">
								<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
								<input type="submit" name="updateDispositivo" value="Editar" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Vincular Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>
<?php else : ?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sin permisos</title>
		<!-- Vincular Bootstrap y el archivo CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../css/style.css">
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