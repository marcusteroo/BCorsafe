<table id="productosTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Imagen</th>
        </tr>
    </thead>
    <tbody>
        <!-- Aquí se llenarán los productos dinámicamente -->
    </tbody>
</table>

<!-- Formulario para añadir producto -->
<h2>Añadir Producto</h2>
<form id="addProductForm">
    <label for="nombre">Nombre del Producto:</label>
    <input type="text" name="nombre" required>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea>

    <label for="precio">Precio:</label>
    <input type="number" name="precio" required>
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen" accept="image/*" required>
    <label for="ingredientes">Selecciona los ingredientes (mínimo 2, máximo 5):</label>
    <select name="ingredientes[]" multiple required>
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

    <button type="submit">Añadir Producto</button>
</form>

<p id="message" style="display: none;">Producto añadido con éxito.</p>
<p id="errorMessage" style="display: none; color: red;">Error al añadir producto.</p>

<script src="/BCorsafe/assets/js/productos-admin.js"></script>