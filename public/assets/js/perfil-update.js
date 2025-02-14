const formPassword = document.getElementById("form-password")
const formDirection = document.getElementById("form-direction")


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

// Modal de procesando datos
const showLoadingModal = () => {
    Swal.fire({
        title: 'Procesando datos',
        text: 'Por favor no recargue ni cierre página',
        didOpen: () => {
            Swal.showLoading()
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
}

// Funcion mostrar el modal y editar el correo
const modalUpdateEmail = () => {
    Swal.fire({
        title: "Actualizar correo",
        icon: "warning",
        input: "email",
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
            const regex = new RegExp(/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/)

            if (!value) {
                return "Ingrese un correo";
            }
            if (value.length <= 4) {
                return "Ingrese al menos 5 caracteres";
            }
            if (value.length > 30) {
                return "Se permiten maximo 30 caracteres";
            }
            if (!regex.test(value)) {
                return "El correo es inválido";
            }
        },
        preConfirm: async (mail) => {
            try {
                const peticion = await fetch(`${RUTA}/perfil/setemail`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify({ newEmail: mail })
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

// Funcion mostrar el modal y editar el username
const modalUpdateUsername = () => {
    Swal.fire({
        title: "Actualizar usuario",
        icon: "warning",
        input: "text",
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
            const regex = /^[a-zA-Z]+(?:_[a-zA-Z0-9]+)?[a-zA-Z0-9]*$/;

            if (!value) {
                return "Ingrese el usuario";
            }
            if (value.length <= 4) {
                return "Ingrese al menos 5 caracteres";
            }
            if (value.length > 15) {
                return "Se permiten máximo 30 caracteres";
            }
            if (!regex.test(value)) {
                return "El usuario es inválido";
            }
        },
        preConfirm: async (username) => {
            try {
                const peticion = await fetch(`${RUTA}/perfil/setusername`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify({ newUsername: username })
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

// Funcion para validar el numero de telefono a editar
const validPhone = (codArea, number) => {
    const optionsCodAred = ["0414", "0424", "0426", "0416", "0412"]
    const validCodArea = optionsCodAred.findIndex((code) => code === codArea);
    const regex = new RegExp(/^[0-9]+$/)

    if (validCodArea === -1) return "Código de área inválido"
    if (number === "" || number.trim() === "") return "Ingrese el número de teléfono"
    if (!regex.test(number)) return "El número es inválido"
    if (number.length !== 7) return "Ingrese 7 números"
    return true
}

// Mostrar modal de editar telefono
const modalUpdatePhone = () => {
    Swal.fire({
        title: "Actualizar teléfono",
        icon: "warning",
        iconColor: "#6b99e3",
        confirmButtonText: "Actualizar",
        confirmButtonColor: "#2367d5",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        html: `
            <select class="swal2-select" id="swal-select">
                <option value="0414">0414</option>
                <option value="0424">0424</option>
                <option value="0416">0416</option>
                <option value="0426">0426</option>
                <option value="0412">0412</option>
            </select>
            <input id="swal-input" class="swal2-input" type="number" placeholder="Ingrese el número">
        `,
        preConfirm: async () => {
            try {
                const select = document.getElementById("swal-select").value
                const input = document.getElementById("swal-input").value
                const isValidPhone = validPhone(select, input)

                if (isValidPhone !== true) return Swal.showValidationMessage(isValidPhone)

                const peticion = await fetch(`${RUTA}/perfil/setphone`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify({ newCodArea: select, newTel: input })
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


// Mostrar y actualizar la foto de perfil
const modalUpdateAvatar = async () => {
    await Swal.fire({
        title: "Actualizar avatar",
        input: "file",
        inputAttributes: {
            "accept": "image/*",
            "aria-label": "Actualizar foto de perfil"
        },
        icon: "warning",
        iconColor: "#6b99e3",
        confirmButtonText: "Actualizar",
        confirmButtonColor: "#2367d5",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        inputValidator: (value) => {
            const typeImage = ['image/png', 'image/jpeg']; // Se acepta imagenes PNG y JPG

            if (!value) {
                return "Seleccione una imagen"
            }
            if (!typeImage.includes(value.type)) {
                return "Solo se permiten imagenes en formato PNG o JPG"
            }
            if (value.size > 500 * 1024) {
                return "La imagen no debes pesar más de 500KB"
            }
            const img = new Image();
            img.src = URL.createObjectURL(value);
            return new Promise((resolve) => {
                img.onload = function () {
                    if (img.width > 700 || img.height > 700) {
                        resolve("La imagen no debe tener más de 700px de ancho y alto");
                    } else {
                        resolve()
                    }
                };
            });
        },
        preConfirm: async (img) => {
            const reader = new FileReader();
            reader.readAsDataURL(img);

            reader.onload = (e) => {
                console.log({ newAvatar: e.target.result })
                console.log(e.target.result)
                fetch(`${RUTA}/perfil/setavatar`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify({ newAvatar: e.target.result })
                }).then(res => {
                    return res.json()
                }).then(data => {
                    console.log(data)
                    if (data.status) {
                        Swal.fire({
                            title: data.response,
                            imageWidth: 250,
                            imageHeight: 250,
                            image: 'object-fit: cover',
                            imageUrl: e.target.result,
                            imageAlt: "La foto subida por el usuario",
                            confirmButtonText: "Aceptar",
                            confirmButtonColor: "#2367d5",
                        });
                        getUser()
                    }
                    else {
                        showErrorModal(data.response)
                    }
                })
                    .catch(error => {
                        console.log(error)
                        showErrorModal("No se pudo actualizar el avatar")
                    })
            };
        },
        allowOutsideClick: () => Swal.isLoading()
    });
}



// ***** FUNCIONES PARA VALIDAR EL FORMULARIO DE ACTUALIZAR CONTRASENA Y DIRECCION *****
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

// Para validar la contraseña
const validPassword = (selectorInput, selectorError) => {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    error.classList.add("update__form__input-error")


    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "Complete este campo", input, error)
        return false
    }
    if (value.length < 8) {
        handleErrorMessage(selectorError, "Se permiten mínimo 8 caracteres", input, error)
        return false
    }
    if (value.length > 16) {
        handleErrorMessage(selectorError, "Se permiten máximo 16 caracteres", input, error)
        return false
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Contraseña inválida", input, error)
        return false
    }


    if (inputContainer.children[2].className === "update__form__input-error") inputContainer.removeChild(inputContainer.children[2])
    return true
}

// Para verificar que las contraseñas son iguales
const validPasswordConfirm = (selectorPassword1, selectorPassword2, selectorError) => {
    const password1 = document.querySelector(selectorPassword1)
    const password2 = document.querySelector(selectorPassword2)
    const error = document.createElement("span")
    const inputContainer = password2.parentElement
    error.classList.add("update__form__input-error")

    if (password1.value !== password2.value) {
        handleErrorMessage(selectorError, "Las contraseñas no coinciden", password2, error)
        return false
    }

    if (inputContainer.children[2].className === "update__form__input-error") inputContainer.removeChild(inputContainer.children[2])
    return true
}

// Validar los municipios y los estados
const validMunicipiosParroquias = (selectorInput, selectorError, location, max) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = new RegExp(/^[0-9]+$/)

    error.classList.add("update__form__input-error")

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, `Seleccione un ${location}`, input, error)
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

// Validar la comunidad, calle, numero de casa y punto de referencia
const validateAddress = (selectorInput, selectorError, max, min) => {
    const input = document.querySelector(selectorInput)
    const value = input.value
    const error = document.createElement("span")
    const inputContainer = input.parentElement
    const regex = /^[a-zA-ZáéíóúññÁÉÍÓÚÑ0-9\s\-/]+$/

    error.classList.add("update__form__input-error")

    if (value === "" || value.trim() === "") {
        handleErrorMessage(selectorError, "Campo requerido", input, error)
        return false
    }
    if (!regex.test(value)) {
        handleErrorMessage(selectorError, "Solo se permiten letras, números, espacios y guiones", input, error)
        return false
    }
    if (value.length < min) {
        handleErrorMessage(selectorError, `El campo acepta al menos ${min} caracteres`, input, error)
        return false
    }
    if (value.length > max) {
        handleErrorMessage(selectorError, `El campo acepta como máximo ${max} caracteres`, input, error)
        return false
    }

    // Eliminando el error si todo está bien y devolviendo true
    if (input.nextElementSibling) inputContainer.removeChild(inputContainer.lastElementChild)
    return true
}

// Obtener los datos del formulario en un  objeto
const getFormData = form => {
    return Object.fromEntries(new FormData(form))
}



// ***** Para enviar los datos *****
const updateData = async (ruta, data, type) => {
    try {
        const peticion = await fetch(ruta, {
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
                if (type === "password") {
                    formPassword.reset()
                }
                else {
                    formDirection.reset()
                    getUser()
                }
            } else {
                showErrorModal(response.response)
            }
        } else {
            showErrorModal("¡Ooooops! Error inesperado")
        }
    } catch (error) {
        showErrorModal("¡Ooooops! Error inesperado")
        console.log(error)
    }
}

// Actualizar la password
const updateAddress = async (data) => {
    try {
        const peticion = await fetch(`${RUTA}/perfil/setaddress`, {
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
                formPassword.reset()
            } else {
                showErrorModal(response.response)
            }
        } else {
            showErrorModal("¡Ooooops! Error inesperado")
        }
    } catch (error) {
        showErrorModal("¡Ooooops! Error inesperado")
        console.log(error)
    }
}



document.addEventListener('click', e => {
    // Click en actualizar correo
    if (e.target.matches("#edit-email")) {
        modalUpdateEmail()
    }

    // Click en editar telefono
    else if (e.target.matches("#edit-phone")) {
        modalUpdatePhone()
    }

    // Click en editar usuario
    else if (e.target.matches("#edit-username")) {
        modalUpdateUsername()
    }

    // Click en editar foto
    else if (e.target.matches("#update-avatar")) {
        modalUpdateAvatar()
    }

    // Para mostrar el formulario de contrasena
    else if (e.target === showFormPasswordBtn) {
        formPassword.classList.add("active")
        showFormPasswordBtn.classList.add("active")
        formDirection.classList.remove("active")
        showFormDirectionBtn.classList.remove("active")
    }

    // Para mostrar el formulario de direccion
    else if (e.target === showFormDirectionBtn) {
        showFormDirectionBtn.classList.add("active")
        formDirection.classList.add("active")
        formPassword.classList.remove("active")
        showFormPasswordBtn.classList.remove("active")
    }

    // Para mostrar y ocultar la contrasena
    else if (e.target.matches(".update__form__input__eye")) {
        if (e.target.dataset.eye === "eye") {
            e.target.dataset.eye = "eye-slash"
            const input = e.target.parentElement.children[1]
            e.target.firstElementChild.src = imagesData.eyeOff.url
            e.target.firstElementChild.alt = imagesData.eyeOff.alt
            input.type = "text"
        }
        else {
            e.target.dataset.eye = "eye"
            const input = e.target.parentElement.children[1]
            e.target.firstElementChild.src = imagesData.eye.url
            e.target.firstElementChild.alt = imagesData.eye.alt
            input.type = "password"
        }
    }
})


// Cuando se envia el formulario de nueva contrasena
formPassword.addEventListener('submit', e => {
    e.preventDefault()

    if (
        validPassword("#currentPassword", "#currentPassword + .update__form__input-error") &&
        validPassword("#newPassword", "#newPassword + .update__form__input-error") &&
        validPasswordConfirm("#newPassword", "#newPasswordConfirm", "#newPasswordConfirm + .update__form__input-error")
    ) {
        showLoadingModal()
        updateData(`${RUTA}/perfil/setpassword`, getFormData(e.target), "password")
    }
})

formDirection.addEventListener('submit', e => {
    e.preventDefault()

    if (
        validMunicipiosParroquias("#municipio", "#municipio + .update__form__input-error", "municipio", 4) &&
        validMunicipiosParroquias("#parroquia", "#parroquia + .update__form__input-error", "parroquia", 4) &&
        validateAddress("#sector", "#sector + .update__form__input-error", 70, 5) &&
        validateAddress("#calle", "#calle + .update__form__input-error", 40, 1) &&
        validateAddress("#numCasa", "#numCasa + .update__form__input-error", 10, 1) &&
        validateAddress("#refCasa", "#refCasa + .update__form__input-error", 70, 10)
    ) {
        showLoadingModal()
        updateData(`${RUTA}/perfil/setaddress`, getFormData(e.target), "address")
    }
})
