<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo ?? 'Mi Proyecto MVC'; ?></title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <header>
        <h1>Mi Proyecto</h1>
        <nav>
            <a href="index.php?controller=home&action=index">Home</a>
            <a href="index.php?controller=productos&action=index">Productos</a>
        </nav>
    </header>

    <main>
        <?php include_once $vista; ?>
    </main>

    <footer>
        <div class="fondo-footer">
            <div class="container1-footer">
                <img src="./assets/img/logoweb.png" alt="Logo del restaurante">
                <p>Las mejojres Hamburgesas Gamings del mundo junto con el mejor Cafe</p>
                <div class="iconos-redes">
                    <img src="" alt="logo whatsApp">
                    <img src="" alt="logo Facebook">
                    <img src="" alt="logo Instagram">
                </div>
            </div>
        </div>
    </footer>

    <script src="/assets/js/funciones.js"></script>
</body>
</html>
