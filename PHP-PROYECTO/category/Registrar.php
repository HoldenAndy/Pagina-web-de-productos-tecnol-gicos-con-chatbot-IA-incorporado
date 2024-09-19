<?php

require '../config/config.php';
require '../config/database.php';
require '../clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];
if (!empty($_POST)) {
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $dni = trim($_POST['dni']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if (esNulo([$nombres, $apellidos, $email, $telefono, $dni, $usuario, $password, $repassword])) {
        $errors[] = "Debe llenar todos los campos";
    }
    if (esEmail($email)) {
        $errors[] = "La dirección de correo no es válida";
    }

    if (validaPassword($password, $repassword)) {
        $errors[] = "Las contraseñas no coinciden";
    }
    if (usuarioExiste($usuario, $con)) {
        $errors[] = "El nombre de usuario $usuario ya existe";
    }
    if (emailExiste($email, $con)) {
        $errors[] = "El correo electrónico $email ya existe";
    }
    if (count($errors) == 0) {
        $id = registraCliente([$nombres, $apellidos, $email, $telefono, $dni], $con);

        if ($id > 0) {
            require '../clases/Mailer.php';
            $mailer = new Mailer();
            $token = generarToken();
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            $idUsuario = registraUsuario([$usuario, $pass_hash, $token, $id], $con);
            if ($idUsuario > 0) {
                $url = SITE_URL . '/activa_cliente.php?id=' . $idUsuario . '&token=' . $token;
                http: //localhost/ProyectoFinalTallerWeb/PHP-PROYECTO/activa_cliente.php?id=13&token=65ee5369fd66fced3a2d81a333ed209d  
                $asunto = "Activar cuenta - Tienda online";
                $cuerpo = "estimado $nombres: <br> Para continuar con el proceso de registro es indispensable de click 
            en la siguiente liga <a href ='$url'>Activar Cuenta</a>";


                if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                    echo "Para terminar este reistro sigan las instrucciones que le hemos enviado ala direccion de 
                    correo electronico $email";
                    exit;
                }
            } else {
                $errors[] = "Error al registrar usuario";
            }
        } else {
            $errors[] = "Error al registrar cliente";
        }
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
    <link rel="stylesheet" href="../assets/estilos/crearCuenta.css" />
</head>

<body>
    <?php mostrarMensajes($errors); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Crear cuenta</h3>
                        <hr>
                    </div>
                    <div class="card-body">
                        <a class="navbar-brand" href="../index.php"><img src="../assets/img/imgIndex/logo.jpg" class="logo" width="180px" height="85px"></a>
                        <p class="text-center">¡Regístrate aquí!</p>
                        <p class="text-center">Regístrate y disfruta de nuestros beneficios y una experiencia de compra más rápida y sencilla.</p>

                        <form action="Registrar.php" method="post" autocomplete="off">
                            <div class="mb-3">
                                <label for="nombres" class="form-label">Nombres <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombre" required pattern="[a-zA-ZáéíóúÁÉÍÓÚ\s]+">
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellido" required pattern="[a-zA-ZáéíóúÁÉÍÓÚ\s]+">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Correo" required>
                                <span id="validaEmail" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" required>
                            </div>
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="dni" id="dni" placeholder="DNI" required pattern="\d{8}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8)">
                            </div>
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
                                <span id="validaUsuario" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Crear contraseña <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Crear contraseña" required>
                            </div>
                            <div class="mb-3">
                                <label for="repassword" class="form-label">Repetir contraseña <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Repetir contraseña" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="radio" class="form-check-input" name="P1" value="1" required>
                                <label class="form-check-label">He leído y acepto <a href="#">los términos y condiciones</a></label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Crear cuenta</button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="../index.php">Volver al login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let txtusuario = document.getElementById('usuario')
        txtusuario.addEventListener("blur", function() {
            existeUsuario(txtusuario.value)
        }, false)

        let txtEmail = document.getElementById('email')
        txtEmail.addEventListener("blur", function() {
            existeEmail(txtEmail.value)
        }, false)

        function existeEmail(email) {
            let url = "../clases/clienteAjax.php"
            let formData = new FormData()
            formData.append("action", "existeEmail")
            formData.append("email", email)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(Response => Response.json())
                .then(data => {
                    if (data.ok) {
                        document.getElementById('email').value = ''
                        document.getElementById('validaEmail').innerHTML = 'Email no disponible'
                    } else {
                        document.getElementById('validaEmail').innerHTML = ''
                    }

                })
        }

        function existeUsuario(usuario) {
            let url = "../clases/clienteAjax.php"
            let formData = new FormData()
            formData.append("action", "existeUsuario")
            formData.append("usuario", usuario)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(Response => Response.json())
                .then(data => {
                    if (data.ok) {
                        document.getElementById('usuario').value = ''
                        document.getElementById('validaUsuario').innerHTML = 'Usuario no disponible'
                    } else {
                        document.getElementById('validaUsuario').innerHTML = ''
                    }

                })
        }
    </script>
</body>

</html>