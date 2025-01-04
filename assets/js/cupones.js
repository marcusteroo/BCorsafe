//Esto es para obtener los cupones que ya tenemos
document.addEventListener('DOMContentLoaded', function() {
    const url = 'http://localhost/BCorsafe/web/api/api.php?action=get_cupones';
    
    fetch(url)
        .then(response => response.json()) 
        .then(data => {
            if (data.estado === 'Exito') {
               
                const cupones = data.cupones;
                const cuponesContainer = document.getElementById('cupones-container');
                
                
                cuponesContainer.innerHTML = '';

                // Recorrer los cupones y mostrarlos en la página
                cupones.forEach(cupon => {
                    const cuponElement = document.createElement('div');
                    cuponElement.classList.add('cupon');
                    cuponElement.innerHTML = `
                        <h3>${cupon.nombre_cupon}</h3>
                        <p>Descuento: ${cupon.descuento}%</p>
                    `;
                    cuponesContainer.appendChild(cuponElement);
                });
            } else {
                const cuponesContainer = document.getElementById('cupones-container');
                cuponesContainer.innerHTML = `<p>Error: ${data.mensaje}</p>`;
            }
        })
        .catch(error => {
            const cuponesContainer = document.getElementById('cupones-container');
            cuponesContainer.innerHTML = `<p>Error al cargar los cupones: ${error}</p>`;
        });
});