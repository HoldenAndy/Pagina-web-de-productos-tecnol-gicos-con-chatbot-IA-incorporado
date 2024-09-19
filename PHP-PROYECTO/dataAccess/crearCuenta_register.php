<?php
if (isset($_POST['signUp'])) {
    include 'bd.php';
    session_start();

    // Obtenemos los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT); // Aplicamos hash BCRYPT a la contraseña

    // Verificamos si el correo electrónico ya existe en la base de datos
    $checkEmail = "SELECT * FROM usuario WHERE email='$email'";
    $result = $conn->query($checkEmail);
    

    if ($result->num_rows > 0) {
        echo '
        <script>
            alert("¡El correo electrónico proporcionado ya existe!.");
            window.location="../category/crearCuenta.php";
        </script>
    ';
        exit();
    } else {
        // Insertar los datos del usuario en la base de datos
        $insertQuery = "INSERT INTO usuario (nombres, apellidos, dni, email, contrasena)
                        VALUES ('$nombres', '$apellidos', '$dni', '$email', '$hashed_password')";
        if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['nombreUser'] = $nombre;
            header("location: ../category/inicioSesion.php");
            exit(); // Terminamos el script después de redireccionar
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
