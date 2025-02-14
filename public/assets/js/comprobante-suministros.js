const form = document.getElementById('form-suministro')
const selectProveedor = document.getElementById('proveedorSelect')


// Validar la fecha de compra
const validPurchaseDate = (selectorInput, selectorError) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = /^\d{4}-\d{2}-\d{2}$/;
    error.classList.add('form__input-error')

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "Ingrese la fecha ", input, error)
        return false
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Formato de fecha inválido", input, error)
        return false;
    }
    // Verificando que la fecha no sea mayor a la fecha actual y que el año no sea menor a 2023
    const enteredDate = new Date(value);
    const currentDate = new Date();
    if (enteredDate > currentDate) {
        handleErrorMessage(selectorError, "Fecha futura inválida", input, error)
        return false;
    }
    if (enteredDate.getFullYear() <= 2023) {
        handleErrorMessage(selectorError, "El año debe ser menor a 2024", input, error)
        return false;
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}



/**
 * FUNCIONES PARA RELLENAR CON LOS DATOS DEL SERVIDOR
 * LOS PROVEDORES REGISTRADOS Y LAS CATEGORIAS
*/

const fillProviders = async () => {
    const providers = await listarProviders()
    const select = document.getElementById("proveedorSelect")
    let options = ""

    if (providers === false) options += `<option value="false">-- NO SE PUDIERON TRAER LOS PROVEEDORES --</option>`

    else if (providers.length < 1) {
        options += `<option value="false">-- NO HAY PROVEEDORES REGISTRADOS --</option>`
        select.classList.add("disabled-input")
    }

    else {
        options += `<option value="false">-- Seleccione un proveedor ya registrado --</option>`
        providers.forEach(provider => {
            options += `<option value="${provider.idProveedor}">${provider.nombreRifProveedor}</option>`
        })
    }

    select.innerHTML = options
}

fillProviders()






// Validar el proveedor
const validProvider = (inputValue) => {
    const regex = /^[0-9]+$/

    if (!regex.test(inputValue)) {
        return "Proveedor inválido"
    }

    return true
}


/**
 * Creando los modales al enviar los datos, el de loading y el de la respuesta del servidor
 */
// Mostrar modal de procesando
const showModalLoading = () => {
    Swal.fire({
        title: 'Procesando datos',
        text: 'Por favor no recargue ni cierre página',
        didOpen: () => {
            Swal.showLoading()
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
}

// Mostrar modal de exito
const showSuccesModal = (message) => {
    Swal.fire({
        title: message,
        icon: "success",
        iconColor: "#6b99e3",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#2367d5"
    });
}

// Mostrar modal de error
const showErrorModal = (message = "Oooops! ocurrió un error") => {
    Swal.fire({
        title: message,
        icon: "error",
        iconColor: "#f27474",
        confirmButtonText: "Cerrar",
        confirmButtonColor: "#f27474"
    });
}




// Obtener los datos del formulario en un  objeto
const getFormData = form => {
    return Object.fromEntries(new FormData(form))
}


// Enviando los datos al servidor
const sendData = async (data, form) => {
    try {
        const peticion = await fetch(`${RUTA}/suministros/comprobantesupplies`, {
            method: 'POST',
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify(data)
        });

        if (peticion.ok) {
            const response = await peticion.json();

            if (response.status) {
                showSuccesModal(response.response);
                setTimeout(() => {
                    form.submit(); // Envío programático del formulario
                }, 3000); // 5000 milisegundos = 5 segundos                
            } else {
                showErrorModal(response.response);
            }
        } else {
            console.log("error");
            showErrorModal();
        }

    } catch (error) {
        console.log(error);
        showErrorModal();
    }
}

form.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (validPurchaseDate('#fechaCompraSuministro', '#fechaCompraSuministro + .form__input-error')) {
        const dataSend = getFormData(form);
        console.log(dataSend);
        showModalLoading();
        await sendData(dataSend, form); // Pasa el formulario como argumento
    }
});