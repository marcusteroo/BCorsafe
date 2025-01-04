<!-- Esta página a sido echa por petición del David para utlizar arrays en Sesiones -->
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
        <h1>Ultimos 3 Pedidos</h1>


        <table class="adminpanel-table" id="tablaPedidos-adminpanel">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se insertarán los últimos pedidos -->
            </tbody>
        </table>
        <a class="boton-tres-pedidos" href="/BCorsafe/admin/adminPage">Volver atras</a>
    </div>

</div>
<script src="/BCorsafe/assets/js/admin-pedidos.js"></script>