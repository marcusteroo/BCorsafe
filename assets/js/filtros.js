document.addEventListener("DOMContentLoaded", function() {
    const contenedorProductos = document.querySelector(".productos-container");

    
    function obtenerFiltros() {
        const preciosSeleccionados = [];
        const ingredientesSeleccionados = [];

        
        document.querySelectorAll('.filtro-precio:checked').forEach(function(checkbox) {
            preciosSeleccionados.push(checkbox.value);
        });

        
        document.querySelectorAll('.filtro-ingrediente:checked').forEach(function(checkbox) {
            ingredientesSeleccionados.push(checkbox.value);
        });

        return { precios: preciosSeleccionados, ingredientes: ingredientesSeleccionados };
    }

 
    function actualizarProductos(productos) {
        contenedorProductos.innerHTML = ''; 
        if (productos.length === 0) {
            contenedorProductos.innerHTML = 'No se encontraron productos.';
            return;
        }

        productos.forEach(function(producto) {
            const productoElement = document.createElement('div');
            productoElement.classList.add('producto');
            
            productoElement.innerHTML = `
                <img src="${producto.img}" alt="${producto.nombre}" class="producto-img" width="100%">
                <div class="producto-info">
                    <div class="producto-nombre">${producto.nombre}</div>
                    <div class="producto-descripcion">${producto.descripcion}</div>
                    <div class="producto-precio">${producto.precio}€</div>
                    <button class="btn-carrito">Añadir al carrito</button>
                </div>
            `;
            contenedorProductos.appendChild(productoElement);
        });
    }

    const filtros = document.querySelectorAll('.filtro-precio, .filtro-ingrediente');
    filtros.forEach(function(filtro) {
        filtro.addEventListener('change', function() {
            const filtrosSeleccionados = obtenerFiltros();
            console.log('Filtros seleccionados:', filtrosSeleccionados);

           
            fetch('./web/api/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(filtrosSeleccionados)
            })
            .then(response => response.json())
            .then(data => {
                if (data.estado === 'Exito' && Array.isArray(data.data)) {
                    actualizarProductos(data.data);
                } else {
                    console.error('No se encontraron productos');
                }
            })
            .catch(error => {
                console.error('Error al obtener productos:', error);
            });
        });
    });
});