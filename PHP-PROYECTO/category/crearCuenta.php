<?php
include ("../dataAccess/bd.php");

?>

<?php
include ("../dataAccess/crearCuenta_register.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREAR CUENTA</title>

    <link rel="stylesheet" href="../assets/estilos/crearCuenta.css" />

</head>
<body>
    <div id="__next">
     <div class="index_card_container___e1jb" data-testid="login_container">
       <div>
        <div class="index_card_title__TPMcJ">
          <p>Crear cuenta</p><hr>
          </div>
        <div class="index_card_container_mfc__cuDVg">
        <a class="navbar-brand" href="../index.php"><img src="../assets/img/imgIndex/logo.jpg" class= "logo" width="180px" height="85px""></a>
            
        <div class="Login_textContainer__eqP4J">
            
            <p class="Login_titleText__0VKiZ">¡Registrate aqui!</p>
            <p class="Login_paragraphText__ttJgP">Regístrate y disfruta de nuestros beneficios y una experiencia de compra más rápida y sencilla.</p>
        </div>
    
        <div class="Login_formContainer__klZ7f">
          
            <form method="post"> <!--POST es para enviar informacion-->
                <div class="campos">
                    <input type="text" name="nombres" size="40" placeholder="Nombre*" required pattern="[a-zA-ZáéíóúÁÉÍÓÚ\s]+"> 
                </div>
                <div class="campos">
                    <input type="text" name="apellidos" size="40" placeholder="Apellido*" required pattern="[a-zA-ZáéíóúÁÉÍÓÚ\s]+">          
                </div>

                <div class="campos">
                    <input type="text" name="dni" size="40" placeholder="DNI*" required  pattern="\d{8}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8)">          
                </div>
                <div class="campos">
                    <input type="email" name="email" size="40" placeholder="Correo*" required>          
                </div>
                <div class="campos">
                    <input type="text" name="contrasena" size="40" placeholder="Crear contraseña*" required>          
                </div> 

                <div class="index_back_container__OxOQJ">
                    <input type="radio" name="P1" value="1"> He leído y acepto <a href="#"> los términos y condiciones </a>   
                </div>

                <br>
                
                <div class="LoadingButton_contentButton__kYTiC ">
                  <button class="LoadingButton_button__gEXLo LoadingButton_disabledButton__eGE4z" name="signUp" id="signUp" data-testid="login" type="submit">Crear cuenta</button>
                </div>
                
                <div class="index_back_container__OxOQJ">
                   <a class="index_link_back__aCSUN" href="../index.php">Volver al login</a>
                </div>
                
              </form>
            
        </div>

       
       </div>
      </div>
     </div>

     
    

</body>
</html>