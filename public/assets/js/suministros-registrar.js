const form = document.getElementById('form-suministro')
const inputFile = document.getElementById('imagenSuministro')

// Estos se usaran para deshabilitar losinputs cuando se selecione un proveedor registrado
const selectProveedor = document.getElementById('proveedorSelect')
const disabledInputsContainer = document.getElementById('disable-inputs')

/*************************
 *       FUNCIONES       *
*************************/
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

const validCategory = (selectorInput, selectorError) => {
    const select = document.querySelector(selectorInput)
    const error = document.createElement("span")
    const inputContainer = select.parentElement

    error.classList.add("form__input-error")
    
    if (select.value === "null" || CATEGORIES_ID.length === 0) {
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

// Validando el telefono
const validPhone = (selectorInput, selectorError) => {
    const regex = new RegExp(/^[0-9]+$/)
    const input = document.querySelector(selectorInput)
    const select = input.previousElementSibling
    const inputContainer = input.parentElement
    const value = input.value
    const options = ["0414", "0424", "0412", "0416", "0426"]
    const error = document.createElement("span")

    error.classList.add("form__input-error")

    if (options.indexOf(select.value) === -1) {
        handleErrorMessage(selectorError, "Codigo de área inválido", input, error)
        return false
    }

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "El número no debe estar vacío", input, error)
        return false;
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Ingrese solo números", input, error)
        return false
    }
    if (value.length !== 7) {
        handleErrorMessage(selectorError, "Ingrese 7 números", input, error)
        return false
    }

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true;
}

