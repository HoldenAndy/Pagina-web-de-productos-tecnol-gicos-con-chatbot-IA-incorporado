<?php


require 'config/config.php';
require 'config/database.php';
$db = new Database ();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if($productos  != null){
    foreach($productos as $clave  =>  $cantidad){  

       $sql = $con->prepare ("SELECT id, nombre, descripcion, precio, descuento, $cantidad AS cantidad FROM productos WHERE 
       id=?  AND  activo=1");
       $sql->execute([$clave]);
       $lista_carrito []= $sql->fetch(PDO::FETCH_ASSOC);
    }
}

//session_destroy();
//print_r($_SESSION);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARRITO DE COMPRAS</title>

<!-- ------------------------------------------------------------------- -->

<!-- Logos -->
<script src="https://kit.fontawesome.com/24a7aa86be.js" crossorigin="anonymous"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="assets/estilos/car.css"/>

<!-- ------------------------------------------------------------------- -->
 
</head>
<body>


<!-- php - anuncioUno -->
  <?php
  include ("view/anuncioUno.php");
  ?>

<!-- php - header -->
  <?php
  include ("view/header.php");
  ?>

<!-- php - nav -->
  <?php
  include ("view/nav.php");
  ?>



  <div class="container my-3">
   <section class="conte" id="lista-1">
    <div class="table-responsive">

        <table class="table">
            <thead>
                <tr>
                    <th>Productos</th>
                    <th>Caracteristicas</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
  
            <tbody>
                <?php if($lista_carrito  == null)  {

                    echo '<td> <td colspan="6" class="text-center"> <br>Lista vacia</br> </td> </td>';
                 } else {
                    $total = 0;
                    foreach($lista_carrito as $producto) {
                        $_id =  $producto['id'];
                        $nombre =  $producto['nombre'];
                        $descripcion =  $producto['descripcion'];
                        $precio =  $producto['precio'];
                        $descuento =  $producto['descuento'];
                        $cantidad =  $producto['cantidad'];
                        $precio_desc =  $precio - (($precio *  $descuento) / 100);
                        $subtotal =  $cantidad * $precio_desc;
                        $total += $subtotal;
                ?>
                
                <tr>
                    <td><?php echo $nombre; ?></td>
                    <td><?php echo $descripcion; ?></td>
                    <td><?php echo MONEDA . number_format($precio_desc,2, '.', ','); ?></td>
                    <td>
                        <input type="number" min="1" max="10"  step="1" value="<?php echo $cantidad ?>"
                        size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value,<?php echo $_id;?>)">
                    </td>
                    <td>
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . 
                        number_format($subtotal,2, '.', ','); ?></div>
                    </td>

                    <td><a  id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo
                    $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                </tr>
                <?php } ?>

                <tr>
                    <td colspan="4"></td>
                    <td colspan="2">
                        <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', 
                        ','); ?></p>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
<?php if($lista_carrito  != null)  { ?>
    <div class="row">
        <div class="col-md-100 offset-md-9 d-grid gap-5">
            <a href="pago.php" class="btn btn-primary btn-lg">Realizar pago</a>
        </div>
    </div> 
    <?php } ?>
   

   </section>
   
  </div>
   
  <!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="eliminarModalLabel">Alerta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Deseas eliminar el producto de la lista?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id= "btn-elimina"type="button" class="btn btn-danger" onclick="eliminar()">Elimimar</button>
      </div>
    </div>
  </div>
</div>

<br>

<!-- php - footer -->
  <?php
  include ("view/footer.php");
  ?>

<!-- ------------------------------------------------------------------- -->
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<!-- Custom JS -->
<script src="assets/js/main.js"></script>
<script src="assets/js/btnCarrito.js"></script> 
<script src="assets/js/carrito.js"></script>
<script src="assets/js/buscar.js"></script>

<!-- ------------------------------------------------------------------- -->
<script>

    let eliminaModal = document.getElementById('eliminaModal') 
    eliminaModal.addEventListener('show.bs.modal', function(event){
        let button = event.relatedTarget
        let id= button.getAttribute('data-bs-id')
        let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
        buttonElimina.value=id 
    })
    
   function actualizaCantidad (cantidad, id ){
     let url = 'clases/actualizar_carrito.php'
     let formData = new FormData()
     formData.append('action', 'agregar')
     formData.append('id', id)
     formData.append('cantidad', cantidad)

     fetch(url, {
      method: 'POST',
      body: formData,
      mode: 'cors'
     }).then(response => response.json())
     .then(data => {  
      if (data.ok) { 

        let divsubtotal = document.getElementById('subtotal_' + id);
divsubtotal.innerHTML = data.sub;
let total = 0.00;
let list = document.getElementsByName('subtotal[]');

for (let i = 0; i < list.length; i++) {
    total += parseFloat(list[i].innerHTML.replace(/[S/,]/g, ''));
}

total = new Intl.NumberFormat('en-US', {
    minimumFractionDigits: 2
}).format(total);

document.getElementById('total').innerHTML = 'S/ ' + total;

      }

     })
   }

   function eliminar (){
    let botonElimina = document.getElementById('btn-elimina')
    let id = botonElimina.value

     let url = 'clases/actualizar_carrito.php'
     let formData = new FormData()
     formData.append('action', 'eliminar')
     formData.append('id', id)
    
     fetch(url, {
      method: 'POST',
      body: formData,
      mode: 'cors'
     }).then(response => response.json())
     .then(data => {  
      if (data.ok) { 
location.reload()
      }

     })
   }

  </script>

    
</body>
</html>