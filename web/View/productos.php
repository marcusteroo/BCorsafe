<div class="fondo-pro">
    <h2 class="titulo_productos">Productos Disponibles</h2>
    <div class="productos-home">
        <div class="contenedor-pagina">
            <!-- Sección de Filtros -->
            <div class="seccion-filtros filtros">
                <h3>Filtros</h3>

                <!-- Filtro por precio -->
                <!-- Filtro por precio -->
                <div class="filtro-precio">
                    <div class="checkboxes">
                        <?php
                        // Precios predeterminados
                        $precios = [12, 15, 19];
                        foreach ($precios as $precio) {
                            $checked = isset($_GET['precios']) && in_array($precio, $_GET['precios']) ? 'checked' : '';
                            echo '<div class="checkbox-custom"><input type="checkbox" class="filtro-precio" name="precios[]" value="' . htmlspecialchars($precio) . '" ' . $checked . '> ' . htmlspecialchars($precio) . '€</div>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Filtro por ingredientes -->
                <div class="filtro-ingredientes">
                    <label>Ingredientes:</label>
                    <div class="checkboxes">
                        <?php
                        $ingredientes = ["Tomate", "Lechuga", "Huevo", "Queso", "Bacon"];
                        foreach ($ingredientes as $ingrediente) {
                            $checked = isset($_GET['ingredientes']) && in_array($ingrediente, $_GET['ingredientes']) ? 'checked' : '';
                            echo '<div class="checkbox-custom"><input type="checkbox" class="filtro-ingrediente" name="ingredientes[]" value="' . htmlspecialchars($ingrediente) . '" ' . $checked . '> ' . htmlspecialchars($ingrediente) . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Contenedor de Productos -->
            <div class="productos-container">
                <?php foreach ($productos as $producto): ?>
                    <div class="producto">
                        <img src="<?php echo htmlspecialchars($producto->img); ?>" alt="<?php echo htmlspecialchars($producto->nombre); ?>" class="producto-img" width="100%">

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
    </div>
</div>
<script src="assets/js/filtros.js"></script>

