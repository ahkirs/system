// Section
const section = document.querySelector(".table__section")
// Aqui se pegaran las rows en la tabla
const tableBody = document.getElementById("table-body")



// Inicializando a tabla
const initDataTable = () => {
    var dataTable = new DataTable('#myTable', {
        language: {
            search: "Buscar:",
            lengthMenu: "_MENU_ registros por pagina",
            zeroRecords: "No se encontraron registros",
            loadingRecords: "Buscando...",
            info: "Mostrando del _START_ al _END_ de _TOTAL_ registros",
            infoFiltered: "(filtrado de _MAX_ registros)",
            emptyTable: "No hay registros",
            infoEmpty: "",
        },
        // pageLength: 2,
        responsive: true,
    });
}



const showCardOnFetchError = () => {
    section.innerHTML = ""

    const card = document.createElement("div")
    card.classList.add("card__error")

    card.innerHTML = `
        <h2 class="card__error-title">Ocurrió un error al mostrar los datos</h2>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>
    `;

    section.appendChild(card)
}




// Creando las filas
const createRows = (data) => {
    if (data.length > 0) {
        const fragment = document.createDocumentFragment()

        data.forEach(item => {
            const row = document.createElement("tr")

            row.innerHTML = `
                <td>${item.nombreSuministro}</td>
                <td>${item.nombreProveedor}</td>
                <td>${item.fechaAbasto}</td>
                <td>${item.cantidadAbasto}</td>
                <td>${item.pagadoUsd}</td>
                <td>${item.pagadoBs}</td>
            `

            fragment.appendChild(row)
        })

        tableBody.innerHTML = ""
        tableBody.appendChild(fragment)
    }

    initDataTable()
}


// Obtener los datos del srervidr
const getPurchaseHistory = async () => {
    try {
        const peticion = await fetch(`${RUTA}/suministros/ShoppingList`)

        if (peticion.ok) {
            const response = await peticion.json()
            createRows(response)
        }
        else {
            showCardOnFetchError()
        }
    } catch (error) {
        console.log(error)
        showCardOnFetchError()
    }
}


document.addEventListener("DOMContentLoaded", () => {
    getPurchaseHistory()
})