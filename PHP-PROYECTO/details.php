<?php
//Configuración y Conexión a la Base de Datos:
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

//Validación de Parámetros id y token:
$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
  echo 'Error al procesar la petición';
  exit;
} else {

  //Verificación del Token:
  $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

  if ($token == $token_tmp) {

    //Consulta de Existencia y Datos del Producto:
    $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
    $sql->execute([$id]);
    if ($sql->fetchColumn() > 0) {
      $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento, id_categoria FROM productos WHERE id=? AND activo=1");
      $sql->execute([$id]);
      $row = $sql->fetch(PDO::FETCH_ASSOC);
      $nombre = $row['nombre'];
      $descripcion = $row['descripcion'];
      $precio = $row['precio'];
      $descuento = $row['descuento'];
      $cate = $row['id_categoria']; // Obtener la categoría del producto

      //Cálculo del Precio con Descuento y Ruta de Imágenes:
      $precio_desc = $precio - (($precio * $descuento) / 100);
      $dir_images = "assets/img/imgindex/" . $cate . "/";

      $rutaImg = $dir_images . $id . ".jpg";

      if (!file_exists($rutaImg)) {
        $rutaImg = "assets/img/imgindex/logo.jpg";
      }

      //Listar Imágenes Adicionales:
      $imagenes = array();
      if (file_exists($dir_images)) {
        $dir = dir($dir_images);

        while (($archivo = $dir->read()) !== false) {
          if ($archivo != $id . '.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
            $imagenes[] = $dir_images . $archivo;
          }
        }
        $dir->close();
      }
    }
  } else {
    echo 'Error al procesar la petición';
    exit;
  }
}

$sql = $con->prepare("SELECT id, nombre, descripcion, precio, id_categoria FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DETAILS</title>

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
  <link rel="stylesheet" href="assets/estilos/index.css" />

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

  <!--Mostrar Detalles del Producto: -->
  <div class="container my-3">
    <div class="row">
      <div class="col-md-6 order-md-1">


        <div class="carousel-item active">
          <img src="<?php echo $rutaImg; ?>" width="200" class="d-block w-50">
        </div>

        <?php foreach ($imagenes as $img) { ?>
          <div class="carousel-item">
            <img src="<?php echo $img; ?>" width="200" class="d-block w-50">
          </div>
        <?php } ?>



      </div>

      <div class="col-md-6 order-md-2">

        <h2><?php echo  $nombre; ?></h2>

        <?php if ($descuento > 0) { ?>

          <p><del><?php echo  MONEDA . number_format($precio, 2, '.', ','); ?></del></p>
          <h2>
            <?php echo  MONEDA . number_format($precio_desc, 2, '.', ','); ?>
            <small class="text-success"><?php echo $descuento; ?>% descuento</small>
          </h2>

        <?php } else { ?>

          <h2><?php echo  MONEDA . number_format($precio, 2, '.', ','); ?></h2>

        <?php } ?>

        <p class="lead">
          <?php echo $descripcion; ?>
        </p>

        <div class="d-grid gap-3 col-10 mx-auto">
          <button class="btn btn-primary" type="button">Comprar ahora</button>
          <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp ?>')">Agregar al Carrito</button>
        </div>

      </div>

    </div>
  </div>

  <br>


  <!-- php - carrusel -->
  <?php
  include("view/carrusel.php");
  ?>

  <!-- php - footer -->0
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
  <!--Script para Agregar al Carrito:-->
  <script>
    function addProducto(id, token) {
      let url = 'clases/carrito.php'

      //Creación de FormData:
      let formData = new FormData()
      formData.append('id', id)
      formData.append('token', token)

      //Realización de la Solicitud Fetch:
      fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'

          //Procesamiento de la Respuesta:
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