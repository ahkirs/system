const selectMunicipios = document.getElementById('municipio');
const selectParroquias = document.getElementById('parroquia')


// Rellenar el select con los municipios
const fillSelectMunicipios = (municipios) => {
    let options = ""
    municipios.forEach(municipio => {
        options += `<option value='${municipio.id_municipio}'>${municipio.nombre_municipio}</option>`
    });
    selectMunicipios.innerHTML = options;
}


// Rellenar el select con las parroquias
const fillSelectParroquias = (parroquias) => {
    if (parroquias.length > 0) {
        let options = ""

        parroquias.forEach(parroquia => {
            options += `<option value='${parroquia.id_parroquia}'>${parroquia.parroquia_city}</option>`
        });

        selectParroquias.innerHTML = options;
    }
    else {
        selectParroquias.innerHTML = `<option value='true' selected>No hay parroquias</option>`
    }
}


// Obtener lasparroquias
const getParroquias = async (idMunicipio) => {
    try {
        const peticion = await fetch(`${RUTA}/Ubicaciones/parroquias`, {
            method: "POST",
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify({
                code_municiple: idMunicipio
            })
        })

        if (peticion.ok) {
            const parroquias = await peticion.json()
            fillSelectParroquias(parroquias)
        } else {
            selectParroquias.innerHTML = `<option value=''>No se cargaron las parroquias</option>`
        }
    } catch (error) {
        console.log(error)
        selectParroquias.innerHTML = `<option value=''>No se cargaron las parroquias</option>`
    }
}

// Obtener los municipios
const getMunicipios = async () => {
    try {
        const peticion = await fetch(`${RUTA}/Ubicaciones/municipios`, {
            method: "POST",
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify({
                code_state: 2
            })
        })

        if (peticion.ok) {
            const municipios = await peticion.json()
            fillSelectMunicipios(municipios)
            getParroquias(selectMunicipios.value)
        } else {
            selectMunicipios.innerHTML = `<option value=''>No se cargaron los municipios</option>`
        }

    } catch (error) {
        console.log(error)
        selectMunicipios.innerHTML = `<option value=''>No se cargaron los municipios</option>`
    }
}




selectMunicipios.addEventListener('change', () => {
    getParroquias(selectMunicipios.value)
})

document.addEventListener('DOMContentLoaded', () => {
    getMunicipios()
})