const form = document.getElementById("form")
const showPasswordBtn = document.getElementById("show-pass-btn")
const inputPassword = document.getElementById("password")
const inputUsername = document.getElementById("username")
const eyeImage = document.querySelector(".form__input__eye-img")
const loaderSection = document.getElementById("loader-section")

// Datos de las imagenes para el ojo
const imagesData = {
    eye: {
        url: `${IMG_URL}eye.svg`,
        alt: "Ver contraseña"
    },
    eyeOff: {
        url: `${IMG_URL}eye-off.svg`,
        alt: "Ocultar contraseña"
    }
}



/***************************************************
* Funciones para validar el username y la password *
****************************************************/
const validUsername = () => {
    const regex = /^[a-zA-Z]+(?:_[a-zA-Z0-9]+)?[a-zA-Z0-9]*$/;
    const username = inputUsername.value
    
    if (username === "") {
        Lobibox.notify('error', {
            msg: "Se requiere el nombre de usuario"
        });
        return false
    }
    
    if (username.length <= 4) {
        Lobibox.notify('error', {
            msg: "El usuario debe ser mayor a 4 caracteres"
        });
        return false
    }
    
    if (username.length > 15) {
        Lobibox.notify('error', {
            msg: "El usuario debe ser menor a 15 caracteres"
        });
        return false
    }

    if (!regex.test(username)) {
        Lobibox.notify('error', {
            msg: "Nombre de usuario inválido"
        });
        return false
    }

    return true
}

const validPassword = () => {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$*&_-])[A-Za-z\d$*&_-]{8,}$/
    const password = inputPassword.value

    if (password === "") {
        Lobibox.notify('error', {
            msg: "Se requiere la contraseña"
        });
        return false
    }
    
    if (password.length <= 7) {
        Lobibox.notify('error', {
            msg: "La contraseña debe ser mayor a 7 caracteres"
        });
        return false
    }
    
    if (password.length > 16) {
        Lobibox.notify('error', {
            msg: "La contraseña debe ser menor a 16 caracteres"
        });
        return false
    }

    if (!regex.test(password)) {
        Lobibox.notify('error', {
            msg: "Contraseña inválida"
        });
        return false
    }

    return true
}


// Funcion para obtener los datos del form
const getFormData = (form) => {
    return Object.fromEntries(
        new FormData(form)
    )
}


// Funcion para enviar los datos al servidor los datos
const sendData = async (data) => {
    try {
        const peticion = await fetch(`${RUTA}/login/startLogin`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })

        const response = await peticion.json()

        if (response.estado === false) {
            Lobibox.notify('error', {
                msg: response.mensaje
            });
        } else {
            window.location.href = `${RUTA}/main`
        }
        console.log(response)
    } catch (error) {
        Lobibox.notify('error', {
            msg: "Oooops! Ocurrió un error inesperado"
        });
        console.log(error)
    }
}





// Mostrado y ocultando la contraseña
showPasswordBtn.addEventListener("click", () => {
    if (inputPassword.type === "password") {
        inputPassword.type = "text"
        eyeImage.src = imagesData.eyeOff.url
        eyeImage.alt = imagesData.eyeOff.alt
    } else {
        inputPassword.type = "password"
        eyeImage.src = imagesData.eye.url
        eyeImage.alt = imagesData.eye.alt
    }
})










form.addEventListener('submit', e => {
    e.preventDefault()
    if (validUsername() && validPassword()) {
        // loaderSection.classList.add("show-loader")
        // console.log(getFormData(e.target))
        sendData(getFormData(e.target))
    }
    
})