<div class="container mt-5 seccion-password">
    <div class="form-container-reg">
        <h1>Cambiar Contraseña</h1>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['mensaje_error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['mensaje_error']; unset($_SESSION['mensaje_error']); ?></div>
        <?php endif; ?>

        <form action="/BCorsafe/usuario/cambiarContrasena" method="POST">
            <div class="mb-3">
                <label for="actual_contrasena" class="form-label">Contraseña Actual</label>
                <input type="password" class="form-control" id="actual_contrasena" name="actual_contrasena" required>
            </div>
            <div class="mb-3">
                <label for="nueva_contrasena" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="nueva_contrasena" name="nueva_contrasena" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
        </form>
    </div>
</div>