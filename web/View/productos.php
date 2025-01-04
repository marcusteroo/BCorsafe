<div class="container-fluid fondo-pro py-5">
    <h2 class="text-center text-white mb-4 titulo_productos">Productos Disponibles</h2>
    <div class="row">
        <!-- Sección de filtros -->
        <div class="col-md-3 formulario-filtros">
            <form action="/BCorsafe/productos/filtrar" method="POST" class="bg-dark p-3 rounded">
                <h3 class="text-white">Filtros</h3>

                <!-- Filtro por precio -->
                <div class="mb-4">
                    <label class="text-white">Precios:</label>
                    <div class="checkboxes">
                        <?php
                        $precios = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
                        foreach ($precios as $precio) {
                            $checked = isset($_POST['precios']) && in_array($precio, $_POST['precios']) ? 'checked' : '';
                            echo '<div class="checkbox-custom"><input type="checkbox" name="precios[]" value="' . htmlspecialchars($precio) . '" ' . $checked . '> ' . htmlspecialchars($precio) . '€</div>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Filtro por ingredientes -->
                <div class="mb-4">
                    <label class="text-white">Ingredientes:</label>
                    <div class="checkboxes">
                        <?php
                        $ingredientes = ["Tomate", "Cebolla", "Queso", "Lechuga", "Bacon","Pulled Pork","Huevo","Aros Led","Sugus","Cebolla Caramelizada"];
                        
                        foreach ($ingredientes as $ingrediente) {
                            $checked = isset($_POST['ingredientes']) && in_array($ingrediente, $_POST['ingredientes']) ? 'checked' : '';
                            
                            echo '
                            <div class="checkbox-custom">
                                <input type="checkbox" 
                                    name="ingredientes[]" 
                                    value="' . htmlspecialchars($ingrediente) . '" 
                                    ' . $checked . '> 
                                <label>' . htmlspecialchars($ingrediente) . '</label>
                            </div>';
                        }
                        ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 boton-filtros">Aplicar filtros</button>
            </form>
        </div>

        <!-- Contenedor de Productos -->
        <div class="col-md-9">
            <div class="row productos-container">
                <?php foreach ($productos as $producto): ?>
                    <div class="col-lg-4 col-md-6 mb-4 container-productos">
                        <div class="producto bg-dark text-white p-3 producto-contenedor-media">
                            <img src="<?php echo htmlspecialchars($producto->img); ?>" alt="<?php echo htmlspecialchars($producto->nombre); ?>" class="producto-img img-fluid rounded mb-3">
                            <div class="producto-info">
                                <h5 class="producto-nombre"><?php echo htmlspecialchars($producto->nombre); ?></h5>
                                <p class="producto-descripcion"><?php echo nl2br(htmlspecialchars($producto->descripcion)); ?></p>
                                <div class="producto-precio"><?php echo ($producto->precio); ?>€</div>
                                <a href="/BCorsafe/productos/detalle?id=<?php echo urlencode($producto->id_producto); ?>" class="btn btn-success btn-carrito w-100 mt-3">Ver más</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
