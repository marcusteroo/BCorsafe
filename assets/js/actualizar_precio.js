document.addEventListener("DOMContentLoaded", function() {
    const precioBase = parseFloat(document.getElementById("precio-base").value); // Obtener el precio base
    const precioElemento = document.getElementById("precio-producto"); // Elemento que muestra el precio
    const checkboxes = document.querySelectorAll('.ingrediente-checkbox'); // Todos los checkboxes de ingredientes
    const ingredientesCustom = document.getElementsByName('ingredientes_custom[]'); // Ingredientes custom
    const cantidadInput = document.getElementById("cantidad"); // Campo de cantidad

    // Función para calcular el precio
    function actualizarPrecio() {
        let precioFinal = precioBase;

        // Recorrer todos los ingredientes seleccionados y deseleccionados
        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                // Si no está seleccionado, restar 2€ al precio final
                precioFinal -= parseFloat(checkbox.getAttribute('data-precio-reduccion'));
            }
        });

        // Obtener la cantidad seleccionada
        const cantidad = parseInt(cantidadInput.value) || 1; // Si no hay cantidad, se asume 1

        // Multiplicar el precio final por la cantidad
        precioFinal *= cantidad;

        // Actualizar el precio mostrado
        precioElemento.textContent = precioFinal.toFixed(2) + "€";

        // Actualizar el valor de los ingredientes seleccionados (se envía con el formulario)
        let ingredientesSeleccionados = [];
        for (let i = 0; i < ingredientesCustom.length; i++) {
            if (ingredientesCustom[i].checked) {
                ingredientesSeleccionados.push(ingredientesCustom[i].value);
            }
        }

        // Actualizar el campo 'ingredientes_custom' en el formulario
        document.querySelector('input[name="ingredientes_custom[]"]').value = ingredientesSeleccionados.join(',');
    }

    // Añadir evento para cada checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', actualizarPrecio);
    });

    // Añadir evento para cuando cambie la cantidad
    cantidadInput.addEventListener('input', actualizarPrecio);

    // Llamar a la función para establecer el precio inicial
    actualizarPrecio();
});
