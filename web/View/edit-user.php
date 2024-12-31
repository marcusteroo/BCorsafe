<h1>Editar Usuario</h1>
<form id="editUserForm" method="POST">
    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo htmlspecialchars($usuario->id_usuario); ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario->nombre); ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario->email); ?>" required>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario->telefono); ?>" required>

    <input type="submit" value="Actualizar Usuario">
</form>
    <script src="/BCorsafe/assets/js/admin-usuarios.js"></script>