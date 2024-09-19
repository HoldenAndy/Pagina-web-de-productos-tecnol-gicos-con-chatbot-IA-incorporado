// Obtener referencias a elementos del DOM
const carrito = document.getElementById("lista-carrito").getElementsByTagName("tbody")[0];
const carritoItemsContainer = document.querySelector('.carrito-items');
const btnPagar = document.querySelector('.btn-pagar');
const btnVaciarCarrito = document.getElementById('vaciar-carrito');

// Cargar productos del almacenamiento local al cargar la página
document.addEventListener('DOMContentLoaded', cargarProductosLocalStorage);

// Agregar evento al botón de eliminar producto del carrito
carrito.addEventListener("click", eliminarProducto);

// Agregar evento al botón de vaciar carrito
btnVaciarCarrito.addEventListener("click", vaciarCarrito);

// Agregar evento al botón de pagar
btnPagar.addEventListener("click", moverProductosAlCarrito);

function cargarProductosLocalStorage() {
    let productos;
    if(localStorage.getItem("productos") === null) {
        productos = [];
    } else {
        productos = JSON.parse(localStorage.getItem("productos"));
        productos.forEach(function(producto) {
            agregarProductoAlCarrito(producto);
        });
    }
}

function agregarProductoAlCarrito(producto) {
    const row = document.createElement("tr");
    row.innerHTML = `
        <td><img src="${producto.imagen}" class="img-thumbnail" width="50" /></td>
        <td>${producto.nombre}</td>
        <td>${producto.precio}</td>
        <td><button class="btn btn-danger btn-sm eliminar-producto">X</button></td>
    `;
    carrito.appendChild(row);
}

function eliminarProducto(e) {
    if(e.target.classList.contains("eliminar-producto")) {
        const producto = e.target.parentElement.parentElement;
        producto.remove();

        const index = Array.from(carrito.children).indexOf(producto);

        let productos = JSON.parse(localStorage.getItem("productos"));
        productos.splice(index, 1);
        localStorage.setItem("productos", JSON.stringify(productos));
    }
}

function vaciarCarrito() {
    while(carrito.firstChild) {
        carrito.removeChild(carrito.firstChild);
    }
    localStorage.removeItem("productos");
}

function moverProductosAlCarrito() {
    let productos = [];

    document.querySelectorAll('.carrito-item').forEach(item => {
        const producto = {
            imagen: item.querySelector('img').src,
            nombre: item.querySelector('.carrito-item-titulo').textContent,
            precio: item.querySelector('.carrito-item-precio').textContent
        };
        productos.push(producto);
        agregarProductoAlCarrito(producto);
    });

    localStorage.setItem("productos", JSON.stringify(productos));
    vaciarCarritoItems();
}

function vaciarCarritoItems() {
    while(carritoItemsContainer.firstChild) {
        carritoItemsContainer.removeChild(carritoItemsContainer.firstChild);
    }
}
