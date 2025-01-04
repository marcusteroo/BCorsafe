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
    <form id="editUserForm" method="POST" class="form-editar-usuario-edit-user-admin">
        <h1 class="titulo-editar-usuario-edit-user-admin">Editar Usuario</h1>
        <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo htmlspecialchars($usuario->id_usuario); ?>">
        <div class="form-group-edit-user-admin">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario->nombre); ?>" required>
        </div>
        <div class="form-group-edit-user-admin">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario->email); ?>" required>
        </div>
        <div class="form-group-edit-user-admin">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario->telefono); ?>" required>
        </div>
        <div class="form-group-edit-user-admin">
            <input type="submit" value="Actualizar Usuario" class="btn-submit-edit-user-admin">
        </div>
    </form>
    
</div>
<script src="/BCorsafe/assets/js/admin-usuarios.js"></script>