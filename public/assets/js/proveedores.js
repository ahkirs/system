// Contenedor de las cards
const cardsSection = document.querySelector(".suppliers")



// Poner los datos de las estadisticas
const fillStadistics = (totalProveedores) => {
    const proveedoresTotales = document.getElementById("total-proveedores")
    proveedoresTotales.textContent = totalProveedores
}



// Card vacia cuando no hay suministros registrados y su hay error en la peticion
const emptyProviders = (text, type = "empty") => {
    const card = document.createElement("div")
    card.classList.add("empty__card")

    if (type === "error") card.classList.add("error")

    card.innerHTML = `
        <h2 class="empty__card-title">${text}</h2>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>
    `;

    cardsSection.appendChild(card)
}



// Ocultar las estadisticas cuando halla error al traer los datos
const hideStadistics = () => {
    const stadistics = document.querySelector(".stadistics")
    stadistics.style.display = "none"
    stadistics.style.visibility = "hidden"
}



// Creando las cards y poniendolas en el HTML
const createCards = (data) => {
    if (data.length > 0) {
        const fragment = document.createDocumentFragment()

        data.forEach(item => {
            const div = document.createElement("div")
            div.classList.add("card")

            div.innerHTML = `
                <header class="card__header">
                    <h2 class="card__header-name">${item.nombreProveedor}</h2>
                    <div class="card__header-clippy"></div>
                    <div class="card__header-clippy-shadow"></div>
                </header>
                <div class="card__texts">
                    <p class="card__texts__item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9.715 12c1.151 0 2-.849 2-2s-.849-2-2-2-2 .849-2 2 .848 2 2 2z"></path><path d="M20 4H4c-1.103 0-2 .841-2 1.875v12.25C2 19.159 2.897 20 4 20h16c1.103 0 2-.841 2-1.875V5.875C22 4.841 21.103 4 20 4zm0 14-16-.011V6l16 .011V18z"></path><path d="M14 9h4v2h-4zm1 4h3v2h-3zm-1.57 2.536c0-1.374-1.676-2.786-3.715-2.786S6 14.162 6 15.536V16h7.43v-.464z"></path></svg>
                        <span class="card__texts__item-title">RIF:</span>
                        <span class="card__texts__item-text">${item.rifProveedor}</span>
                    </p>

                    <p class="card__texts__item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M17.707 12.293a.999.999 0 0 0-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 0 0 0-1.414l-4-4a.999.999 0 0 0-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 0 0 0-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 0 0-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 0 0 .912-.271L17 14.414 19.586 17l-2.006 2.005z"></path></svg>
                        <span class="card__texts__item-title">Teléfono:</span>
                        <span class="card__texts__item-text">${item.telProveedor}</span>
                    </p>

                    <p class="card__texts__item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 6.223-8-6.222V6h16zM4 18V9.044l7.386 5.745a.994.994 0 0 0 1.228 0L20 9.044 20.002 18H4z"></path></svg>
                        <span class="card__texts__item-title">Correo:</span>
                        <span class="card__texts__item-text">${item.correoProveedor}</span>
                    </p>

                    <p class="card__texts__item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                        <span class="card__texts__item-title">Fecha de registro:</span>
                        <span class="card__texts__item-text">${item.fechaIngresoProvee}</span>
                    </p>

                    <p class="card__texts__item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364L12 23.7279ZM16.9497 15.9497C19.6834 13.2161 19.6834 8.78392 16.9497 6.05025C14.2161 3.31658 9.78392 3.31658 7.05025 6.05025C4.31658 8.78392 4.31658 13.2161 7.05025 15.9497L12 20.8995L16.9497 15.9497ZM12 13C10.8954 13 10 12.1046 10 11C10 9.89543 10.8954 9 12 9C13.1046 9 14 9.89543 14 11C14 12.1046 13.1046 13 12 13Z"></path></svg>
                        <span class="card__texts__item-title">Ubicación:</span>
                        <span class="card__texts__item-text">${item.direccionProveedor}</span>
                    </p>
                </div>
            `;

            fragment.appendChild(div)
        })

        cardsSection.appendChild(fragment)
    }

    else {
        emptyProviders("No hay proveedores registrados")
        hideStadistics()
    }
}






// Traer los datos del servidor
const getProviders = async () => {
    try {
        const peticion = await fetch(`${RUTA}/proveedores/listarSuppliers`)

        if (peticion.ok) {
            const response = await peticion.json()
            createCards(response.dataRegistro)
            fillStadistics(response.generalData.totalProveedores)
        } else {
            emptyProviders("Ocurrió un error al mostrar los datos", "error")
            hideStadistics()
        }
    } catch (error) {
        emptyProviders("Ocurrió un error al mostrar los datos", "error")
        hideStadistics()
        console.log(error)
    }
}


document.addEventListener("DOMContentLoaded", () => {
    getProviders()
})