<?php


require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if ($productos  != null) {
    foreach ($productos as $clave  =>  $cantidad) {

        $sql = $con->prepare("SELECT id, nombre, descripcion, precio, descuento, $cantidad AS cantidad FROM productos WHERE 
       id=?  AND  activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("location: index.php");
    exit;
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



    <div class="container my-3">
        <div class="row">
            <div class="col-6">
                <h4>Detalles de pago </h4>
                <div id="paypal-button-container"></div>
            </div>
            <div class="col-6">
                <section class="conte" id="lista-1">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Productos</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if ($lista_carrito  == null) {

                                    echo '<td> <td colspan="6" class="text-center"> <br>Lista vacia</br> </td> </td>';
                                } else {
                                    $total = 0;
                                    foreach ($lista_carrito as $producto) {
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
                                            <td>
                                                <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA .
                                                                                                                number_format($subtotal, 2, '.', ','); ?></div>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <td colspan="2">
                                            <p class="h3 text-end" id="total"><?php echo MONEDA . number_format(
                                                                            $total,
                                                                            2,
                                                                            '.',
                                                                            ','
                                                                        ); ?></p>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php } ?>
                        </table>
                    </div>

            </div>
        </div>
        </section>

    </div>

    <br>

    <!-- php - footer -->
    <?php
    include("view/footer.php");
    ?>

    <!-- ------------------------------------------------------------------- -->
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>

    <script>
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $total;?>
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                let URL= 'clases/captura.php'
                actions.order.capture().then(function(detalles) {
                    console.log(detalles)

                    let url = 'clases/captura.php'

                    return fetch(url, {
                        method: 'post',
                        headers: {
                            'content-type':'application/json'
                        },
                        body: JSON.stringify({
                            detalles: detalles
                        })
                    }).then(function(response){
                        window.location.href = "completado.php?key=" + detalles ['id'];
                    })
                  
                });
            },
            onCancel: function(data) {
                alert("pago cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container')
    </script>

    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/btnCarrito.js"></script>
    <script src="assets/js/carrito.js"></script>
    <script src="assets/js/buscar.js"></script>

    <!-- ------------------------------------------------------------------- -->

</body>

</html>