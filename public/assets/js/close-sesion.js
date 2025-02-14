const closeSessionBtn = document.getElementById('close-sesion')

const closeSession = async () => {
    try {
        const peticion = await fetch(`${RUTA}/login/logout`)
        const res = await peticion.json()

        if (res.status === true) {
            window.location.href = `${RUTA}`
        }
        else {
            Lobibox.notify('error', {
                msg: "No se puedo cerrar sesion, intentelo nuevamente"
            });
        }
    } catch (error) {
        console.log(error)
        Lobibox.notify('error', {
            msg: "No se puedo cerrar sesion, intentelo nuevamente"
        });
    }
}

closeSessionBtn.addEventListener('click', () => {
    closeSession()
})