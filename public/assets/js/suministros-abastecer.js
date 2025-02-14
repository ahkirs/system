// Proveedores a listar mas adelante
let listProvidersOptions = ""

// llenadno los proveedores en el modal
const getProviders = async () => {
    const providers = await listarProviders()

    if (providers === false) {
        listProvidersOptions += `<option value="false">-- ERROR AL MOSTRAR LOS PROVEEDORES --</option>`
    }

    else {
        providers.forEach(provider => {
            listProvidersOptions += `<option value="${provider.idProveedor}">${provider.nombreRifProveedor}</option>`
        })
    }
}


/***********************
 *      FUNCIONES      *
 ***********************/

// Modal de error para mostrar en caso de que falle la peticion al traer los datos del usuario
const showErrorModal = (message) => {
    Swal.fire({
        title: "¡Ocurrió un error!",
        text: message,
        icon: "error",
        iconColor: "#f27474",
        confirmButtonColor: "#f27474"
    });
}

// Modal de exito al actualizar algun campo
const showSuccesModal = (title) => {
    Swal.fire({
        title: title,
        icon: "success",
        iconColor: "#6b99e3",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#2367d5"
    });
}



/**
 * funciones para validar los campos en el modal de abastecer suministr
 * en la funcion abastecerModal() */
// Validar la fecha de compra
const validPurchaseDate = (inputValue) => {
    const regex = /^\d{4}-\d{2}-\d{2}$/;

    if (inputValue === "" || inputValue.trim() === "") {
        return "Fecha de compra requerida"
    }
    if (!regex.test(inputValue)) {
        return "Fecha de compra con formato inválido";
    }


    // Verificando que la fecha no sea mayor a la fecha actual y que el año no sea menor a 2023
    const enteredDate = new Date(inputValue);
    const currentDate = new Date();
    if (enteredDate > currentDate) {
        return "Fecha futura inválida";
    }
    if (enteredDate.getFullYear() > currentDate.getFullYear()) {
        return `El año debe ser menor a ${currentDate.getFullYear()}`;
    }

    return true
}

// Validar la fecha de vencimiento
const validExpirationDate = (inputValue) => {
    const regex = /^\d{4}-\d{2}-\d{2}$/;

    if (inputValue === "" || inputValue.trim() === "") {
        return "Fecha de vencimiento requerida"
    }
    if (!regex.test(inputValue)) {
        return "Fecha de vencimiento con formato inválido";
    }


    // Verificando que la fecha no sea mayor a la fecha actual y que el año no sea menor a 2023
    const enteredDate = new Date(inputValue);
    const currentDate = new Date();
    enteredDate.setHours(0, 0, 0, 0);
    currentDate.setHours(0, 0, 0, 0);

    if (enteredDate.getFullYear() < currentDate.getFullYear()) return "Fecha de vencimiento menor a la actual es inválida";

    if (enteredDate < currentDate) return "Fecha de vencimiento menor a la actual es inválida";

    return true
}

// Validar el precio
const validPrice = (inputValue, type = "bs") => {
    const regex = /^[0-9]*\.?[0-9]+$/;

    if (inputValue === "" || inputValue.trim() === "") {
        if (type === "bs") {
            return "Monto en Bs requerido"
        }
        return "Monto en USD requerido"
    }

    if (!regex.test(inputValue)) {
        if (type === "bs") {
            return "Monto en Bs inválido"
        }
        return "Monto en USD inválido"
    }

    return true
}

// Validar las unidades adquiridas
const validUnidadesAdquiridas = (inputValue) => {
    const regex = /^[0-9]+$/

    if (inputValue === "" || inputValue.trim() === "") {
        return "Ingrese las unidades adquiridas"
    }

    if (!regex.test(inputValue)) {
        return "Unidades adquiridas inválidas"
    }

    return true
}

const validPayment = (inputValue) => {
    const options = ["1", "2"]

    if (!options.includes(inputValue)) return "Condición de pago inválida"

    return true
}

// Validar el proveedor
const validProvider = (inputValue) => {
    const regex = /^[0-9]+$/

    if (!regex.test(inputValue)) {
        return "Proveedor inválido"
    }

    return true
}

