<header>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light navbar-light">
      <div class="container-logo">
        <a class="navbar-brand" href="index.php"><img src="assets/img/imgIndex/logo.jpg"  class= "logo"  width="190px" height="90px""></a><!--para que apereza el logo como encabezado del formulario-->
      </div>

      <div class="container-apps">
        <a class="nav-link" href="https://www.instagram.com/"> <img src= "assets/img/imgIndex/instagramLogo.jpg" width="40" align="40"></a> <!--boton para ir a instagram-->        
        <a class="nav-link" href="https://es-la.facebook.com/"> <img src= "assets/img/imgIndex/facebookLogo.jpg" width="40" align="40"></a> <!--boton para ir a facebook-->    
      </div>      

      <!-- Botón para colapsar la barra de navegación en dispositivos pequeños -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Contenido de la barra de navegación -->
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <div class="container-busqueda">
              <li class="nav-item">
              <form class="form-inline my-2 my-lg-0" id="search-form">
  <div class="busqueda">
    <input class="form-control mr-sm-2 buscar" id="buscadorr" type="search" placeholder="Buscar..." aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
      <img src=" assets/img/imgIndex/botonBuscar.png" width="20" align="20">
    </button>
  </div> 
</form>

              </li>
            </div>
           
            <div class="container-servicios">  
              <a class="nav-link" href="https://web.whatsapp.com/"> <img src= "assets/img/imgIndex/ayuda.png" class="imgAyuda" width="40" align="40"></a> 
              <a class="nav-link" href="category/inicioSesion.php"> <img src= "assets/img/imgIndex/miCuenta.jpg" class="imgCuenta" width="40" align="40"> </a>     
              
    <div>
      <lu>
        <li class="submenu">
              <a class="nav-link" href="carrito.php"><img src= "assets/img/imgIndex/miCarrito.png" class="imgCarrito" width="40" align="40">
              <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a>

              <div id="carrito">
                <table id="lista-carrito" class="tabla-carrito">
                  <thead>
                    <tr>
                      <th>Imagen</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
                <a href="#" id="vaciar-carrito" class="btn-3">vaciar Carrito</a>
              </div>
        </li>
      </lu>
    </div>        
            </div>
        </ul>
      </div>
    </nav>
  </div>
 </header>