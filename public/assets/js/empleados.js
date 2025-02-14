// Objeto vacio que se va llenar con el id del empleado y el username a crear mas adelante
const dataUser = {}

// Poner la informacion del servidor en la data general
const fillStadisticsData = (data) => {
    const totalEmployees = document.getElementById("total-employees")
    const totalMale = document.getElementById("male-employees")
    const totalFemale = document.getElementById("female-employees")
    const averageAge = document.getElementById("average-age")
    const maleBar = document.getElementById("male-bar")
    const femaleBar = document.getElementById("female-bar")

    totalEmployees.textContent = data.empleadosTotales
    totalMale.textContent = data.empleadosMasculinos
    totalFemale.textContent = data.empleadosFemeninos
    averageAge.textContent = data.promedioEdad

    maleBar.style.width = `${(data.empleadosMasculinos * 100) / data.empleadosTotales}%`
    femaleBar.style.width = `${(data.empleadosFemeninos * 100) / data.empleadosTotales}%`
}


// Crear las cards de empleados
const createEmployeeCard = (employees) => {
    const fragment = document.createDocumentFragment()
    const cardsContainer = document.querySelector(".cards__section")
    cardsContainer.innerHTML = ""

    employees.forEach((item, index) => {
        const nameKey = `Empleado${++index}`
        const employee = item[nameKey]
        const employeeCard = document.createElement("div")
        employeeCard.classList.add("card")
        console.log(employee)

        employeeCard.innerHTML = `
            <div class="card__buttons">
                <button class="card__buttons-info card__buttons-info--info" data-name="${employee.nombre}" data-mail="${employee.correo}" data-fn="${employee.fn}" data-dir="${employee.direccion}" data-cargo="${employee.cargo}" data-edoCivil="${employee.edoCivil}" data-after="Ver informacion completa">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="m5.705 3.71-1.41-1.42C1 5.563 1 7.935 1 11h1l1-.063C3 8.009 3 6.396 5.705 3.71zm13.999-1.42-1.408 1.42C21 6.396 21 8.009 21 11l2-.063c0-3.002 0-5.374-3.296-8.647zM12 22a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22zm7-7.414V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.184 4.073 5 6.783 5 10v4.586l-1.707 1.707A.996.996 0 0 0 3 17v1a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-1a.996.996 0 0 0-.293-.707L19 14.586z"></path></svg>
                </button>

                <button class="card__buttons-info card__buttons-info--delete" data-id="${employee.idEmpleado}" data-after="Eliminar empleado">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                </button>
            </div>

            <header class="card__header">
                <figure class="card__header__figure">
                ${employee.birthday !== "no" ? "<span>🍰</span>" : ""}
                    <img src="${(employee.sexo === "Masculino") ? `${RUTA_IMG}man-avatar.png` : `${RUTA_IMG}woman-avatar.png`}" alt="Avatar empleado" class="card__header-avatar">
                </figure>

                <div class="card__header__texts">
                    <h2 class="card__header__texts-title">${employee.nombre}</h2>
                    <p class="card__header__texts-text">${employee.cargo}</p>
                </div>
            </header>

            <div class="card__content">
                <p class="card__content__text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M9.715 12c1.151 0 2-.849 2-2s-.849-2-2-2-2 .849-2 2 .848 2 2 2z"></path><path d="M20 4H4c-1.103 0-2 .841-2 1.875v12.25C2 19.159 2.897 20 4 20h16c1.103 0 2-.841 2-1.875V5.875C22 4.841 21.103 4 20 4zm0 14-16-.011V6l16 .011V18z"></path><path d="M14 9h4v2h-4zm1 4h3v2h-3zm-1.57 2.536c0-1.374-1.676-2.786-3.715-2.786S6 14.162 6 15.536V16h7.43v-.464z"></path></svg>
                    <span class="card__content__text-data">${employee.ci}</span>
                </p>

                <p class="card__content__text" style="flex-wrap: wrap;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M2 12h2a7.986 7.986 0 0 1 2.337-5.663 7.91 7.91 0 0 1 2.542-1.71 8.12 8.12 0 0 1 6.13-.041A2.488 2.488 0 0 0 17.5 7C18.886 7 20 5.886 20 4.5S18.886 2 17.5 2c-.689 0-1.312.276-1.763.725-2.431-.973-5.223-.958-7.635.059a9.928 9.928 0 0 0-3.18 2.139 9.92 9.92 0 0 0-2.14 3.179A10.005 10.005 0 0 0 2 12zm17.373 3.122c-.401.952-.977 1.808-1.71 2.541s-1.589 1.309-2.542 1.71a8.12 8.12 0 0 1-6.13.041A2.488 2.488 0 0 0 6.5 17C5.114 17 4 18.114 4 19.5S5.114 22 6.5 22c.689 0 1.312-.276 1.763-.725A9.965 9.965 0 0 0 12 22a9.983 9.983 0 0 0 9.217-6.102A9.992 9.992 0 0 0 22 12h-2a7.993 7.993 0 0 1-.627 3.122z"></path><path d="M12 7.462c-2.502 0-4.538 2.036-4.538 4.538S9.498 16.538 12 16.538s4.538-2.036 4.538-4.538S14.502 7.462 12 7.462zm0 7.076c-1.399 0-2.538-1.139-2.538-2.538S10.601 9.462 12 9.462s2.538 1.139 2.538 2.538-1.139 2.538-2.538 2.538z"></path></svg>
                    <span class="card__content__text-subtitle">Edad:</span>
                    <span class="card__content__text-data">${employee.edad}</span>
                </p>

                <p class="card__content__text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M17.707 12.293a.999.999 0 0 0-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 0 0 0-1.414l-4-4a.999.999 0 0 0-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 0 0 0-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 0 0-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 0 0 .912-.271L17 14.414 19.586 17l-2.006 2.005z"></path></svg>
                    <span class="card__content__text-data">${employee.tel}</span>
                </p>
                        
                <p class="card__content__text" style="flex-wrap: wrap;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                    <span class="card__content__text-subtitle">Fecha ingreso:</span>
                    <span class="card__content__text-data">${employee.fechaIngreso}</span>
                </p>

            ${(employee.tieneUser === "true")
                ? ` <p class="card__content__text" style="flex-wrap: wrap;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path></svg>
                        <span class="card__content__text-subtitle">Usuario:</span>
                        <span class="card__content__text-data">${employee.username}</span>
                    </p> `

                : ` <button class="card__content-add" data-id="${employee.idEmpleado}">
                        crear usuario
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M4.5 8.552c0 1.995 1.505 3.5 3.5 3.5s3.5-1.505 3.5-3.5-1.505-3.5-3.5-3.5-3.5 1.505-3.5 3.5zM19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3zM4 19h10v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h2z"></path></svg>
                    </button>`
            }
            </div>`;

        fragment.appendChild(employeeCard)
    })

    cardsContainer.appendChild(fragment)
}


