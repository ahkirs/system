// Objeto vacio que se rellenara con el id del usuario a reiniciar o eliminar
const dataSend = {}


/*********************
 *     FUNCIONES     *
 *********************/

// Poner la informacion del servidor en la data general
const fillStadisticsData = (data) => {
    const totalUsers = document.getElementById("total-users")
    const adminsUsers = document.getElementById("admin-users")
    const asistUsers = document.getElementById("asist-users")

    totalUsers.textContent = data.usersTotales
    adminsUsers.textContent = data.userAdmins
    asistUsers.textContent = data.usersAsist
}

// Crear las cards de usuarios
const createUsersCards = (users) => {
    const fragment = document.createDocumentFragment()
    const usersContainer = document.querySelector(".users")
    usersContainer.innerHTML = ""

    users.forEach((item, index) => {
        const nameKey = `Usuario${++index}`
        const user = item[nameKey]
        const userCard = document.createElement("div")
        userCard.classList.add("users__card")

        userCard.innerHTML = `
            <figure class="users__card__figure">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg>
            </figure>

            <div class="users__cards__texts">
                <p>
                    <strong>usuario:</strong>
                    <span>${user.usuario}</span>
                </p>
                <p>
                    <strong>rol:</strong>
                    <span>${user.rol}</span>
                </p>
                <p>
                    <strong>estado:</strong>
                    <span>${(user.status == "true") ? "Activo" : "Inactivo"}</span>
                </p>
            </div>

            <div class="users__actions">
                <button class="users__actions-btn users__actions-btn--info">
                    <span>informacion</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path></svg>
                </button>

                <button class="users__actions-btn users__actions-btn--restart" data-username="${user.usuario}" data-id="${user.idUsuario}">
                    <span>Reiniciar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.5374 19.5674C16.7844 21.0831 14.4993 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 14.1361 21.3302 16.1158 20.1892 17.7406L17 12H20C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C14.1502 20 16.1022 19.1517 17.5398 17.7716L18.5374 19.5674Z"></path></svg>
                </button>

                ${(user.rol == "Administrador")
                ? ''
                : `<button class="users__actions-btn users__actions-btn--delete" data-username="${user.usuario}" data-id="${user.idUsuario}">
                            <span>Eliminar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7 4V2H17V4H22V6H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V6H2V4H7ZM6 6V20H18V6H6ZM9 9H11V17H9V9ZM13 9H15V17H13V9Z"></path></svg>
                        </button>`
            }
            </div>

            <p class="users__card-number">${index}</p>
        `;

        fragment.appendChild(userCard)
    });
    usersContainer.appendChild(fragment)
}

// Obtener todos los usuarios
const getUsers = async () => {
    try {
        const peticion = await fetch(`${RUTA}/users/listarusers`)

        if (peticion.ok) {
            const users = await peticion.json()
            createUsersCards(users.dataRegistro)
            fillStadisticsData(users.generalData[0])
        }
    } catch (error) {
        console.log(error)
    }
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

// Modal de exito
const showSuccesModal = (message) => {
    Swal.fire({
        title: message,
        text: "",
        icon: "success",
        iconColor: "#6b99e3",
        confirmButtonColor: "#2367d5"
    });
}

// Modal de error
const showErrorModal = (message) => {
    Swal.fire({
        title: "¡Ocurrió un error!",
        text: message,
        icon: "error",
        iconColor: "#f27474",
        confirmButtonColor: "#f27474"
    });
}

// Reiniciar usuario
const resetUser = async (data) => {
    try {
        const peticion = await fetch(`${RUTA}/users/resetUser`, {
            method: "POST",
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify(data)
        })

        if (peticion.ok) {
            const response = await peticion.json()
            console.log(response)

            if (response.status == true) {
                showSuccesModal(response.response)
                getUsers()
            }
            else showErrorModal(response.response)
        }
        else {
            showErrorModal("¡Ooooops! Error inesperado")
        }
    } catch (error) {
        showErrorModal("¡Ooooops! Error inesperado")
        console.log(error)
    }
}

// Reiniciar usuario
const deleteUser = async (data) => {
    try {
        const peticion = await fetch(`${RUTA}/users/delUser`, {
            method: "POST",
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify(data)
        })

        if (peticion.ok) {
            const response = await peticion.json()
            console.log(response)

            if (response.status == true) {
                showSuccesModal(response.response)
                getUsers()
            }
            else showErrorModal(response.response)
        }
        else {
            showErrorModal("¡No se pudo eliminar el usuario")
        }
    } catch (error) {
        showErrorModal("¡No se pudo eliminar el usuario")
        console.log(error)
    }
}


document.addEventListener('DOMContentLoaded', () => {
    getUsers()
})

document.addEventListener("click", e => {
    // Reiniciar usuario
    if (e.target.matches(".users__actions-btn.users__actions-btn--restart")) {
        dataSend.id = e.target.dataset.id

        Swal.fire({
            title: "Reiniciar este usuario",
            text: `¿Seguro que quiere reiniciar a ${e.target.dataset.username}?`,
            icon: "warning",
            iconColor: "#6b99e3",
            confirmButtonText: "Reiniciar",
            confirmButtonColor: "#2367d5",
            showCancelButton: true,
            cancelButtonText: "Cancelar"
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                showLoadingModal()
                resetUser(dataSend)
            }
        });
    }


    // ELiminar usuario
    else if (e.target.matches(".users__actions-btn.users__actions-btn--delete")) {
        dataSend.id = e.target.dataset.id

        Swal.fire({
            title: "Eliminar este usuario",
            text: `¿Seguro que quiere eliminar a ${e.target.dataset.username}?`,
            icon: "warning",
            iconColor: "#f27474",
            confirmButtonText: "Eliminar",
            confirmButtonColor: "#f27474",
            showCancelButton: true,
            cancelButtonText: "Cancelar"
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                showLoadingModal()
                deleteUser(dataSend)
            }
        });
    }
})




