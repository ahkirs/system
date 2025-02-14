let CATEGORIES_ID = null

const getCategory = async () => {
    try {
        const peticion = await fetch(`${RUTA}/categorias/getcategory`)
        
        if (peticion.ok) {
            const response = await peticion.json()
            if (response.length > 0) return response
            return null
        } else {
            return false
        }
        
    } catch (error) {
        console.log(error)
        return false
    }
}

const getCategoryId = async () => {
    try {
        const peticion = await fetch(`${RUTA}/categorias/getidCategory`)
        
        if (peticion.ok) {
            const response = await peticion.json()
            console.log(response)
            CATEGORIES_ID = response
        } else {
            CATEGORIES_ID = false
        }
        
    } catch (error) {
        console.log(error)
        CATEGORIES_ID = false
    }
}

document.addEventListener("DOMContentLoaded", () => {
    getCategoryId()
})