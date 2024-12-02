<h2 class="text-center carrito-titulo">Tu Carrito</h2>
<div class="container mt-5 carrito-container">
    <?php if (empty($detalles)): ?>
        <div class="alert alert-warning text-center carrito-alerta">
            <p>No tienes productos en el carrito.</p>
        </div>
    <?php else: ?>
        <div class="carrito-grid">
            <?php 
            $total = 0;
            foreach ($detalles as $detalle): 
                $subtotal = $detalle->cantidad * $detalle->precio_pedido;
                $total += $subtotal;

                // Obtener la imagen del producto
                $producto = $productoDAO->getProductoById($detalle->id_producto);
            ?>
                <div class="carrito-item">
                    <div class="carrito-info-img">
                        <div class="carrito-imagen">
                            <img src="<?php echo htmlspecialchars($producto->img); ?>" 
                                alt="<?php echo htmlspecialchars($producto->nombre_producto); ?>" 
                                class="carrito-img">
                        </div>
                        <div class="carrito-info">
                            <h4 class="carrito-nombre"><?php echo htmlspecialchars($detalle->nombre_producto); ?></h4>
                            <p class="carrito-ingredientes"><?php echo htmlspecialchars($detalle->ingredientes_custom ?: 'Todos los ingredientes'); ?></p>
                            <p class="carrito-cantidad">Cantidad: <?php echo $detalle->cantidad; ?></p>
                            <p class="carrito-subtotal"><?php echo number_format($subtotal, 2); ?>€</p>

                            <div class="carrito-acciones">
                                <form method="post" action="/editar_ingredientes">
                                    <input type="hidden" name="id_detalle" value="<?php echo $detalle->id_detalle; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm carrito-btn">Editar</button>
                                </form>
                                <a href="/eliminar_producto?id=<?php echo $detalle->id_detalle; ?>" class="btn btn-danger btn-sm carrito-btn">Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="carrito-resumen">
            <h4 class="carrito-total">Subtotal: €<?php echo number_format($total, 2); ?></h4>
            <p class="carrito-envio">Envío: <span class="carrito-envio-gratis">GRATIS</span></p>
            <p class="carrito-iva">IVA incl.: <?php echo number_format($total * 0.21, 2); ?>€</p>
            <h4 class="carrito-total-final">Total Estimado: <?php echo number_format($total, 2); ?>€</h4>
            <button class="btn btn-success carrito-pagar">Pagar</button>
        </div>
    <?php endif; ?>
</div>