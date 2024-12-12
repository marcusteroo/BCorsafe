<div class="fondo-home">
    <h2 class="text-center carrito-titulo">Tu Carrito</h2>
    <div class="container mt-5 carrito-container">
        <?php if (empty($detalles)): ?>
            <div class="carrito-alerta">
                <img src="/BCorsafe/assets/img/notfound.webp" alt="Foto de carrito vacio">
            </div>
        <?php else: ?>
            <div class="carrito-grid">
                <?php 
                $total = 0;
                $total = floatval($total);  
                $descuento = isset($_SESSION['descuento']) ? $_SESSION['descuento'] : 0;
                $descuento = floatval($descuento);
                
                foreach ($detalles as $detalle): 
                    $subtotal = $detalle->cantidad * $detalle->precio_pedido;
                    $total += $subtotal;

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
                                <p class="carrito-ingredientes"><?php echo htmlspecialchars($detalle->ingredientes_custom ?: 'Sin ingredientes'); ?></p>
                                <p class="carrito-cantidad">Cantidad: <?php echo $detalle->cantidad; ?></p>
                                <p class="carrito-subtotal"><?php echo number_format($subtotal, 2); ?>€</p>

                                <div class="carrito-acciones">
                                    <form method="post" action="/BCorsafe/pedidos/editarProducto">
                                        <input type="hidden" name="id_detalle" value="<?php echo $detalle->id_detalle; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm carrito-btn">Editar</button>
                                    </form>
                                    <a href="/BCorsafe/pedidos/quitarProducto?id=<?php echo $detalle->id_detalle; ?>" class="btn btn-danger btn-sm carrito-btn">Quitar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $totalDescuento = $total * ($descuento / 100); $total = $total - $totalDescuento; ?>
            </div>

            <div class="carrito-resumen">
                <h4 class="carrito-titulo-resumen">RESUMEN DEL PEDIDO</h4>
                <p class="carrito-total">Subtotal: <?php echo number_format($total, 2); ?>€</p>
                <p class="carrito-envio">Envío: <span class="carrito-envio-gratis">GRATIS</span></p>
                <p class="carrito-iva">IVA incl.: <?php echo number_format($total * 0.21, 2); ?>€</p>
                <form method="POST" action="/BCorsafe/productos/aplicarCupon">
                    <p>
                        ¿Tienes un código promocional? 
                        <a class="cupon-input-mas" id="cupon-btn-carrito">+</a>
                    </p>
                    <div id="cupon-input-carrito">
                        <input type="text" name="codigo_cupon"class="form-control-carrito-des" placeholder="Introduce tu código promocional" />
                        <button class="aplicar-cupon-carrito">Aplicar</button>
                    </div>
                </form>
                <hr>
                <h4 class="carrito-total-final">Total Estimado: <?php echo number_format($total, 2); ?>€</h4>
                <a href="/BCorsafe/pedidos/PedidoCompra" class="carrito-pagar">Pagar</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="/BCorsafe/assets/js/verimg.js"></script>