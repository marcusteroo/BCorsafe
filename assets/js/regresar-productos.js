//Este script lo utilizo porque en la pagina productos cuando utilizo los filtros y luego voy a ver detalles del producto, si quiero tirar para atras me salta una pagina en blanco con un error de que no se ha rellenado el formulario, esto se debe a causa de los filtros, por eso he utilizado esto para prevenir todo tipo de problemas y que me regrese si o si a la pagina de productos.
if (window.location.pathname.includes('/BCorsafe/productos/detalle')) {
    // Añadir un estado vacío al historial para que el navegador registre esta página
    history.pushState(null, null, window.location.href);
    
    // Escuchar el evento de retroceso del navegador
    window.addEventListener('popstate', function(event) {
        // Redirigir siempre a la página principal de productos cuando el usuario regrese
        window.location.href = '/BCorsafe/productos';
    });
}