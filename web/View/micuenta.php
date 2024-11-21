<div class="altura-reg-micuenta">
    <div class="form-container-reg-micuenta">
        <h1>Mi Cuenta</h1>

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
</div>