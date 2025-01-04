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
    <div class="container-adminpanel">
        <h1>Añadir Nuevo Cupon</h1>
        <form id="addCuponFormAdmin">
            <div class="form-group-admin">
                <label for="nombre_cupon">Nombre</label>
                <input type="text" id="nombre_cupon" name="nombre_cupon" required>
            </div>
            <div class="form-group-admin">
                <label for="descuento">Descuento</label>
                <input type="number" id="descuento" name="descuento" required>
            </div>
            <button type="submit">Añadir Cupon</button>
        </form>
        <div id="message" style="display:none; color: green;">Cupon añadido correctamente.</div>
        <div id="error-message" style="display:none; color: red;">Error al añadir el cupon</div>
        <div id="cupones-container" class="cupones-admin">
            <!-- Aquí se mostrarán los cupones -->
        </div>
        
    </div>
    

</div>
<script src="/BCorsafe/assets/js/admin-usuarios.js"></script>
<script src="/BCorsafe/assets/js/cupones.js"></script>