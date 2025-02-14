const listarProviders = async () => {
    try {
        const peticion = await fetch(`${RUTA}/proveedores/getsupplier`)
        
        if (peticion.ok) {
            const response = await peticion.json()
            return response
        } else {
            return false
        }
        
    } catch (error) {
        console.log(error)
        return false
    }
}
