<div class="container-finalizarCompra">
        <h1>Finalizar Compra</h1>

        <!-- Datos del Usuario -->
        <div class="usuario-info-finalizarCompra">
            <h2>Datos del Usuario</h2>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario->nombre); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario->email); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario->telefono); ?></p>
        </div>
        <div class="finalizar-grid">
            <?php 
            $total = 0;
            foreach ($detalles as $detalle): 
                $subtotal = $detalle->cantidad * $detalle->precio_pedido;
                $total += $subtotal;
            ?>
                <div class="finalizar-item">
                    <div class="finalizar-info-img">
                        <div class="finalizar-imagen">
                            <img src="<?php echo htmlspecialchars($detalle->producto->img); ?>" 
                                alt="<?php echo htmlspecialchars($detalle->producto->nombre_producto); ?>" 
                                class="finalizar-img">
                        </div>
                        <div class="finalizar-info">
                            <h4 class="finalizar-nombre"><?php echo htmlspecialchars($detalle->producto->nombre   ); ?></h4>
                            <p class="finalizar-ingredientes"><?php echo htmlspecialchars($detalle->ingredientes_custom ?: 'Todos los ingredientes'); ?></p>
                            <p class="finalizar-cantidad">Cantidad: <?php echo $detalle->cantidad; ?></p>
                            <p class="finalizar-subtotal"><?php echo number_format($subtotal, 2); ?>€</p>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Métodos de Pago -->
        <div class="metodos-pago-finalizarCompra">
            <h2>Método de Pago</h2>
            <ul class="list-group-finalizarCompra">
                <?php foreach ($metodos_pago as $metodo): ?>
                    <li class="list-group-item-metodopago-finalizarCompra">
                        <div class="container1-metodos-finalizarCompra">
                            <strong>Tipo:</strong> <?php echo htmlspecialchars($metodo->tipo_pago); ?><br>
                            <strong>Número:</strong> **** **** **** <?php echo substr(htmlspecialchars($metodo->numero_tarjeta), -4); ?><br>
                            <strong>Expira:</strong> <?php echo htmlspecialchars($metodo->fecha_expiracion); ?>
                        </div>
                        <div class="container2-metodos-finalizarCompra">
                            <img src="/BCorsafe/assets/img/<?php echo htmlspecialchars($metodo->tipo_pago);?>.svg" alt="Imagen de <?php echo htmlspecialchars($metodo->tipo_pago);?>">
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="/BCorsafe/MetodosPago/listar">Cambiar Metodo de pago</a>
        </div>

        <!-- Formulario de Dirección de Envío -->
        <div class="direccion-envio-finalizarCompra">
            <h2>Dirección de Envío</h2>
            <form action="/BCorsafe/pedido/confirmarCompra" method="POST">
                <div class="form-group-finalizarCompra">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" class="form-control-finalizarCompra" required>
                </div>
                <div class="form-group-finalizarCompra">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" id="ciudad" name="ciudad" class="form-control-finalizarCompra" required>
                </div>
                <div class="form-group-finalizarCompra">
                    <label for="codigo_postal">Código Postal:</label>
                    <input type="text" id="codigo_postal" name="codigo_postal" class="form-control-finalizarCompra" required>
                </div>
                <div class="form-group-finalizarCompra">
                    <label for="pais">País:</label>
                    <input type="text" id="pais" name="pais" class="form-control-finalizarCompra" required>
                </div>
                <button type="submit" class="btn btn-primary-finalizarCompra">Finalizar Compra</button>
            </form>
        </div>
    </div>