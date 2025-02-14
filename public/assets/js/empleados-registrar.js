const form = document.getElementById('form')
const loaderSubmit = document.getElementById('loader-submit')
const loaderContent = document.querySelector(".loader__submit__container")



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

// Validando la cedula
const validId = (selectorInput, selectorError) => {
    const regex = new RegExp(/^[0-9]+$/)
    const input = document.querySelector(selectorInput)
    const select = input.previousElementSibling
    const inputContainer = input.parentElement
    const value = input.value
    const typeId = ["V", "E"]
    const error = document.createElement("span")

    error.classList.add("form__input-error")

    if (typeId.indexOf(select.value) === -1) {
        handleErrorMessage(selectorError, "Tipo de doumento inválido", input, error)
        return false
    }

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "La cédula no debe estar vacía", input, error)
        return false;
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "La cédula solo acepta números", input, error)
        return false
    }
    if (value.length < 6 || value.length > 8) {
        handleErrorMessage(selectorError, "La cédula debe tener entre 6 y 8 números", input, error)
        return false
    }

    if(input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true;
}

// Verificar si el nombre no esta vacio
const verifyName = nameSelector => {
    if (document.querySelector(nameSelector).value === "") return true
    else return false
}

// Para validar el primer nombre
const validFirstName = (selectorInput, selectorError) => {
    const regex = new RegExp(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/)
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement

    error.classList.add("form__input-error")

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "El nombre no debe estar vacío", input, error)
        return false
    }    
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "El nombre solo acepta letras", input, error)
        return false
    }
    if (value.indexOf(" ") !== value.lastIndexOf(" ")) {
        handleErrorMessage(selectorError, "Nombre acepta máximo 1 espacio de blanco", input, error)
        return false
    }
    if (value.length < 3 || value.length > 15 || value.trim() < 3) {
        handleErrorMessage(selectorError, "El nombre debe estar entre 3 y 15 caracteres", input, error)
        return false
    }

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validando el segundo nombre
const validSecondName = (selectorInput, selectorError) => {
    const regex = new RegExp(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/)
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement

    error.classList.add("form__input-error")

    if (value === "") {
        if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
        return true
    }
    
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "El nombre solo acepta letras", input, error)
        return false
    }
    if (value.indexOf(" ") !== value.lastIndexOf(" ")) {
        handleErrorMessage(selectorError, "Nombre acepta máximo 1 espacio de blanco", input, error)
        return false
    }
    if (value.length < 3 || value.length > 15 || value.trim() < 3) {
        handleErrorMessage(selectorError, "El nombre debe estar entre 3 y 15 caracteres", input, error)
        return false
    }

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validando el tercer nombre
const validThirdName = (selectorInput, selectorError, secondName) => {
    const regex = new RegExp(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/)
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const isEmptySecondName = verifyName(secondName)

    error.classList.add("form__input-error")

    if (value !== "" && isEmptySecondName) {
        handleErrorMessage(selectorError, "Ingrese el segundo nombre", input, error)
        return false
    }   
    if (value === "") {
        if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
        return true
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "El nombre solo acepta letras", input, error)
        return false
    }
    if (value.indexOf(" ") !== value.lastIndexOf(" ")) {
        handleErrorMessage(selectorError, "Nombre acepta máximo 1 espacio de blanco", input, error)
        return false
    }
    if (value.length < 3 || value.length > 15 || value.trim() < 3) {
        handleErrorMessage(selectorError, "El nombre debe estar entre 3 y 15 caracteres", input, error)
        return false
    }

    console.log(input.nextElementSibling)
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Para validar el primer y segundo apellido
const validLastame = (selectorInput, selectorError, numLastname) => {
    const regex = new RegExp(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/)
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement

    error.classList.add("form__input-error")
    // Guardando el numero de espacios en un arreglo
    const numSpaces = value.split("").filter(char => char === " ")

    // Verificando en el primer y segundo condicional de que apellido se trata si del primero o del segundo
    if (numLastname === "first" && (value === "" || value.trim() === "")) {
        handleErrorMessage(selectorError, "El apellido no debe estar vacío", input, error)
        return false
    }    
    if (numLastname === "second" && (value === "" || value.trim() === "")) {
        if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
        return true;
    }    
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "El apellido solo acepta letras", input, error)
        return false
    }
    if (numSpaces.length > 2) {
        handleErrorMessage(selectorError, "El apellido acepta máximo 2 espacios en blanco", input, error)
        return false
    }
    if (value.length < 3 || value.length > 20) {
        handleErrorMessage(selectorError, "El apellido debe estar entre 3 y 20 caracteres", input, error)
        return false
    } 

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validando la fecha de nacimiento
const validBornDate = (selectorInput, selectorError) => {
    const input = document.querySelector(selectorInput)
    const inputContainer = input.parentElement
    const error = document.createElement("span")
    const bornData = input.value.split("-")
    const currentYear = new Date().getFullYear()
    const currentMonth = new Date().getMonth() + 1
    const currentDay = new Date().getDate()
    const regex =  new RegExp(/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/);
  
    error.classList.add("form__input-error")


    // Para calcular la edad
    const fechaNacimiento = new Date(input.value);
    const hoy = new Date();
    let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const mes = hoy.getMonth() - fechaNacimiento.getMonth();
    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
        edad--
    }


    if (input.value === "") {
        handleErrorMessage(selectorError, "La fecha no debe estar vacía", input, error)
        return false
    }
    else if (!regex.test(input.value)) {
        handleErrorMessage(selectorError, "Formato de fecha inválido", input, error)
        return false
    }
    // Validando el año
    else if (bornData[0] < 1940) {
        handleErrorMessage(selectorError, "El año no debe ser menor a 1940", input, error)
        return false
    }
    else if (bornData[0] > currentYear) {
        handleErrorMessage(selectorError, "Año inválido", input, error)
        return false
    }
    
    // Validando el mes
    else if (bornData[1] < 1 || bornData[1] > 12) {
        handleErrorMessage(selectorError, "Mes inválido", input, error)
        return false
    }

    // Validando el dia
    else if (bornData[2] < 1 || bornData[2] > 31) {
        handleErrorMessage(selectorError, "Día inválido", input, error)
        return false
    }
    
    // Validando que la fecha no sea futura
    if (bornData[0] > currentYear || (bornData[0] == currentYear && bornData[1] > currentMonth) || (bornData[0] == currentYear && bornData[1] == currentMonth && bornData[2] >= currentDay)) {
        handleErrorMessage(selectorError, "Fecha inválida", input, error)
        return false;
    } 

    // Validando que el empleado sea mayor de edad
    console.log(edad)
    if (edad < 18) {
        handleErrorMessage(selectorError, "El empleado no es mayor de edad", input, error)
        return false;
    }

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validar estado civil, cargo y sexo
const validSelect = (selectorInput, selectorError, options) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement

    error.classList.add("form__input-error")

    if (options.indexOf(value) === -1) {
        handleErrorMessage(selectorError, "Valor inválido", input, error)
        return false
    }

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
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

    if(input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
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

// Validar username
const validUsername = (selectorInput, selectorError) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = /^[a-zA-Z]+(?:_[a-zA-Z0-9]+)?[a-zA-Z0-9]*$/;

    error.classList.add("form__input-error")

    if (value === "") {
        if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
        return true
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Nombre de usuario inválido", input, error)
        return false
    }
    if (value.length <= 4) {
        handleErrorMessage(selectorError, "Se permiten mínimo 5 caracteres", input, error)
        return false
    }
    if (value.lenght > 15) {
        handleErrorMessage(selectorError, "Se permiten máximo 15 caracteres", input, error)
        return false
    }

    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Validar la fecha en la que entro a trabajar
const validDateStartWork = (selectorInput, selectorError, selectorBornDate) => {
    const input = document.querySelector(selectorInput)
    const inputContainer = input.parentElement
    const error = document.createElement("span")
    const regex =  new RegExp(/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/);
    const dateBornValue = document.querySelector(selectorBornDate).value
    const bornDate = new Date(dateBornValue)
    const date = input.value.split("-")
    const currentYear = new Date().getFullYear()
    const currentMonth = new Date().getMonth() + 1
    const currentDay = new Date().getDate()
    const enteredDate = new Date(input.value)

    error.classList.add("form__input-error")

    if (input.value === "") {
        handleErrorMessage(selectorError, "La fecha no debe estar vacía", input, error)
        return false
    }
    if (!regex.test(input.value)) {
        handleErrorMessage(selectorError, "Formato de fecha inválido", input, error)
        return false
    }
    // Validando el año
    if (date[0] < 1940) {
        handleErrorMessage(selectorError, "El año no debe ser menor a 1940", input, error)
        return false
    }
    if (date[0] > currentYear) {
        handleErrorMessage(selectorError, "Año inválido", input, error)
        return false
    }
    // Validando el mes
    if (date[1] < 1 || date[1] > 12) {
        handleErrorMessage(selectorError, "Mes inválido", input, error)
        return false
    }
    // Validando el dia
    if (date[2] < 1 || date[2] > 31) {
        handleErrorMessage(selectorError, "Día inválido", input, error)
        return false
    }
    // Si la fecha es igual a la fecha actual
    if (enteredDate.getTime() === currentDay) {
        if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
        return true 
    }
    // Validando que la fecha no sea futura
    if (date[0] > currentYear || (date[0] === currentYear && date[1] > currentMonth) || (date[0] === currentYear && date[1] === currentMonth && date[2] >= currentDay)) {
        handleErrorMessage(selectorError, "Fecha inválida", input, error)
        return false;
    }    
    if (enteredDate.getTime() < bornDate.getTime()) {
        handleErrorMessage(selectorError, "La fecha debe no debe ser menor a la fecha de nacimiento", input, error)
        return false
    }   
    if (enteredDate.getTime() > new Date().getTime()) {
        handleErrorMessage(selectorError, "La fecha no debe ser mayor a la fecha actual", input, error)
        return false
    }
    if (enteredDate.getTime() === bornDate.getTime()) {
        handleErrorMessage(selectorError, "La fecha no debe ser igual a la fecha de nacimiento", input, error)
        return false
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true    
}

// Validar la comunidad, calle, numero de casa y punto de referencia
const validateAddress = (selectorInput, selectorError, max, min) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s\-/]+$/

    error.classList.add("form__input-error")

    if (value === ""  || value.trim() === "") {
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

// Validar los municipios y los estados
const validMunicipiosParroquias = (selectorInput, selectorError, location, max) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = new RegExp(/^[0-9]+$/)

    error.classList.add("form__input-error")

    if (value === ""  || value.trim() === "") {
        handleErrorMessage(selectorError, `Seleccione un ${location}`, input, error)
        return false
    }
    if (!regex.test(value)  || value.length > max) {
        handleErrorMessage(selectorError, "Valor inválido", input, error)
        return false
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true 
}





// Mostrar modal de procesando
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

const senData = async (data) => {
    try {
        const peticion = await fetch(`${RUTA}/empleados/newemployee`, {
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
                form.reset()
            } else {
                showErrorModal(response.response)
            }
        }
    } catch (error) {
        showErrorModal()
        console.log(error)
    }
}



form.addEventListener('submit', e => {
    e.preventDefault()

    if (
        validId('#ci',  '#ci + .form__input-error') &&
        validFirstName('#pn',  '#pn + .form__input-error') &&
        validSecondName('#sn',  '#sn + .form__input-error') &&
        validThirdName('#tn',  '#tn + .form__input-error', '#sn') &&
        validLastame('#pa', '#pa + .form__input-error', 'first') &&
        validLastame('#sa', '#sa + .form__input-error', 'second') &&
        validBornDate('#fn',  '#fn + .form__input-error') &&
        validSelect('#sex', '#sex + .form__input-error', ['F', 'M']) &&
        validSelect('#ec', '#ec + .form__input-error', ['S', 'C', 'V']) &&
        validEmail('#correo', '#correo + .form__input-error') &&
        validPhone('#numTel', '#numTel + .form__input-error') &&
        validDateStartWork('#fi', '#fi + .form__input-error', '#fn') &&
        validSelect('#cargo', '#cargo + .form__input-error', ['administrador', 'cocinero', 'encargado']) &&
        validateAddress('#sector', '#sector + .form__input-error', 70, 5) &&
        validateAddress('#calle', '#calle + .form__input-error', 40, 1) &&
        validateAddress('#numCasa', '#numCasa + .form__input-error', 10, 1) &&
        validateAddress('#refCasa', '#refCasa + .form__input-error', 70, 5) &&
        validUsername('#username', '#username + .form__input-error')  &&
        validMunicipiosParroquias('#municipio',  '#municipio + .form__input-error', 'municipio', 4) &&
        validMunicipiosParroquias('#parroquia',  '#parroquia + .form__input-error',  'parroquia', 5)
    ) {
        showModalLoading()
        senData(getFormData(form))
    }
})