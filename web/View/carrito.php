<div class="container mt-5">
    <h2><?php echo $titulo; ?></h2>
    <?php if (empty($detalles)): ?>
        <p>No tienes productos en el carrito.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Imagen</th> <!-- Nueva columna para la imagen -->
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Ingredientes</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($detalles as $detalle): 
                    $subtotal = $detalle->cantidad * $detalle->precio_pedido;
                    $total += $subtotal;

                    // Obtener la imagen del producto
                    $producto = $productoDAO->getProductoById($detalle->id_producto); // Aquí ya está inicializado
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detalle->nombre_producto); ?></td>

                        <!-- Mostrar la imagen del producto -->
                        <td>
                            <img src="<?php echo htmlspecialchars($producto->img); ?>" 
                                 alt="<?php echo htmlspecialchars($producto->nombre_producto); ?>" 
                                 class="img-thumbnail" 
                                 width="100px">
                        </td>

                        <td><?php echo $detalle->cantidad; ?></td>
                        <td>€<?php echo number_format($detalle->precio_pedido, 2); ?></td>
                        <td><?php echo htmlspecialchars($detalle->ingredientes_custom ?: 'Todos los ingredientes'); ?></td>
                        <td>€<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <form method="post" action="/editar_ingredientes">
                                <input type="hidden" name="id_detalle" value="<?php echo $detalle->id_detalle; ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Editar Ingredientes</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4>Total: €<?php echo number_format($total, 2); ?></h4>
    <?php endif; ?>
</div>
<div class="seccion-carrito-carrito">
    <?php 
        $total = 0;
        foreach ($detalles as $detalle): 
            $subtotal = $detalle->cantidad * $detalle->precio_pedido;
            $total += $subtotal;

            // Obtener la imagen del producto
            $producto = $productoDAO->getProductoById($detalle->id_producto); 
    ?>
        <div class="producto-carrito-carrito">
            <!-- Imagen del producto -->
            <div class="producto-imagen-carrito">
                <img src="<?php echo $producto->img; ?>" alt="Imagen de <?php echo $producto->nombre; ?>">
            </div>

            <!-- Detalles del producto -->
            <div class="producto-detalles-carrito">
                <p class="producto-nombre-carrito"><?php echo $producto->nombre; ?></p>
                <p class="producto-cantidad-carrito">Cantidad: <?php echo $detalle->cantidad; ?></p>
                <p class="producto-subtotal-carrito">Subtotal: $<?php echo number_format($subtotal, 2); ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Total -->
    <div class="total-carrito">
        <p>Total: $<?php echo number_format($total, 2); ?></p>
    </div>
</div>


