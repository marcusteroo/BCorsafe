<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo ?? 'Mi Proyecto MVC'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> <!-- Esto es para importar el Boostrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet"> <!-- Esto es para poder utilizar los iconos de Boostrap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Saira+Condensed:wght@100;200;300;400;500;600;700;800;900&family=Saira:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- He insertado todo estos links para poder utilizar la fuente Saira original de Google Fonts -->
    <link rel="stylesheet" href="assets/css/estilos-footer.css">
    <link rel="stylesheet" href="assets/css/estilos-nav.css">
    <link rel="stylesheet" href="assets/css/home.css">

    
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                
                <!-- Logo con clases para que se centre en pantallas pequeñas -->
                <a class="navbar-brand d-flex align-items-center mx-auto mx-lg-0 logo-nav" href="index.php?controller=home&action=index">
                    <img src="./assets/img/logowebGaming.png" alt="Logo BCorsafe" width="80" height="80" class="d-inline-block align-text-top">
                    <span class="ms-2 d-none d-lg-inline texto-logo-nav">BCorsafe</span> 
                </a>

                <!-- Botón de menú que se coloca en la izquierda -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menú de navegación -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=productos&action=index">Producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sobre Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>

                        <!-- Iconos de búsqueda y carrito como enlaces en pantallas pequeñas -->
                        <li class="nav-item d-lg-none">
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-search"></i> Buscar
                            </a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-cart"></i> Carrito
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Iconos de búsqueda y carrito como iconos en pantallas grandes -->
                <div class="d-none d-lg-flex justify-content-end " id="icono-nav">
                    <a href="#" class="nav-link text-white me-3 ">
                        <i class="bi bi-search"></i> 
                    </a>
                    <a href="#" class="nav-link text-white ">
                        <i class="bi bi-cart"></i> 
                    </a>
                </div>
            </div>
        </nav>

    </header>

    <main>
        <?php include_once $vista; ?>
    </main>

    <footer>
        <div class="footer-container">
            <div class="fondo-footer">
                <div class="footer-logo">
                    <img src="./assets/img/logowebGaming.png" alt="Logo del restaurante">
                    <p>Las mejores Hamburguesas Gamings del mundo junto con el mejor Cafe</p>
                    <div class="iconos-redes">
                        <a href="#"><img src="./assets/img/whatsApp.png" alt="Logo WhatsApp"></a>
                        <a href="#"><img src="./assets/img/facebook (1).png" alt="Logo Facebook"></a>
                        <a href="#"><img src="./assets/img/instagram (1).png" alt="Logo Instagram"></a>
                        <!-- Utilizo el formato png para que no se vea el fondo y sea transparante -->
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
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/assets/js/funciones.js"></script>

</body>
</html>
