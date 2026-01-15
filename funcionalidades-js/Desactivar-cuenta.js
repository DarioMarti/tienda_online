function desactivarCuenta(idUsuario) {

    fetch('../modelos/sesion/cerrar-sesion-usuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id_usuario=' + idUsuario
    })

}
