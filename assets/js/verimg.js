try {
    document.getElementById('imagenPerfil').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagenPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
} catch (error) {
    console.warn('Error en el código de imagen de perfil:', error.message);
}
//Este script es para el cupon de descuento
try{

document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('cupon-btn-carrito');
    const cuponInput = document.getElementById('cupon-input-carrito');

    cuponInput.style.display = 'none';

    toggleButton.addEventListener('click', function () {
        if (cuponInput.style.display === 'none' || cuponInput.style.display === '') {
            cuponInput.style.display = 'block';
            toggleButton.textContent = '―';

        } else {
            cuponInput.style.display = 'none';
            toggleButton.textContent = '+';
        }
    });
});
}catch (error) {
    console.warn('Error en el código del cupón:', error.message);
}

