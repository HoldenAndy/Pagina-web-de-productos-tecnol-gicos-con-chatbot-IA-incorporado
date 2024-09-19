<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SABER MAS</title>
    <script src="https://kit.fontawesome.com/24a7aa86be.js" crossorigin="anonymous"></script>

    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/estilos/ubicacion.css" />
  </head>

  <div class="paginaMaps">
    <fieldset class="navegacionMaps">
        <a href="../index.php"><img src="../assets/img/imgIndex/logo.jpg" class="logo" width="280px" height="140px"></a>
    </fieldset>
  </div>

    <section class="nosotros" id="nosotros">
       <h1>¿Quienes somos?</h1>
       <div class="wrapper">
          <div class="contenido">
            <h3>Breve Historia:</h3>
            <p>
                Negocios y Servicios Junior es una empresa constituida fecha, que se dedica a la venta de equipos electrónicos como celulares, 
                audífonos, carcasas, etc. Esta idea nace a partir de la necesidad de un pueblo, en el cual no se ofrecían este tipo de 
                productos, obligando a que los pobladores tengan que viajar hacia la ciudad de Piura para poder adquirir un teléfono celular. 
                Negocios Junior ofrece productos tecnológicos buenos, bonitos y baratos satisfaciendo los diferentes requerimientos de los 
                consumidores.
            </p>
       </div>
       <div class="image-section">
          <img src="../assets/img/imgIndex/local.jpg" width=350px" height="290px">
       </div>
    </section>

    <br>
    <br>

    <div class="mision">
        <h1 class="mision-titleDos">NOSOTROS</h1>
        <div class="card-pro">
          <div class="content">
            <p class="heading">MISION</p>
            <p class="para">
                En nuestra tienda de electrónicos, nos dedicamos a brindar a la comunidad del pueblo un acceso sencillo y práctico 
                a dispositivos tecnológicos de alta calidad. Nuestro objetivo es convertirnos en el lugar favorito de nuestros clientes, 
                ofreciendo una variedad amplia de productos, asesoramiento y un servicio excepcional. De esta manera, contribuimos al 
                progreso y la comodidad de nuestra comunidad.
            </p>
          </div>
        </div>
        <div class="card-pro">
          <div class="content">
            <p class="heading">VISION</p>
            <p class="para">
                Convertirnos en el principal recurso tecnológico del pueblo, donde cada persona encuentra opciones innovadoras, 
                productos de confianza y atención personalizada. Nos esforzamos por ser vistos como colaboradores esenciales que 
                simplifican el acceso y la integración de la tecnología, mejorando así el bienestar de nuestros clientes y promoviendo 
                el progreso digital en nuestra comunidad.
            </p>
          </div>
        </div>
    </div>

    <br>

    <div class="maps">
       <fieldset class="ubicacion">
          <div class="col">
             <div>
                <iframe class="embed-responsive-item map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1105.708023711029!2d-80.0012079!3d-4.5141687!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x90350f3fe552c9e5%3A0xa8f40fefab4ba33d!2sNegocios%20%22Junior%22!5e1!3m2!1ses-419!2spe!4v1714198588526!5m2!1ses-419!2spe"
                      allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
             </div>
          </div>
      </fieldset>
    </div>

    <br>

<!-- php - carrusel -->
<?php
  include ("view/footer.php");
?>
</body>
</html>