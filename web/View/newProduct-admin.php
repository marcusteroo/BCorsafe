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
    <div class="form-container-producto-admin">
        <h2 class="titulo-admin-producto">Añadir Producto</h2>
        <form id="addProductForm" class="formulario-new-producto">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" placeholder="Ejemplo: Hamburguesa Especial" required>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" placeholder="Describe el producto..." required></textarea>

            <label for="precio">Precio: (mínimo 8€)</label>
            <input type="number" name="precio" placeholder="Ejemplo: 9.99" step="0.01" required>

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>

            <label for="ingredientes">Selecciona los ingredientes (mínimo 2, máximo 5):</label>
            <select class="ingredientesSelect" name="ingredientes[]" multiple required>
                <option value="1">Tomate</option>
                <option value="2">Cebolla</option>
                <option value="3">Queso</option>
                <option value="4">Lechuga</option>
                <option value="5">Bacon</option>
                <option value="6">Pulled Pork</option>
                <option value="7">Huevo</option>
                <option value="8">Aros Led</option>
                <option value="9">Sugus</option>
                <option value="10">Cebolla Caramelizada</option>
            </select>

            <button type="submit" class="btn-submit-admin-producto">Añadir Producto</button>
        </form>

        <p id="message" class="success-message">Producto añadido con éxito.</p>
        <p id="errorMessage" class="error-message">Error al añadir producto.</p>
    </div>
    
</div>
<script src="/BCorsafe/assets/js/productos-admin.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
