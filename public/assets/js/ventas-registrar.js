const modalBuscarCliente = () => {
    Swal.fire({
        title: "Buscar cliente ya registrado",
        icon: "warning",
        input: "number",
        inputAttributes: {
            autocapitalize: "off",
            placeholder: "Ingrese el número de cédula"
        },
        iconColor: "#6b99e3",
        confirmButtonText: "Buscar",
        confirmButtonColor: "#2367d5",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        inputValidator: (value) => {
            const regex = /^[0-9]+$/

            if (!value) {
                return "Ingrese la cédula";
            }
            if (!regex.test(value)) {
                return "La cédula es inválida";
            }
        },
        preConfirm: async (cedula) => {
            try {
                console.log({ cedulaCliente: cedula })
                const peticion = await fetch(`${RUTA}/perfil/setusername`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify({ cedulaCliente: cedula })
                })

                if (peticion.ok) {
                    const response = await peticion.json()
                    console.log(response)
                    if (response.status === true) {
                        showSuccesModal(response.response)
                        getUser()
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



/**
 * LISTENERS
 */ 
document.addEventListener("click", e => {
    if (e.target.matches("#buscar-cliente")) {
        modalBuscarCliente()
    }
})