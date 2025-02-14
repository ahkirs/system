const $sectionProducts = document.getElementById("products-section")
let categories = null

/**
 ***********************
 *      FUNCIONES      *
 ***********************/
/***  Crear y/o ocultar HTML  ***/

// Ocultar las estadisticas si falla la peticion al mostrar los datos o si no hay productos registrados
const hideStadistics = () => {
    const stadistics = document.querySelector(".stadistics")
    stadistics.style.display = "none"
    stadistics.style.visibility = "hidden"
}

// Poner los datos de las estadisticas
const fillStadistics = (products, categories) => {
    const totalProducts = document.getElementById("productos-totales")
    const totalCategories = document.getElementById("categories")

    totalProducts.textContent = products
    totalCategories.textContent = categories
}

// Card vacia cuando no hay productos registrados o si hay un error
const noProducts = (text, type = "empty") => {
    const card = document.createElement("div")
    card.classList.add("empty__card")

    if (type === "error") card.classList.add("error")

    card.innerHTML = `
        <h2 class="empty__card-title">${text}</h2>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>
    `;

    $sectionProducts.innerHTML = ""
    $sectionProducts.appendChild(card)
}

const createCards = (products) => {
    console.log(products)
    $sectionProducts.innerHTML = ""
    const fragment = document.createDocumentFragment()

    products.forEach(product => {
        const card = document.createElement("div")
        card.classList.add("card")
        card.innerHTML = `
        <figure class="card__figure">
            <img src="${RUTA_IMG}productos${product.imagenProducto}" alt="${product.nombreProducto}" class="card__figure-img">

            <div class="card__figure__buttons">
                <button class="card__figure__buttons-btn editar" data-id="${product.idProducto}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                </button>
            </div>
        </figure>

        <div class="card__texts">
            <h3 class="card__texts-title">${product.nombreProducto}</h3>
            <p class="card__texts-description">${product.descripProducto}</p>
            <p class="card__texts-category">${product.categoriaProducto}</p>
        </div>

        <div class="card__action">
            <button class="card__action-btn edit" data-id="${product.idProducto}" data-name="${product.nombreProducto}" data-description="${product.descripProducto}" data-price="${product.precioUsd}" data-category=${product.idCategoria}>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                Editar
            </button>
            <button class="card__action-btn delete" data-id="${product.idProducto}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                Eliminar
            </button>
        </div>

        <footer class="card__price">
            <p>
                <span>$</span>${product.precioUsd}
            </p>
            <p>
                <span>Bs. </span>${product.precioBs}
            </p>
        </footer>
        `

        fragment.appendChild(card)
    });
    $sectionProducts.appendChild(fragment)
}


/***  Peticiones al servidor  ***/
// Obteniendo los datos del servidor
const getProducts = async () => {
    try {
        const peticion = await fetch(`${RUTA}/productos/listarProducts`)

        if (peticion.ok) {
            const response = await peticion.json()
            if (response.dataRegistro < 1) {
                hideStadistics()
                noProducts("no hay productos registrados")
            } else {
                createCards(response.dataRegistro)
                fillStadistics(response.generalData.totalProductos, response.generalData.totalCategorias)
            }
        } else {
            noProducts("Ocurrió un error al mostrar los datos", "error")
            hideStadistics()
        }

    } catch (error) {
        noProducts("Ocurrió un error al mostrar los datos", "error")
        hideStadistics()
        console.log(error)
    }
}

// Haciendo la peticion para eliminar un producto
const deleteProduct = async (id) => {
    try {
        const peticion = await fetch(`${RUTA}/productos/delProduct`, {
            method: "POST",
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify({ idProducto: id })
        })

        if (peticion.ok) {
            const response = await peticion.json()

            if (response.status === true) {
                showSuccesModal(response.response)
                getProducts()
            }
            else showErrorModal(response.response)
        }
        else {
            showErrorModal("¡No se pudo eliminar! Ocurrió un error inesperado")
        }
    } catch (error) {
        console.log(error)
        showErrorModal("¡No se pudo eliminar! Ocurrió un error inesperado")
    }
}




/***  MODALES  ***/
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

// Modal de exito al editar o eliminar
const showSuccesModal = (title) => {
    Swal.fire({
        title: title,
        icon: "success",
        iconColor: "#6b99e3",
        confirmButtonText: "Aceptar",
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
        confirmButtonText: "Cerrar",
        confirmButtonColor: "#f27474"
    });
}

// Crear modal de eliminar
const deleteProductModal = (id) => {
    console.log(id)
    Swal.fire({
        title: "Eliminar producto",
        text: "¿Seguro de que desea eliminar este producto?",
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
            deleteProduct(id)
        }
    });
}

// Validar el nombre y la descripcion del producto al actualizar
const validProductName = (input, type, min, max) => {
    const regex = /^[A-Za-zzáéíóúÁÉÍÓÚñÑ0-9\s]+$/

    if (input === "" || input.trim() === "") {
        return `Se requiere ${type} del producto`
    }
    if (!regex.test(input)) {
        if (type === "nombre") return "Solo se permiten letras y números en el nombre"
        else return "Solo se permiten letras y números en la descripción"
    }
    if (input.length < min) {
        if (type === "nombre") return `Nombre debe tener mínimo ${min} caracteres`
        else return `Descripción debe tener mínimo ${min} caracteres`
    }
    if (input.length > max) {
        if (type === "nombre") return `Nombre debe tener máximo ${max} caracteres`
        else return `Descripción debe tener máximo ${max} caracteres`
    }
    return true
}

