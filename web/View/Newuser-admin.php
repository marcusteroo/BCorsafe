
<div class="admin-principal-container">
    <div class="lateral-adminpage">
        <div class="adminpage-fotologo">
            <img src="/BCorsafe/assets/img/logowebGaming.png" alt="Logo web">
            <p>Bcorsafe</p>
        </div>
        <br><br>
        <a href="/BCorsafe/admin/adminProductos">Gestionar Productos</a>
        <hr>
        <a href="/BCorsafe/admin/adminPage">Gestionar Pedidos</a>
        <hr>
        <a href="/BCorsafe/admin/usuarioAdmin">Gestionar Usuarios</a>
        <hr>
        <a href="/BCorsafe/admin/NewCuponAdmin">Gestionar Cupones</a>
        <hr>
        <a href="/BCorsafe/usuario/cerrarSesion">Cerrar Sesión</a>
    </div>
    <div class="container-adminpanel">
    <h1>Añadir Nuevo Usuario</h1>
        <form id="addUserFormAdmin">
            <div class="form-group-admin">
                <label for="username">Nombre:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group-admin">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group-admin">
                <label for="tel">Teléfono:</label>
                <input type="tel" id="tel" name="tel" required>
            </div>
            <button type="submit">Añadir Usuario</button>
        </form>
        <div id="message" style="display:none; color: green;">Usuario añadido correctamente.</div>
        <div id="error-message" style="display:none; color: red;">El correo electronico introducido ya existe</div>
        <a class="boton-new-user" href="/BCorsafe/admin/usuarioAdmin">Volver atras</a>
    </div>
    

</div>
<script src="/BCorsafe/assets/js/admin-usuarios.js"></script>