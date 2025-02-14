const $form = document.getElementById("form")
const $inputFile = document.getElementById("imagenProducto")

/***************
 *  FUNCIONES  *
 ***************
 */

// Llenar las cotegorias en el select
const fillCategories = async () => {
    const categories = await getCategory()
    const select = document.getElementById("categoriaProducto")
    let options = ""

    if (categories === false) {
        options = `<option value="false">-- NO SE PUDIERON TRAER LAS CATEGORIAS --</option>`
    }
    else if (categories === null) {
        options = `<option value="${categories}">-- NO HAY CATEGORIAS REGISTRADAS --</option>`
    }
    else {
        categories.forEach(category => {
            options += `<option value="${category.idCategoria}">${category.nombreCategoria}</option>`
        })
    }

    select.innerHTML = options
}


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

// Validar la categoria
const validCategory = (selectorInput, selectorError) => {
    const select = document.querySelector(selectorInput)
    const error = document.createElement("span")
    const inputContainer = select.parentElement

    error.classList.add("form__input-error")
    
    if (select.value === "null" || CATEGORIES_ID.lenght === 0) {
        handleErrorMessage(selectorError, "Registre una categoría", select, error)
        return false
    }

    if (!CATEGORIES_ID.includes(parseInt(select.value))) {
        handleErrorMessage(selectorError, "Categoría inválida", select, error)
        return false
    }    

    if (select.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validar nombre del y la descripcion del producto
const validateText = (selectorInput, selectorError, max, min) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = /^[A-Za-zzáéíóúÁÉÍÓÚñÑ0-9\s]+$/

    error.classList.add("form__input-error")

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "Campo requerido", input, error)
        return false
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Solo se permiten letras y números", input, error)
        return false
    }
    if (value.length < min) {
        handleErrorMessage(selectorError, `Debe tener mínimo ${min} caracteres`, input, error)
        return false
    }
    if (value.length > max) {
        handleErrorMessage(selectorError, `Debe tener como máximo ${max} caracteres`, input, error)
        return false
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validar precio
const validPrice = (selectorInput, selectorError) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const inputContainer = input.parentElement
    const regex = /^\d+(\.\d+)?$/;

    const error = document.createElement("span")
    error.classList.add("form__input-error")

    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Precio inválido", input, error)
        return false
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validar la imagen del suministro
const validImageToUpload = (selectorInput, selectorError) => {
    const input = document.querySelector(selectorInput)
    const inputContainer = input.parentElement
    const error = document.createElement("span")

    error.classList.add("form__input-error")
    // Si se selecciona la imagen hacer las validaciones
    if (input.files[0]) {
        const file = input.files[0]
        const validTypes = ['image/png', 'image/jpeg'];
        // console.log(file)

        // Verficar que sea el formato correcto
        if (!validTypes.includes(file.type)) {
            handleErrorMessage(selectorError, "Solo se permiten imagenes en formato PNG o JPG", input, error)
            return false
        }
        // Que no pese mas de 500KB
        if (file.size > 700 * 1024) {
            handleErrorMessage(selectorError, "La imagen no debes pesar más de 700KB", input, error);
            return false;
        }

        // Que no tenga ancho y alto mayor a 900px
        const img = new Image();
        img.src = URL.createObjectURL(file);
        img.classList.add('form__input-fileImg')

        return new Promise((resolve) => {
            img.onload = function () {
                if (img.width > 900 || img.height > 900) {
                    handleErrorMessage(selectorError, "La imagen no debe tener más de 900px de ancho y alto", input, error);
                    resolve(false);
                } else {
                    resolve(true);
                }
            };
        });
    }

    // Si no se selecciona la imagen mostrar el error
    else {
        handleErrorMessage(selectorError, "Seleccione una imagen", input, error)
        if (inputContainer.children[4]) {
            inputContainer.removeChild(inputContainer.children[4])
        }
        return false
    }
}


// Obtener los datos del formulario en un  objeto
const getFormData = form => {
    return Object.fromEntries(new FormData(form))
}

// Resetear el formulario al registrar un suministro
const resetForm = () => {
    $form.reset()

    if (document.querySelector(".form__input-fileImg")) {
        const container = document.querySelector(".form__input-fileImg").parentElement
        container.removeChild(container.lastElementChild)
    }
}

/**  MODALES  **/ 
// Modal de cargando
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


// Enviando los datos al servidor
const sendData = async (data) => {
    console.log(data)
    try {
        const peticion = await fetch(`${RUTA}/productos/newproduct`, {
            method: 'POST',
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify(data)
        })

        if (peticion.ok) {
            const response = await peticion.json()

            if (response.status) {
                showSuccesModal(response.response)
                resetForm()
            } else {
                console.log(response)
                showErrorModal(response.response)
            }
        } else {
            console.log("error")
            showErrorModal()
        }

    } catch (error) {
        console.log(error)
        showErrorModal()
    }
}






/**************
 *  LISTENER  *
 *************
 */
// Para cuando se sube una imagen del suministro
$inputFile.addEventListener('change', e => {
    const inputContainer = $inputFile.parentElement
    const error = document.createElement("span")
    error.classList.add('form__input-error')

    if (e.target.files[0]) {
        const file = e.target.files[0]
        const img = document.querySelector('.form__input-fileImg') || new Image();
        const selectorError = "#imagenSuministro + .form__input-error"
        img.classList.add('form__input-fileImg')

        const validTypes = ['image/png', 'image/jpeg'];

        // Verficar que sea el formato correcto
        if (!validTypes.includes(file.type)) {
            handleErrorMessage(selectorError, "Solo se permiten imagenes en formato PNG o JPG", e.target, error)
            // ELiminando la imagen si hay un archivo en un formato invalido
            if (inputContainer.children[4].classList.contains('form__input-fileImg')) {
                inputContainer.removeChild(inputContainer.lastElementChild)
            }
            return false
        }

        if (file.size > 700 * 1024) {
            handleErrorMessage(selectorError, "La imagen no debe pesar más de 700KB", e.target, error);
            // Eliminando la imagen si existe
            if (inputContainer.children[4] && inputContainer.children[4].classList.contains('form__input-fileImg')) {
                inputContainer.removeChild(inputContainer.lastElementChild)
            }
            return false;
        }

        img.src = URL.createObjectURL(file);
        img.style.width = '100px'
        img.style.height = '100px'
        img.style.objectFit = 'cover'

        if (!document.querySelector('.form__input-fileImg')) {
            inputContainer.appendChild(img)
        }
    }

    if (e.target.nextElementSibling.classList.contains('form__input-error')) inputContainer.removeChild(inputContainer.children[3])
})


// Al enviar el formulario
$form.addEventListener("submit", async (e) => {
    e.preventDefault()
    const isImageValid = await validImageToUpload('#imagenProducto', '#imagenProducto + .form__input-error');
    if (
        isImageValid &&
        validCategory("#categoriaProducto", "#categoriaProducto + .form__input-error") &&
        validateText("#nombreProducto", "#nombreProducto + .form__input-error", 20, 4) &&
        validateText("#descripcionProducto", "#descripcionProducto + .form__input-error", 40, 4) &&
        validPrice("#precioProducto", "#precioProducto + .form__input-error")
    ) {

        const imagenProducto = $inputFile.files[0]

        if ($inputFile.nextElementSibling.classList.contains("form__input-error")) {
            const parent = $inputFile.parentElement
            parent.removeChild($inputFile.nextElementSibling)
        }

        if (imagenProducto) {
            const reader = new FileReader();
            reader.readAsDataURL(imagenProducto)
            reader.onloadend = function () {
                const base64data = reader.result; // Obtiene la cadena en Base64

                const dataSend = getFormData(form)
                dataSend.imagenProducto = base64data
                showModalLoading()
                sendData(dataSend)
            }
        }
    }
})

document.addEventListener("DOMContentLoaded", () => {
    fillCategories()
})