// Validar precio del producto al actualizar
const validPrice = (input) => {
    const regex = /^\d+(\.\d+)?$/;

    if (!regex.test(input)) return "Precio inválido"
    return true
}

// Validar la categoria del producto al actualizar
const validCategory = (category) => {
    const regex = /^[0-9]+$/;

    if (!regex.test(category)) return "Valor de categoría inválido"
    return true
}

// Modal de actualizar
const updateProductModal = ({ productId, productName, productDescription, productPrice, categoryId }) => {
    console.log(categories)
    let options = ""

    if (categories === false) {
        options = `<option value="false">-- NO SE PUDIERON TRAER LAS CATEGORIAS --</option>`
    }
    else if (categories === null) {
        options = `<option value="null">-- NO HAY CATEGORIAS REGISTRADAS --</option>`
    }
    else {
        categories.forEach(category => {
            console.log(category.idCategoria, parseInt(categoryId))
            options += `<option value="${category.idCategoria}" ${parseInt(categoryId) === category.idCategoria ? "selected" : ""}>${category.nombreCategoria}</option>`
        })
    }
    Swal.fire({
        title: "Actualizar producto",
        icon: "warning",
        iconColor: "#6b99e3",
        confirmButtonText: "Actualizar",
        confirmButtonColor: "#2367d5",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        html: `
            <select class="swal2-select" id="product-category">
                ${options}
            </select>
            <input id="product-name" class="swal2-input" type="text" placeholder="Nombre del producto" value="${productName}">
            <input id="product-description" class="swal2-input" type="text" placeholder="Descripcion del producto" value="${productDescription}">
            <input id="product-price" class="swal2-input" type="text" placeholder="Precio en dolares" value="${productPrice}">
        `,
        preConfirm: async () => {
            try {
                const category = document.getElementById("product-category").value
                const name = document.getElementById("product-name").value
                const descripcion = document.getElementById("product-description").value
                const price = document.getElementById("product-price").value
                const isValidCategory = validCategory(category)
                const isValidName = validProductName(name, "nombre", 5, 20)
                const isValidDescripcion = validProductName(descripcion, "descripción", 5, 40)
                const isValidPrice = validPrice(price)

                if (isValidCategory !== true) return Swal.showValidationMessage(isValidCategory)
                if (isValidName !== true) return Swal.showValidationMessage(isValidName)
                if (isValidDescripcion !== true) return Swal.showValidationMessage(isValidDescripcion)
                if (isValidPrice !== true) return Swal.showValidationMessage(isValidPrice)
                
                const data = {
                    idProduct: productId,
                    newCategory: category,
                    newProduct: name,
                    newDescripcion: descripcion,
                    newPrecio: price
                }

                console.log(data)

                const peticion = await fetch(`${RUTA}/productos/upProduct`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify(data)
                })

                if (peticion.ok) {
                    const response = await peticion.json()
                    console.log(response)
                    if (response.status === true) {
                        showSuccesModal(response.response)
                        getProducts()
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


// Mostrar y actualizar la foto de perfil en el modal
const updateProductImageModal = async (id) => {
    await Swal.fire({
        title: "Actualizar foto del producto",
        input: "file",
        inputAttributes: {
            "accept": "image/*",
            "aria-label": "Actualizar foto del producto"
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
            if (value.size > 700 * 1024) {
                return "La imagen no debes pesar más de 700KB"
            }
            const img = new Image();
            img.src = URL.createObjectURL(value);
            return new Promise((resolve) => {
                img.onload = function () {
                    if (img.width > 900 || img.height > 900) {
                        resolve("La imagen no debe tener más de 900px de ancho y alto");
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
                console.log({
                    idProduct: id,
                    newImgProduct: e.target.result
                })
                console.log(e.target.result)
                fetch(`${RUTA}/productos/upimgproduct`, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify({
                        idProduct: id,
                        newImgProduct: e.target.result
                    })
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
                            imageAlt: "Nueva foto del producto",
                            confirmButtonText: "Aceptar",
                            confirmButtonColor: "#2367d5",
                        });
                        getProducts()
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


/***************
 *  LISTENERS  *
 ***************/
document.addEventListener("DOMContentLoaded", async () => {
    getProducts()
    categories = await getCategory()
})

document.addEventListener("click", e => {
    // Eliminar un producto
    if (e.target.matches(".card__action-btn.delete")) {
        deleteProductModal(e.target.dataset.id)
    }

    // Editar un producto (menos la imagen)
    else if (e.target.matches(".card__action-btn.edit")) {
        updateProductModal({
            productId: e.target.dataset.id,
            productName: e.target.dataset.name,
            productDescription: e.target.dataset.description,
            productPrice: e.target.dataset.price,
            categoryId: e.target.dataset.category
        })
    }

    // Editar laimagen del producto
    else if (e.target.matches(".card__figure__buttons-btn.editar")) {
        updateProductImageModal(e.target.dataset.id)
    }
})