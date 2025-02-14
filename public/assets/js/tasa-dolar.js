const $tasaDollarBtn = document.getElementById("tasa-dolar-btn")
let tasaDollar = null

/*******************
 *    FUNCIONES    *
 *******************/
// Traer los datos de la tasa de cambio
const getTasaDollar = async () => {
    try {
        const peticion = await fetch(`${RUTA}/ventas/tasas`)

        if (peticion.ok) {
            const res = await peticion.json()
            tasaDollar = res[0]
        }
    } catch (error) {
        console.log(error)
    }
}

// Modal de error si no se trajeron los datos de la tasa del dolar
const modalErrorTasa = () => {
    Swal.fire({
        title: "No se pudo mostrar la tasa",
        text: "Ocurrió un error al mostrar la tasa del dólar, por favor recargue la ventana",
        icon: "error",
        iconColor: "#f27474",
        confirmButtonColor: "#f27474",
        confirmButtonText: "Cerrar"
    });
}

// Modal de exito al actualizar algun campo
const modalSuccesData = (title) => {
    Swal.fire({
        title: title,
        icon: "success",
        iconColor: "#6b99e3",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#2367d5"
    });
}

// Mostrar el modal de actualizar tasa de cambio
const modalUpdateTasa = () => {
    console.log(tasaDollar)

    // Si hay un error al traer los datos de la tasa
    if (tasaDollar === null) {
        modalErrorTasa()
    }
    
    // Si no hay error
    else {
        Swal.fire({
            title: "Actualizar tasa de cambio",
            icon: "warning",
            input: "number",
            inputAttributes: {
                autocapitalize: "off"
            },
            iconColor: "#6b99e3",
            confirmButtonText: "Actualizar",
            confirmButtonColor: "#2367d5",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            inputValidator: (value) => {
                const regex = /^[0-9]*\.?[0-9]+$/
                console.log(value)

                if (!value) {
                    return "Ingrese el valor de la tasa";
                }
                if (!regex.test(value)) {
                    return "Valor de tasa inválido";
                }
            },
            preConfirm: async (price) => {
                try {
                    const peticion = await fetch(`${RUTA}/ventas/upTasa`, {
                        method: "POST",
                        headers: {
                            'Content-Type': "application/json"
                        },
                        body: JSON.stringify({
                            idTasa: tasaDollar.idTasa,
                            newValorTasa: price
                        })
                    })

                    if (peticion.ok) {
                        const response = await peticion.json()
                        console.log(response)
                        if (response.status === true) {
                            modalSuccesData(response.response)
                            getTasaDollar()
                        }
                        else {
                            return Swal.showValidationMessage(response.response);
                        }
                    }
                    else {
                        return Swal.showValidationMessage("¡No se actualizó la tasa! Ocurrió un error inesperado");
                    }
                } catch (error) {
                    console.log(error)
                    Swal.showValidationMessage("¡No se actualizó la tasa! Ocurrió un error inesperado");
                }
            },
            allowOutsideClick: () => Swal.isLoading()
        })
    }
}



/**
 * LISTENERS
 */

// Mostrar el modal de la tasa de cambio
$tasaDollarBtn.addEventListener("click", () => {
    // Error al traer los datos de la tasa
    if (tasaDollar === null) {
        modalErrorTasa()
    }
    // Si se trajeron los datos de la tasa
    else {
        Swal.fire({
            title: "Tasa del Dólar",
            icon: "success",
            iconColor: "#6b99e3",
            confirmButtonText: "Cerrar",
            confirmButtonColor: "#2367d5",
            html: `
                <div class="sweet__texts">
                    <p>
                        <span>Tasa:</span> ${tasaDollar.nombreTasa}
                    </p>
                    <p>
                        <span>Precio:</span> ${tasaDollar.valorTasa}
                    </p>
                    <p>
                        <span>Última Actualización:</span> ${tasaDollar.fechaUpdatedTasa}
                    </p>
                </div>
            `,
        });
    }
})

document.addEventListener("click", e => {
    if (e.target.matches("#update-tasa")) {
        modalUpdateTasa()
    }
})

document.addEventListener("DOMContentLoaded", () => {
    getTasaDollar()
})