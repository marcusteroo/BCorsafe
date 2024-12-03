
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
        <div class="container-metodopago">
            <h2 class="titulo-metodopago">Mis Métodos de Pago</h2>
            <?php if (!empty($metodos_pago)): ?>
                <ul class="list-group-metodopago">
                    <?php foreach ($metodos_pago as $metodo): ?>
                        <li class="list-group-item-metodopago">
                            <strong>Tipo:</strong> <?php echo htmlspecialchars($metodo->tipo_pago); ?><br>
                            <strong>Número:</strong> **** **** **** <?php echo substr(htmlspecialchars($metodo->numero_tarjeta), -4); ?><br>
                            <strong>Expira:</strong> <?php echo htmlspecialchars($metodo->fecha_expiracion); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <button class="btn-metodopago btn-cambiar-metodopago" onclick="mostrarFormulario()">Cambiar Método de Pago</button>
                <form id="formulario-editar-metodopago" style="display: none;" method="POST" action="/BCorsafe/metodosPago/updatePago">
                    <input type="hidden" name="id_pago" value="<?php echo $metodo->id_pago; ?>">
                    <div class="form-group-metodopago">
                        <label for="numero_tarjeta_editar" class="label-metodopago">Tarjeta de crédito:</label>
                        <div class="input-container-metodo">
                            <input type="text" placeholder="Número de Tarjeta" id="numero_tarjeta_editar" name="numero_tarjeta" class="form-control-metodopago" maxlength="16" required pattern="\d{16}" title="Debe contener 16 dígitos">
                            <img id="tipo_tarjeta_img_editar" src="" alt="Tipo de Tarjeta" class="tipo-tarjeta-icono" style="display: none;">
                        </div>
                    </div>
                    <input type="hidden" id="tipo_pago_editar" name="tipo_pago"> 
                    <div class="fecha-cvv">
                        <div class="form-group-metodopago">
                            <input type="text" placeholder="Fecha de vencimiento (MM / AA)" id="fecha_expiracion" name="fecha_expiracion" class="form-control-metodopago" required>
                        </div>
                        <div class="form-group-metodopago">
                            <input type="text" placeholder="Código de seguridad" id="codigo_seguridad" name="codigo_seguridad" class="form-control-metodopago" maxlength="3" required pattern="\d{3}" title="Debe contener 3 dígitos">
                        </div>
                    </div>
                    <button type="submit" class="btn-metodopago">Guardar Cambios</button>
                </form>
            <?php else: ?>
                <h2 class="titulo-agregar-metodopago">Agregar Método de Pago</h2>
                <form id="formulario-agregar-metodopago" style="display: none;" method="POST" action="/BCorsafe/metodosPago/agregar">
                    <div class="form-group-metodopago">
                        <label for="numero_tarjeta_nuevo" class="label-metodopago">Número de Tarjeta:</label>
                        <div class="input-container-metodo">
                            <input type="text" id="numero_tarjeta_nuevo" name="numero_tarjeta" class="form-control-metodopago" maxlength="16" required pattern="\d{16}" title="Debe contener 16 dígitos">
                            <img id="tipo_tarjeta_img_nuevo" src="" alt="Tipo de Tarjeta" class="tipo-tarjeta-icono" style="display: none;">
                        </div>
                    </div>
                    <input type="hidden" id="tipo_pago_nuevo" name="tipo_pago"> 
                    <div class="form-group-metodopago">
                        <label for="fecha_expiracion" class="label-metodopago">Fecha de Expiración:</label>
                        <input type="month" id="fecha_expiracion" name="fecha_expiracion" class="form-control-metodopago" required>
                    </div>
                    <div class="form-group-metodopago">
                        <label for="codigo_seguridad" class="label-metodopago">Código de Seguridad (CVV):</label>
                        <input type="text" id="codigo_seguridad" name="codigo_seguridad" class="form-control-metodopago" maxlength="3" required pattern="\d{3}" title="Debe contener 3 dígitos">
                    </div>
                    <button type="submit" class="btn-metodopago">Agregar Método de Pago</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="/BCorsafe/assets/js/metodopago.js"></script>
