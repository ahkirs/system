const showFormPasswordBtn = document.getElementById("show-form-password")
const showFormDirectionBtn = document.getElementById("show-form-direction")

// Data para poner la imagen de ver y ocultar contrasena en el boton correspondiente
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


/***********************
 *      FUNCIONES      *
 ***********************/

// Poniendo la informacio del usuario en el HTML
const fillUserData = (data) => {
    const name = document.querySelector(".header__perfil-title")
    const cargo = document.querySelector(".header__perfil-cargo")
    const correo = document.getElementById("email")
    const phone = document.getElementById("phone")
    const username = document.getElementById("username")
    const edad = document.getElementById("edad")
    const rol = document.getElementById("rol")
    const currentDirection = document.getElementById("direction")
    const avatar = document.getElementById("avatar")

    name.textContent = data.nombre
    cargo.textContent = data.cargo
    correo.textContent = data.correo
    phone.textContent = data.tel
    username.textContent = data.username
    edad.textContent = data.edad
    rol.textContent = data.rol
    currentDirection.textContent = data.direccion
    avatar.src = (data.avatar) ? `${IMG_URL}perfiles${data.avatar}` : `${IMG_URL}usuario.png`
}

// Obteniendo los datos del usuario en sesion
const getUser = async () => {
    try {
        const peticion = await fetch(`${RUTA}/perfil/getUsuario`)

        if (peticion.ok) {
            const response = await peticion.json()
            console.log(response)
            fillUserData(response)
        }
        else {
            showErrorModal("No se pudo traer los datos, pro favor recarga de nuevo la página")
        }
    } catch (error) {
        showErrorModal("No se pudo traer los datos, pro favor recarga de nuevo la página")
        console.log(error)
    }
}


document.addEventListener('DOMContentLoaded', () => {
    getUser()
})