// Validando el correo
const validEmail = (selectorInput, selectorError) => {
    const regex = new RegExp(/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/)
    const input = document.querySelector(selectorInput)
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const value = input.value

    error.classList.add("form__input-error")

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "El correo no debe estar vacío", input, error)
        return false
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "El correo es inválido", input, error)
        return false
    }
    if (input.value.length > 40 || input.value.lenght < 10) {
        handleErrorMessage(selectorError, "El correo debe estar entre 15 y 50 caracteres", input, error)
        return false
    }

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validar los municipios y los estados
const validMunicipiosParroquias = (selectorInput, selectorError, max) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = new RegExp(/^[0-9]+$/)

    error.classList.add("form__input-error")

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "Seleccione una opción", input, error)
        return false
    }
    if (!regex.test(value) || value.length > max) {
        handleErrorMessage(selectorError, "Valor inválido", input, error)
        return false
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validar nombre del suministro, descripcion del suministro, nombre del proveedor la comunidad, y punto de referencia
const validateText = (selectorInput, selectorError, max, min) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = /^(?=(?:[^-]*-){0,3}[^-]*$)[A-Za-záéíóúÁÉÍÓÚñÑ0-9 -]+$/;

    error.classList.add("form__input-error")

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "Campo requerido", input, error)
        return false
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Solo se permiten letras, números, espacios y guiones", input, error)
        return false
    }
    if (value.length < min) {
        handleErrorMessage(selectorError, `El campo debe tener al menos ${min} caracteres`, input, error)
        return false
    }
    if (value.length > max) {
        handleErrorMessage(selectorError, `El campo debe tener como máximo ${max} caracteres`, input, error)
        return false
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validar las unidades compradas y los montos cancelados
const validNumber = (selectorInput, selectorError, type = 'monto') => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement

    error.classList.add("form__input-error")

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "Campo requerido", input, error)
        return false
    }
    if (type === "monto") {
        const regex = /^[0-9]*\.?[0-9]+$/;

        if (!regex.test(value)) {
            handleErrorMessage(selectorError, "Monto inválido", input, error)
            return false
        }
    } else {
        const regex = /^[0-9]+$/

        if (!regex.test(value)) {
            handleErrorMessage(selectorError, "Unidades inválidas", input, error)
            return false
        }
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

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

// Validar la fecha de vencimiento
const validExpirationDate = (selectorInput, selectorError) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = /^\d{4}-\d{2}-\d{2}$/;
    error.classList.add('form__input-error')

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "Se requiere la fecha", input, error)
        return false
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Formato de fecha inválido", input, error)
        return false;
    }

    // Verificando que la fecha no sea menor a la fecha actual
    const enteredDate = new Date(value);
    const currentDate = new Date();
    enteredDate.setHours(0, 0, 0, 0);
    currentDate.setHours(0, 0, 0, 0);

    if (enteredDate.getFullYear() < currentDate.getFullYear()) {
        handleErrorMessage(selectorError, "La fecha de puede ser menor a la fecha actual", input, error)
        return false;
    }
    if (enteredDate < currentDate) {
        handleErrorMessage(selectorError, "La fecha de puede ser menor a la fecha actual", input, error)
        return false;
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
        if (file.size > 400 * 1024) {
            handleErrorMessage(selectorError, "La imagen no debes pesar más de 400KB", input, error);
            return false;
        }

        // Que no tenga ancho y alto mayor a 400px
        const img = new Image();
        img.src = URL.createObjectURL(file);
        img.classList.add('form__input-fileImg')

        return new Promise((resolve) => {
            img.onload = function () {
                if (img.width > 700 || img.height > 700) {
                    handleErrorMessage(selectorError, "La imagen no debe tener más de 700px de ancho y alto", input, error);
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

// Validar el RIF del suministro
const validRif = (selectorInput, selectorSelect, selectorError) => {
    const typeRif = ["J", "G", "E", "C", "P", "V"]
    const input = document.querySelector(selectorInput)
    const typeRifSelect = document.querySelector(selectorSelect).value
    const inputContainer = input.parentElement

    const error = document.createElement("span")
    error.classList.add('form__input-error')


    if (!typeRif.includes(typeRifSelect)) {
        handleErrorMessage(selectorError, "Tipo de RIF inválido", input, error)
        return false
    }
    if (input.value === "" || input.value.trim() === "") {
        handleErrorMessage(selectorError, "Ingrese el RIF", input, error)
        return false
    }
    if (input.value.length < 6 || input.value.length > 10) {
        handleErrorMessage(selectorError, "RIF inválido", input, error)
        return false
    }

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validar la condicion de pago
const validPayment = (selectorInput, selectorError) => {
    const select = document.querySelector(selectorInput)
    const inputContainer = select.parentElement
    const options = ["1", "2"]
    const error = document.createElement("span")
    error.classList.add("form__input-error")

    if (!options.includes(select.value)) {
        handleErrorMessage(selectorError, "Condición de pago inválida", select, error)
        return false
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (select.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}



// Resetear el formulario al registrar un suministro
const resetForm = () => {
    form.reset()
    fillProviders()

    const proveedorSelect = document.getElementById("proveedorSelect")
    const disabledInputs = document.getElementById("disable-inputs")
    disabledInputs.setAttribute("data-disabled", false)
    proveedorSelect.classList.remove("disabled-input")


    if (document.querySelector(".form__input-fileImg")) {
        const container = document.querySelector(".form__input-fileImg").parentElement
        container.removeChild(container.lastElementChild)
    }
}




/**
 * FUNCIONES PARA RELLENAR CON LOS DATOS DEL SERVIDOR
 * LOS PROVEDORES REGISTRADOS Y LAS CATEGORIAS
*/
const fillCategories = async () => {
    const categories = await getCategory()
    const select = document.getElementById("categoriaSuministro")
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

fillCategories()
fillProviders()




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
const sendData = async (data) => {
    try {
        const peticion = await fetch(`${RUTA}/suministros/newsupply`, {
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
                console.log(response)
                resetForm()
            } else {
                showErrorModal(response.response)
                console.log(response)
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


// Para cuando se sube una imagen del suministro
inputFile.addEventListener('change', e => {
    const inputContainer = inputFile.parentElement
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

        if (file.size > 400 * 1024) {
            handleErrorMessage(selectorError, "La imagen no debe pesar más de 400KB", e.target, error);
            // Eliminando la imagen si existe
            if (inputContainer.children[4].classList.contains('form__input-fileImg')) {
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


// Cuando se seleciona un proveedor registrado deshabilitar los inputs
selectProveedor.addEventListener('change', e => {
    if (e.target.value === 'false') {
        disabledInputsContainer.setAttribute('data-disabled', 'false')
    }
    else {
        disabledInputsContainer.setAttribute('data-disabled', 'true')
        const erros = [...disabledInputsContainer.querySelectorAll('.form__input-error')]

        // console.log(erros)
        erros.forEach(item => {
            const errorElement = item.parentElement.lastElementChild
            item.parentElement.removeChild(errorElement)
        })
    }
})




form.addEventListener('submit', async (event) => {
    event.preventDefault()
    const isImageValid = await validImageToUpload('#imagenSuministro', '#imagenSuministro + .form__input-error');
    const isSelectedProveedor = selectProveedor.value

    // Si no se selecciona un proveedor validar todos los campos
    if (isSelectedProveedor === 'false') {
        if (
            isImageValid &&
            validateText('#nombreSuministro', '#nombreSuministro + .form__input-error', 50, 5) &&
            validateText('#descripcionSuministro', '#descripcionSuministro + .form__input-error', 50, 5) &&
            validPurchaseDate('#fechaCompraSuministro', '#fechaCompraSuministro + .form__input-error') &&
            validExpirationDate('#fechaVencimientoSuministro', '#fechaVencimientoSuministro + .form__input-error') &&
            validNumber('#unidadesAdquiridas', '#unidadesAdquiridas + .form__input-error', 'unidades') &&
            validNumber('#montoDolaresSuministro', '#montoDolaresSuministro + .form__input-error') &&
            validNumber('#montoBsSuministro', '#montoBsSuministro + .form__input-error') &&
            validPayment('#condicionPagoSuministro', '#condicionPagoSuministro + .form__input-error') &&
            validRif('#rifProveedor', '#rifProveedorTipo', '#rifProveedor + .form__input-error') &&
            validateText('#nombreProveedor', '#nombreProveedor + .form__input-error', 50, 5) &&
            validPhone('#telProveedor', '#telProveedor + .form__input-error') &&
            validEmail('#correoProveedor', '#correoProveedor + .form__input-error') &&
            validMunicipiosParroquias('#municipio', '#municipio + .form__input-error', 4) &&
            validMunicipiosParroquias('#parroquia', '#parroquia + .form__input-error', 5) &&
            validateText('#comunidadProveedor', '#comunidadProveedor + .form__input-error', 50, 5) &&
            validateText('#refProveedor', '#refProveedor + .form__input-error', 70, 5)
        ) {
            // Con FormData Forma 1
            const imagenSuministro = document.getElementById('imagenSuministro').files[0]
            const imagenSuministroInput = document.getElementById('imagenSuministro')

            if (imagenSuministroInput.nextElementSibling.classList.contains("form__input-error")) {
                const parent = imagenSuministroInput.parentElement
                parent.removeChild(imagenSuministroInput.nextElementSibling)
            }

            if (imagenSuministro) {
                const reader = new FileReader();
                reader.readAsDataURL(imagenSuministro)
                reader.onloadend = function () {
                    const base64data = reader.result; // Obtiene la cadena en Base64

                    const dataSend = getFormData(form)
                    dataSend.imagenSuministro = base64data
                    console.log(dataSend)
                    showModalLoading()
                    sendData(dataSend)
                }
            }
        }
    }

    // Si se selecciona un proveedor validor solo los campos del suministro
    else {
        if (
            isImageValid &&
            validateText('#nombreSuministro', '#nombreSuministro + .form__input-error', 50, 5) &&
            validateText('#descripcionSuministro', '#descripcionSuministro + .form__input-error', 50, 5) &&
            validPurchaseDate('#fechaCompraSuministro', '#fechaCompraSuministro + .form__input-error') &&
            validExpirationDate('#fechaVencimientoSuministro', '#fechaVencimientoSuministro + .form__input-error') &&
            validNumber('#unidadesAdquiridas', '#unidadesAdquiridas + .form__input-error', 'unidades') &&
            validNumber('#montoDolaresSuministro', '#montoDolaresSuministro + .form__input-error') &&
            validNumber('#montoBsSuministro', '#montoBsSuministro + .form__input-error') &&
            validPayment('#condicionPagoSuministro', '#condicionPagoSuministro + .form__input-error')
        ) {
            // Con FormData Forma 1
            const imagenSuministro = document.getElementById('imagenSuministro').files[0]

            if (imagenSuministro) {
                const reader = new FileReader();
                reader.readAsDataURL(imagenSuministro)
                reader.onloadend = function () {
                    const base64data = reader.result; // Obtiene la cadena en Base64

                    const dataSend = getFormData(form)
                    dataSend.imagenSuministro = base64data
                    console.log(dataSend)
                    showModalLoading()
                    sendData(dataSend)
                }
            }
        }
    }
})