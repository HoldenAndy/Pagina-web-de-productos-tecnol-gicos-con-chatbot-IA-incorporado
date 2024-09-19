document.addEventListener('DOMContentLoaded', function() {
  const searchForm = document.getElementById('search-form');
  const searchInput = document.getElementById('buscadorr');
  const productos = document.querySelectorAll('.productos');

  searchForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    const searchTerm = searchInput.value.toLowerCase();

    productos.forEach(function(producto) {
      const productName = producto.querySelector('.modelopro').textContent.toLowerCase();
      const productBrand = producto.querySelector('.titulopro').textContent.toLowerCase();

      if (productName.includes(searchTerm) || productBrand.includes(searchTerm)) {
        producto.style.display = 'block';
      } else {
        producto.style.display = 'none';
      }
    });
  });
});

