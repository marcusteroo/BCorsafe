window.onload = function() {
    const currentPath = window.location.pathname;

    if (currentPath === '/BCorsafe/admin/usuarioAdmin') {
        obtenerUsuarios();
    }
    if (currentPath.includes('BCorsafe/admin/NewusuarioAdmin')){ //Esto es para que si no esta en la página de usuarioAdmin no se ejecute
        document.getElementById('addUserFormAdmin').addEventListener('submit', function (e) {
            e.preventDefault(); // Para evitar que el formulario se envíe por defecto
    
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const tel = document.getElementById('tel').value;
            const password = '1234'; // Contraseña predeterminada
    
            const url = 'http://localhost/BCorsafe/web/api/api.php?action=add_user';
    
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    username,
                    email,
                    tel,
                    password,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.estado === 'Exito') {
                        document.getElementById('message').style.display = 'block';
                        document.getElementById('error-message').style.display = 'none';
                        document.getElementById('addUserFormAdmin').reset();
    
                    } else {
                        document.getElementById('message').style.display = 'none';
                        document.getElementById('error-message').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('message').style.display = 'none';
                    document.getElementById('error-message').style.display = 'block';
                });
        });
    }
    if (currentPath.includes('BCorsafe/admin/editarUsuarioPage')){
        document.getElementById('editUserForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Evitar que se recargue la página
    
            const idUsuario = document.getElementById('idUsuario').value;
            const nombre = document.getElementById('nombre').value;
            const email = document.getElementById('email').value;
            const telefono = document.getElementById('telefono').value;
    
            const url = 'http://localhost/BCorsafe/web/api/api.php?action=editar_usuario';
    
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ idUsuario, nombre, email, telefono }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.estado === 'Exito') {
                    alert('Usuario actualizado correctamente');
                    window.location.href = '/BCorsafe/admin/usuarioAdmin';
                } else {
                    alert('Error al actualizar el usuario: ' + data.mensaje);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
};
function obtenerUsuarios() {
    const url = 'http://localhost/BCorsafe/web/api/api.php?action=usuarios';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.estado === 'Exito') {
                let usuarios = data.data;

                let tbody = document.querySelector(".adminpanel-table tbody");
                tbody.innerHTML = ''; // Limpiar la tabla

                usuarios.forEach(usuario => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${usuario.id_usuario}</td>
                        <td>${usuario.nombre}</td>
                        <td>${usuario.email}</td>
                        <td>${usuario.telefono}</td>
                        <td>
                            <button class="adminpanel-btn-delete" onclick="eliminarUsuario(${usuario.id_usuario})">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                            <button class="adminpanel-btn-edit" onclick="editarUsuario(${usuario.id_usuario})">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } else {
                alert('Hubo un problema al obtener los usuarios.');
            }
        })
        .catch(error => console.error('Error:', error));
}
function eliminarUsuario(idUsuario) {
    const url = `http://localhost/BCorsafe/web/api/api.php?action=usuarios&id_usuario=${idUsuario}`;

    fetch(url, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        if (data.estado === 'Exito') {
            obtenerUsuarios(); // Volver a cargar los pedidos después de eliminar
        } else {
            alert('Hubo un problema al eliminar el Usuario.');
        }
    })
    .catch(error => console.error('Error:', error));
}
function editarUsuario(idUsuario) {
    window.location.href = `/BCorsafe/admin/editarUsuarioPage?id_usuario=${idUsuario}`;
}

 