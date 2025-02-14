const $cardSection = document.querySelector(".card__section")

// Crear las cards y la de error o vacia correspondiente
const createCards = async () => {
    const categories = await getCategory()
    console.log(categories)
    if (categories === null) {
        $cardSection.innerHTML = `
        <div class="error__card empty">
            <h3 class="error__card-title">no hay categorias registradas</h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>
        </div>
        `
    }
    else if (categories.length > 0) {
        const fragment = document.createDocumentFragment()

        categories.forEach((category, index) => {
            const card = document.createElement("div")
            card.classList.add("card")
            card.innerHTML = `
                <p class="card-number">${++index}</p>

                <p class="card-text">
                    <span class="card-category">Nombre:</span> <span>${category.nombreCategoria}</span>
                </p>

                <p class="card-text">
                    <span class="card-category">Descripión:</span> <span>${category.descripCategoria === null ? "No posee" : category.descripCategoria}</span>
                </p>

                <div class="card__buttons">
                    <button class="card__buttons-btn header-cta edit" data-id="${category.idCategoria}">
                        Editar
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                    </button>
                    
                    <button class="card__buttons-btn header-cta delete" data-id="${category.idCategoria}">
                        Eliminar
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                    </button>
                </div>
            `
            fragment.appendChild(card)
        })

        $cardSection.innerHTML = ""
        $cardSection.appendChild(fragment)
    }
    else {
        $cardSection.innerHTML = `
        <div class="error__card empty">
            <h3 class="error__card-title">Ocurrió un error al mostrar las categorías</h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>
        </div>
        `
    }
}


/**
 * 
 *  MODALES
 */
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

// Crear modal de eliminar
const deleteCategoryModal = (id) => {
    Swal.fire({
        title: "Eliminar categoría",
        text: `¿Seguro que quiere eliminar esta categoría?`,
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
            deleteCategory(id)
        }
    });
}

// Modal de exito
const successModal = (title) => {
    Swal.fire({
        title: title,
        icon: "success",
        iconColor: "#6b99e3",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#2367d5"
    });
}

// Modal de error
const errorModal = (message) => {
    Swal.fire({
        title: "¡Ocurrió un error!",
        text: message,
        icon: "error",
        iconColor: "#f27474",
        confirmButtonColor: "#f27474"
    });
}

// Validar el nombre de la categoria y la descripcion
const validCategory = (input, type) => {
    const regex = new RegExp(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/)
    const blankSpaces = input.split("").filter(letter => letter === " ")

    if (input === "" || input.trim() === "") {
        return `${type} requerida`
    }
    if (!regex.test(input)) {
        return `${type} solo acepta letras`
    }
    if (input.length < 3 || input.length > 25 || input.trim() < 3) {
        return `${type} debe estar entre 3 y 25 caracteres`
    }
    if (blankSpaces.length > 10) {
        return `${type} inválida`
    }

    return true
}

// Mostrar modal de editar telefono
const modalUpdateCategory = (id) => {
    Swal.fire({
        title: "Actualizar categoría",
        icon: "warning",
        iconColor: "#6b99e3",
        confirmButtonText: "Actualizar",
        confirmButtonColor: "#2367d5",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        html: `
            <input id="swal-input-name" class="swal2-input" type="text" placeholder="Nombre de la categoría">
            <input id="swal-input-description" class="swal2-input" type="text" placeholder="Descripción de la categoría">
        `,
        preConfirm: async () => {
            try {
                const name = document.getElementById("swal-input-name").value
                const descripcion = document.getElementById("swal-input-description").value
                const isValidName = validCategory(name, "categoria")
                const isValidDescripcion = validCategory(descripcion, "descripción")

                if (isValidName !== true) return Swal.showValidationMessage(isValidName)
                if (isValidDescripcion !== true) return Swal.showValidationMessage(isValidDescripcion)
                    console.log({idCategory: id, newCategory: name, newDescripcion: descripcion })

                const peticion = await fetch(`${RUTA}/categorias/upcategory`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify({idCategory: id, newCategory: name, newDescripcion: descripcion })
                })

                if (peticion.ok) {
                    const response = await peticion.json()
                    console.log(response)
                    if (response.status === true) {
                        successModal(response.response)
                        createCards()
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

// Haciendo la peticion para eliminar una categoria
const deleteCategory = async (id) => {
    try {
        console.log({ idCategory: id})
        const peticion = await fetch(`${RUTA}/categorias/delCategory`, {
            method: "POST",
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify({ idCategory: id })
        })

        if (peticion.ok) {
            const response = await peticion.json()

            if (response.status === true) {
                successModal(response.response)
                createCards()
            }
            else errorModal(response.response)
        }
        else {
            errorModal("¡Ooooops! Error inesperado")
        }
    } catch (error) {
        console.log(error)
        errorModal("¡Ooooops! Error inesperado")
    }
}

// Modal de registrar nueva categoria
const modalNewCategory = () => {
    Swal.fire({
        title: "Nueva categoría",
        icon: "warning",
        iconColor: "#6b99e3",
        confirmButtonText: "Registrar",
        confirmButtonColor: "#2367d5",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        html: `
            <input id="swal-input-name" class="swal2-input" type="text" placeholder="Nombre de la categoría">
            <input id="swal-input-description" class="swal2-input" type="text" placeholder="Descripción de la categoría">
        `,
        preConfirm: async () => {
            try {
                const categoryName = document.getElementById("swal-input-name").value
                const categoryDescripcion = document.getElementById("swal-input-description").value
                const isValidName = validCategory(categoryName, "categoria")
                const isValidDescripcion = validCategory(categoryDescripcion, "descripción")

                if (isValidName !== true) return Swal.showValidationMessage(isValidName)
                if (isValidDescripcion !== true) return Swal.showValidationMessage(isValidDescripcion)

                const peticion = await fetch(`${RUTA}/categorias/newcategory`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify({
                        nombreCategoria: categoryName,
                        descripcionCategoria: categoryDescripcion
                    })
                })

                if (peticion.ok) {
                    const response = await peticion.json()
                    if (response.status === true) {
                        successModal(response.response)
                        createCards()
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




// Cuando se haga click en eliminar o editar
document.addEventListener("click", e => {
    // Registrar categoria
    if (e.target.matches("#add-category")) {
        modalNewCategory()
    }

    // Eliminar categoria
    if (e.target.matches(".card__buttons-btn.delete")) {
        deleteCategoryModal(e.target.dataset.id)
        console.log(e.target.dataset.id)
    }

    // Actualizar categoria
    else if (e.target.matches(".card__buttons-btn.edit")) {
        console.log(e.target.dataset.id)
        modalUpdateCategory(e.target.dataset.id)
    }
})


document.addEventListener("DOMContentLoaded", () => {
    createCards()
})