// Modal para abastecer
const abastecerModal = (suministro, idSuministro) => {
    Swal.fire({
        title: `Abastecer ${suministro}`,
        confirmButtonText: "Actulizar",
        confirmButtonColor: "#2367d5",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        html: `
            <select class="swal2-select" name="proveedor" id="swal-select">
                ${listProvidersOptions}
            </select>

            <label for="fechaCompra">Fecha de compra:</label>
            <input class="swal2-input" id="fechaCompra" name="fechaCompra" type="date" placeholder="Fecha de compra">

            <label for="fechaVencimiento">Fecha de vencimiento:</label>
            <input class="swal2-input" id="fechaVencimiento" name="fechaVencimiento" type="date" placeholder="Fecha de compra">

            <input class="swal2-input" name="unidadesAdquiridas" type="text" placeholder="Unidades adquiridas">
            <input class="swal2-input" name="montoDolares" type="text" placeholder="Monto en dolares">
            <input class="swal2-input" name="montoBs" type="text" placeholder="Monto en bs">
            
            <label for="condicionPago">Condición de pago:</label>
            <select class="swal2-select" name="condicionPago" id="condicionPago">
                <option value="1">Crédito</option>
                <option value="2">Contado</option>
            </select>
        `,
        preConfirm: async () => {
            try {
                const provider = document.querySelector("select[name='proveedor']").value
                const fechaCompra = document.querySelector("input[name='fechaCompra'").value
                const fechaVencimiento = document.querySelector("input[name='fechaVencimiento'").value
                const unidadesAdquiridas = document.querySelector("input[name='unidadesAdquiridas'").value
                const montoUsd = document.querySelector("input[name='montoDolares'").value
                const montoBs = document.querySelector("input[name='montoBs'").value
                const condicionPago = document.querySelector("select[name='condicionPago']").value

                // Ressultado de las funciones al validar los campos
                const isValidProvider = validProvider(provider)
                const isValidFechaCompra = validPurchaseDate(fechaCompra)
                const isValidFechaExpiration = validExpirationDate(fechaVencimiento)
                const isValidMontoUsd = validPrice(montoUsd, "usd")
                const isValidMontoBs = validPrice(montoBs, "bs")
                const isValidUnidadesAdquiridas = validUnidadesAdquiridas(unidadesAdquiridas)
                const isValidPayment = validPayment(condicionPago)

                if (isValidProvider !== true) return Swal.showValidationMessage(isValidProvider)

                if (isValidFechaCompra !== true) return Swal.showValidationMessage(isValidFechaCompra)

                if (isValidFechaExpiration !== true) return Swal.showValidationMessage(isValidFechaExpiration)

                if (isValidUnidadesAdquiridas !== true) return Swal.showValidationMessage(isValidUnidadesAdquiridas)

                if (isValidMontoUsd !== true) return Swal.showValidationMessage(isValidMontoUsd)

                if (isValidMontoBs !== true) return Swal.showValidationMessage(isValidMontoBs)

                if (isValidPayment !== true) return Swal.showValidationMessage(isValidPayment)

                const dataSend = {
                    idSuministro,
                    idProveedor: provider,
                    fechaCompraSuministro: fechaCompra,
                    fechaVencimientoSuministro: fechaVencimiento,
                    unidadesAdquiridasSuministro: unidadesAdquiridas,
                    montoUsdSuministro: montoUsd,
                    montoBsSuministro: montoBs,
                    condicionPagoSuministro: condicionPago
                }

                const peticion = await fetch(`${RUTA}/suministros/addsupply`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify(dataSend)
                })

                if (peticion.ok) {
                    const response = await peticion.json()
                    console.log(response)
                    if (response.status === true) {
                        showSuccesModal(response.response)
                    }
                    else {
                        return Swal.showValidationMessage(response.response);
                    }
                }
                else {
                    return Swal.showValidationMessage("Ocurrió un error inesperado");
                }
            } catch (error) {
                console.log(error)
                Swal.showValidationMessage("Ocurrió un error inesperado");
            }
        },
        allowOutsideClick: () => Swal.isLoading()
    })
}




document.addEventListener("click", e => {
    if (e.target.matches(".header-cta.card-btn")) {
        abastecerModal(e.target.dataset.product, e.target.dataset.suministro)
    }
})


document.addEventListener("DOMContentLoaded", () => {
    getProviders()
})