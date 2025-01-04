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
        <a href="/BCorsafe/usuario/cerrarSesion">Cerrar Sesión</a>
    </div>
    <form id="editProductForm" method="POST" enctype="multipart/form-data" class="form-editar-producto-edit-product-admin">
        <h1 class="titulo-editar-producto-edit-product-admin">Editar Producto</h1>

        <!-- Campo oculto para el ID del producto -->
        <input type="hidden" id="idProducto" name="idProducto" value="<?php echo htmlspecialchars($producto->id_producto); ?>">

        <div class="form-group-edit-product-admin">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto->nombre); ?>" required>
        </div>
        <div class="form-group-edit-product-admin">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo htmlspecialchars($producto->precio); ?>" step="0.01" required>
        </div>

        <div class="form-group-edit-product-admin">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($producto->descripcion); ?></textarea>
        </div>
        <div class="form-group-edit-product-admin">
            <label for="imagen">Imagen Actual:</label>
            <?php if ($producto->img): ?>
                <div class="imagen-actual-edit-product-admin">
                    <img src="<?php echo htmlspecialchars($producto->img); ?>" alt="<?php echo htmlspecialchars($producto->nombre); ?>" width="150">
                </div>
                <label for="imagen">Subir nueva imagen (opcional):</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
            <?php else: ?>
                <p>No hay imagen disponible para este producto.</p>
                <label for="imagen">Subir imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required>
            <?php endif; ?>
        </div>
        <div class="form-group-edit-product-admin">
            <label for="ingredientes">Ingredientes: (mínimo 2, máximo 5)</label>
            <select id="ingredientes" name="ingredientes[]" multiple="multiple" class="ingredientesSelect">
                <?php foreach ($allIngredientes as $ingrediente): ?>
                    <option value="<?php echo $ingrediente->id_ingrediente; ?>"
                        <?php echo in_array($ingrediente->id_ingrediente, $ingredientesSeleccionados) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($ingrediente->nombre_ingrediente); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group-edit-product-admin">
            <input type="submit" value="Actualizar Producto" class="btn-submit-edit-product-admin">
        </div>
    </form>                  
</div>
<script src="/BCorsafe/assets/js/productos-admin.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>