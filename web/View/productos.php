<div class="fondo-pro">
    <h2>Productos Disponibles</h2>
    <div class="productos-home">
        <div class="contenedor-pagina">
            <!-- Sección de Filtros -->
            <div class="seccion-filtros filtros">
                <h3>Filtros</h3>

                <!-- Filtro por precio -->
                <form method="GET" action="">
                    <div class="filtro-precio">
                        <label>Rango de precio:</label>
                        <div>
                            <input type="range" name="precio-min" id="precio-min" min="0" max="100" 
                                value="<?php echo htmlspecialchars($_GET['precio-min'] ?? '0'); ?>" 
                                oninput="mostrarValoresPrecio()">
                            <input type="range" name="precio-max" id="precio-max" min="0" max="100" 
                                value="<?php echo htmlspecialchars($_GET['precio-max'] ?? '100'); ?>" 
                                oninput="mostrarValoresPrecio()">
                        </div>
                        <div>
                            <span id="precio-min-display">0</span> - <span id="precio-max-display">100</span>
                        </div>
                    </div>

                    <!-- Filtro por ingredientes -->
                    <div class="filtro-ingredientes">
                        <label>Ingredientes:</label>
                        <div class="checkboxes">
                            <!-- Checkboxes para cada ingrediente -->
                            <?php
                            $ingredientes = ["Tomate", "Lechuga", "Huevo", "Queso", "Bacon"];
                            foreach ($ingredientes as $ingrediente) {
                                $checked = isset($_GET['ingredientes']) && in_array($ingrediente, $_GET['ingredientes']) ? 'checked' : '';
                                echo '<div><input type="checkbox" name="ingredientes[]" value="' . htmlspecialchars($ingrediente) . '" ' . $checked . '> ' . htmlspecialchars($ingrediente) . '</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <button type="submit">Aplicar Filtros</button>
                </form>
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
