<div class="fondo-detalle">
    <div class="container seccion-detalle">
        <div class="row">
            <!-- Imagen del producto -->
            <div class="col-md-6">
                <img src="<?php echo htmlspecialchars($producto->img); ?>" 
                    alt="<?php echo htmlspecialchars($producto->nombre); ?>" 
                    class="imagen-detalle" width="800px">
            </div>

            <!-- Información del producto -->
            <div class="col-md-6 info-producto-detalle">
                <h1><?php echo htmlspecialchars($producto->nombre); ?></h1>
                <h3><?php echo htmlspecialchars($producto->precio); ?>€</h3>
                <p class="mt-4"><?php echo nl2br(htmlspecialchars($producto->descripcion)); ?></p>

                <h5 class="mt-4">Ingredientes:</h5>
                <ul>
                    <?php 
                    if (!empty($ingredientes)) {
                        foreach ($ingredientes as $ingrediente): 
                    ?>
                        <li>
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

                <button class="btn btn-primary mt-3 boton-añadir-carrito-detalles">Añadir al carrito</button>
            </div>
        </div>
    </div>
</div>
