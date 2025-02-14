const sectionSupplies = document.querySelector(".supplies")



/**
 * FUNCIONES
 **/ 

// Poner las estadisticas
const fillStadistics = (supplies, categories) => {
    const totalSupplies = document.getElementById("suministros-totales")
    const totalCategories = document.getElementById("categories")

    totalSupplies.textContent = supplies
    totalCategories.textContent = categories
}


// Card vacia cuando no hay suministros registrados
const emptySupplies = (text, type = "empty") => {
    const card = document.createElement("div")
    card.classList.add("empty__card")

    if (type === "error") card.classList.add("error")

    card.innerHTML = `
        <h2 class="empty__card-title">${text}</h2>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>
    `;

    sectionSupplies.appendChild(card)
}


// Mostrar mensaje de error si falla la peticion al mostrar los datos
const hideStadistics = () => {
    const stadistics = document.querySelector(".stadistics")
    stadistics.style.display = "none"
    stadistics.style.visibility = "hidden"
}


// Crear las cards de suministros y mostrarlas
const createCards = (supplies) => {
    sectionSupplies.innerHTML = ""

    if (supplies.length > 0 ) {
        const fragment = document.createDocumentFragment()

        supplies.forEach(item => {
            const div = document.createElement("div")
            div.classList.add("card")
            div.innerHTML = `
                <header class="card__header">
                    <span class="card__header-category">${item.categoriaSuministro}</span>

                    <figure class="card__header__figure">
                        <img src="${RUTA_IMG}suministros${item.imagenSuministro}" alt="${item.nombreSuministro}" class="card__header__figure-img">
                    </figure>
                </header>

                <div class="card__texts">
                    <p class="card__texts-paragraph card__texts-title">${item.nombreSuministro}</p>
                    <p class="card__texts-paragraph">${item.descripSuministro}</p>
                    <p class="card__texts-paragraph"><span>Código: </span>${item.codSuministro}</p>
                </div>

                <button class="card-delete" data-suministro="${item.idSuministro}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                </button>

                <button class="header-cta card-btn" data-suministro="${item.idSuministro}" data-product="${item.nombreSuministro}">Abastacer</button>
            `;

            fragment.appendChild(div)
        });

        sectionSupplies.appendChild(fragment)
    }
    else {
        emptySupplies("no hay suministros registrados")
        hideStadistics()
    }
}


// Obteniendo los datos del servidor
const getSupplies = async () => {
    try {
        const peticion = await fetch(`${RUTA}/suministros/listarSupplies`)
        
        if (peticion.ok) {
            const response = await peticion.json()
            createCards(response.dataRegistro)
            fillStadistics(response.generalData.totalSuministros, response.generalData.totalCategorias)
        } else {
            emptySupplies("Ocurrió un error al mostrar los datos", "error")
            hideStadistics()
        }
        
    } catch (error) {
        emptySupplies("Ocurrió un error al mostrar los datos", "error")
        hideStadistics()
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


// Haciendo la peticion para eliminar un empleado
const deleteSuppply = async (id) => {
    try {
        const peticion = await fetch(`${RUTA}/suministros/DelSupply`, {
            method: "POST",
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify({ idSuministro: id })
        })

        if (peticion.ok) {
            const response = await peticion.json()

            if (response.status === true) {
                showSuccesModal(response.response)
                getSupplies()
            }
            else showErrorModal(response.response)
        }
        else {
            showErrorModal("¡Lo sentimos! Ocurrió un error inesperado")
        }
    } catch (error) {
        console.log(error)
        showErrorModal("¡Lo sentimos! Ocurrió un error inesperado")
    }
}


// Crear modal de eliminar
const deleteSupplyModal = (id) => {
    Swal.fire({
        title: "¿Eliminar suministro de forma permanente?",
        text: "Si elimina un suministro este se borrará del historial de compras",
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
            deleteSuppply(id)
        }
    });
}



/**
 * LISTENERS
 * */ 
document.addEventListener("click", e => {
    if (e.target.matches(".card .card-delete")) {
        deleteSupplyModal(e.target.dataset.suministro)
    }
})


document.addEventListener("DOMContentLoaded", () => {
    getSupplies()
})