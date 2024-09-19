<?php

require '../config/config.php';
require '../config/database.php';
require '../clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];
if (!empty($_POST)) {
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['contrasena']); // Corrected line

    if (esNulo([$usuario, $password])) {
        $errors[] = "Debe llenar todos los campos";
    }
    if (count($errors) == 0) {
        $errors[] = login($usuario, $password, $con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREAR CUENTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/estilos/crearCuenta.css">
</head>

<body>
    <?php mostrarMensajes($errors); ?>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-header text-center">
                <p>Iniciar sesión</p>
                <hr>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <a class="navbar-brand" href="../index.php">
                        <img src="../assets/img/imgIndex/logo.jpg" class="logo" width="180" height="85">
                    </a>
                    <p class="h5">¡Bienvenido de nuevo!</p>
                    <p>Ingresa tu usuario y contraseña para iniciar sesión.</p>
                </div>
                <form method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario*" required>
                        <label for="usuario">Usuario</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="contrasena" id="password" placeholder="Contraseña*" required>
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="mb-3 text-center">
                        <a href="recupera.php">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" name="login" id="login" type="submit">Iniciar sesión</button>
                    </div>
                    <div class="mt-3 text-center">
                        <p>No te encuentras registrado?</p>
                        <a href="Registrar.php">Crear cuenta</a>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="../index.php">Salir</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
