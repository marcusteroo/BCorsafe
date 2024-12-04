//Esta función la he encontrado en internet y es para poder saber el tipo de la tarjeta que se utiliza
function detectarTipoTarjeta(numeroTarjeta) {
    if (/^4[0-9]{0,}$/.test(numeroTarjeta)) {
        return "Visa";
    } else if (/^5[1-5][0-9]{0,}$/.test(numeroTarjeta) || /^2(2[2-9][0-9]{0,}|[3-6][0-9]{0,}|7[01][0-9]{0,}|720[0-9]{0,})$/.test(numeroTarjeta)) {
        return "MasterCard";
    } else if (/^3[47][0-9]{0,}$/.test(numeroTarjeta)) {
        return "American Express";
    } else if (/^6(011|5[0-9]{2}|4[4-9][0-9]|22[1-9]|22[3-9]|622[1-9][0-9]{0,})[0-9]{0,}$/.test(numeroTarjeta)) {
        return "Discover";
    } else {
        return null;
    }
}

function mostrarFormulario() {
    const formulario = document.getElementById('formulario-editar-metodopago');
    formulario.style.display = 'block';
}
//Esta función es para poder poner la imagen de su respectiva tarjeta
document.addEventListener("DOMContentLoaded", function () {
    const formularioAgregar = document.getElementById("formulario-agregar-metodopago");
    const formularioEditar = document.getElementById("formulario-editar-metodopago");

    const iconoTarjetaNuevo = document.getElementById("tipo_tarjeta_img_nuevo");
    const iconoTarjetaEditar = document.getElementById("tipo_tarjeta_img_editar");

    const inputTipoTarjetaNuevo = document.getElementById("tipo_pago_nuevo");
    const inputTipoTarjetaEditar = document.getElementById("tipo_pago_editar");

    if (formularioAgregar) {
        formularioAgregar.style.display="block"
        document.getElementById("numero_tarjeta_nuevo").addEventListener("input", function (e) {
            const numeroTarjeta = e.target.value.replace(/\s+/g, ""); 
            const tipoTarjeta = detectarTipoTarjeta(numeroTarjeta);
            

            if (tipoTarjeta) {
                iconoTarjetaNuevo.src = '/BCorsafe/assets/img/' + tipoTarjeta.toLowerCase() + '.svg';
                iconoTarjetaNuevo.style.display = "block";
                inputTipoTarjetaNuevo.value = tipoTarjeta;
            } else {
                iconoTarjetaNuevo.style.display = "none";
                inputTipoTarjetaNuevo.value = "";
            }
        });
    }

    if (formularioEditar) {
        document.getElementById("numero_tarjeta_editar").addEventListener("input", function (e) {
            const numeroTarjeta = e.target.value.replace(/\s+/g, ""); 
            const tipoTarjeta = detectarTipoTarjeta(numeroTarjeta);

            if (tipoTarjeta) {
                iconoTarjetaEditar.src = '/BCorsafe/assets/img/' + tipoTarjeta.toLowerCase() + '.svg';
                iconoTarjetaEditar.style.display = "block";
                inputTipoTarjetaEditar.value = tipoTarjeta;
            } else {
                iconoTarjetaEditar.style.display = "none";
                inputTipoTarjetaEditar.value = "";
            }
        });
    }
});
//Este código sirve para autorrelenar la fecha de vencimiento en el input con el formato correcto
const fechaExpiracionInput = document.getElementById('fecha_expiracion');

    fechaExpiracionInput.addEventListener('input', (e) => {
        let valor = e.target.value.replace(/\D/g, ''); 
        if (valor.length >= 3) {
            valor = valor.slice(0, 2) + '/' + valor.slice(2); 
        }
        if (valor.length > 5) {
            valor = valor.slice(0, 5); 
        }
        e.target.value = valor;
    });

    fechaExpiracionInput.addEventListener('blur', (e) => {
        let valor = e.target.value;
        if (valor.length === 4 && valor.includes('/')) {
            const [mes, anio] = valor.split('/');
            e.target.value = (mes.length === 1 ? '0' + mes : mes) + '/' + anio; 
        }
    });
