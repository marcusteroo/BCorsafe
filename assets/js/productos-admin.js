
// Cargar productos al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    const url = 'http://localhost/BCorsafe/web/api/api.php?action=obtener_productos';
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.estado === 'Exito') {
                const productosTable = document.getElementById('productosTable').querySelector('tbody');
                productosTable.innerHTML = ''; // Limpiar la tabla

                data.productos.forEach(producto => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${producto.id_producto}</td>
                        <td>${producto.nombre}</td>
                        <td>${producto.precio}</td>
                        <td>${producto.descripcion}</td>
                        <td>
                            ${producto.img ? `<img src="${producto.img}" alt="Imagen" width="50">` : ''}
                        </td>
                    `;
                    productosTable.appendChild(row);
                });
            } else {
                console.error('Error al obtener los productos:', data.mensaje);
            }
        })
        .catch(error => console.error('Error:', error));
});

// Esto es para el formulario de añadir producto
document.getElementById('addProductForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevenir el envío por defecto
    const url = 'http://localhost/BCorsafe/web/api/api.php?action=add_producto';
    const formData = new FormData(this);

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Obtener la respuesta como texto primero
    .then(text => {
        console.log('Respuesta de la API:', text);  // Ver lo que devuelve el servidor
        try {
            const data = JSON.parse(text); // Intentamos parsear la respuesta a JSON
            if (data.estado === 'Exito') {
                document.getElementById('message').style.display = 'block';
                document.getElementById('errorMessage').style.display = 'none';
                this.reset();

                // Recargar productos
                document.dispatchEvent(new Event('DOMContentLoaded'));
            } else {
                document.getElementById('message').style.display = 'none';
                document.getElementById('errorMessage').style.display = 'block';
            }
        } catch (error) {
            console.error('Error al parsear JSON:', error);
            document.getElementById('message').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        document.getElementById('message').style.display = 'none';
        document.getElementById('errorMessage').style.display = 'block';
    });
});