// Obterner los datosd el servidor
const getEmployees = async () => {
    try {
        const peticion = await fetch(`${RUTA}/empleados/listaremployees`)

        if (peticion.ok) {
            const response = await peticion.json()
            const { dataRegistro, generalData } = response
            fillStadisticsData(generalData[0])
            createEmployeeCard(dataRegistro)
        }
    } catch (error) {
        console.log(error)
    }
}

// Modal de procesando datos
const showLoadingModal = () => {
    Swal.fire({
        title: 'Procesando solicitud',
        text: 'Por favor no recargue ni cierre página',
        didOpen: () => {
            Swal.showLoading()
        },
        allowOutsideClick: () => !Swal.isLoading()
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

// Mostrar modal de exito
const showSuccesModal = (title, username, password) => {
    Swal.fire({
        title: title,
        icon: "success",
        iconColor: "#6b99e3",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#2367d5",
        html: `
            <p class="info-text info-text--center">
                <span>Usuario:</span> ${username}
            </p>
            <p class="info-text info-text--center">
                <span>Contraseña:</span> ${password}
            </p>
        `
    });

}

// Crear modal de crear usuario y haciendo la peticion
const createUserModal = (element) => {
    Swal.fire({
        title: "Ingresa el nombre de usuario",
        input: "text",
        confirmButtonColor: "#2367d5",
        inputAttributes: {
            autocapitalize: "off"
        },
        showCancelButton: true,
        confirmButtonText: "Crear usuario",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        inputValidator: (value) => {
            const regex = /^[a-zA-Z]+(?:_[a-zA-Z0-9]+)?[a-zA-Z0-9]*$/;

            if (!value) {
                return "Escribe el nombre de usuario";
            }
            if (value.length <= 4) {
                return "El nombre de usuario debe tener al menos 5 caracteres";
            }
            if (value.length > 15) {
                return "El nombre de usuario debe ser menor a 15 caracteres";
            }
            if (!regex.test(value)) {
                return "El nombre de usuario es invalido";
            }
        },
        preConfirm: async (username) => {
            try {
                dataUser.username = username
                dataUser.idEmpleado = element.dataset.id

                const peticion = await fetch(`${RUTA}/empleados/SetUser`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify(dataUser)
                })

                if (peticion.ok) {
                    const response = await peticion.json()
                    console.log(response)
                    if (response.status === true) {
                        showSuccesModal(response.response, response.user, response.pass_default)
                        getEmployees()
                    }
                    else {
                        return Swal.showValidationMessage(response.response);
                    }
                }
                return
            } catch (error) {
                console.log(error)
            }
        },
        allowOutsideClick: () => Swal.isLoading()
    })
}

// Haciendo la peticion para eliminar un empleado
const deleteEmployee = async (id) => {
    try {
        const peticion = await fetch(`${RUTA}/empleados/delEmployee`, {
            method: "POST",
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify({ idEmpleado: id })
        })

        if (peticion.ok) {
            const response = await peticion.json()

            if (response.status === true) {
                Swal.fire({
                    title: response.response,
                    icon: "success",
                    iconColor: "#6b99e3",
                    confirmButtonText: "Aceptar",
                    confirmButtonColor: "#2367d5"
                });
                getEmployees()
            }
            else showErrorModal(response.response)
        }
        else {
            showErrorModal("¡Ooooops! Error inesperado")
        }
    } catch (error) {
        console.log(error)
        showErrorModal("¡Ooooops! Error inesperado")
    }
}

// Crear modal de eliminar
const deleteEmployeeModal = (element) => {
    Swal.fire({
        title: "Eliminar este empleado",
        text: `¿Seguro que quiere eliminar este empleado?`,
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
            deleteEmployee(element.dataset.id)
        }
    });
}






document.addEventListener('click', e => {
    // Mostrando la informacion de detalles
    if (e.target.matches('.card__buttons-info.card__buttons-info--info')) {
        const card = e.target.dataset

        Swal.fire({
            title: "Información del empleado",
            confirmButtonText: "Cerrar",
            confirmButtonColor: "#104bab",
            html: `
                <p class="info-text">
                    <span>Nombre:</span> ${card.name}
                </p>
                <p class="info-text">
                    <span>Cargo:</span> ${card.cargo}
                </p>
                <p class="info-text">
                    <span>Correo:</span> ${card.mail}
                </p>
                <p class="info-text">
                    <span>Fecha de nacimiento:</span> ${card.fn}
                </p>
                <p class="info-text">
                    <span>Dirección:</span> ${card.dir}
                </p>
                <p class="info-text">
                    <span>Estado civil:</span> ${card.edocivil}
                </p>
            `,
        })
    }


    // Mostrando el modal de crear usuario
    else if (e.target.matches(".card__content-add")) {
        createUserModal(e.target)
    }


    // ELiminar empleado
    else if (e.target.matches(".card__buttons-info.card__buttons-info--delete")) {
        deleteEmployeeModal(e.target)
    }
})

document.addEventListener('DOMContentLoaded', () => {
    getEmployees()
})