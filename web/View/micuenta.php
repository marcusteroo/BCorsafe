<div class="altura-reg-micuenta">
    <div class="micuenta-container">
        <!-- parte izquierda  -->
        <div class="micuenta-menu">
            <h2>Mi Cuenta</h2>
            <ul>
                <li><a href="/BCorsafe/usuario/miCuenta">Mi Perfil</a></li>
                <hr>
                <li><a href="/BCorsafe/usuario/pedidos">Mis Pedidos</a></li>
                <hr>
                <li><a href="/BCorsafe/metodosPago/listar">Métodos de Pago</a></li>
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
                    <img id="imagenPreview" src="<?php echo htmlspecialchars($usuario->imagen). '?v=' . time(); ?>" 
                        alt="Vista previa de tu foto de perfil" class="img-thumbnail"> <!-- El v = time() es para que el navegador piense que es una url y muestre la última version de la imagen ya que en la base de datos tienen el mismo nombre -->
                </div>
                <div class="fotoperfil-container mb-3">
                    <label for="imagenPerfil" class="seleccionar-imagen">
                        Seleccionar imagen
                    </label>
                    <input type="file" name="imagenPerfil" id="imagenPerfil" accept="image/*" class="form-control-micuenta">
                    <small class="texto-maximo">Tamaño máximo: 2 MB</small>
                </div>
                <button type="submit" class="btn btn-primary-micuenta">Subir Imagen</button>
            </form>
        </div>
    </div>
</div>
<script src="/BCorsafe/assets/js/verimg.js"></script> <!-- Lo que hace este script es ver en tiempo real cuando selecciono la imagen sin tenerla que subir -->