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
        <h1>Panel de Administración - Pedidos</h1>

        <div class="message-adminpanel" id="message-adminpanel">
            El pedido ha sido eliminado correctamente.
        </div>

        <table class="adminpanel-table" id="tablaPedidos-adminpanel">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los pedidos se cargarán aquí -->
            </tbody>
        </table>
        <a class="boton-tres-pedidos" href="/BCorsafe/admin/adminPage3Pedidos">Ver Últimos 3 pedidos</a>
    </div>

</div>
<script src="/BCorsafe/assets/js/admin-pedidos.js"></script>