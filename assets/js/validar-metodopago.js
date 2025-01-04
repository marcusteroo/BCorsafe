//Este script es para validar si el usuario tiene metodo de pago, en caso de no tener se le obligara a añadir metodo de pago para continuar
document.addEventListener("DOMContentLoaded", function () {
    const formFinalizarCompra = document.querySelector('form[data-hay-metodos-pago]');

    if (formFinalizarCompra) {
        formFinalizarCompra.addEventListener("submit", function (event) {
            const hayMetodosPago = formFinalizarCompra.getAttribute("data-hay-metodos-pago") === "true";

            if (!hayMetodosPago) {
                event.preventDefault(); // Evitar el envío del formulario
                alert("Por favor, añade un método de pago antes de finalizar la compra.");
            }
        });
    } else {
        console.error("Formulario no encontrado en el DOM.");
    }
});