<?php


require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, descripcion, precio, id_categoria FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

//session_destroy();

print_r($_SESSION);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INDEX</title>

  <!-- ------------------------------------------------------------------- -->

  <!-- Logos -->
  <script src="https://kit.fontawesome.com/24a7aa86be.js" crossorigin="anonymous"></script>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/estilos/car.css" />

  <!-- ------------------------------------------------------------------- -->
</head>

<body>


  <!-- php - anuncioUno -->
  <?php
  include("view/anuncioUno.php");
  ?>

  <!-- php - header -->
  <?php
  include("view/header.php");
  ?>
  <!-- php - nav -->
  <?php
  include("view/nav.php");
  ?>

  <!-- php - anuncioDos -->
  <?php
  include("view/anuncioDos.php");
  ?>

  <div class="container my-3">
    <section class="conte" id="lista-1">

      <div class="conteproductos"> <!--insertar estilo css a un bloque de elementos-->

        <?php foreach ($resultado as $row) { ?>
          <div class="productos">
            <span class="titulopro"><?php echo $row['nombre']; ?> </span>
            <?php
            $cate = $row["id_categoria"];
            $id =  $row["id"];
            $imagen = "assets/img/imgindex/" . $cate . "/" . $id . ".jpg";

            if (!file_exists($imagen)) {
              $imagen = "assets/img/imgindex/logo.jpg";
            }
            ?>
            <div class="btnGroup"> 
              <a href="details.php?id=<?php echo $row['id']; ?>& token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btnPrimary">
                <img src="<?php echo $imagen; ?>" alt="" class="proimagen card-img-top">
              </a>
            </div>
            <span class="modelopro"><?php echo $row['descripcion']; ?></span>
            <span class="preciopro"><?php echo number_format($row['precio'], 2, '.', ','); ?></span>
            <!-- <button class="carritopro">Agregar al Carrito</button> -->
            <button class="btn btn-outline-primary carritopro" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar al Carrito</button>
          </div>
        <?php } ?>

        <!--
    <div class="productos">
     <span class="titulopro">HONOR</span>
     <img src="assets/img/imgindex/imgPromos/HONORMAGIC5LITE5G.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">HONOR MAGIC 5 LITE 5G 6.67" 8GB+256GB GREEN EMERALD</span>
     <span class="preciopro">S/1,199</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">APPLE</span>
     <img src="assets/img/imgindex/imgPromos/APPLEIPHONE15.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">CELULAR SMARTPHONE APPLE IPHONE 15 6.1" 128 GB AZUL - IOS</span>
     <span class="preciopro">S/4,299</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">XIAOMI</span>
     <img src="assets/img/imgindex/imgPromos/XIAOMIREDMI13C.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">SMARTPHONE XIAOMI REDMI 13C 256GB 8GB RAM - NAVY BLUE</span>
     <span class="preciopro">S/629.00</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">SAMSUNG</span>
     <img src="assets/img/imgindex/imgPromos/SAMSUNGGALAXYS24+.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">SMARTPHONE SAMSUNG GALAXY S24+ 512GB - ONYX BLACK</span>
     <span class="preciopro">S/5,298</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">SAMSUNG</span>
     <img src="assets/img/imgindex/imgPromos/SAMSUNGGALAXYA55.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">SAMSUNG GALAXY A55 5G 256GB+8GB RAM-LIGHT VIOLET</span>
     <span class="preciopro">S/1,699</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">HONOR</span>
     <img src="assets/img/imgindex/imgPromos/HONORX6A.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">SMARTPHONE HONOR X6A 4GB+128GB MIDNIGHT BLACK</span>
     <span class="preciopro">S/569.00</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">OPPO</span>
     <img src="assets/img/imgindex/imgPromos/OPPOA78.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">CELULAR OPPO A78 5G 128 GB + 4GB RAM BLACK</span>
     <span class="preciopro">S/699.00</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">MOTOROLA</span>
     <img src="assets/img/imgindex/imgPromos/MOTOROLAMOTOEDGE30NEO.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">MOTOROLA MOTO EDGE 30 NEO 6" 8GB 128MB 64MP+13MP NEGRO</span>
     <span class="preciopro">S/899.00</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">XIAOMI</span>
     <img src="assets/img/imgindex/imgPromos/XIAOMIREDMINOTE13PRO.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">XIAOMI REDMI NOTE 13 PRO 256GB+8GBRAM -FOREST GREEN</span>
     <span class="preciopro">S/1,249</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">MOTOROLA</span>
     <img src="assets/img/imgindex/imgPromos/MOTOROLAMOTOG04.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">MOTOROLA MOTO G04 4+128GB NARANJA AMANECER</span>
     <span class="preciopro">S/429.00</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>

    <div class="productos">
     <span class="titulopro">OPPO</span>
     <img src="assets/img/imgindex/imgPromos/OPPOA38.jpg" alt="" class= "proimagen card-img-top">  
     <span class="modelopro">CELULAR SMARTPHONE OPPO A38 6.56" 4 + 128GB NEGRO</span>
     <span class="preciopro">S/729.00</span>
     <button class="carritopro">Agregar al Carrito</button>
    </div>
-->

      </div>

      <!-- php - carrito -->


    </section>

  </div>

  <br>


  <!-- php - carrusel -->
  <?php
  include("view/carrusel.php");
  ?>

  <!-- php - footer -->
  <?php
  include("view/footer.php");
  ?>

  <!-- ------------------------------------------------------------------- -->
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <!-- Custom JS -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/btnCarrito.js"></script>
  <script src="assets/js/carrito.js"></script>
  <script src="assets/js/buscar.js"></script>

  <!-- ------------------------------------------------------------------- -->
  <script>
    function addProducto(id, token) {
      let url = 'clases/carrito.php'
      let formData = new FormData()
      formData.append('id', id)
      formData.append('token', token)

      fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'
        }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            let elemento = document.getElementById("num_cart")
            elemento.innerHTML = data.numero

          }

        })
    }
  </script>


</body>

</html>