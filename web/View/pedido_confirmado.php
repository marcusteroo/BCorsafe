<div class="altura-reg-micuenta">
    <div class="micuenta-container">
        <!-- parte izquierda  -->
        <div class="micuenta-menu">
            <h2>Mi Cuenta</h2>
            <ul>
                <li><a href="/BCorsafe/usuario/miCuenta">Mi Perfil</a></li>
                <hr>
                <li><a href="/BCorsafe/pedidos/listarPedido">Mis Pedidos</a></li>
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
        <h2 class="text-center titulo-confirmado">Tus Pedidos</h2>
        <div class="container mt-5 seccion-confirmado">
            <?php if (empty($pedidos)): ?>
                <div class="alert alert-info text-center">
                    <p>No has realizado compras todavía. ¡Explora nuestra tienda y realiza tu primer pedido!</p>
                </div>
            <?php else: ?>

                <?php 
                $compra_actual = null; 
                foreach ($pedidos as $pedido): 
                    // Agrupamos por id_compra
                    if ($compra_actual !== $pedido['id_compra']):
                        if ($compra_actual !== null): ?>
                            </div> <!-- Cerrar contenedor anterior -->
                        <?php endif; ?>
                        <div class="compra mb-4 p-3 border rounded bg-light">
                            <h3>Compra ID: <?php echo htmlspecialchars($pedido['id_compra']); ?></h3>
                            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($pedido['direccion']); ?>, 
                            <?php echo htmlspecialchars($pedido['ciudad']); ?>,
                            <?php echo htmlspecialchars($pedido['pais']); ?></p>
                            <p><strong>Código Postal:</strong> <?php echo htmlspecialchars($pedido['codigo_postal']); ?></p>
                            <div>
                                <p><strong>¡Tu pedido con la ID: <?php echo htmlspecialchars($pedido['id_compra']); ?> llegará en menos de 48 horas!</strong></p>
                            </div>
                            <hr>
                        <?php 
                        $compra_actual = $pedido['id_compra'];
                    endif; 
                    ?>
                    <div class="producto d-flex align-items-center mb-3">
                        <img src="<?php echo htmlspecialchars($pedido['img']); ?>" 
                            alt="Imagen del producto" 
                            class="img-thumbnail me-3" 
                            style="width: 100px; height: 100px;">
                        <div>
                            <h5><?php echo htmlspecialchars($pedido['nombre']); ?></h5>
                            <p><strong>Cantidad:</strong> <?php echo $pedido['cantidad']; ?></p>
                            <p><strong>Precio:</strong> <?php echo number_format($pedido['precio_pedido'], 2); ?>€</p>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div> <!-- Cerrar última compra -->
                
            <?php endif; ?>
            
        </div>
    </div>
</div>
