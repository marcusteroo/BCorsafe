
<div class="fondo-pro">
    <h2>Productos Disponibles</h2>

    <div class="productos-container">
        <?php foreach ($productos as $producto): ?>
            <div class="producto">
                <img src="<?php echo htmlspecialchars($producto->img);  ?>" alt="<?php echo htmlspecialchars($producto->nombre); ?> " class="producto-img" width="100%">
                
                <div class="producto-info">
                    <div class="producto-nombre"><?php echo htmlspecialchars($producto->nombre); ?></div>
                    <div class="producto-descripcion">
                        <?php echo nl2br(htmlspecialchars($producto->descripcion)); ?>
                    </div>
                    <div class="producto-precio"><?php echo ($producto->precio); ?>€</div>
                    <button class="btn-carrito">Añadir al carrito</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
