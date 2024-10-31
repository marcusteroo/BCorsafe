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
            <div class="footer-logo">
                <img src="./assets/img/logoweb.png" alt="Logo del restaurante">
                <p>Las mejores Hamburguesas Gamings del mundo junto con el mejor Cafe</p>
                <div class="iconos-redes">
                    <a href="#"><img src="./assets/img/whatsApp.png" alt="Logo WhatsApp"></a>
                    <a href="#"><img src="./assets/img/facebook (1).png" alt="Logo Facebook"></a>
                    <a href="#"><img src="./assets/img/instagram (1).png" alt="Logo Instagram"></a>
                </div>
            </div>

            <div class="footer-links">
                <div class="footer-section">
                    <h3>TIENDA</h3>
                    <ul>
                        <li><a href="#">Las mejores hamburguesas</a></li>
                        <li><a href="#">Los mejores Cafés</a></li>
                        <li><a href="#">Productos</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>BCORSAFE</h3>
                    <ul>
                        <li><a href="#">Sobre Nosotros</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>CONTACTO</h3>
                    <ul>
                        <li><a href="mailto:marc@bcorsafe.com">marc@bcorsafe.com</a></li>
                        <li><p>Carrer Ntra. Sra. de Lourdes, 34, 08750 Molins de Rei, Barcelona</p></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>Copyright © 2024 BCorsafe. All rights reserved.</p>
            <div class="terminos">
            
            <a href="#">Términos de Uso</a> | <a href="#">Configuración de Cookies</a>
            </div>
        </div>
    </footer>



    <script src="/assets/js/funciones.js"></script>
</body>
</html>
