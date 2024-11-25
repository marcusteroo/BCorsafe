<div class="altura-reg">
    <div class="form-container-reg">
        <h1 class="login-titulo">Iniciar Sesión</h1>

        <?php if (isset($_SESSION['mensaje_error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['mensaje_error']; unset($_SESSION['mensaje_error']); ?></div>
        <?php endif; ?>

        <form action="/BCorsafe/usuario/login" method="POST">
            <div class="mb-3">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-warning">Iniciar Sesión</button>
        </form>

        <p class="mt-3 texto-login-reg">
            ¿No tienes una cuenta? <a href="/BCorsafe/usuario/registro">Regístrate aquí</a>.
        </p>
    </div>
</div>