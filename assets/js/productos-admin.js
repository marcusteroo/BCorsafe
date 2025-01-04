document.addEventListener('DOMContentLoaded', () => {
    // Inicializamos Select2 en los elementos con la clase js-example-basic-single
    $('.ingredientesSelect').select2({
        width: '100%',
    });
});
window.addEventListener('DOMContentLoaded', () => {
    const currentPath = window.location.pathname;

    if (currentPath === '/BCorsafe/admin/adminProductos') {
        // Cargar productos al cargar la página
        const url = 'http://localhost/BCorsafe/web/api/api.php?action=obtener_productos';
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.estado === 'Exito') {
                    const productosContainer = document.getElementById('productosContainer');
                    productosContainer.innerHTML = ''; // Limpiar el contenedor

                    data.productos.forEach(producto => {
                        const card = document.createElement('div');
                        card.className = 'card-admin';
                        card.innerHTML = `
                            ${producto.img ? `<img src="${producto.img}" alt="${producto.nombre}">` : ''}
                            <div class="card-body-admin">
                                <h3>${producto.nombre}</h3>
                                <p>${producto.descripcion}</p>
                                <p class="precio-admin-productos">$${producto.precio}</p>
                            </div>
                            <div class="actions">
                                <button class="adminpanel-btn-delete" onclick="eliminarProducto(${producto.id_producto})">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                                <button class="adminpanel-btn-edit" onclick="editarProducto(${producto.id_producto})">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </div
                        `;
                        productosContainer.appendChild(card);
                    });
                } else {
                    console.error('Error al obtener los productos:', data.mensaje);
                }
            })
            .catch(error => console.error('Error:', error));
    }
    if (currentPath === '/BCorsafe/admin/NewProductoAdmin') {
        // Esto es para que Select2 se inicialice correctamente
        
    
        // Esto es para el formulario de añadir producto
        const form = document.getElementById('addProductForm');
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Prevenir el envío por defecto
                const url = 'http://localhost/BCorsafe/web/api/api.php?action=add_producto';
                const formData = new FormData(this);
    
                fetch(url, {
                    method: 'POST',
                    body: formData,
                })
                    .then((response) => response.text())
                    .then((text) => {
                        try {
                            const data = JSON.parse(text);
                            if (data.estado === 'Exito') {
                                document.getElementById('message').style.display = 'block';
                                document.getElementById('message').textContent = data.mensaje;
                                document.getElementById('errorMessage').style.display = 'none';
                                this.reset();
                            } else {
                                document.getElementById('errorMessage').style.display = 'block';
                                document.getElementById('errorMessage').textContent = data.mensaje; 
                                document.getElementById('message').style.display = 'none';
                            }
                        } catch (error) {
                            console.error('Error al parsear JSON:', error);
                            document.getElementById('errorMessage').style.display = 'block';
                            document.getElementById('errorMessage').textContent = 'Error al procesar la respuesta.';
                            document.getElementById('message').style.display = 'none';
                        }
                    })
                    .catch((error) => {
                        console.error('Error en la solicitud:', error);
                        document.getElementById('errorMessage').style.display = 'block';
                        document.getElementById('errorMessage').textContent = 'Error en la solicitud.';
                        document.getElementById('message').style.display = 'none';
                    });
            });
        }
    }
    if (currentPath.includes('BCorsafe/admin/editarProductoAdmin')) {
        document.getElementById('editProductForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Evitar que se recargue la página
        
            const idProducto = document.getElementById('idProducto').value;
            const nombre = document.getElementById('nombre').value;
            const descripcion = document.getElementById('descripcion').value;
            const precio = document.getElementById('precio').value;
            const imagen = document.getElementById('imagen').files[0]; // Tomamos la imagen del input
            const ingredientesSeleccionados = $('#ingredientes').val();
            
            // Se construye el FormData para enviar la imagen junto con los otros datos
            const formData = new FormData();
            formData.append('idProducto', idProducto);
            formData.append('nombre', nombre);
            formData.append('descripcion', descripcion);
            formData.append('precio', precio);
            formData.append('ingredientes', JSON.stringify(ingredientesSeleccionados));
            if (imagen) {
                formData.append('imagen', imagen);
            }
            const url = 'http://localhost/BCorsafe/web/api/api.php?action=editar_producto';
        
            fetch(url, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.estado === 'Exito') {
                    alert('Producto actualizado correctamente');
                    window.location.href = '/BCorsafe/admin/adminProductos'; // Redirige a la lista de productos
                } else {
                    alert('Error al actualizar el producto: ' + data.mensaje);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
function eliminarProducto(idProducto) {
    const url = `http://localhost/BCorsafe/web/api/api.php?action=eliminar_producto&id_producto=${idProducto}`;
    
    fetch(url, { method: 'DELETE' })
        .then(response => response.json())
        .then(data => {
            if (data.estado === 'Exito') {
                alert(data.mensaje);
                location.reload();
            } else {
                alert('Error al eliminar el producto: ' + data.mensaje);
            }
        })
        .catch(error => console.error('Error al eliminar producto:', error));
}
function editarProducto(idProducto) {
    // Redirigir a la página de edición
    window.location.href = `/BCorsafe/admin/editarProductoAdmin?id_producto=${idProducto}`;
}