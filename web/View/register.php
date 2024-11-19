<div class="altura-reg">
    <div class="form-container-reg">
        <h2 class="text-center">Registro de Usuario</h2>
        <form method="POST" action="/BCorsafe/usuario/registrar">
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Telefono:</label>
                <input type="tel" id="tel" name="tel" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="/BCorsafe/assets/js/tel.js"></script>