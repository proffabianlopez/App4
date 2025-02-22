<?php
session_start();
require_once '../../models/Personas.php';

use Clases\Personas;

if ($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == 2 || $_SESSION['rol_id'] == null) :

	$personas = new Personas;

	$personas = $personas->selectOne($_GET['id']);
	$nombre_completo = explode(",", $personas[2]['titular']);
?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editar Personas</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../css/style.css">
	</head>

	<body class="form-background">
		<div class="container-fluid mt-5">
			<div class="row mb-4 justify-content-center">
				<div class="col-12 col-md-6 col-lg-4">
					<div class="card p-4 text-left">
						<h3 class="text-center">Editar Persona</h3>
						<form action="../../controllers/scriptPersonas.php" method="post">
							<div class="mb-3">
								<label for="nombre" class="form-label">Nombre:</label>
								<input type="text" name="nombre" class="form-control" value="<?php echo trim($nombre_completo[0]) ?>" required>
							</div>
							<div class="mb-3">
								<label for="apellido" class="form-label">Apellido:</label>
								<input type="text" name="apellido" class="form-control" value="<?php echo trim($nombre_completo[1]) ?>" required>
							</div>
							<div class="mb-3">
								<label for="email" class="form-label">Correo electrónico:</label>
								<input type="email" name="email" class="form-control" value="<?php echo $personas[2]['email'] ?>" required>
							</div>
							<div class="mb-3">
								<label for="dni" class="form-label">Número de DNI:</label>
								<input type="number" name="dni" class="form-control" value="<?php echo $personas[2]['dni'] ?>" required>
							</div>
							<div class="mb-3">
								<label for="telefono" class="form-label">Teléfono:</label>
								<input type="text" name="telefono" class="form-control" value="<?php echo $personas[2]['phone'] ?>" required>
							</div>
							<div class="mb-3">
								<label>Género:</label>
								<div>
									<label for="sex" class="form-check-label">Masculino</label>
									<input type="radio" name="sex" value="M" class="form-check-input" required style="margin-right: 20px;" <?php echo ($personas[2]['gender'] == "M") ? "checked" : ""; ?>>
									<label for="sex" class="form-check-label">Femenino</label>
									<input type="radio" name="sex" value="F" class="form-check-input" required style="margin-right: 20px;" <?php echo ($personas[2]['gender'] == "F") ? "checked" : ""; ?>>
									<label for="sex" class="form-check-label">X</label>
									<input type="radio" name="sex" value="X" class="form-check-input" <?php echo ($personas[2]['gender'] == "X") ? "checked" : ""; ?>>
								</div>
							</div>
							<div class="mb-3">
								<label for="direccion" class="form-label">Dirección:</label>
								<input type="text" name="direccion" class="form-control" value="<?php echo $personas[2]['addresses'] ?>" required>
							</div>
							<div class="mb-3">
								<label for="pais" class="form-label">País:</label>
								<input type="text" name="pais" class="form-control" value="<?php echo $personas[2]['country'] ?>" required>
							</div>
							<div class="text-center">
								<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
								<input type="submit" name="updatePersonas" value="Editar" class="btn btn-warning">
								<br><br><a href="/views/dataTables/dataTablePersonas.php" class="btn btn-info">Ir a Consulta de Personas</a>
								<?php include_once '../links/linkPantallas.php' ?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php include_once '../../views/footer/footer.php' ?>
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
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../css/style.css">
	</head>

	<body class="form-background">
		<div class="container mt-5 text-center">
			<div class="card p-4">
				<nav><?php include_once '../links/linkSinPermisos.php'; ?></nav>
			</div>
		</div>
	</body>

	</html>
<?php endif ?>