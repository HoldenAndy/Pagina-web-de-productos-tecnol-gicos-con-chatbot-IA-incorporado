//Variable que mantiene el estado visible del carrito
var carritoVisible = false;

if(document.readyState=='loading'){
    document.addEventListener('DOMContentLoaded', ready)
}else{
    ready();
}

function ready(){
    //funcion de los botones
    var botonesEliminarItem = document.getElementsByClassName('btn-eliminar')
    for(var i=0; i<botonesEliminarItem.length; i++){
        var button = botonesEliminarItem[i];
        button.addEventListener('click', eliminarItemCarrito);
    }    
    //funcionalidad sumar cantidad
    var botonesSumarCantidad = document.getElementsByClassName('sumar-cantidad');
    for (var i=0; i<botonesSumarCantidad.length; i++){
        var button= botonesSumarCantidad [i];
        button.addEventListener('click', sumarCantidad);
    }  

    //funcionalidad restar cantidad
    var botonesRestarCantidad = document.getElementsByClassName('restar-catidad');
    for (var i=0; i < botonesRestarCantidad.length; i++){
        var button  = botonesRestarCantidad [i];
        button.addEventListener('click', restarCantidad);
    }  
    //agregar la funcionalidad a los botones Agregar al carrito
    var botonesAgregarAlCarrito = document.getElementsByClassName ('carritopro');
    for (var i=0; i<botonesAgregarAlCarrito.length; i++){
        var button= botonesAgregarAlCarrito[i];
        button.addEventListener ('click', agregarAlCarritoClicked);
    }

    //Agregar funcionalidad del boton pagar
    document.getElementsByClassName('btn-pagar')[0].addEventListener('click', pagarClicked);
}

function eliminarItemCarrito(event){
    var  buttonClicked = event.target;
    buttonClicked.parentElement.parentElement.remove(); 

    actualizarTotalCarrito();

    //conrolar si hay elementos en el carrito una vez que se elimino
    //si no hay ocultar el carrito
    ocultarCarrito();

}

//actualizar total del carrito
function actualizarTotalCarrito(){
    //seleccionamos el contenedor carrito
    var carritoContenedor = document.getElementsByClassName('carritoMas')[0];
    var carritoItems = carritoContenedor.getElementsByClassName('carrito-item');
    var total = 0;

    for (var i=0; i<carritoItems.length; i++){
        var item = carritoItems [i];
        var precioElemento = item.getElementsByClassName('carrito-item-precio')[0];
        console.log(precioElemento);
        //quitamos el simbolo soles y el punto
        var precio = parseFloat(precioElemento.innerText.replace('S/', '').replace(',', ''));
        console.log(precio);
        var cantidadItem = item.getElementsByClassName('carrito-item-cantidad')[0];
        var cantidad = cantidadItem.value;
        console.log(cantidad);
        total = total + (precio * cantidad);
    }
    total = Math.round(total*100)/100;
    document.getElementsByClassName('carrito-precio-total')[0].innerText = 'S/' + total.toLocaleString("es") + ',00';
}

function ocultarCarrito(){
    var carritoItems = document.getElementsByClassName('carrito-items')[0];
    if(carritoItems.childElementCount ==0){
        var carrito = document.getElementsByClassName('carritoMas')[0];
        carrito.style.marginRight = '-100%';
        carrito.style.opacity='0';
        carritoVisible= false;

        var items = document.getElementsByClassName('conteproductos')[0];
        items.style.width= '100%';
    }  
}

//Aumentar en uno la cantidad
function sumarCantidad(event){
   var buttonClicked = event.target;
   var selector = buttonClicked.parentElement;
   var cantidadActual = selector.getElementsByClassName('carrito-item-cantidad')[0].value;
   console.log(cantidadActual);
   cantidadActual++;
   selector.getElementsByClassName('carrito-item-cantidad') [0].value = cantidadActual;

   //actualizamos el total
   actualizarTotalCarrito();
}

function restarCantidad(event){
    var buttonClicked = event.target;
   var selector = buttonClicked.parentElement;
   var cantidadActual = selector.getElementsByClassName('carrito-item-cantidad')[0].value;
   console.log(cantidadActual);
   cantidadActual--;
   //controlamos que no sea menor que 1
   if (cantidadActual>=1){
   selector.getElementsByClassName('carrito-item-cantidad') [0].value = cantidadActual;
   //actualizamos el total
   actualizarTotalCarrito();
   }
}

function agregarAlCarritoClicked (event){
    var button = event.target;
    var item = button.parentElement;
    var titulo = item.getElementsByClassName ('modelopro') [0].innerText;
    console.log (titulo);
    var precio = item.getElementsByClassName ('preciopro') [0].innerText;
    var imagenSrc = item.getElementsByClassName ('proimagen') [0].src;
    console.log (imagenSrc);

    //Agregar el elemento al carrito
    agregarItemAlCarrito(titulo, precio, imagenSrc);

    //hacer visible del carrito
    hacerVisibleCarrito();
}


function agregarItemAlCarrito (titulo, precio, imagenSrc){
    var item = document.createElement ('div');
    item.classList.add = 'item';
    var itemsCarrito = document.getElementsByClassName ('carrito-items') [0];

    //Verificar si el item ingresado no se encuentran ya en el carrito
    var nombresItemsCarrito = itemsCarrito.getElementsByClassName ('carrito-item-titulo');
    for (var i=0; i< nombresItemsCarrito.length; i++){
        if (nombresItemsCarrito [i].innerText==titulo){
           alert("El items ya se encuentra en el carrito");
           return;

        }    
    }


    var itemCarritoContenido = `

    <div class="carrito-item">
      <img src="${imagenSrc}" alt="" width="60px"height="90"> 
      <div class="carrito-item-detalles">
         <span class="carrito-item-titulo">${titulo}</span>
         <div class="selector-cantidad">
          <i class="fa-solid fa-minus restar-catidad"></i>
          <input type="text" value="1" class="carrito-item-cantidad" disabled>
          <i class="fa-solid fa-plus sumar-cantidad"></i>
      </div>
       <span class="carrito-item-precio">${precio}</span>
      </div>
      <span class="btn-eliminar">
       <i class="fa-solid fa-trash"></i>
      </span>
    </div>
    `
    item.innerHTML= itemCarritoContenido;
    itemsCarrito.append(item);

    //Aggregamos funcionalidad de eliminar al nuevo item
    item.getElementsByClassName('btn-eliminar') [0].addEventListener('click', eliminarItemCarrito);
    
    //Aggregamos funcionalidad de sumar al nuevo item
    var botonSumarCantidad=item.getElementsByClassName('sumar-cantidad')[0];
    botonSumarCantidad.addEventListener('click', sumarCantidad);
   
    
    //Agregamos funcionalidad de restar al nuevo item
    var botonnRestarCantidad = item.getElementsByClassName ('restar-catidad') [0];
    botonnRestarCantidad.addEventListener('click', restarCantidad);

    actualizarTotalCarrito();


}

function pagarClicked(event){
   alert("Gracias por su compra");
   var carritoItems = document.getElementsByClassName ('carrito-items') [0];
   while(carritoItems.hasChildNodes()){
    carritoItems.removeChild(carritoItems.firstChild);
   }

   actualizarTotalCarrito();

   //funcion de ocultar el carrito
   ocultarCarrito();
}

function hacerVisibleCarrito (){
   carritoVisible=true;
   var carrito = document.getElementsByClassName('carritoMas')[0];
   carrito.style.marginRight = '0';
   carrito.style.opacity = '1';

   var items = document.getElementsByClassName('conteproductos')[0];
   items.style.width = '70%';
}
