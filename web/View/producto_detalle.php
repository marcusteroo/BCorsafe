<div class="fondo-detalle">
    <div class="container seccion-detalle">
        <div class="row">
            <!-- Imagen del producto -->
            <div class="col-md-6 imagen-container-producto">
                <img src="<?php echo htmlspecialchars($producto->img); ?>" 
                     alt="<?php echo htmlspecialchars($producto->nombre); ?>" 
                     class="imagen-detalle" width="800px">
            </div>

            <!-- Información del producto -->
            <div class="col-md-6 info-producto-detalle">
                <h1><?php echo htmlspecialchars($producto->nombre); ?></h1>
                <h3 id="precio-producto"><?php echo htmlspecialchars($producto->precio); ?>€</h3>
                <p class="mt-4"><?php echo nl2br(htmlspecialchars($producto->descripcion)); ?></p>

                <!-- Ingredientes seleccionables -->
                <form method="post" action="/BCorsafe/pedidos/agregarAlCarrito">
                    <input type="hidden" name="id_producto" value="<?php echo $producto->id_producto; ?>">
                    <input type="hidden" id="precio-base" value="<?php echo htmlspecialchars($producto->precio); ?>">

                    <h5 class="mt-4">Ingredientes:</h5>
                    <ul>
                        <?php 
                        if (!empty($ingredientes)) {
                            foreach ($ingredientes as $ingrediente): 
                        ?>
                            <li>
                                <input type="checkbox" 
                                       name="ingredientes_custom[]" 
                                       value="<?php echo htmlspecialchars($ingrediente->nombre_ingrediente); ?>" 
                                       checked 
                                       class="ingrediente-checkbox"
                                       data-precio-reduccion="2">
                                <?php echo htmlspecialchars($ingrediente->nombre_ingrediente); ?> 
                                (Cantidad: <?php echo htmlspecialchars($ingrediente->cantidad); ?>)
                            </li>
                        <?php 
                            endforeach; 
                        } else {
                            echo "<li>No hay ingredientes asociados a este producto.</li>";
                        }
                        ?>
                    </ul>

                    <!-- Cantidad -->
                    <div class="form-group mt-3 producto-detalle-cantidad">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" value="1" min="1" class="form-control w-25">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 boton-añadir-carrito-detalles">Añadir al carrito</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/BCorsafe/assets/js/actualizar_precio.js"></script>
