const $form = document.getElementById("form")


/*************
 * FUNCIONES *
 *************/ 

/* PARA VALIDAR EL FORMULARIO */

// Para verificar si el elemento con el mesaje de error existe, si es así modificarle el mensaje, sino añadirlo al DOM
// esto para evitar que se añada mas de una vez el elemento al DOM
const handleErrorMessage = (selector, errorText, input, errorElement) => {
    if (document.querySelector(selector)) {
        document.querySelector(selector).textContent = errorText
    } else {
        errorElement.textContent = errorText
        input.insertAdjacentElement("afterEnd", errorElement)
    }
}


// Validar el nombre de la categoria y la descripcion
const validText = (selectorInput, selectorError) => {
    const regex = new RegExp(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/)
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const blankSpaces = value.split("").filter(letter => letter === " ")
    error.classList.add("form__input-error")

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "Campo requerido", input, error)
        return false
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Este campo solo acepta letras", input, error)
        return false
    }
    if (value.length < 3 || value.length > 25 || value.trim() < 3) {
        handleErrorMessage(selectorError, "Este campo debe estar entre 3 y 25 caracteres", input, error)
        return false
    }
    if (blankSpaces.length > 7) {
        handleErrorMessage(selectorError, "Valor inválido", input, error)
        return false
    }

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}


// Obtener los datos del formulario en un  objeto
const getFormData = form => {
    return Object.fromEntries(new FormData(form))
}


/**
 * MODAL
 */
// Modal de procesando
const showModalLoading = () => {
    Swal.fire({
        title: 'Procesando datos',
        text:  'Por favor no recargue ni cierre página',
        didOpen: () =>  {
            Swal.showLoading()
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
}

// Modal de exito
const showSuccesModal = (message) => {
    Swal.fire({
        title: message,
        icon: "success",
        iconColor: "#6b99e3",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#2367d5"
    });
}

// Modal de error
const showErrorModal = (message = "Oooops! ocurrió un error") => {
    Swal.fire({
        title: message,
        icon: "error",
        iconColor: "#f27474",
        confirmButtonText: "Cerrar",
        confirmButtonColor: "#f27474"
    });
}


// Enviar los datos
const senData = async (data) => {
    try {
        const peticion = await fetch(`${RUTA}/categorias/newcategory`, {
            method: 'POST',
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify(data)
        })

        if (peticion.ok) {
            const response = await peticion.json()
            console.log(response)
            if (response.status) {
                showSuccesModal(response.response)
                $form.reset()
            } else {
                showErrorModal(response.response)
            }
        }
    } catch (error) {
        showErrorModal()
        console.log(error)
    }
}





$form.addEventListener("submit", e => {
    e.preventDefault()

    if (
        validText("#nombreCategoria", "#nombreCategoria + .form__input-error") &&
        validText("#descripcionCategoria", "#descripcionCategoria + .form__input-error")
    ) {
        console.log(getFormData($form))
        showModalLoading()
        senData(getFormData($form))
    }
})