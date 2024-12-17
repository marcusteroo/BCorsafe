
window.onload = function() {
    obtenerPedidos(); // Llamar a la función obtenerPedidos() cuando se cargue la página
};
function obtenerPedidos() {
    const url = 'http://localhost/BCorsafe/web/api/api.php?action=pedidos'; 

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.estado === 'Exito') {
                let pedidos = data.data;

                // Filtrar solo los pedidos con estado "completado"
                let pedidosCompletados = pedidos.filter(pedido => pedido.estado === 'completado');

                let tbody = document.querySelector(".adminpanel-table tbody");
                tbody.innerHTML = ''; 

                pedidosCompletados.forEach(pedido => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${pedido.id_pedido}</td>
                        <td>${pedido.id_usuario}</td>
                        <td>${pedido.fecha_pedido}</td>
                        <td>
                            <button class="adminpanel-btn-delete" onclick="eliminarPedido(${pedido.id_pedido})">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } else {
                alert('Hubo un problema al obtener los pedidos.');
            }
        })
        .catch(error => console.error('Error:', error));
}


// Función para eliminar un pedido
function eliminarPedido(idPedido) {
    const url = `http://localhost/BCorsafe/web/api/api.php?action=pedidos&id_pedido=${idPedido}`;

    fetch(url, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        if (data.estado === 'Exito') {
            document.getElementById("message-adminpanel").style.display = 'block';
            obtenerPedidos(); // Volver a cargar los pedidos después de eliminar
        } else {
            alert('Hubo un problema al eliminar el pedido.');
        }
    })
    .catch(error => console.error('Error:', error));
}
