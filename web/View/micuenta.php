<div class="altura-reg-micuenta">
    <div class="micuenta-container">
        <!-- parte izquierda  -->
        <div class="micuenta-menu">
            <h2>Mi Cuenta</h2>
            <ul>
                <li><a href="/BCorsafe/usuario/pedidos">Mis Pedidos</a></li>
                <hr>
                <li><a href="/BCorsafe/usuario/metodos-pago">Métodos de Pago</a></li>
                <hr>
                <li>
                    <a href="/BCorsafe/usuario/cerrarSesion" class="cerrar-sesion">
                        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    <div class="derecha-micuenta">
        <!-- parte derecha -->
        <div class="micuenta-info">
            <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
            <?php endif; ?>

            <div class="mb-4">
                <h4>Datos de Usuario</h4>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario->nombre); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario->email); ?></p>
            </div>
            <a href="/BCorsafe/usuario/cambiarContrasena" class="btn btn-warning">Cambiar Contraseña</a>
               
        </div>
        <hr>
        <div class="perfil-imagen">
                <h4>Foto de Perfil</h4>
                <form action="/BCorsafe/usuario/subirImagen" method="POST" enctype="multipart/form-data">
                    <div class="imagen-preview mb-3">
                        <img id="imagenPreview" src="<?php echo $usuario->imagen?>" alt="Foto de Perfil" class="img-thumbnail" style="width: 150px; height: 150px;">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="imagenPerfil" id="imagenPerfil" accept="image/*" class="form-control-micuenta">
                        <small class="text-muted">Tamaño máximo: 2 MB</small>
                    </div>
                    <button type="submit" class="btn btn-primary-micuenta">Subir Imagen</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/BCorsafe/assets/js/verimg.js"></script> <!-- Lo que hace este script es ver en tiempo real cuando selecciono la imagen sin tenerla que subir -->