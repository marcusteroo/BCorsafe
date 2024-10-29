<!-- web/View/productos.php -->

<h2>Productos Disponibles</h2>
<ul>
    <?php foreach ($productos as $producto): ?>
        <li><?php echo htmlspecialchars($producto->nombre); ?> - $<?php echo htmlspecialchars($producto->precio); ?></li>
    <?php endforeach; ?>
</ul>
