<div class="container mt-5 carrito-container">
    <h2 class="text-center mb-4 carrito-titulo"><?php echo $titulo; ?></h2>

    <?php if (empty($detalles)): ?>
        <div class="alert alert-warning text-center carrito-alerta">
            <p>No tienes productos en el carrito.</p>
        </div>
    <?php else: ?>
        <table class="table-bordered carrito-tabla">
            <thead class="thead-dark carrito-thead">
                <tr>
                    <th class="carrito-th">Producto</th>
                    <th class="carrito-th">Imagen</th> <!-- Nueva columna para la imagen -->
                    <th class="carrito-th">Cantidad</th>
                    <th class="carrito-th">Precio</th>
                    <th class="carrito-th">Ingredientes</th>
                    <th class="carrito-th">Subtotal</th>
                    <th class="carrito-th">Acciones</th>
                </tr>
            </thead>
            <tbody class="carrito-tbody">
                <?php 
                $total = 0;
                foreach ($detalles as $detalle): 
                    $subtotal = $detalle->cantidad * $detalle->precio_pedido;
                    $total += $subtotal;

                    // Obtener la imagen del producto
                    $producto = $productoDAO->getProductoById($detalle->id_producto); // Aquí ya está inicializado
                ?>
                    <tr class="carrito-fila">
                        <td class="carrito-td-nombre"><?php echo htmlspecialchars($detalle->nombre_producto); ?></td>

                        <!-- Mostrar la imagen del producto -->
                        <td class="carrito-td">
                            <img src="<?php echo htmlspecialchars($producto->img); ?>" 
                                 alt="<?php echo htmlspecialchars($producto->nombre_producto); ?>" 
                                 class="carrito-img" 
                                 width="200px">
                        </td>

                        <td class="carrito-td"><?php echo $detalle->cantidad; ?></td>
                        <td class="carrito-td"><?php echo number_format($detalle->precio_pedido, 2); ?>€</td>
                        <td class="carrito-td"><?php echo htmlspecialchars($detalle->ingredientes_custom ?: 'Todos los ingredientes'); ?></td>
                        <td class="carrito-td"><?php echo number_format($subtotal, 2); ?>€</td>
                        <td class="carrito-td">
                            <form method="post" action="/editar_ingredientes" class="carrito-form">
                                <input type="hidden" name="id_detalle" value="<?php echo $detalle->id_detalle; ?>">
                                <button type="submit" class="btn btn-primary btn-sm carrito-btn">Editar Ingredientes</button>
                                <a href="#">Quitar producto</a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4 class="carrito-total">Total: €<?php echo number_format($total, 2); ?></h4>
    <?php endif; ?>
</div>
